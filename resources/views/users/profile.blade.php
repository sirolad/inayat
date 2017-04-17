@extends('layout.master')
@section('content')
    <div class="container">
        <div class="jumbotron">
            <h3>Profile Details</h3>
            @include('layout.alerts')
            <br>
            <h4>Personal Details</h4>
            <form class="form-inline" method="post" action="{{ route('admin.post') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="registration" class="col-4 col-form-label">Registration Id</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="" name="registration">
                    </div>
                </div>
                <div class="form-group">
                    <label for="surname" class="col-4 col-form-label">Surname</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="" name="surname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="first name" class="col-4 col-form-label">First Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="" name="first-name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle name" class="col-4 col-form-label">Middle Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="" name="middle-name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle name" class="col-2 col-form-label">Sex</label>
                    <div class="col-10">
                        <select class="custom-select form-control" name="sex">
                            <option selected>Select</option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle name" class="col-2 col-form-label">Date Of Birth</label>
                    <div class="col-10">
                        <input class="form-control" type="date" value="" id="" name="dob">
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle name" class="col-2 col-form-label">Marital Status</label>
                    <div class="col-10">
                        <select class="custom-select form-control" name="maritalStatus">
                            <option selected>Select</option>
                            <option value="married">married</option>
                            <option value="single">single</option>
                            <option value="divorced">divorced</option>
                            <option value="widowed">widowed</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-12 col-form-label">Address</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="" name="address">
                    </div>
                </div>
                <div class="form-group">
                    <label for="permanent-address" class="col-12 col-form-label">Permanent Address</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="" name="permanentAddress">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-12 col-form-label">Phone Number</label>
                    <div class="col-10">
                        <input class="form-control" type="tel" value="" id="" name="phone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-12 col-form-label">Email</label>
                    <div class="col-10">
                        <input class="form-control" type="email" value="" id="" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="occupation" class="col-12 col-form-label">Occupation</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="" name="occupation">
                    </div>
                </div>
                <hr>
                <h4>Next of Kin</h4>
                <div class="form-group">
                    <label for="kin-name" class="col-4 col-form-label">Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="relationship" class="col-4 col-form-label">Relationship</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="" name="relationship">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-4 col-form-label">Address</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="" name="kin-address">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-12 col-form-label">Phone Number</label>
                    <div class="col-10">
                        <input class="form-control" type="tel" value="" id="" name="kin-phone">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection