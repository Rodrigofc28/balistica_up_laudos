<?php

namespace App\Models\ChassiDate;

use Illuminate\Database\Eloquent\Model;

class Chassi extends Model
{
    protected $table = 'veiculo';
    protected $fillable = ['veiculo_id','laudo_id','estado_conservacao', 'marca_fabricacao','modelo','ano','placa','cor'];

    public $timestamps = false;

    
}