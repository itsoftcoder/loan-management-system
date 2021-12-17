<?php

namespace App\Http\Controllers;

use App\Models\BranchCapital;
use Illuminate\Http\Request;

class BranchCapitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        // if
        if($id != null){
            $deposit_capitals = BranchCapital::where('branch_id',$id)->isDeposit()->get();
            $withdrawal_capitals = BranchCapital::where('branch_id',$id)->isWithdrawal()->get();
            return view('branch-capital.index',compact('deposit_capitals','withdrawal_capitals','id'));
        }else{
            return redirect()->back();
        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        //
        if($id != null){  
            return view('branch-capital.create',compact('id'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //
        $this->validate($request,[
            'date' => "required|date",
            "amount" => "required|numeric",
            "description" => "nullable|max:255"
        ]);

        $branch_capital = new BranchCapital();
        $branch_capital->branch_id = $id;
        $branch_capital->capital_date = $request->date;
        $branch_capital->capital_amount = $request->amount;
        $branch_capital->capital_type = $request->capital_type;
        $branch_capital->description = $request->description;
        $branch_capital->status = $request->status;

        if($branch_capital->save()){
            return redirect()->route('branch-capital.index',$id)->with(['success' => "Capital Added Successfully Done!"]);
        }else{
            return back()->with(['errors' => "Something Went To Wrong!"]);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        $branch_capital = BranchCapital::find($id);
        return view('branch-capital.edit',compact('branch_capital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'date' => "required|date",
            "amount" => "required|numeric",
            "description" => "nullable|max:255"
        ]);

        $branch_capital = BranchCapital::find($id);
        $branch_capital->capital_date = $request->date;
        $branch_capital->capital_amount = $request->amount;
        $branch_capital->capital_type = $request->capital_type;
        $branch_capital->description = $request->description;
        $branch_capital->status = $request->status;

        if($branch_capital->update()){
            return redirect()->route('branch-capital.index',$branch_capital->branch_id)->with(['success' => "Capital Updated Successfully Done!"]);
        }else{
            return back()->with(['errors' => "Something Went To Wrong!"]);
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
