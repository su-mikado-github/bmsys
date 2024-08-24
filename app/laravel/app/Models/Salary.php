<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_tm';
    const UPDATED_AT = 'update_tm';

    protected $table = 'salarys';

    protected $hidden = [
        //
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'days',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        //
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeByToday($query, $today) {
        return $query->where("{$this->table}.start_date", '<=', $today)->where("{$this->table}.end_date", '>', $today);
    }

    public function scopeEnabled($query) {
        return $query->where("{$this->table}.is_deleted", 0);
    }

    public function scopeDisplayOrder($query) {
        return $query->orderBy("{$this->table}.start_date");
    }
}
