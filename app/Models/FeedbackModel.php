<?php

namespace App\Models;
use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id_feedback';

    protected $allowedFields = [
        'id_pengaduan',
        'isi_feedback',
        'tanggal'
    ];
}