<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pengaduan');
        $builder->select('pengaduan.*, users.nama, aspirasi.kategori, feedback.isi_feedback');
        $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
        $builder->join('aspirasi', 'aspirasi.id_aspirasi = pengaduan.id_aspirasi', 'left');
        $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');

        // Ambil semua pengaduan
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
