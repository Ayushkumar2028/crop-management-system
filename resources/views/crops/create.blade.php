<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Crop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('crops.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Crop Name -->
                            <div>
                                <x-input-label for="crop_name" :value="__('Crop Name')" />
                                <x-text-input id="crop_name" class="block mt-1 w-full bg-white text-gray-900 border-gray-300" type="text" name="crop_name" :value="old('crop_name')" required autofocus style="background-color: white !important; color: black !important;" />
                                <x-input-error :messages="$errors->get('crop_name')" class="mt-2" />
                            </div>

                            <!-- Crop Type -->
                            <div>
                                <x-input-label for="crop_type" :value="__('Crop Type')" />
                                <select id="crop_type" name="crop_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="Grain">Grain</option>
                                 <option value="Vegetable">Vegetable</option>
                                    <option value="Fruit">Fruit</option>
                                    <option value="Legume">Legume</option>
                                    <option value="Root">Root</option>
                                    <option value="Other">Other</option>
                                </select>
                                <x-input-error :messages="$errors->get('crop_type')" class="mt-2" />
                            </div>

                            <!-- Sowing Date -->
                            <div>
                                <x-input-label for="sowing_date" :value="__('Sowing Date')" />
                                <x-text-input id="sowing_date" class="block mt-1 w-full bg-white text-gray-900 border-gray-300" type="date" name="sowing_date" :value="old('sowing_date')" required style="background-color: white !important; color: black !important;" />
                                <x-input-error :messages="$errors->get('sowing_date')" class="mt-2" />
                            </div>

                            <!-- Growth Stage -->
                            <div>
                                <x-input-label for="growth_stage" :value="__('Growth Stage')" />
                                <select id="growth_stage" name="growth_stage" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="Seedling">Seedling</option>
                                    <option value="Vegetative">Vegetative</option>
                                    <option value="Flowering">Flowering</option>
                                    <option value="Fruiting">Fruiting</option>
                                    <option value="Mature">Mature</option>
                                </select>
                                <x-input-error :messages="$errors->get('growth_stage')" class="mt-2" />
                            </div>

                            <!-- Health Status -->
                            <div>
                                <x-input-label for="health_status" :value="__('Health Status')" />
                                <select id="health_status" name="health_status" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="Healthy">Healthy</option>
                                    <option value="Minor Issues">Minor Issues</option>
                                    <option value="Needs Attention">Needs Attention</option>
                                    <option value="Critical">Critical</option>
                                </select>
                                <x-input-error :messages="$errors->get('health_status')" class="mt-2" />
                            </div>

                            <!-- Cultivation Area -->
                            <div>
                                <x-input-label for="cultivation_area" :value="__('Cultivation Area (hectares)')" />
                                <x-text-input id="cultivation_area" class="block mt-1 w-full bg-white text-gray-900 border-gray-300" type="number" step="0.01" name="cultivation_area" :value="old('cultivation_area')" required style="background-color: white !important; color: black !important;" />
                                <x-input-error :messages="$errors->get('cultivation_area')" class="mt-2" />
                            </div>

                            <!-- Soil Type -->
                            <div>
                                <x-input-label for="soil_type" :value="__('Soil Type')" />
                                <select id="soil_type" name="soil_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="Clay">Clay</option>
                                    <option value="Sandy">Sandy</option>
                                    <option value="Loamy">Loamy</option>
                                    <option value="Silt">Silt</option>
                                    <option value="Peaty">Peaty</option>
                                    <option value="Chalky">Chalky</option>
                                </select>
                                <x-input-error :messages="$errors->get('soil_type')" class="mt-2" />
                            </div>

                            <!-- Irrigation Type -->
                            <div>
                                <x-input-label for="irrigation_type" :value="__('Irrigation Type')" />
                                <select id="irrigation_type" name="irrigation_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="Drip">Drip</option>
                                    <option value="Sprinkler">Sprinkler</option>
                                    <option value="Flood">Flood</option>
                                    <option value="Furrow">Furrow</option>
                                    <option value="Rainwater">Rainwater</option>
                                </select>
                                <x-input-error :messages="$errors->get('irrigation_type')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            <x-input-label for="notes" :value="__('Notes')" />
                            <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-3">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Create Crop') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>