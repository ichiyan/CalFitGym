<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use App\Models\person;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = DB::table('employees')
                        ->leftJoin('people', 'employees.employeeID', '=', 'people.personID')
                        ->get();

        $bday = array();
        foreach ($employees as $value => $employee) {
            $bday[$value] = Carbon::parse($employee->birthday)->age;
        }
        
        return view('employee', compact('employees', 'bday'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return 'creating part';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $employees = DB::table('employees')
                        ->leftJoin('people', 'employees.employeeID', '=', 'people.personID')
                        ->get();
        $bday = array();
        foreach ($employees as $value => $employee) {
            $bday[$value] = Carbon::parse($employee->birthday)->age;
        }
        
        return view('employee', compact('employees', 'bday'));
    }


    public function showAll()
    {
        $employees = DB::table('employees')
                        ->join('people', 'employees.employeeID', '=', 'people.personID')
                        ->get();

        $bday = array();
        foreach ($employees as $value => $employee) {
            $bday[$value] = Carbon::parse($employee->birthday)->age;
        }
        
        return view('employee', compact('employees', 'bday'));
    }


    public function showCurrent()
    {
        $employees = DB::table('employees')
                        ->join('people', 'employees.employeeID', '=', 'people.personID')
                        ->whereNull('dateSeparated')
                        ->get();

        $bday = array();
        foreach ($employees as $value => $employee) {
            $bday[$value] = Carbon::parse($employee->birthday)->age;
        }
        
        return view('employee', compact('employees', 'bday'));
    }


    public function showPrevious()
    {
        $employees = DB::table('employees')
                        ->join('people', 'employees.employeeID', '=', 'people.personID')
                        ->whereNotNull('dateSeparated')
                        ->get();
        $bday = array();
        foreach ($employees as $value => $employee) {
            $bday[$value] = Carbon::parse($employee->birthday)->age;
        }
        
        return view('employee', compact('employees', 'bday'));
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
