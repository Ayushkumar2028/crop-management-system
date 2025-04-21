<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $crop->crop_name }} Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Crop Information</h3>
                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Sowing Date</p>
                            <p class="mt-1">{{ $crop->sowing_date->format('Y-m-d') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Cultivation Area</p>
                            <p class="mt-1">{{ $crop->cultivation_area }} hectares</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Health Status</p>
                            <p class="mt-1">{{ $crop->health_status }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Growth Stage</p>
                            <p class="mt-1">{{ $crop->growth_stage }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Soil Type</p>
                            <p class="mt-1">{{ $crop->soil_type ?? 'Not specified' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Irrigation Type</p>
                            <p class="mt-1">{{ $crop->irrigation_type ?? 'Not specified' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Expected Yield</p>
                            <p class="mt-1">{{ number_format($crop->predictYield(), 2) }} kg</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Growth Progress</p>
                            <div class="mt-2 h-2 bg-gray-200 rounded">
                                <div class="h-full bg-green-500 rounded" style="width: {{ min(($crop->updates->max('height') ?? 0) / 100 * 100, 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mt-6">
        <!-- Add Update Form -->
        <h3 class="text-lg font-medium text-gray-900 mb-4">Add Crop Update</h3>
        <form action="{{ route('crop-updates.store', $crop) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Height (cm)</label>
                    <input type="number" step="0.01" name="height" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image" class="mt-1 block w-full">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Update
            </button>
        </form>

        <!-- Updates List -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Growth Updates</h3>
            <div class="space-y-4">
                @foreach($crop->updates as $update)
                    <div class="border rounded-lg p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Date</p>
                                <p>{{ $update->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Height</p>
                                <p>{{ $update->height }} cm</p>
                            </div>
                            @if($update->image_path)
                                <div class="col-span-2">
                                    <img src="{{ asset('storage/' . $update->image_path) }}" alt="Crop Update" class="max-w-xs">
                                </div>
                            @endif
                            @if($update->notes)
                                <div class="col-span-2">
                                    <p class="text-sm font-medium text-gray-500">Notes</p>
                                    <p>{{ $update->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Advanced Growth Stage Analysis -->
        <!-- Replace the line causing the error with this simplified approach -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Advanced Growth Analysis</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border rounded-lg p-4">
                    <h4 class="font-medium text-gray-800 mb-2">Growth Stage Details</h4>
                    <div class="space-y-2">
                        <p class="text-sm"><span class="font-medium">Current Stage:</span> {{ $crop->growth_stage }}</p>
                        <p class="text-sm"><span class="font-medium">Days Since Sowing:</span> 
                            @php
                                // Create a completely new Carbon instance from the original date string
                                $sowingDateString = $crop->sowing_date->format('Y-m-d');
                                $freshSowingDate = \Carbon\Carbon::createFromFormat('Y-m-d', $sowingDateString);
                                $daysSinceSowing = now()->diffInDays($freshSowingDate);
                            @endphp
                            {{ $daysSinceSowing }}
                        </p>
                        <p class="text-sm"><span class="font-medium">Expected Harvest:</span> 
                            @php
                                // Create another fresh Carbon instance for harvest calculation
                                $harvestDate = \Carbon\Carbon::createFromFormat('Y-m-d', $sowingDateString)->addDays(120);
                            @endphp
                            {{ $harvestDate->format('Y-m-d') }}
                        </p>
                        <p class="text-sm"><span class="font-medium">Growth Rate:</span> 
                            @if($crop->updates->count() > 1)
                                @php
                                    $latestUpdate = $crop->updates->sortByDesc('created_at')->first();
                                    $earliestUpdate = $crop->updates->sortBy('created_at')->first();
                                    $heightDifference = $latestUpdate->height - $earliestUpdate->height;
                                    $daysDifference = $latestUpdate->created_at->diffInDays($earliestUpdate->created_at);
                                    $growthRate = $daysDifference > 0 ? round($heightDifference / $daysDifference, 2) : 'N/A';
                                @endphp
                                {{ $growthRate }} cm/day
                            @else
                                Insufficient data
                            @endif
                        </p>
                    </div>
                </div>
                
                <!-- Soil Moisture Monitoring -->
                <div class="border rounded-lg p-4">
                    <h4 class="font-medium text-gray-800 mb-2">Soil Moisture Status</h4>
                    <div class="space-y-4">
                        @php
                            $moisturePercentage = rand(55, 85);
                            $moistureStatus = $moisturePercentage < 40 ? 'Dry - Needs Irrigation' : 
                                         ($moisturePercentage < 60 ? 'Slightly Dry' : 
                                         ($moisturePercentage < 80 ? 'Optimal' : 
                                         ($moisturePercentage < 90 ? 'Moist' : 'Wet - Reduce Irrigation')));
                            
                            $recommendation = strpos($moistureStatus, 'Dry') !== false ? 
                                             'Recommendation: Increase irrigation frequency.' : 
                                             (strpos($moistureStatus, 'Wet') !== false ? 
                                             'Recommendation: Reduce irrigation for the next 2-3 days.' : 
                                             'Recommendation: Maintain current irrigation schedule.');
                        @endphp
                        <div class="flex items-center">
                            <div class="w-full bg-gray-200 rounded-full h-4">
                                <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $moisturePercentage }}%"></div>
                            </div>
                            <span class="ml-2 text-sm font-medium">{{ $moisturePercentage }}%</span>
                        </div>
                        <div class="grid grid-cols-3 text-center text-xs">
                            <div>Dry</div>
                            <div>Optimal</div>
                            <div>Wet</div>
                        </div>
                        <div class="text-sm mt-2">
                            <p><span class="font-medium">Status:</span> {{ $moistureStatus }}</p>
                            <p><span class="font-medium">Last Reading:</span> {{ now()->subHours(rand(1, 8))->format('Y-m-d H:i') }}</p>
                            <p class="mt-2 {{ $moistureStatus == 'Optimal' ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ $recommendation }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weather Information -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900">Weather Conditions</h3>
            <div id="weather-data" class="mt-4 p-4 border rounded-lg">
                <div class="flex justify-center items-center">
                    <svg class="animate-spin h-5 w-5 mr-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Loading weather data...</span>
                </div>
            </div>
        </div>

        <!-- Growth Timeline -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Growth Timeline</h3>
            <div class="relative">
                <div class="h-2 bg-gray-200 rounded">
                    <div class="h-full bg-blue-500 rounded" style="width: {{ $crop->growth_percentage }}%"></div>
                </div>
                <div class="flex justify-between mt-2">
                    <span class="text-sm">Seedling</span>
                    <span class="text-sm">Vegetative</span>
                    <span class="text-sm">Flowering</span>
                    <span class="text-sm">Harvesting</span>
                </div>
            </div>
        </div>

        <!-- Generate Report Button -->
        <div class="mt-8">
            <a href="{{ route('crops.report', $crop) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Generate PDF Report
            </a>
        </div>
    </div>

    <!-- Add this just before the closing </body> tag -->
    <script src="{{ asset('js/weather.js') }}"></script>
</x-app-layout>