document.addEventListener('DOMContentLoaded', function() {
    // Check if weather-data element exists
    const weatherContainer = document.getElementById('weather-data');
    if (!weatherContainer) return;

    // Coordinates for Delhi, India
    const lat = 28.6139;
    const lon = 77.2090;
    
    // Fetch weather directly from Open-Meteo API
    fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,relative_humidity_2m,wind_speed_10m,weather_code&timezone=auto`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Get weather description based on code
            const weatherCode = data.current.weather_code;
            const weatherDesc = getWeatherDescription(weatherCode);
            
            // Update the weather container
            weatherContainer.innerHTML = `
                <div class="grid grid-cols-2 gap-4 p-4 bg-white rounded-lg shadow">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Temperature</p>
                        <p class="text-xl">${data.current.temperature_2m}°C</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Humidity</p>
                        <p class="text-xl">${data.current.relative_humidity_2m}%</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Weather</p>
                        <p class="text-xl">${weatherDesc}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Wind Speed</p>
                        <p class="text-xl">${data.current.wind_speed_10m} km/h</p>
                    </div>
                </div>
            `;
        })
        .catch(error => {
            console.error('Weather fetch error:', error);
            weatherContainer.innerHTML = `
                <div class="p-4 bg-red-50 text-red-500 rounded-lg">
                    Unable to load weather data. Please try again later.
                </div>
            `;
        });
});

// Helper function to convert weather codes to descriptions
function getWeatherDescription(code) {
    const weatherCodes = {
        0: 'Clear sky',
        1: 'Mainly clear',
        2: 'Partly cloudy',
        3: 'Overcast',
        45: 'Fog',
        48: 'Depositing rime fog',
        51: 'Light drizzle',
        53: 'Moderate drizzle',
        55: 'Dense drizzle',
        56: 'Light freezing drizzle',
        57: 'Dense freezing drizzle',
        61: 'Slight rain',
        63: 'Moderate rain',
        65: 'Heavy rain',
        66: 'Light freezing rain',
        67: 'Heavy freezing rain',
        71: 'Slight snow fall',
        73: 'Moderate snow fall',
        75: 'Heavy snow fall',
        77: 'Snow grains',
        80: 'Slight rain showers',
        81: 'Moderate rain showers',
        82: 'Violent rain showers',
        85: 'Slight snow showers',
        86: 'Heavy snow showers',
        95: 'Thunderstorm',
        96: 'Thunderstorm with slight hail',
        99: 'Thunderstorm with heavy hail'
    };
    
    return weatherCodes[code] || 'Unknown';
}