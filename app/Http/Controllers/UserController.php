<?php

namespace App\Http\Controllers;

use App\Models\AdoptionRequest;
use App\Models\Stray;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;
class UserController extends Controller
{
    //

    public function dashboard()
    {
        return view('dashboard');
    }

    public function adopt()
    {
        $strays = DB::table('strays')->select('id', 'name', 'description', 'photo_url')->paginate(9);
        $user = Auth::user();
        $userIsAdmin = $user->isAdmin;
        return view('adopt', compact('strays', 'userIsAdmin'));
    }

    public function policies()
    {
        return view('policies');
    }

    public function adoptionrequest($strayId)
    {
        $name = Stray::find($strayId)->name;
        return view('adoptionrequest', compact('strayId', 'name'));
    }

    public function store(Request $request)
    {


        try {
            $validated = $request->validate([
                'stray_id' => 'required|exists:strays,id',
                'name' => 'required|string|max:50',
                'email' => 'required|email|max:100',
                'contact_number' => 'required|string|max:11',
                'location' => 'required|string|max:20',
            ]);

            AdoptionRequest::create($validated);
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

    public function adoptionrequests()
    {
        $user = Auth::user();
        $userId = Auth::user()->id;
        $userIsAdmin = $user->isAdmin;

        if ($userIsAdmin == 0)
            $requests = DB::table('adoptionrequests')
                ->join('strays', function ($join) {
                    $join->on('adoptionrequests.stray_id', '=', 'strays.id');
                })
                ->where('adoptionrequests.email', $user->email)
                ->select('adoptionrequests.id', 'strays.name as strayname', 'adoptionrequests.name as adoptername', 'adoptionrequests.contact_number', 'adoptionrequests.email', 'adoptionrequests.location')
                ->paginate(5);
        else
            $requests = DB::table('adoptionrequests')
                ->join('strays', function ($join) {
                    $join->on('adoptionrequests.stray_id', '=', 'strays.id');
                })
                ->select('adoptionrequests.id', 'strays.name as strayname', 'adoptionrequests.name as adoptername', 'adoptionrequests.contact_number', 'adoptionrequests.email', 'adoptionrequests.location')
                ->paginate(5);

        return view('adoptionrequests', compact('userIsAdmin', 'requests'));
    }
}
