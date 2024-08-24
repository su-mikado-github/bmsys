<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const CREATED_AT = 'create_tm';
    const UPDATED_AT = 'update_tm';

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_no',
        'email',
        'password',
        'last_name',
        'first_name',
        'last_name_hirakana',
        'first_name_hirakana',
        'hire_date',
        'first_paid_grant_date',
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
        'hire_date' => 'date',
        'first_paid_grant_date' => 'date',
    ];

    public function user_roles() {
        return $this->hasMany(UserRole::class, 'user_id');
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function salarys() {
        return $this->hasMany(Salary::class, 'user_id');
    }

    public function use_salarys() {
        return $this->hasMany(UseSalary::class, 'user_id');
    }

    public function password_historys() {
        return $this->hasMany(PasswordHistory::class, 'user_id');
    }

    public function scopeEnabled($query) {
        return $query->where("{$this->table}.is_deleted", 0);
    }

    public function scopeDisplayOrder($query) {
        return $query->orderBy("{$this->table}.id");
    }

    public function scopeEmployeeNoOrder($query) {
        return $query->orderBy("{$this->table}.employee_no");
    }

    public function scopeFullnameOrder($query) {
        return $query->orderBy("{$this->table}.id");
    }

    public function scopeHireDateOrder($query) {
        return $query->orderBy("{$this->table}.hire_date");
    }
}
