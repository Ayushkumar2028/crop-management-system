<?php

namespace App\Console\Commands;

use App\Models\Crop;
use App\Notifications\CropStageChange;
use Illuminate\Console\Command;

class CheckCropStages extends Command
{
    protected $signature = 'crops:check-stages';
    protected $description = 'Check and update crop growth stages';

    public function handle()
    {
        Crop::all()->each(function ($crop) {
            $newStage = $crop->calculateGrowthStage();
            
            if ($newStage !== $crop->growth_stage) {
                $crop->update(['growth_stage' => $newStage]);
                $crop->user->notify(new CropStageChange($crop, $newStage));
            }
        });
    }
}