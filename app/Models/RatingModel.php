<?php

namespace App\Models;
use CodeIgniter\Model;

class RatingModel extends Model
{
    protected $table = 'rating';
    protected $primaryKey = 'id_rating';

    protected $allowedFields = [
        'id_pengaduan',
        'id_user',
        'rating',
        'komentar',
        'created_at'
    ];
}
