<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table      = 'menus';
    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function sub_menu()
    {
        return $this->hasMany(Menu::class, 'parent_id')
        ->whereIn('role_id', auth()->user()->roles->pluck('id'))
        ->where('status', 1)
        ->orderBy('order', 'asc');
    }

    public function childs()
    {
        return $this->hasMany(Menu::class, 'parent_id')->where('role_id', auth()->user()->roles->pluck('id'))->where('status', 1);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
