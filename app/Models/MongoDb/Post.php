<?php
namespace App\Models\MongoDb;

use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'mongodb'; // Define que esse modelo usa o MongoDB
    protected $collection = 'posts'; // Nome da coleção no MongoDB

    protected $fillable = ['title', 'content'];
}