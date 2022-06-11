<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Searchable, FormAccessible;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'full_name',
        'email',
        'password',
        'phone',
        'image_name',
        'image_file',
        'status',
        'last_login_at',
        'last_login_ip',
        'created_by',
        'updated_by',
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
        'last_login_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function searchableAs()
    {
        return 'users_index';
    }

    public function toSearchableArray()
    {
        return [
            'full_name' => $this->full_name,
            'email' => $this->email,
        ];
    }

    public function updatedBy(): Attribute
    {
        return Attribute::get(fn ($value) => isset(User::find($value)->username) ? User::find($value)->username : '-');
    }

    public function createdBy(): Attribute
    {
        return Attribute::get(fn ($value) => isset(User::find($value)->username) ? User::find($value)->username : '-');
    }

    public function createdAt(): Attribute
    {
        return Attribute::get(fn ($value) => isset($value) ? Carbon::parse($value)->isoFormat('dddd, Do MMMM YYYY hh:mm:ss a') : '-');
    }

    public function updatedAt(): Attribute
    {
        return Attribute::get(fn ($value) => isset($value) ? Carbon::parse($value)->isoFormat('dddd, Do MMMM YYYY hh:mm:ss a') : '-');
    }

    public function lastLoginAt(): Attribute
    {
        return Attribute::get(fn ($value) => isset($value) ? Carbon::parse($value)->isoFormat('dddd, Do MMMM YYYY hh:mm:ss a') : '-');
    }

    // public function formLastLoginAtAttribute($value)
    // {
    //     return Carbon::parse($value)->format('Y-m-d');
    // }

    public function username(): Attribute
    {
        return new Attribute(
            fn ($value) => str($value)->lower(),
            fn ($value) => str($value)->lower(),
        );
    }

    public function firstName(): Attribute
    {
        return new Attribute(
            fn ($value) => str($value)->ucfirst(),
            fn ($value) => str($value)->ucfirst(),
        );
    }

    public function lastName(): Attribute
    {
        return new Attribute(
            fn ($value) => str($value)->ucfirst(),
            fn ($value) => str($value)->ucfirst(),
        );
    }

    public function fullName(): Attribute
    {
        return new Attribute(
            fn ($value) => str($value)->ucfirst(),
            fn ($value) => str($value)->ucfirst(),
        );
    }
}
