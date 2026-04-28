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

    
public function edit($id)
{
    if (session()->get('role') != 'admin') {
        return redirect()->to('/dashboard');
    }

    $data['pengaduan'] = $this->pengaduan->find($id);

    if (!$data['pengaduan']) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pengaduan tidak ditemukan');
    }

    return view('pengaduan/edit', $data);
}

public function update($id)
{
    if (session()->get('role') != 'admin') {
        return redirect()->to('/dashboard');
    }

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

    return redirect()->to('/pengaduan')
        ->with('success', 'Data berhasil diupdate');
}
    public function delete($id)
{
    // hanya admin yang boleh hapus
    if (session()->get('role') != 'admin') {
        return redirect()->to('/dashboard');
    }

    // ambil data pengaduan
    $data = $this->pengaduan->find($id);

    // hapus foto jika ada
    if ($data && !empty($data['foto'])) {
        $path = FCPATH . 'uploads/' . $data['foto'];

        if (file_exists($path)) {
            unlink($path);
        }
    }

    // hapus data dari database
    $this->pengaduan->delete($id);

    return redirect()->to('/pengaduan')
        ->with('success', 'Data pengaduan berhasil dihapus');
}

public function tolak($id)
{
    if (session()->get('role') != 'admin') {
        return redirect()->to('/dashboard');
    }

    $data['pengaduan'] = $this->pengaduan->find($id);

    if (!$data['pengaduan']) {
        return redirect()->to('/pengaduan')
            ->with('error', 'Data tidak ditemukan');
    }

    return view('pengaduan/tolak', $data);
}

public function simpanPenolakan()
{
    $db = \Config\Database::connect();

    $id_pengaduan = $this->request->getPost('id_pengaduan');
    $alasan = $this->request->getPost('alasan_penolakan');

    // ambil data pengaduan
    $pengaduan = $db->table('pengaduan')
        ->where('id_pengaduan', $id_pengaduan)
        ->get()
        ->getRowArray();

    if (!$pengaduan) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    // simpan penolakan
    $db->table('penolakan')->insert([
        'id_pengaduan' => $id_pengaduan,
        'alasan_penolakan' => $alasan,
        'tanggal_penolakan' => date('Y-m-d H:i:s'),
        'id_admin' => session()->get('id_user')
    ]);

    // update status pengaduan
    $db->table('pengaduan')
        ->where('id_pengaduan', $id_pengaduan)
        ->update([
            'status' => 'ditolak'
        ]);

    // hapus feedback lama
    $db->table('feedback')
        ->where('id_pengaduan', $id_pengaduan)
        ->delete();

    return redirect()->to('/pengaduan')
        ->with('success', 'Pengaduan berhasil ditolak');
}
   public function store()
{
    $db = \Config\Database::connect();

    $file = $this->request->getFile('foto');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaFoto = $file->getRandomName();
        $file->move('uploads/', $namaFoto);
    } else {
        $namaFoto = null;
    }

    // simpan pengaduan
    $this->pengaduan->save([
        'id_user'     => session()->get('id_user'),
        'id_aspirasi' => $this->request->getPost('id_aspirasi'),
        'judul'       => $this->request->getPost('judul'),
        'lokasi'      => $this->request->getPost('lokasi'),
        'deskripsi'   => $this->request->getPost('deskripsi'),
        'tanggal'     => $this->request->getPost('tanggal'),
        'foto'        => $namaFoto,
        'status'      => 'menunggu'
    ]);

    // ambil semua admin
    $adminList = $db->table('users')
        ->where('role', 'admin')
        ->get()
        ->getResultArray();

    // kirim notif ke semua admin
    foreach ($adminList as $admin) {
        $db->table('notifikasi')->insert([
            'id_user' => $admin['id_user'],
            'pesan'   => 'Ada pengaduan baru dari user: ' . session()->get('nama'),
            'status'  => 'baru'
        ]);
    }

    return redirect()->to('/pengaduan')
        ->with('success', 'Pengaduan berhasil ditambahkan');
}
    public function create()
{
    $db = \Config\Database::connect();

    $data['aspirasi'] = $db->table('aspirasi')
        ->get()
        ->getResultArray();

    return view('pengaduan/create', $data);
}
    // ================= FEEDBACK =================
    public function feedback($id)
    {
        $data['pengaduan'] = $this->pengaduan->find($id);

        $feedbackModel = new \App\Models\FeedbackModel();
        $data['feedback'] = $feedbackModel->where('id_pengaduan', $id)->first();

        return view('pengaduan/feedback', $data);
    }

    public function saveFeedback()
{
    $db = \Config\Database::connect();

    $id_pengaduan = $this->request->getPost('id_pengaduan');
    $isi_feedback = $this->request->getPost('isi_feedback');

    // simpan ke tabel feedback
    $feedbackModel = new \App\Models\FeedbackModel();
    $feedbackModel->save([
        'id_pengaduan' => $id_pengaduan,
        'isi_feedback' => $isi_feedback
    ]);

    // simpan juga ke progres_pengaduan
    $db->table('progres_pengaduan')->insert([
        'id_pengaduan' => $id_pengaduan,
        'tindakan'     => 'Feedback: ' . $isi_feedback,
        'progres'      => 90,
        'tanggal'      => date('Y-m-d')
    ]);

    // TIDAK otomatis selesai
    // status tetap diproses

    return redirect()->to('/pengaduan')
        ->with('success', 'Feedback berhasil disimpan');
}

    // ================= PRINT =================
    public function print()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pengaduan');

        $builder->select('pengaduan.*, 
                          feedback.isi_feedback, 
                          users.nama, 
                          aspirasi.kategori');

        $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');
        $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
        $builder->join('aspirasi', 'aspirasi.id_aspirasi = pengaduan.id_aspirasi', 'left');

        if (session()->get('role') != 'admin') {
            $builder->where('pengaduan.id_user', session()->get('id_user'));
        }

        $builder->orderBy('pengaduan.id_pengaduan', 'DESC');

        $data['pengaduan'] = $builder->get()->getResultArray();

        return view('pengaduan/print', $data);
    }

    // ================= HISTORY =================
    public function history()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pengaduan');

        $builder->select('pengaduan.*, users.nama, aspirasi.kategori, feedback.isi_feedback');
        $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
        $builder->join('aspirasi', 'aspirasi.id_aspirasi = pengaduan.id_aspirasi', 'left');
        $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');

        if (session()->get('role') != 'admin') {
            $builder->where('pengaduan.id_user', session()->get('id_user'));
        }

        $builder->orderBy('pengaduan.id_pengaduan', 'DESC');

        $pengaduan = $builder->get()->getResultArray();

        $allProgres = $db->table('progres_pengaduan')
            ->orderBy('tanggal', 'ASC')
            ->get()->getResultArray();

        $progres = [];
        foreach ($allProgres as $pr) {
            $progres[$pr['id_pengaduan']][] = $pr;
        }

        return view('pengaduan/history', [
            'pengaduan' => $pengaduan,
            'progres'   => $progres,
            'notifikasi'=> []
        ]);
    }

    // ================= INDEX =================
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pengaduan');

       $builder->select('
    pengaduan.*,
    users.nama,
    aspirasi.kategori,
    feedback.isi_feedback,
    penolakan.alasan_penolakan
');

        $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
        $builder->join('aspirasi', 'aspirasi.id_aspirasi = pengaduan.id_aspirasi', 'left');
        $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');
        $builder->join('penolakan', 'penolakan.id_pengaduan = pengaduan.id_pengaduan', 'left');

        if (session()->get('role') != 'admin') {
            $builder->where('pengaduan.id_user', session()->get('id_user'));
        }

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
        $data['aspirasi'] = $db->table('aspirasi')->get()->getResultArray();

        return view('pengaduan/index', $data);
    }
}