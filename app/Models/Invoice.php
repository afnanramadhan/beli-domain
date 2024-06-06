<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'duration',
        'price',
        'email',
        'description',
    ];

    protected $casts = [
        'duration' => 'string',
        'description' => 'string',
    ];


}
