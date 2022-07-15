<?php

namespace App\Models\Admin;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasApiTokens,
    HasFactory,
    Notifiable
    ;
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'Birth_date',
        'photo',
        'note',
    ];
}
