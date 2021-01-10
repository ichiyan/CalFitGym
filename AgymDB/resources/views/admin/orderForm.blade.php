@extends('layouts.app')

@section('menu')
    @include('admin.adminmenu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('CUSTOMERS') }}</div>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            Create new customer                             
                        </div>
                        <div class="card-header">
                            <form>
                                <label>Customer Name: <input type="text" name="search" placeholder="find inventory item"></label>
                                <label>Customer ID: <input type="text" name="search" placeholder="find inventory item"></label>
                                <input type='submit' value='Find'>
                            </form>
                        </div>
                        <div class="card-header">
                        
                            <form method='' action='/admin/customer/create'>

                                <div>
                                    <div>Customer Information</div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Surname: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='lname' required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Birthday: </label>
                                        <div class="col-md-6">
                                            <input type='date' name='birthday'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Height: </label>
                                        <div class="col-md-6">
                                            <input type='number' name='height' placeholder='cm'>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <center class="col-md-6">
                                        <input type='hidden' name='person_id' value='{{$customer->id}}'>
                                        <input type='submit' value='Submit'>
                                    </center>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>  
            </div>
        </main>
    </div>            
</div>   
@endsection