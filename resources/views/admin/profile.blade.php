@extends('layout.admin-master')
@section('content')
    <div class="container">
        <div class="jumbotron">
            <h3>{{ $member->fullName() . '\'s' }} Details</h3>
            @include('layout.alerts')
            <br>
            <h4>Personal Details</h4>
            <form class="form-inline" method="post" action="{{ route('update.member', $member->id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="surname" class="col-4 col-form-label">Surname</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ $member->surname }}" id="" name="surname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="first name" class="col-4 col-form-label">First Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ $member->firstName }}" id="" name="first-name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle name" class="col-4 col-form-label">Middle Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ $member->middleName }}" id="" name="middle-name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle name" class="col-2 col-form-label">Marital Status</label>
                    <div class="col-10">
                        <select class="custom-select form-control" name="maritalStatus" value="">
                            <option value="{{ $member->maritalStatus }}">{{ $member->maritalStatus }}</option>
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
                        <input class="form-control" type="text" value="{{ $member->address }}" id="" name="address">
                    </div>
                </div>
                <div class="form-group">
                    <label for="permanent-address" class="col-12 col-form-label">Permanent Address</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ $member->permanentAddress }}" id="" name="permanentAddress">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-12 col-form-label">Phone Number</label>
                    <div class="col-10">
                        <input class="form-control" type="tel" value="{{ $member->phone }}" id="" name="phone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-12 col-form-label">Email</label>
                    <div class="col-10">
                        <input class="form-control" type="email" value="{{ $member->email }}" id="" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="occupation" class="col-12 col-form-label">Occupation</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ $member->occupation }}" id="" name="occupation">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                </div>
            </form>
        @can('super-admin-can-see')
                    <br>
                    <a href="{{ route('delete.member', $member->registration)}}"
                    data-toggle="tooltip" title="Delete Member"><button class=btn-danger>Delete {{ $member->fullName() }}</button>
                    </a>
        @endcan
        </div>
    </div>
@endsection