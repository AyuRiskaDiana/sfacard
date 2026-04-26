<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{

    // 🔔 klik notif → hapus notifikasi & redirect ke laporan
    public function readNotif($id)
    {
        $db = \Config\Database::connect();

        $db->table('notifikasi')
            ->where('id_notifikasi', $id)
            ->delete();

        return redirect()->to('/pengaduan/print');
    }

    public function index()
    {
        $db = \Config\Database::connect();

        // =======================
        // 🔔 NOTIFIKASI (FIX)
        // =======================
        $notifikasi = $db->table('notifikasi')
            ->where('id_user', session()->get('id_user'))
            ->where('status', 'baru') // 🔥 penting
            ->orderBy('id_notifikasi', 'DESC')
            ->get()
            ->getResultArray();

        // =======================
        // DATA PENGADUAN
        // =======================
        $builder = $db->table('pengaduan');
        $builder->select('pengaduan.*, users.nama');
        $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');

        if (session()->get('role') != 'admin') {
            $builder->where('pengaduan.id_user', session()->get('id_user'));
        }

        $builder->orderBy('pengaduan.id_pengaduan', 'DESC');
        $pengaduan = $builder->get()->getResultArray();

        // =======================
        // HITUNG STATUS
        // =======================
        $diproses = $db->table('pengaduan')
            ->whereIn('status', ['proses', 'diproses'])
            ->countAllResults();

        $selesai = $db->table('pengaduan')
            ->where('status', 'selesai')
            ->countAllResults();

        // =======================
        // TOTAL USER
        // =======================
        $total_user = $db->table('users')->countAllResults();

        // =======================
        // 📊 GRAFIK
        // =======================
        $grafikBuilder = $db->table('pengaduan');

        if (session()->get('role') != 'admin') {
            $grafikBuilder->where('id_user', session()->get('id_user'));
        }

        $grafik = $grafikBuilder
            ->select("tanggal,
                SUM(status='menunggu') as menunggu,
                SUM(status='diproses' OR status='proses') as diproses,
                SUM(status='selesai') as selesai")
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get()->getResultArray();

        $tanggal = [];
        $menunggu = [];
        $diprosesArr = [];
        $selesaiArr = [];

        foreach ($grafik as $g) {
            $tanggal[]      = $g['tanggal'];
            $menunggu[]     = (int)$g['menunggu'];
            $diprosesArr[]  = (int)$g['diproses'];
            $selesaiArr[]   = (int)$g['selesai'];
        }

        // =======================
        // KIRIM KE VIEW (FIX)
        // =======================
        $data = [
            'pengaduan'   => $pengaduan,
            'diproses'    => $diproses,
            'selesai'     => $selesai,
            'total_user'  => $total_user,
            'notifikasi'  => $notifikasi, // 🔥 FIX DI SINI

            'tanggal'     => $tanggal,
            'menunggu'    => $menunggu,
            'diprosesArr' => $diprosesArr,
            'selesaiArr'  => $selesaiArr
        ];

        return view('layouts/dashboard', $data);
    }
}