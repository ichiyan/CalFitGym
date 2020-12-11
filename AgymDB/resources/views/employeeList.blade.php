@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            <a href='/admin/employeeList'>All</a>
                            <a href='/admin/employeeList/current'>Current</a>
                            <a href='/admin/employeeList/previous'>Previous</a>
                             <form>
                                <div>
                                    <label>Search: <input type="text" name="search" placeholder="find employee name"></label>
                                </div>
                            </form>
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
                                    <td> {{$employee->employeeID}} </td>
                                    <td> {{$employee->fname}}   {{$employee->lname}} </td>
                                    <td> {{$bday[$value]}} </td>
                                    <td> {{$employee->streetAddress}} ,  {{$employee->city}}  City </td>
                                    <td> {{$employee->emailAddress}} </td>
                                    <td> {{$employee->phoneNumber}} </td>
                                    <td> {{$employee->monthlySalary}} </td>
                                    <td> {{$employee->noOfTrainees}} </td>
                                    <td>
                                        <form>
                                            <input type='hidden' name='employeeID' value='{{$employee->employeeID}}'>
                                            <input type="submit" name="Update" value="update">
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