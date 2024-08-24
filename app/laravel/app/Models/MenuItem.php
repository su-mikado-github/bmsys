<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_tm';
    const UPDATED_AT = 'update_tm';

    protected $table = 'menu_items';

    protected $hidden = [
        //
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_id',
        'menu_group_no',
        'display_order',
        'screen_id'
    ];

    protected $casts = [
        //
    ];

    public function menu() {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function screen() {
        return $this->belongsTo(Screen::class, 'screen_id');
    }

    public function scopeJoinMenu($query, $menu) {
        return $query->joinSub($menu, 'menus', function($join) {
            $join->on("{$this->table}.menu_id", '=', 'menus.id');
        });
    }


    public function scopeByScreenIds($query, $screen_ids) {
        return $query->whereIn("{$this->table}.screen_id", $screen_ids);
    }

    public function scopeEnabled($query) {
        return $query->where("{$this->table}.is_deleted", 0);
    }

    public function scopeDisplayOrder($query) {
        return $query->orderBy("{$this->table}.menu_group_no")->orderBy("{$this->table}.display_order");
    }
}
