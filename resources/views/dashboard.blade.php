<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Crop Management Dashboard') }}
            </h2>
            <a href="{{ route('crops.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Crop
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dashboard Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Crops</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $crops->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Healthy Crops</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $crops->where('health_status', 'Healthy')->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Needs Attention</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $crops->whereNotIn('health_status', ['Healthy'])->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Area</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $crops->sum('cultivation_area') }} ha</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4">
                    <div class="w-full md:w-1/3">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-3 py-2 border-gray-300 rounded-md" placeholder="Search crops...">
                        </div>
                    </div>
                    
                    <div class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-3">
                        <select id="filter-status" class="rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Health Status</option>
                            <option value="Healthy">Healthy</option>
                            <option value="Minor Issues">Minor Issues</option>
                            <option value="Needs Attention">Needs Attention</option>
                            <option value="Critical">Critical</option>
                        </select>
                        
                        <select id="filter-stage" class="rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Growth Stages</option>
                            <option value="Seedling">Seedling</option>
                            <option value="Vegetative">Vegetative</option>
                            <option value="Flowering">Flowering</option>
                            <option value="Fruiting">Fruiting</option>
                            <option value="Mature">Mature</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Crops List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="crops-container">
                        @foreach ($crops as $crop)
                            <div class="crop-card border rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300" 
                                 data-name="{{ strtolower($crop->crop_name) }}"
                                 data-status="{{ strtolower($crop->health_status) }}"
                                 data-stage="{{ strtolower($crop->growth_stage) }}">
                                <div class="h-2 {{ $crop->health_status == 'Healthy' ? 'bg-green-500' : ($crop->health_status == 'Minor Issues' ? 'bg-yellow-500' : 'bg-red-500') }}"></div>
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $crop->crop_name }}</h3>
                                        <span class="px-2 py-1 text-xs rounded-full {{ $crop->health_status == 'Healthy' ? 'bg-green-100 text-green-800' : ($crop->health_status == 'Minor Issues' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $crop->health_status }}
                                        </span>
                                    </div>
                                    
                                    <div class="mt-4 space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-500">Sowing Date:</span>
                                            <span class="text-sm font-medium">{{ $crop->sowing_date->format('Y-m-d') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-500">Growth Stage:</span>
                                            <span class="text-sm font-medium">{{ $crop->growth_stage }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-500">Area:</span>
                                            <span class="text-sm font-medium">{{ $crop->cultivation_area }} hectares</span>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <div class="text-xs text-gray-500 mb-1">Growth Progress</div>
                                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="h-full bg-blue-500 rounded-full" style="width: {{ $crop->growth_percentage }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 flex justify-between">
                                        <a href="{{ route('crops.show', $crop) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            View Details
                                        </a>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('crops.edit', $crop) }}" class="text-gray-600 hover:text-gray-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('crops.destroy', $crop) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this crop?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Empty State -->
                    <div id="empty-state" class="hidden text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No crops found</h3>
                        <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this script at the end of the file -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const filterStatus = document.getElementById('filter-status');
            const filterStage = document.getElementById('filter-stage');
            const cropsContainer = document.getElementById('crops-container');
            const emptyState = document.getElementById('empty-state');
            const cropCards = document.querySelectorAll('.crop-card');
            
            function filterCrops() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusFilter = filterStatus.value.toLowerCase();
                const stageFilter = filterStage.value.toLowerCase();
                
                let visibleCount = 0;
                
                cropCards.forEach(card => {
                    const cropName = card.dataset.name;
                    const cropStatus = card.dataset.status;
                    const cropStage = card.dataset.stage;
                    
                    const matchesSearch = cropName.includes(searchTerm);
                    const matchesStatus = statusFilter === '' || cropStatus === statusFilter;
                    const matchesStage = stageFilter === '' || cropStage === stageFilter;
                    
                    if (matchesSearch && matchesStatus && matchesStage) {
                        card.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                    }
                });
                
                if (visibleCount === 0) {
                    emptyState.classList.remove('hidden');
                } else {
                    emptyState.classList.add('hidden');
                }
            }
            
            searchInput.addEventListener('input', filterCrops);
            filterStatus.addEventListener('change', filterCrops);
            filterStage.addEventListener('change', filterCrops);
            
            // Add hover effects
            cropCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.classList.add('transform', 'scale-105');
                    this.classList.add('shadow-lg');
                });
                
                card.addEventListener('mouseleave', function() {
                    this.classList.remove('transform', 'scale-105');
                    this.classList.remove('shadow-lg');
                });
            });
        });
    </script>
</x-app-layout>