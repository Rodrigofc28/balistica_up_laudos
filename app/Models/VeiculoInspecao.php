<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeiculoInspecao extends Model
{
    protected $table = 'veiculo_inspecao';

    protected $fillable = [
        'chassi_status', 'chassi_numero', 'chassi_foto', 'chassi_nao_tem_foto',
        'chassi_adulterado_numero', 'chassi_adulterado_foto', 'chassi_adulterado_nao_tem_foto',
        'chassi_tipo_adulteracao', 'chassi_metodologia', 'chassi_nao_se_aplica_metodologia',
        'chassi_resultado', 'chassi_nao_se_aplica_resultado', 'chassi_revelado_numero',
        'chassi_revelado_foto', 'chassi_revelado_nao_tem_foto', 'chassi_revelado_parcialmente_numero',
        'chassi_revelado_parcialmente_foto', 'chassi_revelado_parcialmente_nao_tem_foto',
        'motor_status', 'motor_numero', 'motor_foto', 'motor_nao_tem_foto',
        'motor_adulterado_numero', 'motor_adulterado_foto', 'motor_adulterado_nao_tem_foto',
        'motor_tipo_adulteracao', 'motor_metodologia', 'motor_nao_se_aplica_metodologia',
        'motor_resultado', 'motor_nao_se_aplica_resultado', 'motor_revelado_numero',
        'motor_revelado_foto', 'motor_revelado_nao_tem_foto', 'motor_revelado_parcialmente_numero',
        'motor_revelado_parcialmente_foto', 'motor_revelado_parcialmente_nao_tem_foto',
        'data_inspecao'
    ];
}

