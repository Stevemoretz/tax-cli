<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CarModel
 *
 * @property-read \App\Models\Cab|null $cab
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $model_name
 * @property string $model_description
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel whereModelDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel whereUpdatedAt($value)
 */
class CarModel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cab(){
        return $this->belongsTo(Cab::class);
    }
}
