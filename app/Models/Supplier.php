<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'contact_name',
        'Address',
        'city',
        'country',
        'phone',
        'postal_code',
    ];
}
