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
        $model = new \App\Models\FeedbackModel();

        $model->save([
            'id_pengaduan' => $this->request->getPost('id_pengaduan'),
            'isi_feedback' => $this->request->getPost('isi_feedback')
        ]);

        // ubah status otomatis
        $this->pengaduan->update(
            $this->request->getPost('id_pengaduan'),
            ['status' => 'selesai']
        );

        return redirect()->to('/pengaduan');
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

        $builder->select('pengaduan.*, 
                          users.nama, 
                          aspirasi.kategori, 
                          feedback.isi_feedback');

        $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
        $builder->join('aspirasi', 'aspirasi.id_aspirasi = pengaduan.id_aspirasi', 'left');
        $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');

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