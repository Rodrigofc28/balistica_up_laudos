<?php
namespace App\Models\MongoDb;

use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'exams'; // Nome exato da coleção

    protected $casts = [
        'items' => 'array',
        'creationDate' => 'datetime',
        'allocationDate' => 'datetime',
        'executionStartDate' => 'datetime',
        'conclusionDate' => 'datetime',
        '__v' => 'integer',
        'repId' => 'integer'
    ];

    protected $fillable = [
        '_id', 'repId', 'numeroAno', 'expert', 'examNature',
        'occurrenceNature', 'examCity', 'latitude', 'longitude',
        'creationDate', 'allocationDate', 'executionStartDate',
        'conclusionDate', 'items', 'status', 'unit', '__v'
    ];
}
