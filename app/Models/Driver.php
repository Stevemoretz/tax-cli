<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Driver
 *
 * @property-read \App\Models\Cab|null $cab
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Shift[] $shifts
 * @property-read int|null $shifts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Trip[] $trips
 * @property-read int|null $trips_count
 * @method static \Illuminate\Database\Eloquent\Builder|Driver newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Driver newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Driver query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $first_name
 * @property string $last_name
 * @property int $cab_id
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereCabId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereUpdatedAt($value)
 */
class Driver extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cab(){
        return $this->hasOne(Cab::class,"id");
    }

    public function trips(){
        return $this->hasMany(Trip::class);
    }

    public function shifts(){
        return $this->hasMany(Shift::class);
    }
}
