<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_tm';
    const UPDATED_AT = 'update_tm';

    protected $table = 'roles';

    protected $hidden = [
        //
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        //
    ];

    protected $casts = [
        //
    ];

    public function screen_roles() {
        return $this->hasMany(ScreenRole::class, 'role_id');
    }

    public function screens() {
        return $this->belongsToMany(Screen::class, 'screen_roles', 'role_id', 'screen_id');
    }

    public function user_roles() {
        return $this->hasMany(UserRole::class, 'role_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
    }

    public function scopeByMenuKey($query, $role_key) {
        return $this->where("{$this->table}.role_key", $role_key);
    }

    public function scopeEnabled($query) {
        return $query->where("{$this->table}.is_deleted", 0);
    }

    public function scopeDisplayOrder($query) {
        return $query->orderBy("{$this->table}.id");
    }
}
