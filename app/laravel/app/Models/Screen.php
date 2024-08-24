<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_tm';
    const UPDATED_AT = 'update_tm';

    protected $table = 'screens';

    protected $hidden = [
        //
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'screen_key',
        'display_order',
    ];

    protected $casts = [
        //
    ];

    protected $appends = [
        'url'
    ];

    public function screen_roles() {
        return $this->hasMany(ScreenRole::class, 'screen_id');
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'screen_roles', 'screen_id', 'role_id');
    }

    public function menu_items() {
        return $this->hasMany(MenuItem::class, 'screen_id');
    }

    public function scopeBySceenKey($query, $screen_key) {
        return $this->where("{$this->table}.screen_key", $screen_key);
    }

    public function scopeEnabled($query) {
        return $query->where("{$this->table}.is_deleted", 0);
    }

    public function scopeDisplayOrder($query) {
        return $query->orderBy("{$this->table}.display_order")->orderBy("{$this->table}.id");
    }

    public function getUrlAttribute() {
        try {
            return route($this->screen_key);
        }
        catch (\Exception $e) {
            logger()->error("[{$this->screen_key}]ルート名が見つかりません。");
            return null;
        }
    }
}
