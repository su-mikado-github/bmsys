<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreenRole extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_tm';
    const UPDATED_AT = 'update_tm';

    protected $table = 'screen_roles';

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
        'screen_id',
        'permission_group_id',
        'is_create',
        'is_update',
        'is_delete',
        'is_download',
    ];

    protected $casts = [
        //
        'is_create' => 'boolean',
        'is_update' => 'boolean',
        'is_delete' => 'boolean',
        'is_download' => 'boolean',
    ];

    public function screen() {
        return $this->belongsTo(Screen::class, 'screen_id');
    }

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function scopeJoinRoles($query, $sub_query) {
        return $query->joinSub($sub_query, 'roles', function($join) {
            $join->on("{$this->table}.role_id", '=', 'roles.id');
        });
    }

    public function scopeWhenByIsCreate($query, $is_create) {
        return $query->when(!is_null($is_create), fn($query,$value)=>$query->where("{$this->table}.is_create", $is_create));
    }

    public function scopeWhenByIsUpdate($query, $is_update) {
        return $query->when(!is_null($is_update), fn($query,$value)=>$query->where("{$this->table}.is_update", $is_update));
    }

    public function scopeWhenByIsDelete($query, $is_delete) {
        return $query->when(!is_null($is_delete), fn($query,$value)=>$query->where("{$this->table}.is_deleted", $is_delete));
    }

    public function scopeWhenByIsDownload($query, $is_download) {
        return $query->when(!is_null($is_download), fn($query,$value)=>$query->where("{$this->table}.is_download", $is_download));
    }

    public function scopeEnabled($query) {
        return $query->where("{$this->table}.is_deleted", 0);
    }

    public function scopeDisplayOrder($query) {
        return $query->orderBy("{$this->table}.id");
    }
}
