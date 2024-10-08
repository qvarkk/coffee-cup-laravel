<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorited extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'favorites';
}
