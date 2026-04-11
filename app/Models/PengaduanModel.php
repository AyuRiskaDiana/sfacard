<?php

namespace App\Models;
use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';

    protected $allowedFields = [
    'id_user',
    'judul',
    'foto',
    'lokasi',
    'deskripsi',
    'tanggal',
    'status'
];
}