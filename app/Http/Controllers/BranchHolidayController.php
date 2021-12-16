<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchHoliday;
use Illuminate\Http\Request;

class BranchHolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        //
        if($id != null){
            $branch = Branch::with('holidays')->find($id);
            return view('branch-holiday.index',compact('branch','id'));
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
            return view('branch-holiday.create',compact('id'));
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
        if($id != null){
            $branch = Branch::find($id);
           
            $branch->holidays()->create([
                "holiday_date" => $request->date
            ]);
            
            return redirect()->route('branch-holiday.index',$id)->with(['success' => "Branch Holiday added successfully done!"]);
        }else{
            return redirect()->back()->with(['errors' => "Something went to wrong!"]);
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
        //
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
    }


    public function changeFridayIsHoliday(Request $request)
    {
        # code...
        $branch = Branch::find($request->get('id'));
        $branch->friday_is_holiday = $request->get('friday_is_holiday');
        if($branch->update()){
            return response()->json(['success' => 'Branch Friday Is Holiday Changed Successfully']);
        }else{
            return response()->json(['error' => 'Something went to wrong!']);
        }
    }


    public function changeSaturdayIsHoliday(Request $request)
    {
        # code...
        $branch = Branch::find($request->get('id'));
        $branch->saturday_is_holiday = $request->get('saturday_is_holiday');
        if($branch->update()){
            return response()->json(['success' => 'Branch Saturday Is Holiday Changed Successfully']);
        }else{
            return response()->json(['error' => 'Something went to wrong!']);
        }
    }


    public function changeSundayIsHoliday(Request $request)
    {
        # code...
        $branch = Branch::find($request->get('id'));
        $branch->sunday_is_holiday = $request->get('sunday_is_holiday');
        if($branch->update()){
            return response()->json(['success' => 'Branch Sunday Is Holiday Changed Successfully']);
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
