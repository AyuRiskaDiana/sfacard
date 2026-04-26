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

  public function history()
{
    $db = \Config\Database::connect();

    $builder = $db->table('pengaduan');

    $builder->select('pengaduan.*, feedback.isi_feedback, users.nama, aspirasi.kategori, rating.rating, rating.komentar');
    $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');
    $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
    $builder->join('aspirasi', 'aspirasi.id_aspirasi = pengaduan.id_aspirasi', 'left');
    $builder->join('rating', 'rating.id_pengaduan = pengaduan.id_pengaduan', 'left');

    // filter user
    if (session()->get('role') != 'admin') {
        $builder->where('pengaduan.id_user', session()->get('id_user'));
    }

    $builder->orderBy('pengaduan.id_pengaduan', 'DESC');

    // 🔥 ambil data pengaduan (HANYA SEKALI)
    $pengaduan = $builder->get()->getResultArray();

    // 🔥 ambil semua progres
    $allProgres = $db->table('progres_pengaduan')
        ->orderBy('tanggal', 'ASC')
        ->get()->getResultArray();

    // 🔥 kelompokkan progres berdasarkan id_pengaduan
    $progres = [];
    foreach ($allProgres as $pr) {
        $progres[$pr['id_pengaduan']][] = $pr;
    }

    // 🔥 kirim ke view
    $data = [
        'pengaduan' => $pengaduan,
        'progres'   => $progres,
        'notifikasi'=> []
    ];

    return view('pengaduan/history', $data);
}
    public function saveRating()
    {
        $db = \Config\Database::connect();

        $db->table('rating')->insert([
            'id_pengaduan' => $this->request->getPost('id_pengaduan'),
            'id_user'      => session()->get('id_user'),
            'rating'       => $this->request->getPost('rating'),
            'komentar'     => $this->request->getPost('komentar') ?? null,
        ]);

        session()->setFlashdata('success', 'Terima kasih atas penilaian Anda');
        return redirect()->to('/pengaduan/history');
    }
    }