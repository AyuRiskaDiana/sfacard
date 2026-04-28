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

        $id_pengaduan = $this->request->getPost('id_pengaduan');
        $progres      = $this->request->getPost('progres');
        $tindakan     = $this->request->getPost('tindakan');
        $biaya        = $this->request->getPost('biaya');

        // feedback pakai trim agar spasi kosong tidak tersimpan
        $feedback = trim($this->request->getPost('feedback'));

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFoto = $file->getRandomName();
            $file->move('uploads/', $namaFoto);
        } else {
            $namaFoto = null;
        }

        // simpan progres
        $db->table('progres_pengaduan')->insert([
            'id_pengaduan' => $id_pengaduan,
            'tanggal'      => date('Y-m-d H:i:s'),
            'progres'      => $progres,
            'tindakan'     => $tindakan,
            'foto'         => $namaFoto,
            'biaya'        => $biaya,
        ]);

        // simpan feedback jika diisi
        if (!empty($feedback)) {
            $db->table('feedback')->insert([
                'id_pengaduan' => $id_pengaduan,
                'isi_feedback' => $feedback
            ]);
        }

       // otomatis ubah status berdasarkan progres
if ($progres >= 100) {
    $status = 'selesai';
} else {
    $status = 'proses';
}

$db->table('pengaduan')
    ->where('id_pengaduan', $id_pengaduan)
    ->update([
        'status' => $status
    ]);

return redirect()->to('/pengaduan')
    ->with('success', 'Progres berhasil ditambahkan');
}
}