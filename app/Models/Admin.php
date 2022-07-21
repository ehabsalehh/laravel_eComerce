<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements HasMedia
{
    use HasApiTokens,
    HasFactory,
    Notifiable,
    InteractsWithMedia
    ;
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'Birth_date',
        'note',
    ];
     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: "{$this->first_name}{$this->last_name}",
        );
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('admin-avatar')
            ->singleFile();
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(50)
            ->height(50);
    }
   
}
