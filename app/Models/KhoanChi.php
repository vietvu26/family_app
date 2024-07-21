<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhoanChi extends Model
{
    use HasFactory;
    protected $table = 'khoanchi';

    protected $fillable = ['chi_id', 'name', 'amount','payment_date'];

    public function chi()
    {
        return $this->belongsTo(Chi::class, 'chi_id');
    }
    public function thu()
    {
        return $this->belongsTo(Thu::class, 'thu_id');
    }
}
