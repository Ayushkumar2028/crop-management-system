<?php

namespace App\Console\Commands;

use App\Models\Crop;
use Illuminate\Console\Command;

class UpdateCropHealth extends Command
{
    protected $signature = 'crops:update-health';
    protected $description = 'Update crop health based on growth data';

    public function handle()
    {
        Crop::all()->each(function ($crop) {
            $lastUpdate = $crop->updates()->latest()->first();
            
            if ($lastUpdate) {
                // Update health status based on growth rate
                $expectedHeight = $crop->calculateExpectedHeight();
                $actualHeight = $lastUpdate->height;
                
                if ($actualHeight >= $expectedHeight * 0.9) {
                    $crop->health_status = 'good';
                } elseif ($actualHeight >= $expectedHeight * 0.7) {
                    $crop->health_status = 'average';
                } else {
                    $crop->health_status = 'poor';
                }
                
                $crop->save();
            }
        });
    }
}