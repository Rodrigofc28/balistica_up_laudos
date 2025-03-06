<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeiculoInspecao extends Model
{
    protected $table = 'veiculo_inspecao';

    protected $fillable = [ //Chassi
        'chassi_status', 'laudo_id','chassi_numero', 'chassi_foto', 
        'chassi_adulterado_numero', 'chassi_adulterado_foto', 
        'chassi_tipo_adulteracao', 'chassi_metodologia', 
        'reparo_chassi', 'transplante_chassi', 
        'chassi_resultado',  'chassi_revelado_numero',
        'chassi_revelado_foto',  'chassi_revelado_parcialmente_numero',
        'chassi_revelado_parcialmente_foto', 
        //Motor
        'motor_status', 'motor_numero', 'motor_foto',
        'motor_adulterado_numero', 'motor_adulterado_foto', 
        'motor_tipo_adulteracao', 'motor_metodologia', 'transplante_motor',
        'motor_resultado',  'motor_revelado_numero',' reparo_motor', 
        'motor_revelado_foto', 'motor_revelado_parcialmente_numero',
        'motor_revelado_parcialmente_foto', 
        'data_inspecao'
    ];
}
?>


