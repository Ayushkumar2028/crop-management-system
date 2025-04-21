<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">My Crops</h2>
                
                <!-- Add New Crop Form -->
                <form action="{{ route('crops.store') }}" method="POST" class="mb-8">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label>Crop Name</label>
                            <input type="text" name="crop_name" class="form-input w-full">
                        </div>
                        <div>
                            <label>Sowing Date</label>
                            <input type="date" name="sowing_date" class="form-input w-full">
                        </div>
                        <div>
                            <label>Cultivation Area (hectares)</label>
                            <input type="number" step="0.01" name="cultivation_area" class="form-input w-full">
                        </div>
                        <div>
                            <label>Health Status</label>
                            <select name="health_status" class="form-select w-full">
                                <option value="good">Good</option>
                                <option value="average">Average</option>
                                <option value="poor">Poor</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                        Add Crop
                    </button>
                </form>

                <!-- Crops List -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($crops as $crop)
                        <div class="border rounded p-4">
                            <h3 class="text-xl font-bold">{{ $crop->crop_name }}</h3>
                            <p>Growth Stage: {{ $crop->growth_stage }}</p>
                            <p>Health Status: {{ $crop->health_status }}</p>
                            <p>Sowing Date: {{ $crop->sowing_date->format('Y-m-d') }}</p>
                            <div class="mt-4">
                                <a href="{{ route('crops.show', $crop) }}" class="text-blue-500">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>