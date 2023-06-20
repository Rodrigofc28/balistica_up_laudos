<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagensMunicoes extends Model
{
    protected $table = 'imagensmunicoes';

    protected $fillable = ['nome', 'municao_id'];

    public $timestamps = false;

    
}