<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    protected $table = 'veiculo';
    protected $fillable = [ 'image1', 'image2'];

}
?>