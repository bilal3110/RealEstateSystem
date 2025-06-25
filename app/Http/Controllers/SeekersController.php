<?php

namespace App\Http\Controllers;

use App\Models\Seekers;
use Illuminate\Http\Request;

class SeekersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get("search");
        $query = Seekers::query();
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%')
                ->orWhere('contact', 'like', '%' . $search . '%')
                ->orWhere('budget', 'Like', '%' . $search . '%')
                ->orWhere('area', 'Like', '%' . $search . '%')
                ->orWhere('status', 'Like', '%' . $search . '%')
                ->orWhere('preferred_location', '', '%' . $search . '%');
        }
        $seekers = $query->latest()->paginate(10)->appends(['search' => $search]);
        return view("html.propertySeekers", compact("seekers", "search"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:rent,buy',
            'contact' => 'required',
        ]);

        Seekers::create([
            'name' => $request->name,
            'type' => $request->type,
            'contact' => $request->contact,
            'preferred_location' => $request->preferred_location,
            'area' => $request->area,
            'budget' => $request->budget,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Data Inserted Successfully');
    }

    public function delete($id)
    {
        Seekers::destroy($id);
        return back()->with('success', 'Data Deleted Successfully');
    }

    public function show($id)
    {
        $seeker = Seekers::find($id);
        return view("html.showSeeker", compact("seeker"));
    }

    public function edit(Request $request, $id)
    {
        $seeker = Seekers::find($id);
        $seeker->update([
            'name' => $request->name,
            'type' => $request->type,
            'contact' => $request->contact,
            'preferred_location' => $request->preferred_location,
            'area' => $request->area,
            'budget' => $request->budget,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Data Updated Sucessfully');
    }

    public function contacted($id)
    {
        $seeker = Seekers::findOrFail($id);
        $seeker->update([
            'status' => 'contacted'
        ]);

        return redirect()->back()->with('success', 'Seeker marked as contacted.');
    }

    public function closed($id)
    {
        $seeker = Seekers::findOrFail($id);
        $seeker->update([
            'status' => 'closed'
        ]);
        return redirect()->back()->with('success', 'Seeker marked as closed.');
    }

    public static function seekerAnalytics()
    {
        return [
            'seekers' => Seekers::count(),
            'seekersRent' => Seekers::where('type', 'rent')->count(),
            'seekersBuy' => Seekers::where('type', 'buy')->count(),
            'seekersContacted' => Seekers::where('status', 'contacted')->count(),
            'seekersClosed' => Seekers::where('status', 'closed')->count(),
            'seekersPending' => Seekers::where('status', 'pending')->count(),
        ];
    }


}
