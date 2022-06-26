<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FileManager extends Model
{
    use HasFactory;

    protected $table      = 'file_managers';
    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
