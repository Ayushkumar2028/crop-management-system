<!DOCTYPE html>
<html>
<head>
    <title>Crop Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .section { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Crop Progress Report</h1>
        <p>Generated on: {{ now()->format('Y-m-d') }}</p>
    </div>

    <div class="section">
        <h2>Crop Details</h2>
        <p>Name: {{ $crop->crop_name }}</p>
        <p>Sowing Date: {{ $crop->sowing_date->format('Y-m-d') }}</p>
        <p>Current Stage: {{ $crop->growth_stage }}</p>
        <p>Health Status: {{ $crop->health_status }}</p>
        <p>Cultivation Area: {{ $crop->cultivation_area }} hectares</p>
    </div>

    <div class="section">
        <h2>Growth Timeline</h2>
        @foreach($crop->updates as $update)
            <p>
                Date: {{ $update->created_at->format('Y-m-d') }}<br>
                Height: {{ $update->height }} cm<br>
                Notes: {{ $update->notes }}
            </p>
        @endforeach
    </div>
</body>
</html>