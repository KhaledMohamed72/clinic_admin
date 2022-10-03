<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = DB::table('users')
            ->join('clinics','clinics.id','=','users.clinic_id')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.name', 'admin')
            ->select('users.*','clinics.*','users.name as user','clinics.name as clinic','clinics.domain as domain')
            ->get();
        return view('users.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clinics = DB::table('clinics')->get(['id', 'name']);
        return view('users.create', compact('clinics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'clinic_id' => ['required', 'integer'],
            'password' => ['min:8', 'required_with:password_confirmation', 'same:password_confirmation'],
            'password_confirmation' => ['min:8']
        ]);


        $user = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'clinic_id' => $request->clinic_id,
            'password' => Hash::make($request->password),
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        $user_id = DB::getPdo()->lastInsertId();
        $role_id = DB::table('roles')->where('name','=', 'admin')->first();
        $role_user = DB::table('role_user')->insert([
            'user_id' => $user_id,
            'role_id' => $role_id->id
        ]);

        if($user && $role_user){
            toastr()->success('Successfully Created');
            return redirect()->route('users.index');
        }else {
            toastr()->warning('Something went wrong');
            return redirect()->route('users.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = DB::table('users')
            ->join('clinics','clinics.id','=','users.clinic_id')
            ->where('users.id','=',$id)
            ->select('clinics.*','users.*','clinics.name AS clinic_name','users.name AS user_name','users.id AS user_id','clinics.id AS clinic_id')
            ->first();
        if ($row){
            return view('users.show',compact('row'));
        }else{
            toastr()->warning('Something went wrong, Maybe the user does not assign to clinic yet !');
            return redirect()->route('users.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = DB::table('users')
            ->join('clinics','users.clinic_id','=','clinics.id')
            ->select('users.*')
            ->get();
        $clinics = DB::table('clinics')->get(['id', 'name']);
        return view('users.edit',compact('row','clinics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $row = DB::table('users')->where('id',$id)->first();

        if($row){
            if (isset($request->password) != '' && $request->password != ''){
                $this->validate($request, [
                    'name' => ['required', 'string', 'max:191'],
                    'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,'.$row->id],
                    'clinic_id' => ['required', 'integer'],
                    'password' => ['min:8', 'required_with:password_confirmation', 'same:password_confirmation'],
                    'password_confirmation' => ['min:8']
                ]);
                $row = DB::table('users')->where('id',$id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'clinic_id' => $request->clinic_id,
                    'password' => Hash::make($request->password),
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]);
                toastr()->success('Successfully Updated');
                return redirect()->route('users.index');
            }else{
                unset($request->password);
                $this->validate($request, [
                    'name' => ['required', 'string', 'max:191'],
                    'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,'.$row->id],
                    'clinic_id' => ['required', 'integer'],
                ]);
                $row = DB::table('users')->where('id',$id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'clinic_id' => $request->clinic_id,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]);
                    toastr()->success('Successfully Updated');
                    return redirect()->route('users.index');
            }
        }else{
            toastr()->warning('Something went wrong ! please try again.');
            return redirect()->route('users.edit',$id);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
