<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    
    public function index()
    {
        
        $db = \Config\Database::connect();

        // Ambil semua pengaduan
        $pengaduan = $db->table('pengaduan')->get()->getResultArray();

        // Hitung status
        $diproses = $db->table('pengaduan')
            ->where('status', 'proses')
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

        return view('dashboard/index', $data);
    }
}