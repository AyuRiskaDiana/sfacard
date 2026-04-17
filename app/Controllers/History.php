<?php

namespace App\Controllers;

use App\Models\PengaduanModel;
use App\Models\FeedbackModel;

class Pengaduan extends BaseController
{    protected $pengaduan;

    public function __construct()
    {       
        $this->pengaduan = new PengaduanModel();
    }

public function history()
{
    $db = \Config\Database::connect();
    $builder = $db->table('pengaduan');

    $builder->select('pengaduan.*, feedback.isi_feedback');
    $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');

    // admin lihat semua
    if(session()->get('role') == 'admin'){
        $builder->where('status', 'selesai');
    } 
    // siswa/guru hanya miliknya
    else {
        $builder->where('id_user', session()->get('id_user'));
        $builder->where('status', 'selesai');
    }

    $data['pengaduan'] = $builder->get()->getResultArray();

    return view('pengaduan/history', $data);
}
}