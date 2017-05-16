@extends('layout.master')
@section('content')
    <div class="container">
        <div class="jumbotron">
            <h3>Profile Details</h3>
            @include('layout.alerts')
            <br>
            <h4>Personal Details</h4>
            <form class="form-inline" method="post" action="{{ route('edit.profile') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="surname" class="col-4 col-form-label">Surname</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ Auth::user()->surname }}" id="" name="surname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="first name" class="col-4 col-form-label">First Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ Auth::user()->firstName }}" id="" name="first-name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle name" class="col-4 col-form-label">Middle Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ Auth::user()->middleName }}" id="" name="middle-name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle name" class="col-2 col-form-label">Marital Status</label>
                    <div class="col-10">
                        <select class="custom-select form-control" name="maritalStatus" value="">
                            <option value="{{ Auth::user()->maritalStatus }}">{{ Auth::user()->maritalStatus }}</option>
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
                        <input class="form-control" type="text" value="{{ Auth::user()->address }}" id="" name="address">
                    </div>
                </div>
                <div class="form-group">
                    <label for="permanent-address" class="col-12 col-form-label">Permanent Address</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ Auth::user()->permanentAddress }}" id="" name="permanentAddress">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-12 col-form-label">Phone Number</label>
                    <div class="col-10">
                        <input class="form-control" type="tel" value="{{ Auth::user()->phone }}" id="" name="phone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-12 col-form-label">Email</label>
                    <div class="col-10">
                        <input class="form-control" type="email" value="{{ Auth::user()->email }}" id="" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="occupation" class="col-12 col-form-label">Occupation</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ Auth::user()->occupation }}" id="" name="occupation">
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
            {{--Update Next of Kin Form--}}
            <form class="form-inline" method="post" action="{{ route('edit.kin') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <hr class="style2">
                <h4>Next of Kin</h4>
                <div class="form-group">
                    <label for="kin-name" class="col-4 col-form-label">Name</label>
                    <div class="col-10">
                        @if(Auth::user()->kins)
                        <input class="form-control" type="text" value="{{ Auth::user()->kins->name }}" id="" name="name">
                        @else
                        <p>No record Yet</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="relationship" class="col-4 col-form-label">Relationship</label>
                    <div class="col-10">
                        @if(Auth::user()->kins)
                        <input class="form-control" type="text" value="{{ Auth::user()->kins->relationship }}" id="" name="relationship">
                        @else
                            <p>No record Yet</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-4 col-form-label">Address</label>
                    <div class="col-10">
                        @if(Auth::user()->kins)
                        <input class="form-control" type="text" value="{{ Auth::user()->kins->kin_address }}" id="" name="kin-address">
                        @else
                            <p>No record Yet</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-12 col-form-label">Phone Number</label>
                    <div class="col-10">
                        @if(Auth::user()->kins)
                        <input class="form-control" type="tel" value="{{ Auth::user()->kins->kin_phone }}" id="" name="kin-phone">
                        @else
                            <p>No record Yet</p>
                        @endif
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
            {{--Change Password--}}
            <form class="form-inline" method="post" action="{{ route('edit.password') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <hr class="style2">
                <h4>Change Password</h4>
            </form>
            {{--Upload Picture--}}
            <form class="form-inline" method="post" action="{{ route('upload.image') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <hr class="style2">
                <h4>Upload Picture</h4>
            </form>
        </div>
    </div>
@endsection