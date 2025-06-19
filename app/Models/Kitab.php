<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kitab extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fan',
        'nama_kitab',
        'jenjang',
    ];
}
