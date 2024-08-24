<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordHistory extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_tm';
    const UPDATED_AT = 'update_tm';

    protected $table = 'password_historys';

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
        'password',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        //
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
