<?php

namespace App\Controllers;

use App\Models\PengaduanModel;
use App\Models\FeedbackModel;

class Pengaduan extends BaseController
{
    public function feedback($id)
{
    if(session()->get('role') != 'admin'){
        return redirect()->to('/dashboard');
    }

    $data['pengaduan'] = $this->pengaduan->find($id);

    return view('pengaduan/feedback', $data);
}


public function saveFeedback()
{
    if(session()->get('role') != 'admin'){
        return redirect()->to('/dashboard');
    }

    $feedback = new \App\Models\FeedbackModel();

    $id_pengaduan = $this->request->getPost('id_pengaduan');

    // simpan feedback
    $feedback->save([
        'id_pengaduan' => $id_pengaduan,
        'isi_feedback' => $this->request->getPost('isi_feedback'),
        'tanggal' => date('Y-m-d')
    ]);

    // 🔥 update status otomatis jadi selesai
    $this->pengaduan->update($id_pengaduan, [
        'status' => 'selesai'
    ]);

    return redirect()->to('/pengaduan');
}

public function history()
{
    $db = \Config\Database::connect();
    $builder = $db->table('pengaduan');
    $builder->select('pengaduan.*, feedback.isi_feedback');
    $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');

    // 👉 jika admin
    if(session()->get('role') == 'admin'){
        $builder->where('pengaduan.status', 'selesai');
    }
    // 👉 jika siswa / guru
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
    if(session()->get('role') != 'admin'){
        return redirect()->to('/dashboard');
    }

    $db = \Config\Database::connect();

    $builder = $db->table('pengaduan');
    $builder->select('pengaduan.*, feedback.isi_feedback');
    $builder->join('feedback', 'feedback.id_pengaduan = pengaduan.id_pengaduan', 'left');

    $query = $builder->get();

    $data['pengaduan'] = $query->getResultArray();

    return view('pengaduan/index', $data);
}
    public function create()
    {
        return view('pengaduan/create');
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
        'status'    => 'menunggu'
        
    ]);
    
    return redirect()->to('/pengaduan');
    
    
}
}




