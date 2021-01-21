<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Basket;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\Customize;
use App\Models\Employee;
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

        $sidebarActive = 'employees';
        return view('admin.employeeList', compact('sidebarActive'));

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
        $now = Carbon::now();

        $person = new Person(['fname'=>$request->get('fname'), 'lname'=>$request->get('lname'),
                                'birthday'=>$request->get('birthday'), 'street_address'=>$request->get('street_address'),
                                'barangay'=>$request->get('barangay'), 'city'=>$request->get('city'), 'email_address'=>$request->get('email_address'),
                                'phone_number'=>$request->get('phone_number'), 'emergency_contact_name'=>$request->get('emergency_contact_name'),
                                'emergency_contact_number'=>$request->get('emergency_contact_number'), 'emergency_contact_relationship'=>$request->get('emergency_contact_relationship'),
                                'photo'=>NULL, 'user_id'=>$request->get('user_id') ]);
        $person->save();

        $person_id = DB::table('people')->orderBy("id", "desc")->first()->id;

        $employee = new Employee(['id'=>$person_id, 'date_hired'=>$today,
                                    'date_separated'=>NULL, 'monthly_salary'=>$request->get('monthly_salary'),
                                    'no_of_trainees'=>0, 'person_id'=>$person_id ]);
        $employee->save();

        $user_id = Auth::id();
        $logger = DB::table('people')->where('user_id', $user_id)->first();
        $init_log = new EntryLog(['entry'=>$now, 'exit'=>$now, 'person_id'=>$person_id, 'logger_id'=>$logger->id]);
        $init_log->save();

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
                        ->first();
        $trainees = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->where('customers.assigned_employee_id', $id)
                        ->get();

        return view('admin.detailEmployee', compact('employee', 'trainees'));
        //return view('admin-coreUI.detailEmployee', compact('employee'));
    }


    public function showAll($filter)
    {
        $employees = DB::table('employees')
                        ->join('people', 'employees.id', '=', 'people.id')
                        ->get();

        $countAll = DB::table('employees')
                        ->count();

        $countCurrent = DB::table('employees')
                        ->whereNull('date_separated')
                        ->count();

        $countPrevious = DB::table('employees')
                        ->whereNotNull('date_separated')
                        ->count();


        $bday = array();
        foreach ($employees as $value => $employee) {
            $bday[$value] = Carbon::parse($employee->birthday)->age;
        }

        $log = array();
        foreach ($employees as $key => $employee) {
            $log[$key] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $employee->id)->first();
        }


        $count = 0;

        if($filter == 'logged_in') {
            $file = 'admin.allEmployeeListLI';
            foreach ($employees as $key => $employee){
                if($employee->date_separated == NULL && $log[$key]->exit == NULL){
                    $count++;
                }
            }

        } else if($filter == 'logged_out') {
            $file = 'admin.allEmployeeListLO';
            foreach ($employees as $key =>  $employee){
                if($employee->date_separated == NULL && $log[$key]->exit != NULL){
                    $count++;
                }
            }

        }else{
            $file = 'admin.allEmployeeList';
        }

        $active = 'all';

        return view($file, compact('employees', 'bday', 'countAll', 'countCurrent', 'countPrevious', 'count', 'active', 'log' ));
        //return view('admin.employeeList', compact('employees', 'bday', 'countAll', 'countCurrent', 'countPrevious', 'active', 'log'));
    }


    public function showCurrent()
    {
        $employees = DB::table('employees')
                        ->join('people', 'employees.id', '=', 'people.id')
                        ->whereNull('date_separated')
                        ->get();

        $countAll = DB::table('employees')
                        ->count();

        $countCurrent = DB::table('employees')
                        ->whereNull('date_separated')
                        ->count();

        $countPrevious = DB::table('employees')
                        ->whereNotNull('date_separated')
                        ->count();

        $bday = array();
        foreach ($employees as $value => $employee) {
            $bday[$value] = Carbon::parse($employee->birthday)->age;
        }

        $active = 'current';

        $log = array();
        foreach ($employees as $key => $employee) {
            $log[$key] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $employee->id)->first();
        }

        return view('admin.allEmployeeList', compact('employees', 'bday', 'countAll', 'countCurrent', 'countPrevious', 'active', 'log'));
    }


    public function showPrevious()
    {
        $employees = DB::table('employees')
                        ->join('people', 'employees.id', '=', 'people.id')
                        ->whereNotNull('date_separated')
                        ->get();

        $countAll = DB::table('employees')
                        ->count();

        $countCurrent = DB::table('employees')
                        ->whereNull('date_separated')
                        ->count();

        $countPrevious = DB::table('employees')
                        ->whereNotNull('date_separated')
                        ->count();

        $bday = array();
        foreach ($employees as $value => $employee) {
            $bday[$value] = Carbon::parse($employee->birthday)->age;
        }

        $active = 'previous';

        $log = array();
        foreach ($employees as $key => $employee) {
            $log[$key] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $employee->id)->first();
        }

        return view('admin.allEmployeeList', compact('employees', 'bday', 'countAll', 'countCurrent', 'countPrevious', 'active', 'log'));
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
        return view('admin.editEmployeeForm', compact('employee', 'person'));
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
        $person->barangay = $request->get('barangay');
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
        $employee->save();

        return redirect('/admin/employeeList/current');
    }

    public function rehire($id)
    {
        //
        $today = Carbon::today();

        $employee = Employee::findOrFail($id);
        $employee->date_hired = $today;
        $employee->date_separated = NULL;
        $employee->save();

        return redirect('/admin/employeeList/current');
    }
}
