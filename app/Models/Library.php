<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $primaryKey = 'images_id';

    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'title',
        'notes',
        'images',
    ];

    public $timestamps = false;
}
