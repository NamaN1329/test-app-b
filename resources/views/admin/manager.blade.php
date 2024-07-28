@extends('_layouts.app')
@section('pageTitle', 'Manager')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex flex-column">
            <div class="row flex-grow">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title card-title-dash">Total Members</h4>
                                </div>
                                <div>
                                    <!-- Button trigger modal -->
                                    <button class="btn btn-primary btn-lg text-white mb-0 me-0" data-toggle="modal"
                                        data-target="#exampleModalCenter" type="button">
                                        <i class="mdi mdi-account-plus"></i>
                                        Add new member
                                    </button>
                                    <!-- End button trigger modal -->
                                </div>
                            </div>
                            <div class="table-responsive  mt-1">
                                <table id="myTable" class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex ">
                                                        <div>
                                                            <h6>{{ $user->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6>{{ $user->email }}</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $user->phone_number }}</h6>
                                                </td>
                                                <td>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#editModalCenter" class="btn btn-warning"
                                                        data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-phone_number="{{ $user->phone_number }}"
                                                        data-password="{{ $user->password }}" onclick="getEditData(this)">
                                                        Edit
                                                    </button>
                                                    <button type="button" data-toggle="modal" class="btn btn-danger"
                                                        data-id="{{ $user->id }}" onclick="getDeleteData(this)">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Start Create member Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" action="manager/add" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            @csrf
                                            <label for="exampleInputUsername1">Name</label>
                                            <input name="name" type="text" class="form-control"
                                                id="exampleInputUsername1" placeholder="Enter new member name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="email" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPhoneNumber">Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control"
                                                id="exampleInputPhoneNumber" placeholder="Enter phone number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="exampleInputPassword1" placeholder="Enter password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Create member Modal -->

    <!--Start Edit member Modal -->
    <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLongTitle">Edit New Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" action="manager/edit" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            @csrf
                                            <input name="id" type="hidden" id="editInputId">
                                            <label for="editInputName">Name</label>
                                            <input name="name" type="text" class="form-control" id="editInputName"
                                                placeholder="Enter new member name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editInputEmail">Email address</label>
                                            <input type="email" name="email" class="form-control"
                                                id="editInputEmail" placeholder="Enter email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editInputPhoneNumber">Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control"
                                                id="editInputPhoneNumber" placeholder="Enter phone number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editInputPassword">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="editInputPassword" placeholder="Enter password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Create member Modal -->
@endsection
<script>
    function getEditData(button) {
        const id = button.getAttribute('data-id');

        document.getElementById('editInputEmail').value = button.getAttribute('data-email');
        document.getElementById('editInputPhoneNumber').value = button.getAttribute('data-phone_number');
        document.getElementById('editInputName').value = button.getAttribute('data-name');
        document.getElementById('editInputPassword').value = button.getAttribute('data-password');
        document.getElementById('editInputId').value = id;

        var form = document.getElementById('editInputId').closest("form");
        // Check if the form exists
        if (form) {
            // Update the action attribute value
            form.action = `manager/edit/` + id;
        } else {
            console.error('No parent form found.');
        }
    }

    function getDeleteData(button) {
        if (confirm('Are you sure you want to delete this user?')) {
            const id = button.getAttribute('data-id');
            fetch(`manager/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        // Handle error
                        console.error('Error deleting user:', response.statusText);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }
</script>
