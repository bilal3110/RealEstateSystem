<?php

namespace App\Http\Controllers;

use App\Models\InvestDisposed;
use App\Models\Investment;
use Illuminate\Http\Request;
use Storage;

class Investments extends Controller
{

    public function addInvestment(Request $request)
    {
        $validated = $request->validate([
            'prop_title' => 'required|string',
            'prop_area' => 'required|string',
            'prop_loc' => 'required|string',
            'seller_name' => 'required|string',
            'seller_contact' => 'required|string',
            'seller_cnic' => 'required|string',
            'buying_price' => 'required',
            'my_investment' => 'required',
            'my_equity' => 'required',
            'is_sold' => 'sometimes|in:true,false,1,0,"true","false"',
            'prop_img' => 'nullable|array',
            'prop_img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prop_desc' => 'nullable|string',
        ]);

        // Convert is_sold to boolean
        $validated['is_sold'] = filter_var($request->is_sold, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false;

        $imagePaths = [];
        if ($request->hasFile('prop_img')) {
            foreach ($request->file('prop_img') as $prop_img) {
                $path = $prop_img->store('properties', 'public');
                $imagePaths[] = Storage::url($path);
            }
        }
        $investment = Investment::create([
            'prop_title' => $validated['prop_title'],
            'prop_area' => $validated['prop_area'],
            'prop_loc' => $validated['prop_loc'],
            'seller_name' => $validated['seller_name'],
            'seller_contact' => $validated['seller_contact'],
            'seller_cnic' => $validated['seller_cnic'],
            'buying_price' => $validated['buying_price'],
            'my_investment' => $validated['my_investment'],
            'my_equity' => $validated['my_equity'],
            'is_sold' => $validated['is_sold'],
            'prop_desc' => $validated['prop_desc'] ?? null,
            'prop_img' => !empty($imagePaths) ? json_encode($imagePaths) : null,
        ]);

        return redirect()->back()->with('success', 'Investment added successfully');
    }

    public function showInvestment(Request $request)
    {
        $search = $request->input('search');
        $query = Investment::query();
        if ($search) {
            $query->where('seller_cnic', 'LIKE', '%' . $search . '%')
                ->orWhere('seller_contact', 'LIKE', '%' . $search . '%')
                ->orWhere('seller_name', 'LIKE', '%' . $search . '%')
                ->orWhere('prop_area', $search)
                ->orWhere('prop_loc', 'LIKE', '%' . $search . '%')
                ->orWhere('buying_price', 'LIKE', '%' . $search . '%');
        }
        $investments = $query->latest()->paginate(10)->appends(['search' => $search]);
        return view('html.investment', compact('investments', 'search'));
    }

    public function showHold()
    {
        $investments = Investment::where('is_sold', false)->latest()->paginate(10);
        return view('html.investment', compact('investments'));
    }

    public function showSold()
    {
        $investments = Investment::where('is_sold', true)->latest()->paginate(10);
        return view('html.investment', compact('investments'));
    }


    public function showProperty($id)
    {
        $investment = Investment::where('invest_id', $id)->first();
        return view('html.i-show', compact('investment'));
    }

    public function editInvestment(Request $request, $id)
    {
        $investment = Investment::where('invest_id', $id)->first();
        $validated = $request->validate([
            'prop_title' => 'required|string',
            'prop_area' => 'required|string',
            'prop_loc' => 'required|string',
            'seller_name' => 'required|string',
            'seller_contact' => 'required|string',
            'seller_cnic' => 'required|string',
            'buying_price' => 'required',
            'my_investment' => 'required',
            'my_equity' => 'required',
            'is_sold' => 'sometimes|in:true,false,1,0,"true","false"',
            'prop_img' => 'nullable|array',
            'prop_img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prop_desc' => 'nullable|string',
        ]);

        $validated['is_sold'] = filter_var($request->is_sold, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false;

        $imagePaths = [];
        if ($request->hasFile('prop_img')) {
            foreach ($request->file('prop_img') as $prop_img) {
                $path = $prop_img->store('properties', 'public');
                $imagePaths[] = Storage::url($path);
            }
        }
        $investment->update([
            'prop_title' => $validated['prop_title'],
            'prop_area' => $validated['prop_area'],
            'prop_loc' => $validated['prop_loc'],
            'seller_name' => $validated['seller_name'],
            'seller_contact' => $validated['seller_contact'],
            'seller_cnic' => $validated['seller_cnic'],
            'buying_price' => $validated['buying_price'],
            'my_investment' => $validated['my_investment'],
            'my_equity' => $validated['my_equity'],
            'is_sold' => $validated['is_sold'],
            'prop_desc' => $validated['prop_desc'] ?? null,
            'prop_img' => !empty($imagePaths) ? json_encode($imagePaths) : null,
        ]);

        return response()->json([
            'message' => 'Investment updated successfully',
            'data' => $investment
        ]);
    }

    public function delInvestment($id)
    {
        $investment = Investment::where('invest_id', $id)->first();
        if (!$investment) {
            return redirect()->back()->with('error', 'Data Not Found');
        }
        $investment->delete();
        return redirect()->back()->with('success', 'Investment deleted successfully');
    }

    public function restoreInvestment($id)
    {
        $investment = Investment::withTrashed()->where('invest_id', $id)->first();
        $investment->restore();
        return response()->json([
            'message' => 'Investment restored successfully'
        ]);
    }

    public function forceDeleteInvestment($id)
    {
        $investment = Investment::withTrashed()->where('invest_id', $id)->first();
        $investment->forceDelete();
        return response()->json([
            'message' => 'Investment permanently deleted'
        ]);
    }

    public function forceDeleteAllInvestment()
    {
        $process = Investment::onlyTrashed()->get();
        if (!$process) {
            return response()->json(['message' => 'No Sale Process Found']);
        }
        foreach ($process as $p) {
            $p->forceDelete();
        }
        return response()->json(['message' => 'All Sale Process Destroyed Successfully']);
    }

    // Investment Disposed

    // public function investDisposed(Request $request, $id)
    // {
    //     $investment = Investment::where('invest_id', $id)->first();

    //     if (!$investment) {
    //         return redirect()->back()->with('error','No Data Found');
    //     }

    //     $request->validate([
    //         'investment_id' => 'required|exists:investment,invest_id',
    //         'buyer_name' => 'required|string|max:255',
    //         'buyer_contact' => 'required|string|max:20',
    //         'buyer_cnic' => 'required|string|max:15',
    //         'sell_price' => 'required|numeric|min:0',
    //         'advance' => 'required|numeric|min:0',
    //         'agreement' => 'nullable|string',
    //     ]);

    //     $buyingPrice = (double) str_replace(',', '', $investment->buying_price);
    //     $myEquity = (double) $investment->my_equity;

    //     $my_profit = ($request->sell_price - $buyingPrice) * ($myEquity / 100);

    //     $disposed = new InvestDisposed();
    //     $disposed->investment_id = $investment->invest_id;
    //     $disposed->buyer_name = $request->buyer_name;
    //     $disposed->buyer_contact = $request->buyer_contact;
    //     $disposed->buyer_cnic = $request->buyer_cnic;
    //     $disposed->sell_price = $request->sell_price;
    //     $disposed->advance = $request->advance;
    //     $disposed->profit = round($my_profit, 2);
    //     $disposed->agreement = $request->agreement ?? null;
    //     $disposed->save();

    //     Investment::where('invest_id', $investment->invest_id)->update(['is_sold' => true]);

    //     // \Log::info("After Processing:", [
    //     //     'invest_id' => $investment->invest_id,
    //     //     'buying_price' => $buyingPrice,
    //     //     'my_equity' => $myEquity,
    //     //     'profit' => $my_profit
    //     // ]);

    //     return redirect()->route('investDisposedShow')->with('success','Investment Disposed Successfully');
    //     // return response()->json([
    //     //     'message' => 'Investment Disposed Successfully',
    //     //     'data' => $disposed
    //     // ]);
    // }

    public function investDisposed(Request $request, $id)
    {
        // Sanitize inputs before validation
        $request->merge([
            'sell_price' => str_replace(',', '', $request->sell_price),
            'advance' => str_replace(',', '', $request->advance),
        ]);

        // Run validation
        $request->validate([
            'investment_id' => 'required|exists:investment,invest_id',
            'buyer_name' => 'required|string|max:255',
            'buyer_contact' => 'required|string|max:20',
            'buyer_cnic' => 'required|string|max:15',
            'sell_price' => 'required|numeric|min:0',
            'advance' => 'required|numeric|min:0',
            'agreement' => 'nullable|string',
        ]);

        $investment = Investment::where('invest_id', $id)->first();

        if (!$investment) {
            return redirect()->back()->with('error', 'No Data Found');
        }

        $buyingPrice = (double) str_replace(',', '', $investment->buying_price);
        $myEquity = (double) $investment->my_equity;

        $my_profit = ($request->sell_price - $buyingPrice) * ($myEquity / 100);

        $disposed = new InvestDisposed();
        $disposed->investment_id = $investment->invest_id;
        $disposed->buyer_name = $request->buyer_name;
        $disposed->buyer_contact = $request->buyer_contact;
        $disposed->buyer_cnic = $request->buyer_cnic;
        $disposed->sell_price = $request->sell_price;
        $disposed->advance = $request->advance;
        $disposed->profit = round($my_profit, 2);
        $disposed->agreement = $request->agreement ?? null;
        $disposed->save();

        Investment::where('invest_id', $investment->invest_id)->update(['is_sold' => true]);

        return redirect()->route('investDisposedShow')->with('success', 'Investment Disposed Successfully');
    }

    public function investDisposedShow()
    {
        $disposed = InvestDisposed::latest()->paginate(10);

        return view('html.disposed', compact('disposed'));
        // return response()->json([
        //     'data' => $disposed
        // ]);
    }

    public function investDisposedShowSingle($id)
    {
        $disposed = InvestDisposed::where('buyer_id', $id)->first();
        return response()->json([
            'data' => $disposed
        ]);
    }

    public function investDisposedDelete($id)
    {
        $disposed = InvestDisposed::where('buyer_id', $id)->first();
        $disposed->delete();

        Investment::where('invest_id', $disposed->investment_id)->update(['is_sold' => false]);
        return response()->json([
            'message' => 'Disposed Investment Deleted Successfully'
        ]);
    }

    public function investDisposedRestore($id)
    {
        $disposed = InvestDisposed::withTrashed()->where('buyer_id', $id)->first();
        $disposed->restore();
        Investment::where('invest_id', $disposed->investment_id)->update(['is_sold' => true]);
        return response()->json([
            'message' => 'Disposed Investment Restored Successfully'
        ]);
    }

    public function investDisposedDestroy($id)
    {
        $disposed = InvestDisposed::withTrashed()->where('buyer_id', $id)->first();
        $disposed->forceDelete();
        Investment::where('invest_id', $disposed->investment_id)->update(['is_sold' => false]);
        return response()->json([
            'message' => 'Disposed Investment Permanently Deleted'
        ]);
    }

    public function investDisposedDestroyAll()
    {
        $disposed = InvestDisposed::get();
        if (!$disposed) {
            return response()->json(['message' => 'No Disposed Investment Found']);
        }
        foreach ($disposed as $d) {
            Investment::where('invest_id', $d->investment_id)->update(['is_sold' => false]);
            $d->forceDelete();
        }
        return response()->json(['message' => 'All Disposed Investment Destroyed Successfully']);
    }

}
