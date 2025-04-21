<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Crop extends Model
{
    protected $fillable = [
        'user_id',
        'crop_name',
        'sowing_date',
        'cultivation_area',
        'health_status',
        'growth_stage',
        'expected_yield',
        'actual_yield',
        'soil_type',
        'irrigation_type'
    ];

    protected $casts = [
        'sowing_date' => 'date',
        'expected_yield' => 'float',
        'actual_yield' => 'float'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updates()
    {
        return $this->hasMany(CropUpdate::class);
    }

    public function calculateGrowthStage()
    {
        $daysSinceSowing = Carbon::now()->diffInDays($this->sowing_date);
        
        // Example growth stage calculation (adjust based on crop type)
        if ($daysSinceSowing < 20) {
            return 'seedling';
        } elseif ($daysSinceSowing < 40) {
            return 'vegetative';
        } elseif ($daysSinceSowing < 60) {
            return 'flowering';
        } else {
            return 'harvesting';
        }
    }

    public function predictYield()
    {
        // Basic yield prediction based on health status and area
        $baseYield = $this->cultivation_area * 1000; // base yield per hectare
        
        $healthMultiplier = [
            'good' => 1.0,
            'average' => 0.8,
            'poor' => 0.6
        ];

        return $baseYield * ($healthMultiplier[$this->health_status] ?? 0.8);
    }
}