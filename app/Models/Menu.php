<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'name',
        'deskripsi',
        'link_menu',
        'icon_class',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'setting_menus');
    }
}
