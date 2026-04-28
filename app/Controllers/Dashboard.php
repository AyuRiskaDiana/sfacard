<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    // ===================================
    // Klik notifikasi → hapus notif
    // ===================================
    public function readNotif($id)
    {
        $db = \Config\Database::connect();

        $db->table('notifikasi')
            ->where('id_notifikasi', $id)
            ->delete();

        return redirect()->to('/pengaduan');
    }

    // ===================================
    // DASHBOARD
    // ===================================
    public function index()
    {
        $db = \Config\Database::connect();

        // ===================================
        // 🔔 NOTIFIKASI (KHUSUS ADMIN SAJA)
        // ===================================
        $notifikasi = [];

        if (session()->get('role') == 'admin') {

            // jika ada pengaduan baru status menunggu
            $cekPengaduanBaru = $db->table('pengaduan')
                ->where('status', 'menunggu')
                ->countAllResults();

            // jika ada dan notif belum ada → insert notif otomatis
            if ($cekPengaduanBaru > 0) {

                $cekNotif = $db->table('notifikasi')
                    ->where('pesan', 'Ada pengaduan baru dari user')
                    ->where('status', 'baru')
                    ->countAllResults();

                if ($cekNotif == 0) {
                    $db->table('notifikasi')->insert([
                        'id_user' => session()->get('id_user'),
                        'pesan'   => 'Ada pengaduan baru dari user',
                        'status'  => 'baru'
                    ]);
                }
            }

            // ambil notifikasi admin
            $notifikasi = $db->table('notifikasi')
                ->where('id_user', session()->get('id_user'))
                ->where('status', 'baru')
                ->orderBy('id_notifikasi', 'DESC')
                ->get()
                ->getResultArray();
        }

        // ===================================
        // DATA PENGADUAN
        // ===================================
        $builder = $db->table('pengaduan');

        $builder->select("
            pengaduan.*,
            users.nama
        ");

        $builder->join(
            'users',
            'users.id_user = pengaduan.id_user',
            'left'
        );

        // user biasa hanya lihat data sendiri
        if (session()->get('role') != 'admin') {
            $builder->where(
                'pengaduan.id_user',
                session()->get('id_user')
            );
        }

        $builder->orderBy(
            'pengaduan.id_pengaduan',
            'DESC'
        );

        $pengaduan = $builder->get()->getResultArray();

        // ===================================
        // CARD STATISTIK ADMIN
        // ===================================
        $diproses = 0;
        $selesai = 0;
        $ditolak = 0;
        $total_user = 0;

        if (session()->get('role') == 'admin') {

            $diproses = $db->table('pengaduan')
                ->whereIn('status', ['proses', 'diproses'])
                ->countAllResults();

            $selesai = $db->table('pengaduan')
                ->where('status', 'selesai')
                ->countAllResults();

            $ditolak = $db->table('pengaduan')
                ->where('status', 'ditolak')
                ->countAllResults();

            $total_user = $db->table('users')
                ->where('role !=', 'admin')
                ->countAllResults();
        }

        // ===================================
        // 📊 GRAFIK BULANAN
        // ===================================
        $grafikBuilder = $db->table('pengaduan');

        $grafikBuilder->select("
            MONTHNAME(tanggal) as bulan,
            MONTH(tanggal) as urutan_bulan,

            SUM(
                CASE
                    WHEN status = 'menunggu'
                    THEN 1 ELSE 0
                END
            ) as menunggu,

            SUM(
                CASE
                    WHEN status IN ('proses', 'diproses')
                    THEN 1 ELSE 0
                END
            ) as diproses,

            SUM(
                CASE
                    WHEN status = 'selesai'
                    THEN 1 ELSE 0
                END
            ) as selesai,

            SUM(
                CASE
                    WHEN status = 'ditolak'
                    THEN 1 ELSE 0
                END
            ) as ditolak
        ");

        if (session()->get('role') != 'admin') {
            $grafikBuilder->where(
                'id_user',
                session()->get('id_user')
            );
        }

        $grafikBuilder->groupBy("MONTH(tanggal)");
        $grafikBuilder->orderBy("MONTH(tanggal)", "ASC");

        $grafik = $grafikBuilder
            ->get()
            ->getResultArray();

        $bulan = [];
        $menungguArr = [];
        $diprosesArr = [];
        $selesaiArr = [];
        $ditolakArr = [];

        foreach ($grafik as $g) {
            $bulan[]       = $g['bulan'];
            $menungguArr[] = (int) $g['menunggu'];
            $diprosesArr[] = (int) $g['diproses'];
            $selesaiArr[]  = (int) $g['selesai'];
            $ditolakArr[]  = (int) $g['ditolak'];
        }

        // ===================================
        // KIRIM DATA KE VIEW
        // ===================================
        $data = [
            'pengaduan'     => $pengaduan,
            'diproses'      => $diproses,
            'selesai'       => $selesai,
            'ditolak'       => $ditolak,
            'total_user'    => $total_user,
            'notifikasi'    => $notifikasi,

            'bulan'         => $bulan,
            'menungguArr'   => $menungguArr,
            'diprosesArr'   => $diprosesArr,
            'selesaiArr'    => $selesaiArr,
            'ditolakArr'    => $ditolakArr
        ];

        return view('layouts/dashboard', $data);
    }
}