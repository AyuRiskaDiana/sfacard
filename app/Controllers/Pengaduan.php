<?php

namespace App\Controllers;

use App\Models\PengaduanModel;

class Pengaduan extends BaseController
{
    protected $pengaduan;

    public function __construct()
    {
        $this->pengaduan = new PengaduanModel();
    }

    // ================= FEEDBACK =================
    public function feedback($id)
    {
        $data['pengaduan'] = $this->pengaduan->find($id);

        // Ambil feedback jika sudah ada
        $feedbackModel = new \App\Models\FeedbackModel();
        $data['feedback'] = $feedbackModel->where('id_pengaduan', $id)->first();

        return view('pengaduan/feedback', $data);
    }

    public function saveFeedback()
    {
        $model = new \App\Models\FeedbackModel();

        $model->save([
            'id_pengaduan' => $this->request->getPost('id_pengaduan'),
            'isi_feedback' => $this->request->getPost('isi_feedback')
        ]);

        // otomatis ubah status
        $this->pengaduan->update(
            $this->request->getPost('id_pengaduan'),
            ['status' => 'selesai']
        );

        return redirect()->to('/pengaduan');
    }

    // ================= HISTORY =================
    public function history()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pengaduan');

        $builder->select('pengaduan.*, feedback.isi_feedback, users.nama, aspirasi.kategori');
        $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');
        $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
        $builder->join('aspirasi', 'aspirasi.id_aspirasi = pengaduan.id_aspirasi', 'left');

        // FILTER ROLE
        if (session()->get('role') != 'admin') {
            $builder->where('pengaduan.id_user', session()->get('id_user'));
        }

        // URUTKAN TERBARU
        $builder->orderBy('pengaduan.id_pengaduan', 'DESC');

        $data['pengaduan'] = $builder->get()->getResultArray();

        return view('pengaduan/history', $data);
    }

    public function index()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('pengaduan');

        $builder->select('pengaduan.*, users.nama, aspirasi.kategori, feedback.isi_feedback');

        $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
        $builder->join('aspirasi', 'aspirasi.id_aspirasi = pengaduan.id_aspirasi', 'left');
        $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');

        // 🔥 FIX: pastikan admin lihat semua
        if (session()->get('role') != 'admin') {
            $builder->where('pengaduan.id_user', session()->get('id_user'));
        }

        // ambil input filter
        $tanggal     = $this->request->getGet('tanggal');
        $bulan       = $this->request->getGet('bulan');
        $id_user     = $this->request->getGet('id_user');
        $id_aspirasi = $this->request->getGet('id_aspirasi');

        // FILTER (AMAN)
        if (!empty($tanggal)) {
            $builder->where('pengaduan.tanggal', $tanggal);
        }

        if (!empty($bulan)) {
            $builder->where("DATE_FORMAT(pengaduan.tanggal, '%Y-%m') =", $bulan);
        }

        // 🔥 FIX: hanya admin bisa filter user
        if (!empty($id_user) && session()->get('role') == 'admin') {
            $builder->like('users.nama', $id_user);
        }

        if (!empty($id_aspirasi)) {
            $builder->where('pengaduan.id_aspirasi', $id_aspirasi);
        }

        // 🔥 PENTING: group by biar tidak duplikat / hilang
        $builder->groupBy('pengaduan.id_pengaduan');

        $data['pengaduan'] = $builder->get()->getResultArray();

        $data['aspirasi'] = $db->table('aspirasi')->get()->getResultArray();

        return view('pengaduan/index', $data);
    }

    // ================= PRINT =================
    public function print()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pengaduan');

        $builder->select('pengaduan.*, users.nama, aspirasi.kategori, feedback.isi_feedback');
        $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
        $builder->join('aspirasi', 'aspirasi.id_aspirasi = pengaduan.id_aspirasi', 'left');
        $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');

        // Terapkan filter yang sama seperti di index
        $tanggal     = $this->request->getGet('tanggal');
        $bulan       = $this->request->getGet('bulan');
        $id_user     = $this->request->getGet('id_user');
        $id_aspirasi = $this->request->getGet('id_aspirasi');

        if (!empty($tanggal)) {
            $builder->where('pengaduan.tanggal', $tanggal);
        }

        if (!empty($bulan)) {
            $builder->where("DATE_FORMAT(pengaduan.tanggal, '%Y-%m') =", $bulan);
        }

        if (!empty($id_user) && session()->get('role') == 'admin') {
            $builder->like('users.nama', $id_user);
        }

        if (!empty($id_aspirasi)) {
            $builder->where('pengaduan.id_aspirasi', $id_aspirasi);
        }

        $builder->groupBy('pengaduan.id_pengaduan');
        $data['pengaduan'] = $builder->get()->getResultArray();

        return view('pengaduan/print', $data);
    }

    // ================= CREATE =================
    public function create()
    {
        $db = \Config\Database::connect();
        $data['aspirasi'] = $db->table('aspirasi')->get()->getResultArray();

        return view('pengaduan/create', $data);
    }

    // ================= STORE =================
    public function store()
    {
        $db = \Config\Database::connect();

        // NOTIF KE ADMIN
        $admin = $db->table('users')->where('role', 'admin')->get()->getResultArray();

        foreach ($admin as $a) {
            $db->table('notifikasi')->insert([
                'id_user' => $a['id_user'],
                'pesan'   => 'Ada pengaduan baru dari user',
            ]);
        }

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFoto = $file->getRandomName();
            $file->move('uploads/', $namaFoto);
        } else {
            $namaFoto = null;
        }

        $this->pengaduan->save([
            'id_user'     => session()->get('id_user'),
            'judul'       => $this->request->getPost('judul'),
            'foto'        => $namaFoto,
            'lokasi'      => $this->request->getPost('lokasi'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'tanggal'     => $this->request->getPost('tanggal'),
            'status'      => 'menunggu',
            'id_aspirasi' => $this->request->getPost('id_aspirasi')
        ]);

        session()->setFlashdata('success', 'Aspirasi berhasil dikirim!');

        return redirect()->to('/pengaduan/create');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/dashboard');
        }

        $data['pengaduan'] = $this->pengaduan->find($id);
        return view('pengaduan/edit', $data);
    }

    // ================= UPDATE =================
    public function update($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/dashboard');
        }

        $db = \Config\Database::connect();

        // ambil user
        $pengaduan = $db->table('pengaduan')
            ->where('id_pengaduan', $id)
            ->get()
            ->getRowArray();

        // NOTIF KE USER
        $db->table('notifikasi')->insert([
            'id_user' => $pengaduan['id_user'],
            'pesan'   => 'Status pengaduan anda telah diperbarui',
        ]);

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFoto = $file->getRandomName();
            $file->move('uploads/', $namaFoto);
        } else {
            $namaFoto = $this->request->getPost('foto_lama');
        }

        $this->pengaduan->update($id, [
            'judul'     => $this->request->getPost('judul'),
            'foto'      => $namaFoto,
            'lokasi'    => $this->request->getPost('lokasi'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'status'    => $this->request->getPost('status')
        ]);

        return redirect()->to('/pengaduan');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/dashboard');
        }

        $this->pengaduan->delete($id);
        return redirect()->to('/pengaduan');
    }
}
