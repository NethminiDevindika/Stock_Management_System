@extends('layouts.admin')

@section('content')
    
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                        List of Users
                    </div>
                    <div class="text-info text-uppercase">
                        <a href="/users/new-user"><button type="button" class="btn btn-success btn-sm float-right"><i class="fa fa-plus">New User</i></button></a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('user.search') }}" method="post">
                        <div class="form-group row">
                            @csrf
                            <div class="col-lg-6">
                                <input type="text" name="search" class="form-control" placeholder="Enter name / ID / username">
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-primary btn-sm float-left">
                                    <i class="fa fa-search">Search</i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-borderless">
                        <thead class="bg-gradient-navy">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody class="bg-light">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="/users/user-view/{{ $user->id }}" class="btn btn-warning btn-sm"><i class="fa fa-eye">View</i></a></td>
                                <td><button onclick="deleteUser({{ $user->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function deleteUser(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value === true) {

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{url('/users/user-delete')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {

                        if (results.success === true) {
                            swal("Done!", results.message, "success");
                            location.reload();
                        } else {
                            swal("Error!", results.message, "error");
                        }
                    }
                });
            } else {
                result.dismiss;
            }
        })
    }
</script>
@endsection
