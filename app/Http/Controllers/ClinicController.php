<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clinics\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = DB::table('clinics')->paginate(10);
        return view('clinics.index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clinics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $row = $request->except(['_token','create']);
        $clinic = DB::table('clinics')->insert(
            $row +
            [
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
        );

        if ($clinic){
            toastr()->success('Successfully Created');
            return redirect()->route('clinics.index');
        }else{
            toastr()->warning('Something went wrong ! please try again.');
            return redirect()->route('clinics.create');
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
        $row = DB::table('clinics')->where('id',$id)->first();
        return view('clinics.edit',compact('row'));
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
        $row = DB::table('clinics')->where('id',$id)->first();
        $this->validate($request,[
                'name' => ['required','string','max:191'],
                'domain' => ['required','regex:/^[A-Za-z0-9](?:[A-Za-z0-9\-]{0,61}[A-Za-z0-9])?$/','unique:clinics,domain,'.$row->id],
                'phone' => ['required','numeric','digits:11'],
            ]
        );

        $row = DB::table('clinics')->where('id',$id)->update([
            'name' => $request->name,
            'domain' => $request->domain,
            'phone' => $request->phone,
            'type' => $request->type,
            'active' => $request->active
        ]);
        if ($row){
            toastr()->success('Successfully Updated');
            return redirect()->route('clinics.index');
        }else {
            toastr()->warning('Something went wrong ! please try again.');
            return redirect()->route('clinics.edit',$id);
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
