<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    use HasFactory;
    protected  $fillable = [
        'user_id',
        'name',
        'phone',
        'zip',
        'state',
        'city',
        'address',
        'locality',
        'landmark',
        'is_default'
    ];

    protected $atributes = [
        'is_default' => false
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
