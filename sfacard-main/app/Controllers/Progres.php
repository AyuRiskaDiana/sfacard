<?php

namespace App\Controllers;

class Progres extends BaseController
{
    public function create($id_pengaduan)
    {
        return view('progres/create', [
            'id_pengaduan' => $id_pengaduan
        ]);
    }

    public function store()
    {
        $db = \Config\Database::connect();

        // DEBUG (hapus nanti)
        // dd($this->request->getPost());

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFoto = $file->getRandomName();
            $file->move('uploads/', $namaFoto);
        } else {
            $namaFoto = null;
        }

        $db->table('progres_pengaduan')->insert([
            'id_pengaduan' => $this->request->getPost('id_pengaduan'),
            'tanggal'      => date('Y-m-d H:i:s'), // 🔥 WAJIB
            'progres'      => $this->request->getPost('progres'),
            'tindakan'     => $this->request->getPost('tindakan'),
            'foto'         => $namaFoto,
            'biaya'        => $this->request->getPost('biaya'),
        ]);

        return redirect()->to('/pengaduan')->with('success', 'Progres berhasil ditambahkan');
    }
}