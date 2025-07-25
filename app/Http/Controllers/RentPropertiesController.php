<?php

namespace App\Http\Controllers;

use App\Models\InvestDisposed;
use App\Models\Investment;
use App\Models\RentProcess;
use App\Models\RentProperties;
use App\Models\SaleProcess;
use App\Models\SaleProperties;
use App\Models\Spendings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentPropertiesController extends Controller
{
    // MODEL: RentProperties.php

    public function index()
    {
        $d_rent = RentProcess::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        $d_sale = SaleProcess::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        $d_invest = InvestDisposed::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
        $totalDisposed = $d_rent + $d_sale + $d_invest;
        $rent = RentProperties::count();
        $sale = SaleProperties::count();
        $invest = Investment::count();
        $totalStats = $rent + $sale + $invest;
        $spending = Spendings::count();

        $spendingController = new SpendingController();
        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;

        $profitData = $spendingController->getProfit($currentMonth);
        $netIncome = $profitData['net_income'];
        $rentIncome = $profitData['rent_income'];
        $saleIncome = $profitData['sale_income'];
        $investIncome = $profitData['invest_income'];

        $totalSpendingData = $spendingController->totalSpending($currentMonth);

        $totalSpending = $totalSpendingData['total_spending'] ?? 0;

        $seekersData = SeekersController::seekerAnalytics();

        $data = array_merge($seekersData, compact(
            'rent',
            'sale',
            'invest',
            'spending',
            'netIncome',
            'rentIncome',
            'saleIncome',
            'investIncome',
            'totalStats',
            'totalDisposed',
            'd_rent',
            'd_sale',
            'd_invest',
            'totalSpending'
        ));

        return view('html.index', $data);
    }



    public function rentProperties(Request $request)
    {
        $request->validate([
            'seller_name' => 'required',
            'seller_contact' => 'required',
            'seller_cnic' => 'nullable',
            'prop_title' => 'required',
            'prop_area' => 'required',
            'prop_loc' => 'required',
            'demand' => 'required',
            'prop_img' => 'nullable',
            'prop_img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prop_desc' => 'nullable',
        ]);


        $rent = new RentProperties();

        if ($request->hasFile('prop_img')) {
            $imagePaths = [];

            foreach ($request->file('prop_img') as $prop_img) {
                $fileName = time() . '-' . uniqid() . "-BilalDev." . $prop_img->getClientOriginalExtension();
                $prop_img->storeAs('public/image', $fileName);
                $imagePaths[] = 'storage/image/' . $fileName;
            }
            $rent->prop_img = json_encode($imagePaths);
        }

        $rent->seller_name = $request->seller_name;
        $rent->seller_contact = $request->seller_contact;
        $rent->seller_cnic = $request->seller_cnic;
        $rent->prop_title = $request->prop_title;
        $rent->prop_area = $request->prop_area;
        $rent->prop_loc = $request->prop_loc;
        $rent->demand = str_replace(',', '', $request->input('demand'));
        $rent->prop_desc = $request->prop_desc;
        $rent->save();
        return redirect()->back()->with('success', 'Property added successfully');

    }

    public function editRent(Request $request, $id)
    {
        $rent = RentProperties::find($id);

        if (!$rent) {
            return redirect()->back()->with('error', 'Property not found');
        }

        $existingImages = is_array($rent->prop_img) ? $rent->prop_img : json_decode($rent->prop_img, true) ?? [];

        if ($request->filled('remove_images')) {
            $removedImages = json_decode($request->remove_images, true) ?? [];
            $existingImages = array_diff($existingImages, $removedImages);
        }

        if ($request->hasFile('prop_img')) {
            foreach ($request->file('prop_img') as $prop_img) {
                $fileName = time() . '-' . uniqid() . "-BilalDev." . $prop_img->getClientOriginalExtension();
                $prop_img->storeAs('public/image', $fileName);
                $existingImages[] = 'storage/image/' . $fileName;
            }
        }

        $rent->prop_img = json_encode(array_values($existingImages));

        $rent->seller_name = $request->seller_name;
        $rent->seller_contact = $request->seller_contact;
        $rent->seller_cnic = $request->seller_cnic;
        $rent->prop_title = $request->prop_title;
        $rent->prop_area = $request->prop_area;
        $rent->prop_loc = $request->prop_loc;
        $rent->demand = str_replace(',', '', $request->input('demand'));
        $rent->prop_desc = $request->prop_desc;

        $rent->save();

        return redirect()->back()->with('success', 'Property updated successfully');
    }



    public function delRent($id)
    {
        if (!RentProperties::find($id)) {
            return redirect()->back()->with('error', 'Property not found');
        }
        $rent = RentProperties::find($id);
        $rent->delete();
        return redirect()->back()->with('success', 'Property deleted successfully');
    }

    public function restore($id)
    {
        if (!RentProperties::onlyTrashed()->find($id)) {
            return response()->json(['message' => 'Property not found']);
        }
        $rent = RentProperties::onlyTrashed()->find($id);
        $rent->restore();
        return response()->json(['message' => 'Property restored successfully']);
    }

    public function forceDelete($id)
    {
        if (!RentProperties::onlyTrashed()->find($id)) {
            return response()->json(['message' => 'Property not found']);
        }
        $rent = RentProperties::onlyTrashed()->find($id);
        $rent->forceDelete();
        return response()->json(['message' => 'Property deleted permanently']);
    }

    public function rentDestroyAll()
    {
        $rent = RentProperties::onlyTrashed()->get();
        foreach ($rent as $item) {
            $item->forceDelete();
        }
        return response()->json(['message' => 'All deleted properties restored successfully']);
    }

    public function showProperty($id)
    {
        $property = RentProperties::where('seller_id', $id)->first();


        if (!$property) {
            return redirect()->back()->with('error', 'Property Not Found');
        }

        if (request()->expectsJson()) {
            return response()->json($property);
        }

        return view('html.r-show', compact('property'));
    }


    public function rentShow(Request $request)
    {
        $search = $request->input('search');

        $query = RentProperties::query();

        if ($search) {
            $query->where('seller_cnic', 'LIKE', '%' . $search . '%')
                ->orWhere('seller_contact', 'LIKE', '%' . $search . '%')
                ->orWhere('seller_name', 'LIKE', '%' . $search . '%')
                ->orWhere('prop_area', $search)
                ->orWhere('prop_loc', 'LIKE', '%' . $search . '%')
                ->orWhere('demand', 'LIKE', '%' . $search . '%');
        }

        $rent = $query->latest()->paginate(10)->appends(['search' => $search]);

        return view("html.rent", compact('rent', 'search'));
    }



    // MODEL: RentProcess.php
    public function rentProcess(Request $request, $id)
    {
        $rent = RentProperties::where('seller_id', $id)->first();
        if (!$rent) {
            return redirect()->back()->with('error', 'Property not found');
        }

        $validatedData = $request->validate([
            'prop_rent' => 'required',
            'tenant_name' => 'required',
            'tenant_contact' => 'required',
            'tenant_cnic' => 'required',
            'advance' => 'required',
            'commision' => 'required',
            'agreement' => 'nullable',
        ]);

        $process = new RentProcess();

        $process->prop_title = $rent->prop_title;
        $process->prop_area = $rent->prop_area;
        $process->prop_loc = $rent->prop_loc;
        $process->landlord_name = $rent->seller_name;
        $process->landlord_contact = $rent->seller_contact;
        $process->landlord_cnic = $rent->seller_cnic;
        $process->prop_rent = str_replace(',', '', $validatedData['prop_rent']);
        $process->tenant_name = $validatedData['tenant_name'];
        $process->tenant_contact = $validatedData['tenant_contact'];
        $process->tenant_cnic = $validatedData['tenant_cnic'];
        $process->advance = str_replace(',', '', $validatedData['advance']);
        $process->commision = str_replace(',', '', $validatedData['commision']);
        $process->agreement = $validatedData['agreement'] ?? null;

        $process->save();

        $rent->delete();

        return redirect()->route('RentOutDisplay')->with('success', 'Property Rented Out Successfully');
    }

    public function rentProcessUpdate(Request $request, $id)
    {
        $process = RentProcess::find($id);

        $request->validate([
            'prop_title' => 'required',
            'prop_area' => 'required',
            'prop_loc' => 'required',
            'landlord_name' => 'required',
            'landlord_contact' => 'required',
            'landlord_cnic' => 'required',
            'prop_rent' => 'required',
            'tenant_name' => 'required',
            'tenant_contact' => 'required',
            'tenant_cnic' => 'required',
            'advance' => 'required',
            'commision' => 'required',
            'agreement' => 'nullable',
        ]);
        $process->prop_title = $request->prop_title;
        $process->prop_area = $request->prop_area;
        $process->prop_loc = $request->prop_loc;
        $process->landlord_name = $request->landlord_name;
        $process->landlord_contact = $request->landlord_contact;
        $process->landlord_cnic = $request->landlord_cnic;
        $process->prop_rent = $request->prop_rent;
        $process->tenant_name = $request->tenant_name;
        $process->tenant_contact = $request->tenant_contact;
        $process->tenant_cnic = $request->tenant_cnic;
        $process->advance = $request->advance;
        $process->commision = $request->commision;
        $process->agreement = $request->agreement ?? null;
        $process->save();

        return redirect()->back()->with('success', 'Data Updated successfully');

    }

    public function RentOutDisplay(Request $request)
    {

        $search = $request->input('search');

        $query = RentProcess::query();


        if ($search) {
            $query->where('landlord_cnic', 'LIKE', '%' . $search . '%')
                ->orWhere('landlord_contact', 'LIKE', '%' . $search . '%')
                ->orWhere('landlord_name', 'LIKE', '%' . $search . '%')
                ->orWhere('prop_area', $search)
                ->orWhere('prop_loc', 'LIKE', '%' . $search . '%')
                ->orWhere('prop_rent', 'LIKE', '%' . $search . '%')
                ->orWhere('tenant_name', 'LIKE', '%' . $search . '%')
                ->orWhere('tenant_contact', 'LIKE', '%' . $search . '%')
                ->orWhere('tenant_cnic', 'LIKE', '%' . $search . '%');
        }

        $process = $query->latest()->paginate(10)->appends(['search' => $search]);
        return view('html.rent-out', compact('process', 'search'));
    }

    public function rentOutDisplaySingle($id)
    {
        $process = RentProcess::find($id);
        if (!$process) {
            return redirect()->back()->with('error', 'Property Not Found');
        }
        return view('html.rentOutProp', compact('process'));
    }

    public function RentOutDelete($id)
    {
        $process = RentProcess::find($id);
        if (!$process) {
            return redirect()->back()->with('error', 'Property Not Found');
        }
        $process->delete();
        return redirect()->back()->with('success', 'Property Deleted Successfully');
    }
    public function RentOutDestroy($id)
    {
        $process = RentProcess::onlyTrashed()->find($id);
        if (!$process) {
            return response()->json(['message' => 'Rent Process not found'], 404);
        }
        $process->forceDelete();
        return response()->json(['message' => 'Property is Permenantly Deleted']);
    }

    public function RentOutDestroyAll()
    {
        $process = RentProcess::onlyTrashed()->get();
        if (!$process) {
            return response()->json(['message' => 'Rent Process not found'], 404);
        }
        foreach ($process as $data) {
            $data->forceDelete();
        }
        return response()->json(['message' => 'Properties Are Permenantly Deleted']);
    }

    public function RentOutTrashed()
    {
        $process = RentProcess::onlyTrashed()->get();

        if ($process->isEmpty()) {
            return response()->json(['message' => 'Rent Process not found'], 404);
        }

        return response()->json($process);
    }


    public function RentOutRestore($id)
    {
        $process = RentProcess::onlyTrashed()->find($id);
        if (!$process) {
            return response()->json(['message' => 'Rent Process not found'], 404);
        }
        $process->restore();
        return response()->json(['message' => 'Property is Restored']);
    }
}
