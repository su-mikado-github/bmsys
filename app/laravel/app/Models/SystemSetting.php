<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_tm';
    const UPDATED_AT = 'update_tm';

    protected $table = 'system_settings';

    protected $hidden = [
        //
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'property_key',
        'property_group',
        'data_type',
        'is_required',
    ];

    protected $casts = [
        //
        'data_type' => \App\Enums\SystemPropertyTypes::class,
        'is_required' => 'boolean',
    ];

    public function scopeByPropertyKey($query, $property_key) {
        return $query->where("{$this->table}.property_key", $property_key);
    }

    public function scopeByPropertyGroup($query, $property_group) {
        return $query->where("{$this->table}.property_group", $property_group);
    }

    public function scopeEnabled($query) {
        return $query->where("{$this->table}.is_deleted", 0);
    }

    public function scopeDisplayOrder($query) {
        return $query->orderBy("{$this->table}.property_group")->orderBy("{$this->table}.property_key");
    }
}
