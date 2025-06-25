<?php

namespace App\Http\Controllers;

use App\Models\BusinessDetails;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        $business = BusinessDetails::first(); 
        return view('html.business-details', compact('business'));
    }


    public function store(Request $request)
{
    $validated = $request->validate([
        "company_name" => "required|string",
        "logo" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
    ]);

    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');
        $validated['logo'] = $logoPath;
    }

    $business = BusinessDetails::first();
    if ($business) {
        $business->update($validated);
    } else {
        BusinessDetails::create($validated);
    }

    return redirect()->back()->with('success', 'Business details saved successfully.');
}
}
