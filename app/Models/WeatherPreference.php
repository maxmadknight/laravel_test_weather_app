<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $city
 * @property float $latitude
 * @property float $longitude
 * @property float $precipitation_threshold
 * @property float $uv_index_threshold
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|WeatherPreference newModelQuery()
 * @method static Builder|WeatherPreference newQuery()
 * @method static Builder|WeatherPreference query()
 * @method static Builder|WeatherPreference whereCity($value)
 * @method static Builder|WeatherPreference whereCreatedAt($value)
 * @method static Builder|WeatherPreference whereId($value)
 * @method static Builder|WeatherPreference whereLatitude($value)
 * @method static Builder|WeatherPreference whereLongitude($value)
 * @method static Builder|WeatherPreference wherePrecipitationThreshold($value)
 * @method static Builder|WeatherPreference whereUpdatedAt($value)
 * @method static Builder|WeatherPreference whereUserId($value)
 * @method static Builder|WeatherPreference whereUvIndexThreshold($value)
 * @mixin \Eloquent
 */
class WeatherPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city',
        'latitude',
        'longitude',
        'precipitation_threshold',
        'uv_index_threshold'
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'precipitation_threshold' => 'float',
        'uv_index_threshold' => 'float'
    ];
}
