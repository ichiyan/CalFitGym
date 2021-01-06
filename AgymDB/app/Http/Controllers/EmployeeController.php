<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Basket;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\Customize;
use App\Models\EntryLog;
use App\Models\Event;
use App\Models\InventoryLog;
use App\Models\Item;
use App\Models\Membership;
use App\Models\MembershipHistory;
use App\Models\MemberType;
use App\Models\Order;
use App\Models\Person;
use App\Models\Remark;
use App\Models\User;

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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $today = Carbon::today();

        $person = new Person(['fname'=>$request->get('fname'), 'lname'=>$request->get('lname'), 
                                'birthday'=>$request->get('birthday'), 'street_address'=>$request->get('street_address'), 
                                'city'=>$request->get('city'), 'email_address'=>$request->get('email_address'), 
                                'phone_number'=>$request->get('phone_number'), 'emergency_contact_name'=>$request->get('emergency_contact_name'),
                                'emergency_contact_number'=>$request->get('emergency_contact_number'), 'emergency_contact_relationship'=>$request->get('emergency_contact_relationship'),
                                'photo'=>NULL, 'user_id'=>$request->get('user_id') ]);
        $person->save();

        $person_id = DB::table('people')->orderBy("id", "desc")->first()->id; 

        $employee = new Employee(['id'=>$person_id, 'date_hired'=>$today, 
                                    'date_separated'=>NULL, 'monthly_salary'=>$request->get('monthly_salary'),
                                    'no_of_trainees'=>0, 'person_id'=>$person_id ]);
        $employee->save();

        return redirect('/admin/employeeList/');
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
        $employee = DB::table('employees')
                        ->join('people', 'employees.id', '=', 'people.id')
                        ->where('employees.id', '=', $id)
                        ->get();
        $count = 1;

        $bday = Carbon::parse($employee->birthday)->age;
        
        return view('admin.employeeDetail', compact('employees', 'bday', 'count'));
    }


    public function showAll()
    {
        $employees = DB::table('employees')
                        ->join('people', 'employees.id', '=', 'people.id')
                        ->get();

        $count = DB::table('employees')
                        ->count();
        
        $bday = array();
        foreach ($employees as $value => $employee) {
            $bday[$value] = Carbon::parse($employee->birthday)->age;
        }

        return view('admin.employeeList', compact('employees', 'bday', 'count'));
    }


    public function showCurrent()
    {
        $employees = DB::table('employees')
                        ->join('people', 'employees.id', '=', 'people.id') 
                        ->whereNull('date_separated')
                        ->get();

        $count = DB::table('employees')
                        ->whereNull('date_separated')
                        ->count();
        
        $bday = array();
        foreach ($employees as $value => $employee) {
            $bday[$value] = Carbon::parse($employee->birthday)->age;
        }

        return view('admin.employeeListCurrent', compact('employees', 'bday', 'count'));
    }


    public function showPrevious()
    {
        $employees = DB::table('employees')
                        ->join('people', 'employees.id', '=', 'people.id')
                        ->whereNotNull('date_separated')
                        ->get();

        $count = DB::table('employees')
                        ->whereNotNull('date_separated')
                        ->count();

        $bday = array();
        foreach ($employees as $value => $employee) {
            $bday[$value] = Carbon::parse($employee->birthday)->age;
        }
        
        return view('admin.employeeList', compact('employees', 'bday', 'count'));
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
        $employee = Employee::findOrFail($id);
        $person = Person::findOrFail($id);
        return view('admin.employeeEdit', compact('employee', 'person'));
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
        $employee = Employee::findOrFail($id);
        $employee->monthly_salary = $request->get('monthly_salary');
        $employee->save();

        $person = Person::findOrFail($id);
        $person->fname = $request->get('fname');
        $person->lname = $request->get('lname');
        $person->birthday = $request->get('birthday');
        $person->street_address = $request->get('street_address');
        $person->city = $request->get('city');
        $person->email_address = $request->get('email_address'); 
        $person->phone_number = $request->get('phone_number');
        $person->emergency_contact_name = $request->get('emergency_contact_name');
        $person->emergency_contact_number = $request->get('emergency_contact_number');
        $person->emergency_contact_relationship = $request->get('emergency_contact_relationship');
        $person->save();

        return redirect()->route('employeeDetail', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //soft delete by adding an entry on the date separated
        $today = Carbon::today();

        $employee = Employee::findOrFail($id);
        $employee->date_separated = $today;

        return redirect('/admin/employeeList/current');
    }
}
