<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $table = 'veiculo';
    protected $fillable = [
        'id', 'veiculo_id', 'laudo_id', 'placa', 'marca_fabricacao', 'modelo', 'ano', 'cor', 'ano_fab', 'estado_conservacao'
    ];
    
    public $timestamps = false; // Desativa os timestamps
}

?>

