<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagemEmbalagem extends Model
{
    protected $table = 'imagensembalagem';

    protected $fillable = ['nome','laudo_id'];

    public $timestamps = false;

    
}