<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{

    public function index()
    {

        $db = \Config\Database::connect();

        // Ambil semua pengaduan dengan join user
        $builder = $db->table('pengaduan');
        $builder->select('pengaduan.*, users.nama');
        $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
        $builder->orderBy('pengaduan.id_pengaduan', 'DESC');
        $pengaduan = $builder->get()->getResultArray();

        // Hitung status
        $diproses = $db->table('pengaduan')
            ->whereIn('status', ['proses', 'diproses'])
            ->countAllResults();

        $selesai = $db->table('pengaduan')
            ->where('status', 'selesai')
            ->countAllResults();

        // Total user
        $total_user = $db->table('users')->countAllResults();

        $data = [
            'pengaduan'   => $pengaduan,
            'diproses'    => $diproses,
            'selesai'     => $selesai,
            'total_user'  => $total_user
        ];

        return view('layouts/dashboard', $data);
    }
}
