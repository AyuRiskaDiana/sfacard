<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table      = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';

    protected $allowedFields = ['id_user', 'pesan', 'is_read'];

    protected $useTimestamps = false;
}