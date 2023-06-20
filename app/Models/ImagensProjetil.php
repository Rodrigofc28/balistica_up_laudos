<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagensProjetil extends Model
{
    protected $table = 'imagensprojetil';

    protected $fillable = ['nome', 'projetil_id'];

    public $timestamps = false;

    
}