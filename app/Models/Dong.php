<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dong extends Model
{
    use HasFactory;
    protected $table = 'dong';

    protected $fillable = ['thu_id', 'person_id', 'amount','payment_date', 'note'];

    public function annualContribution()
    {
        return $this->belongsTo(Thu::class);
    }
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
    public function thu()
    {
        return $this->belongsTo(Thu::class, 'thu_id');
    }
}
