@extends('layout.admin-master')
@section('content')
<div class="container">
    <div class="jumbotron">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Membership Number</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Sex</th>
                    <th>Date of Birth</th>
                    <th>Marital Status</th>
                    <th>Registration Date</th>
                    <th>Next of Kin</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @foreach($members as $member)
                <tbody>
                <tr class="info">
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->registration }}</td>
                    <td><a href="{{ route('admin.view', $member->registration) }}">{{ $member->fullName() }}</a></td>
                    <td>{{ $member->phone }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->permanentAddress }}</td>
                    <td>{{ $member->sex }}</td>
                    <td>{{ $member->dob }}</td>
                    <td>{{ $member->maritalStatus }}</td>
                    <td>{{ $member->created_at }}</td>
                    @if($member->kins)
                    <td>{{ $member->kins->name }}</td>
                    @else
                        <td></td>
                    @endif
                    <td><button class="btn btn-primary">Transact</button></td>
                </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection