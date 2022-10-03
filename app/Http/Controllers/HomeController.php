<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = DB::table('clinics')->count();
        $doctors = DB::table('doctors')->count();
        $receptionists = DB::table('receptionists')->count();
        $patients = DB::table('patients')->count();
        return view('home',
            compact('clinics','doctors','receptionists','patients'));
    }

}
