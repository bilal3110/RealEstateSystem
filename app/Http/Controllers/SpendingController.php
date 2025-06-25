<?php

namespace App\Http\Controllers;

use App\Models\InvestDisposed;
use App\Models\RentProcess;
use App\Models\SaleProcess;
use App\Models\Spendings;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    public function addSpending(Request $request){
        $request->validate([
            's_name'=>'required',
            's_amount'=>'required',
            's_description'=>'required'
        ]);

        $spending = new Spendings();
        $spending->s_name = $request->s_name;
        $spending->s_amount = $request->s_amount;
        $spending->s_description = $request->s_description;
        $spending->save();
        return redirect()->route('showSpending')->with('success','Data Added Successfully');
    }

    public function showSpending(){
        $spendings = Spendings::latest()->paginate(10);
        return view('html.spendings', compact('spendings'));
    }

    public function totalSpending($month){
        $year = now()->format('Y');
        $monthNumber = date('m', strtotime($month)); 
        $spending = Spendings::whereYear('created_at', $year)->whereMonth('created_at', $monthNumber)->sum('s_amount');
        return [
            'total_spending' => $spending
        ];
    }

    public function editSpending(Request $request, $id){
        $request->validate([
            's_name'=>'required',
            's_amount'=>'required',
            's_description'=>'required'
        ]);

        $spending = Spendings::find($id);
        $spending->s_name = $request->s_name;
        $spending->s_amount = $request->s_amount;
        $spending->s_description = $request->s_description;
        $spending->save();
        return response()->json(['message'=>'Spending Updated Successfully']);
    }

    public function delSpending($id){
        $spending = Spendings::find($id);
        $spending->delete();
        return redirect()->back()->with('success','Data Deleted Successfully');
    }

    public function getProfit($month)
{
    $year = now()->format('Y');
    $monthNumber = date('m', strtotime($month)); 
    
    $rentIncome = RentProcess::whereYear('created_at', $year)->whereMonth('created_at', $monthNumber)->sum('commision');
    $saleIncome = SaleProcess::whereYear('created_at', $year)->whereMonth('created_at', $monthNumber)->sum('commission');
    $investIncome = InvestDisposed::whereYear('created_at', $year)->whereMonth('created_at', $monthNumber)->sum('profit');
    $spending = Spendings::whereYear('created_at', $year)->whereMonth('created_at', $monthNumber)->sum('s_amount');

    $grossIncome = $rentIncome + $saleIncome + $investIncome;
    $netIncome = $grossIncome - $spending;

    return [ 
        'rent_income' => $rentIncome,
        'sale_income' => $saleIncome,
        'invest_income' => $investIncome,
        'spending' => $spending,
        'gross_income' => $grossIncome,
        'net_income' => $netIncome
    ];
}    
}
