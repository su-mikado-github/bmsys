<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_tm';
    const UPDATED_AT = 'update_tm';

    protected $table = 'menus';

    protected $hidden = [
        //
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_key',
    ];

    protected $casts = [
        //
    ];

    public function menu_items() {
        return $this->hasMany(MenuItem::class, 'menu_id');
    }

    public function scopeByMenuKey($query, $menu_key) {
        return $query->where("{$this->table}.menu_key", $menu_key);
    }

    public function scopeEnabled($query) {
        return $query->where("{$this->table}.is_deleted", 0);
    }

    public function scopeDisplayOrder($query) {
        return $query->orderBy("{$this->table}.id");
    }
}
