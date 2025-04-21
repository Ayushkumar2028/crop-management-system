<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

if (!function_exists('getCropStageTransitionDays')) {
    function getCropStageTransitionDays($cropName, $currentStage) {
        $cropStages = [
            'Wheat' => [
                'Seedling' => 15,
                'Vegetative' => 45,
                'Flowering' => 75,
                'Harvesting' => 110
            ],
            'Rice' => [
                'Seedling' => 20,
                'Vegetative' => 60,
                'Flowering' => 90,
                'Harvesting' => 120
            ],
            'Corn' => [
                'Seedling' => 10,
                'Vegetative' => 40,
                'Flowering' => 70,
                'Harvesting' => 100
            ],
            'Potato' => [
                'Seedling' => 14,
                'Vegetative' => 35,
                'Flowering' => 60,
                'Harvesting' => 90
            ],
            'Tomato' => [
                'Seedling' => 21,
                'Vegetative' => 50,
                'Flowering' => 80,
                'Harvesting' => 120
            ],
            // Default for other crops
            'Default' => [
                'Seedling' => 14,
                'Vegetative' => 45,
                'Flowering' => 75,
                'Harvesting' => 105
            ]
        ];

        $stages = $cropStages[$cropName] ?? $cropStages['Default'];
        return $stages[$currentStage] ?? $stages['Seedling'];
    }
}

if (!function_exists('getNextStageTransitionDays')) {
    function getNextStageTransitionDays($cropName, $currentStage) {
        $stageOrder = ['Seedling', 'Vegetative', 'Flowering', 'Harvesting'];
        $currentIndex = array_search($currentStage, $stageOrder);
        
        if ($currentIndex === false || $currentIndex >= count($stageOrder) - 1) {
            return getCropStageTransitionDays($cropName, $currentStage);
        }
        
        $nextStage = $stageOrder[$currentIndex + 1];
        return getCropStageTransitionDays($cropName, $nextStage);
    }
}

if (!function_exists('calculateGrowthRate')) {
    function calculateGrowthRate($updates) {
        if ($updates->count() < 2) {
            return 'Insufficient data';
        }
        
        $latestUpdate = $updates->sortByDesc('created_at')->first();
        $earliestUpdate = $updates->sortBy('created_at')->first();
        
        $heightDifference = $latestUpdate->height - $earliestUpdate->height;
        $daysDifference = $latestUpdate->created_at->diffInDays($earliestUpdate->created_at);
        
        if ($daysDifference === 0) {
            return 'Insufficient time between readings';
        }
        
        return round($heightDifference / $daysDifference, 2);
    }
}

if (!function_exists('getSoilMoisturePercentage')) {
    function getSoilMoisturePercentage($crop) {
        // Simulate soil moisture based on crop type and irrigation type
        $baseMoisture = [
            'Drip' => [60, 80],
            'Sprinkler' => [50, 70],
            'Flood' => [70, 90],
            'Default' => [55, 75]
        ];
        
        $range = $baseMoisture[$crop->irrigation_type ?? 'Default'] ?? $baseMoisture['Default'];
        return rand($range[0], $range[1]);
    }
}

if (!function_exists('getSoilMoistureStatus')) {
    function getSoilMoistureStatus($crop) {
        $moisture = getSoilMoisturePercentage($crop);
        
        if ($moisture < 40) return 'Dry - Needs Irrigation';
        if ($moisture < 60) return 'Slightly Dry';
        if ($moisture < 80) return 'Optimal';
        if ($moisture < 90) return 'Moist';
        return 'Wet - Reduce Irrigation';
    }
}

if (!function_exists('getSoilMoistureRecommendation')) {
    function getSoilMoistureRecommendation($crop) {
        $status = getSoilMoistureStatus($crop);
        
        if (strpos($status, 'Dry') !== false) {
            return 'Recommendation: Increase irrigation frequency.';
        } elseif (strpos($status, 'Wet') !== false) {
            return 'Recommendation: Reduce irrigation for the next 2-3 days.';
        } else {
            return 'Recommendation: Maintain current irrigation schedule.';
        }
    }
}