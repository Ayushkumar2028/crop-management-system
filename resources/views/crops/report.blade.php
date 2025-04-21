<!DOCTYPE html>
<html>
<head>
    <title>{{ $crop->crop_name }} Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .section { margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Crop Report: {{ $crop->crop_name }}</h1>
        <p>Generated on: {{ now()->format('Y-m-d') }}</p>
    </div>

    <div class="section">
        <h2>Basic Information</h2>
        <table class="table">
            <tr>
                <th>Sowing Date</th>
                <td>{{ $crop->sowing_date->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <th>Cultivation Area</th>
                <td>{{ $crop->cultivation_area }} hectares</td>
            </tr>
            <tr>
                <th>Health Status</th>
                <td>{{ $crop->health_status }}</td>
            </tr>
            <tr>
                <th>Growth Stage</th>
                <td>{{ $crop->growth_stage }}</td>
            </tr>
        </table>
    </div>

    @if($crop->updates->count() > 0)
    <div class="section">
        <h2>Growth Updates</h2>
        <table class="table">
            <tr>
                <th>Date</th>
                <th>Height (cm)</th>
                <th>Notes</th>
            </tr>
            @foreach($crop->updates as $update)
            <tr>
                <td>{{ $update->created_at->format('Y-m-d') }}</td>
                <td>{{ $update->height }}</td>
                <td>{{ $update->notes }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif
</body>
</html>