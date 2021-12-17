<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $branches = Branch::paginate(10);
        return view('branch.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('branch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            "name" => "required|unique:branches,name",
            "start_date" => "required|date",
            "start_capital" => "required|numeric"
        ]);

        $branch = new Branch();

        $branch->name = $request->name;
        $branch->start_date = $request->start_date;
        $branch->start_capital = $request->start_capital;

        if($branch->save()){
            $branch->setting()->create([
                "country" => $request->country ?? "bangladesh",
                "currency" => $request->currency ?? "tk",
                "date_format" => $request->date_format ?? "dd/mm/yyyy",
                "currency_in_words" => $request->currency_in_words ?? "taka"
            ]);

            $branch->address()->create([
                "address" => $request->address ?? "unkhown",
                "city" => $request->city ?? "unkhown",
                "province" => $request->province ?? "unkhown",
                "zipcode" => $request->zipcode ?? null,
                "landline" => $request->landline ?? null,
                "mobile" => $request->mobile ?? null
            ]);

            $branch->loanRestriction()->create([
                "minimum_loan_amount" => $request->minimum_loan_amount,
                "maximum_loan_amount" => $request->maximum_loan_amount,
                "minimum_interest_rate" => $request->minimum_interest_rate,
                "maximum_interest_rate" => $request->maximum_interest_rate
            ]);

            return redirect()->route('branch.index')->with(["success" => "Branch Created Successfully Completed!"]);
        }else{
            return back()->with(["errors" => "Something Went To Wrong!!"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::with(['setting','address','loanRestriction'])->find($id);
        return view('branch.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        //
        $this->validate($request,[
            "name" => "required|unique:branches,name,$branch->id",
            "start_date" => "required|date",
            "start_capital" => "required|numeric"
        ]);

        $branch->name = $request->name;
        $branch->start_date = $request->start_date;
        $branch->start_capital = $request->start_capital;

        if($branch->update()){
            $branch->setting()->updateOrCreate([
                "country" => $request->country ?? "bangladesh",
                "currency" => $request->currency ?? "tk",
                "date_format" => $request->date_format ?? "dd/mm/yyyy",
                "currency_in_words" => $request->currency_in_words ?? "taka"
            ]);

            $branch->address()->updateOrCreate([
                "address" => $request->address ?? "unkhown",
                "city" => $request->city ?? "unkhown",
                "province" => $request->province ?? "unkhown",
                "zipcode" => $request->zipcode ?? null,
                "landline" => $request->landline ?? null,
                "mobile" => $request->mobile ?? null
            ]);

            $branch->loanRestriction()->updateOrCreate([
                "minimum_loan_amount" => $request->minimum_loan_amount,
                "maximum_loan_amount" => $request->maximum_loan_amount,
                "minimum_interest_rate" => $request->minimum_interest_rate,
                "maximum_interest_rate" => $request->maximum_interest_rate
            ]);

            return redirect()->route('branch.index')->with(["success" => "Branch Updated Successfully Completed!"]);
        }else{
            return back()->with(["errors" => "Something Went To Wrong!!"]);
        }
    }


    public function changeStatus(Request $request)
    {
        # code...
        $branch = Branch::find($request->get('id'));
        $branch->status = $request->get('status');
        if($branch->update()){
            return response()->json(['success' => 'Status Changed Successfully']);
        }else{
            return response()->json(['error' => 'Something went to wrong!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
