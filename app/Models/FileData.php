<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileData extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'filename',
        'filesize',
        'data_for',
        'is_imported',
        'log',
    ];
}
