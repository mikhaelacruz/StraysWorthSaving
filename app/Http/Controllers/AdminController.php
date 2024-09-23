<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Stray;
class AdminController extends Controller
{
    public function addstray()
    {
        return view('addstray');
    }

    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:65535',
                'photo_url' => 'required|string|max:65535',
            ]);

            Stray::create($validated);
            return redirect()->back()->with('success', 'Request submitted successfully!');
        } catch (\Exception $e) {
            // Log the error with additional context
            \Log::error('Error processing request: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return error message to the view
            return redirect()->back()->withErrors(['error' => 'There was an error: ' . $e->getMessage()]);
        }
    }

    public function editstray($strayId)
    {
        $stray = stray::find($strayId);

        return view('editstray', compact('stray'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'id' => 'required|exists:strays,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:65535', // Adjust according to your needs
            'photo_url' => 'nullable|string|max:65535', // Make it nullable if not always required
        ]);

        try {
            // Find the stray by ID and update it
            $stray = Stray::findOrFail($id);
            $stray->update($validated);

            return redirect()->back()->with('success', 'Stray updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating stray: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'trace' => $e->getTrace(),
            ]);

            return redirect()->back()->withErrors(['error' => 'There was an error updating the stray.']);
        }
    }

}
