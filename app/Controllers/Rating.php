<?php

namespace App\Controllers;

class Rating extends BaseController
{
    public function index($id)
    {
        return view('rating/create', [
            'id_pengaduan' => $id
        ]);
    }

    public function save()
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