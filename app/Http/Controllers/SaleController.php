<?php

namespace App\Http\Controllers;

use App\Models\SaleProcess;
use App\Models\SaleProperties;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function addProperty(Request $request)
    {
        $request->merge([
            'demand' => str_replace(',', '', $request->demand),
        ]);

        $request->validate([
            'seller_name' => 'required',
            'seller_contact' => 'required',
            'seller_cnic' => 'required',
            'prop_title' => 'required',
            'prop_area' => 'required',
            'prop_loc' => 'required',
            'demand' => 'required',
            'prop_img' => 'nullable|array',
            'prop_img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prop_desc' => 'nullable',
        ]);
        $saleProperties = new SaleProperties();
        if ($request->hasFile('prop_img')) {
            $imagePaths = [];

            foreach ($request->file('prop_img') as $prop_img) {
                $fileName = time() . '-' . uniqid() . "-BilalDev." . $prop_img->getClientOriginalExtension();
                $prop_img->storeAs('public/image', $fileName);
                $imagePaths[] = 'storage/image/' . $fileName;
            }
            $saleProperties->prop_img = json_encode($imagePaths);
        }


        $saleProperties->seller_name = $request->seller_name;
        $saleProperties->seller_contact = $request->seller_contact;
        $saleProperties->seller_cnic = $request->seller_cnic;
        $saleProperties->prop_title = $request->prop_title;
        $saleProperties->prop_area = $request->prop_area;
        $saleProperties->prop_loc = $request->prop_loc;
        $saleProperties->demand = $request->demand;
        $saleProperties->prop_desc = $request->prop_desc;
        $saleProperties->save();
        return redirect()->back()->with('success','Property Added Successfully');
    }

    public function showSale(Request $request)
    {
        $search = $request->input('search');

        $query = SaleProperties::query();
        if($search)
        {
            $query->where('seller_cnic', 'LIKE', '%' . $search . '%')
            ->orWhere('seller_contact', 'LIKE', '%' . $search . '%')
            ->orWhere('seller_name', 'LIKE', '%' . $search . '%')
            ->orWhere('prop_area', $search)            
            ->orWhere('prop_loc', 'LIKE', '%' . $search . '%')
            ->orWhere('demand', 'LIKE', '%' . $search . '%');
        }
        $saleProperties = $query->latest()->paginate(10)->appends(['search' => $search]);

        return view('html.sale',compact('saleProperties','search'));


    }

    public function singleShowSale($id)
    {
        $saleProperties = SaleProperties::find($id);
        if(!$saleProperties){
            return redirect()->back()->with('error','Property Not Found');
        }
        return view('html.s-show',compact('saleProperties'));
    }

    public function editSale(Request $request,$id)
    {
        $request->merge([
            'demand' => str_replace(',', '', $request->demand),
        ]);
        $request->validate([
            'seller_name' => 'required|string',
            'seller_contact' => 'required|string',
            'seller_cnic' => 'required|string',
            'prop_title' => 'required|string',
            'prop_area' => 'required|string',
            'prop_loc' => 'required|string',
            'demand' => 'required|numeric',
            'prop_desc' => 'nullable|string',
        ]);
        
        $saleProperties = SaleProperties::find($id);
        if (!SaleProperties::find($id)) {
            return redirect()->back()->with('error','Property Not Found');
        }

        $existingImages = is_array($saleProperties->prop_img) ? $saleProperties->prop_img : json_decode($saleProperties->prop_img, true) ?? [];

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

        $saleProperties->prop_img = json_encode(array_values($existingImages));


        $saleProperties->seller_name = $request->seller_name;
        $saleProperties->seller_contact = $request->seller_contact;
        $saleProperties->seller_cnic = $request->seller_cnic;
        $saleProperties->prop_title = $request->prop_title;
        $saleProperties->prop_area = $request->prop_area;
        $saleProperties->prop_loc = $request->prop_loc;
        $saleProperties->demand = str_replace(',','',$request->demand);
        $saleProperties->prop_desc = $request->prop_desc;
        $saleProperties->save();
        
        return redirect()->back()->with('success','Property updated successfully');

    }

    public function delSale($id)
    {
        $saleProperties = SaleProperties::find($id);
        if(!$saleProperties){
            return redirect()->back()->with('error','Property Not Found');
        }
        $saleProperties->delete();
        return redirect()->back()->with('success','Property Deleted Successfully');
    }

    // Sale Process 

    public function saleProcess(Request $request,$id)
    {
        $saleProperties = SaleProperties::where('seller_id',$id)->first();
        if(!$saleProperties){
            return redirect()->back()->with('error','Property Not Found');
        }

        $request->merge([
            'prop_price' => str_replace(',', '', $request->prop_price),
            'advance' => str_replace(',', '', $request->advance),
            'commission' => str_replace(',', '', $request->commission),
        ]);

        $validatedData = $request->validate([
            'prop_price' => 'required|numeric',
            'buyer_name' => 'required|string',
            'buyer_contact' => 'required|string',
            'buyer_cnic' => 'required|string',
            'advance' => 'required|numeric',
            'commission' => 'required|numeric',
            'agreement' => 'nullable|string',
        ]);

        $process = new SaleProcess();

        $process->prop_title = $saleProperties->prop_title;
        $process->prop_area = $saleProperties->prop_area;
        $process->prop_loc = $saleProperties->prop_loc;
        $process->landlord_name = $saleProperties->seller_name;
        $process->landlord_contact = $saleProperties->seller_contact;
        $process->landlord_cnic = $saleProperties->seller_cnic;
        $process->prop_price = $validatedData['prop_price'];
        $process->buyer_name = $validatedData['buyer_name'];
        $process->buyer_contact = $validatedData['buyer_contact'];
        $process->buyer_cnic = $validatedData['buyer_cnic'];
        $process->advance = $validatedData['advance'];
        $process->commission = $validatedData['commission'];
        $process->agreement = $validatedData['agreement'] ?? null;

        $process->save();

        $saleProperties->delete();
        return redirect()->route('SaleOutDisplay');
    }

    public function saleProcessEdit(Request $request,$id)
    {
        $process = SaleProcess::find($id);
        if(!$process){
            return redirect()->back()->with('error','Sale Process Not Found');
        }

        $request->validate([
            'prop_title' => 'required',
            'prop_area' => 'required',
            'prop_loc' => 'required',
            'landlord_name' => 'required',
            'landlord_contact' => 'required',
            'landlord_cnic' => 'required',
            'prop_price' => 'required',
            'buyer_name' => 'required',
            'buyer_contact' => 'required',
            'buyer_cnic' => 'required',
            'advance' => 'required',
            'commission' => 'required',
            'agreement' => 'nullable',
        ]);
        $process->prop_title = $request->prop_title;
        $process->prop_area = $request->prop_area;
        $process->prop_loc = $request->prop_loc;
        $process->landlord_name = $request->landlord_name;
        $process->landlord_contact = $request->landlord_contact;
        $process->landlord_cnic = $request->landlord_cnic;
        $process->prop_price = $request->prop_price;
        $process->buyer_name = $request->buyer_name;
        $process->buyer_contact = $request->buyer_contact;
        $process->buyer_cnic = $request->buyer_cnic;
        $process->advance = $request->advance;
        $process->commission = $request->commission;
        $process->agreement = $request->agreement ?? null;
        $process->save();

        return redirect()->back()->with('success','Data Updated successfully');

    }

    public function SaleOutDisplay(Request $request)
    {
        $search = $request->input('search');

        $query = SaleProcess::query();
        if ($search) {
            $query->where('landlord_cnic', 'LIKE', '%' . $search . '%')
                ->orWhere('landlord_contact', 'LIKE', '%' . $search . '%')
                ->orWhere('landlord_name', 'LIKE', '%' . $search . '%')
                ->orWhere('prop_area', $search)                
                ->orWhere('prop_loc', 'LIKE', '%' . $search . '%')
                ->orWhere('prop_price', 'LIKE', '%' . $search . '%')
                ->orWhere('buyer_name','LIKE','%' . $search . '%')
                ->orWhere('buyer_contact','LIKE','%' . $search .'%')
                ->orWhere('buyer_cnic','LIKE','%' . $search . '%');
        }

        $process = $query->latest()->paginate(10)->appends(['search' => $search]);
        return view('html.sold-out', compact('process','search'));

    }

    public function soldOutDisplaySingle($id)
    {
        $process = SaleProcess::find($id);
        if(!$process){
            return redirect()->back()->with('error','No Sale Process Found');
        }
        return view('html.soldOutProp',compact('process'));
    }

    public function SaleOutDelete($id)
    {
        $process = SaleProcess::find($id);
        if(!$process){
            return redirect()->back()->with('error','Not Found');
        }
        $process->delete();
        return redirect()->back()->with('success','Sale Process Deleted Successfully');
    }

    public function SaleOutDestroy($id)
    {
        $process = SaleProcess::onlyTrashed()->find($id);
        if(!$process){
            return response()->json(['message' => 'Sale Process Not Found']);
        }
        $process->forceDelete();
        return response()->json(['message' => 'Sale Process Destroyed Successfully']);
    }

    public function SaleOutDestroyAll()
    {
        $process = SaleProcess::onlyTrashed()->get();
        if(!$process){
            return response()->json(['message' => 'No Sale Process Found']);
        }
        foreach($process as $p){
            $p->forceDelete();
        }
        return response()->json(['message' => 'All Sale Process Destroyed Successfully']);
    }

    public function SaleOutRestore($id)
    {
        $process = SaleProcess::onlyTrashed()->find($id);
        if(!$process){
            return response()->json(['message' => 'Sale Process Not Found']);
        }
        $process->restore();
        return response()->json(['message' => 'Sale Process Restored Successfully']);
    }

    public function SaleOutTrashed()
    {
        $process = SaleProcess::onlyTrashed()->get();
        if(!$process){
            return response()->json(['message' => 'No Sale Process Found']);
        }
        return response()->json($process);
    }
}
