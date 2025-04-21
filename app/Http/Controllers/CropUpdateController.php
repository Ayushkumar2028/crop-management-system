<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\CropUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CropUpdateController extends Controller
{
    public function store(Request $request, Crop $crop)
    {
        $validated = $request->validate([
            'height' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'notes' => 'nullable|string|max:1000'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('crop-images', 'public');
            $validated['image_path'] = $path;
        }

        $crop->updates()->create($validated);

        return redirect()->back()->with('success', 'Update added successfully');
    }

    public function destroy(Crop $crop, CropUpdate $update)
    {
        if ($update->image_path) {
            Storage::disk('public')->delete($update->image_path);
        }
        
        $update->delete();
        
        return redirect()->back()->with('success', 'Update deleted successfully');
    }
}