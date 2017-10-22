@extends('layout.admin-master')
@section('content')
<div class="container">
    <div class="jumbotron">
        <span class="pull-right">
            <a href="{{ route('excel.members') }}">
                <button class="btn-info"
                data-toggle="tooltip" title="Print All Members">Print Members</button>
            </a>
        </span>
        <h2>All Members</h2>
        @include('layout.alerts')
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
                <tbody>
                @foreach($members as $member)
                <tr class="info">
                    <td>{{ $member->id }}</td>
                    <td><a href="{{ route('edit.member', $member->registration)}}"
                    data-toggle="tooltip" title="Edit Member">{{ $member->registration }}
                    </a></td>
                    <td><a href="{{ route('admin.view', $member->registration) }}"
                    data-toggle="tooltip" title="View Member's Profile">
                    {{ $member->fullName() }}</a></td>
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
                    <td><a href="{{ route('show.transaction', $member->id) }}" class="btn btn-primary"
                    data-toggle="tooltip" title="Make a Transaction for Member">Transact</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row text-center">
           <div class="col-lg-12">
              <ul class="pagination">
                 {{ $members->links() }}
              </ul>
           </div>
</div>
    </div>
</div>
@endsection