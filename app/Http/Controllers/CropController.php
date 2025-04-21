<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;
use PDF;

class CropController extends Controller
{
    public function index()
    {
        $crops = auth()->user()->crops()->latest()->get();
        return view('dashboard', compact('crops'));
    }

    /**
     * Store a newly created crop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'crop_name' => 'required|string|max:255',
            'crop_type' => 'required|string|max:255',
            'sowing_date' => 'required|date',
            'growth_stage' => 'required|string|max:255',
            'health_status' => 'required|string|max:255',
            'cultivation_area' => 'required|numeric|min:0',
            'soil_type' => 'required|string|max:255',
            'irrigation_type' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $crop = auth()->user()->crops()->create($validated);

        return redirect()->route('crops.show', $crop)
            ->with('success', 'Crop created successfully!');
    }

    public function show(Crop $crop)
    {
        return view('crops.show', compact('crop'));
    }

    public function generateReport(Crop $crop)
    {
        $pdf = PDF::loadView('crops.report', compact('crop'));
        return $pdf->download($crop->crop_name . '_report.pdf');
    }

    /**
     * Show the form for creating a new crop.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('crops.create');
    }

    /**
     * Show the form for editing the specified crop.
     *
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\View\View
     */
    public function edit(Crop $crop)
    {
        return view('crops.edit', compact('crop'));
    }

    /**
     * Update the specified crop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Crop $crop)
    {
        $validated = $request->validate([
            'crop_name' => 'required|string|max:255',
            'crop_type' => 'required|string|max:255',
            'sowing_date' => 'required|date',
            'growth_stage' => 'required|string|max:255',
            'health_status' => 'required|string|max:255',
            'cultivation_area' => 'required|numeric|min:0',
            'soil_type' => 'required|string|max:255',
            'irrigation_type' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $crop->update($validated);

        return redirect()->route('crops.show', $crop)
            ->with('success', 'Crop updated successfully!');
    }
    
    /**
     * Remove the specified crop from storage.
     *
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Crop $crop)
    {
        $crop->delete();
        
        return redirect()->route('dashboard')
            ->with('success', 'Crop deleted successfully!');
    }
}