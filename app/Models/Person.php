<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'birth_date',
        'death_date',
        'parent_id',
        'profile_picture',
    ];
    
    public function parent()
    {
        return $this->belongsTo(Person::class, 'parent_id');
    }

    // Define children relationship
    public function children()
    {
        return $this->hasMany(Person::class, 'parent_id');
    }
}
