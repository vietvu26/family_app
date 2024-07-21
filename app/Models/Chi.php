<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chi extends Model
{
    use HasFactory;
    protected $table = 'chi';

    protected $fillable = ['type', 'note'];
}
