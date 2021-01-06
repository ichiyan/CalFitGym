@extends('layouts.app')

@section('menu')
    @include('admin.adminmenu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('EMPLOYEES') }}</div>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            <form>
                                <label>Search: <input type="search" name="search" placeholder="find employee name"></label>
                                <input type="submit" value="Search">
                            </form>
                            <button>
                                <!-- Can be replaced with an image or icon -->
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">+</a>
                            </button>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link " href='/admin/employeeList'>All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href='/admin/employeeList/current'>Current</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href='/admin/employeeList/previous'>Previous</a>
                                </li>
                            </ul>
                             
                        </div>
                        <div class="card-header">
                            No. of Employees:  {{$count}}
                        </div>
                        <table class="table table-responsive-sm table-hover table-outline mb-0">
                            <tr class="thead-light">
                                <td class="text-center">#</td>
                                <td class="text-center">Name</td>
                                <td class="text-center">Age</td>
                                <td class="text-center">Address</td>
                                <td class="text-center">Email Address</td>
                                <td class="text-center">Contact No.</td>
                                <td class="text-center">Monthly Salary</td>
                                <td class="text-center">Trainees</td>
                                <td class="text-center">Action</td>
                            </tr>        
                            @forEach ($employees as $value => $employee)
                                <tr>
                                    <td> {{$employee->id}} </td>
                                    <td> {{$employee->fname}}   {{$employee->lname}} </td>
                                    <td> {{$bday[$value]}} </td>
                                    <td> {{$employee->street_address}} ,  {{$employee->city}}  City </td>
                                    <td> {{$employee->email_address}} </td>
                                    <td> {{$employee->phone_number}} </td>
                                    <td> {{$employee->monthly_salary}} </td>
                                    <td> {{$employee->no_of_trainees}} </td>
                                    <td>
                                        <form>
                                            <input type='hidden' name='employee_id' value='{{$employee->id}}'>
                                            <input type="submit" value="Update">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>  
            </div>
        </main>
    </div>            
</div>   
@endsection