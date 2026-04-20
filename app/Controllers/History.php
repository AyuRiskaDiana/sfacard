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

        $builder->select('pengaduan.*, feedback.isi_feedback,users.nama,kategori.nama as kategori');
        $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');
        $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
        $builder->join('kategori', 'kategori.id_aspirasi = pengaduan.id_aspirasi', 'left');

        // admin lihat semua
        if (session()->get('role') == 'admin') {
        }
        // siswa/guru hanya miliknya
        else {
            $builder->where('id_user', session()->get('id_user'));
        }

        $data['pengaduan'] = $builder->get()->getResultArray();

        return view('pengaduan/history', $data);
    }
}
