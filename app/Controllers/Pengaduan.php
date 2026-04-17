<?php

namespace App\Controllers;

use App\Models\PengaduanModel;
use App\Models\FeedbackModel;

class Pengaduan extends BaseController
{
    public function feedback($id)
{
    $data['pengaduan'] = $this->pengaduan->find($id);

    return view('pengaduan/feedback', $data);
}

public function saveFeedback()
{
    $model = new \App\Models\FeedbackModel();

    $model->save([
        'id_pengaduan' => $this->request->getPost('id_pengaduan'),
        'isi_feedback' => $this->request->getPost('isi_feedback')
    ]);

    // otomatis selesai
    $this->pengaduan->update(
        $this->request->getPost('id_pengaduan'),
        ['status' => 'selesai']
    );

    return redirect()->to('/pengaduan');
}

public function history()
{
    $db = \Config\Database::connect();
    $builder = $db->table('pengaduan');
    $builder->select('pengaduan.*, feedback.isi_feedback');
    $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');

    // jika admin
    if(session()->get('role') == 'admin'){
        $builder->where('pengaduan.status', 'selesai');
    }
    //  jika siswa / guru
    else{
        $builder->where('pengaduan.id_user', session()->get('id_user'));
        $builder->where('pengaduan.status', 'selesai');
    }

    $data['pengaduan'] = $builder->get()->getResultArray();

    return view('pengaduan/history', $data);
}
    protected $pengaduan;

    public function __construct()
    {
        $this->pengaduan = new PengaduanModel();
    }

  public function index()
{
    $db = \Config\Database::connect();
    $builder = $db->table('pengaduan');

    $builder->select('pengaduan.*, users.nama, aspirasi.kategori, feedback.isi_feedback');

    $builder->join('users', 'users.id_user = pengaduan.id_user', 'left');
    $builder->join('aspirasi', 'aspirasi.id_aspirasi = pengaduan.id_aspirasi', 'left');
    $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');

    // 🔥 ROLE FILTER (INI YANG DIPERBAIKI)
    if(session()->get('role') != 'admin'){
        $builder->where('pengaduan.id_user', session()->get('id_user'));
    }

    // 🔥 AMBIL DATA FILTER
    $tanggal      = $this->request->getGet('tanggal');
    $bulan        = $this->request->getGet('bulan');
    $id_user      = $this->request->getGet('id_user');
    $id_aspirasi  = $this->request->getGet('id_aspirasi');

    // 🔥 FILTER TANGGAL
    if(!empty($tanggal)){
        $builder->where('pengaduan.tanggal', $tanggal);
    }

    // 🔥 FILTER BULAN
    if(!empty($bulan)){
        $builder->like('pengaduan.tanggal', $bulan, 'after');
    }

    // 🔥 FILTER SISWA (khusus admin)
    if(!empty($id_user) && session()->get('role') == 'admin'){
        $builder->where('pengaduan.id_user', $id_user);
    }

    // 🔥 FILTER KATEGORI
    if(!empty($id_aspirasi)){
        $builder->where('pengaduan.id_aspirasi', $id_aspirasi);
    }

    $data['pengaduan'] = $builder->get()->getResultArray();

    // dropdown kategori
    $data['aspirasi'] = $db->table('aspirasi')->get()->getResultArray();

    return view('pengaduan/index', $data);
}
   public function create()
{
    $db = \Config\Database::connect();

    $data['aspirasi'] = $db->table('aspirasi')->get()->getResultArray();

    return view('pengaduan/create', $data);
    
}
public function delete($id)
{
    if(session()->get('role') != 'admin'){
        return redirect()->to('/dashboard');
    }

    $this->pengaduan->delete($id);
    return redirect()->to('/pengaduan');
}

public function edit($id)
{
    if(session()->get('role') != 'admin'){
        return redirect()->to('/dashboard');
    }

    $data['pengaduan'] = $this->pengaduan->find($id);
    return view('pengaduan/edit', $data);
}


public function update($id)
{
    if(session()->get('role') != 'admin'){
        return redirect()->to('/dashboard');
    }

    $file = $this->request->getFile('foto');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        // upload foto baru
        $namaFoto = $file->getRandomName();
        $file->move('uploads/', $namaFoto);
    } else {
        // pakai foto lama
        $namaFoto = $this->request->getPost('foto_lama');
    }

    $this->pengaduan->update($id, [
        'judul'     => $this->request->getPost('judul'),
        'foto'      => $namaFoto,
        'lokasi'    => $this->request->getPost('lokasi'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'tanggal'   => $this->request->getPost('tanggal'),
        'status'    => $this->request->getPost('status')
    ]);

    return redirect()->to('/pengaduan');
}

   public function store()
{
    $file = $this->request->getFile('foto');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaFoto = $file->getRandomName();
        $file->move('uploads/', $namaFoto);
    } else {
        $namaFoto = null;
    }

    $this->pengaduan->save([
        'id_user'   => session()->get('id_user'),
        'judul'     => $this->request->getPost('judul'),
        'foto'      => $namaFoto,
        'lokasi'    => $this->request->getPost('lokasi'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'tanggal'   => $this->request->getPost('tanggal'),
        'status'    => 'menunggu',
        'kategori' => $this->request->getPost('kategori')
    ]);
    session()->setFlashdata('success', 'Aspirasi telah dikirim!!');
    
return redirect()->to('/pengaduan/create'); // BALIK KE CREATE    
    
}
}




