<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Shift
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Driver[] $driver
 * @property-read int|null $driver_count
 * @method static \Illuminate\Database\Eloquent\Builder|Shift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shift newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shift query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $shift_start_time
 * @property string $shift_end_time
 * @property int $driver_id
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereShiftEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereShiftStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereUpdatedAt($value)
 */
class Shift extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function driver(){
        return $this->hasMany(Driver::class);
    }
}
