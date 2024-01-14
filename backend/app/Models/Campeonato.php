<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    use HasFactory;

    protected $table = 'campeonato';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nome', 
        'primeiro',
        'segundo',
        'terceiro',
        'quarto'
    ];
}
