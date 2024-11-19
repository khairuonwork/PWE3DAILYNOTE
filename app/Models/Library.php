<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'images';

    // Define the primary key if it's not `id`
    protected $primaryKey = 'images_id';

    // Indicates whether the IDs are auto-incrementing
    public $incrementing = true;

    // Define the attributes that are mass assignable
    protected $fillable = [
        'user_id',
        'title',
        'notes',
        'images',
    ];

    // Disable timestamps if not present in the table
    public $timestamps = false;
}
