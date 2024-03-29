<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $table = 'times';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nome', 
        'pontos',
        'classifica',
        'usu_criacao'
    ];

}
