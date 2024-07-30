@extends('_layouts.app')
@section('pageTitle', 'Posts')

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
                                        Add Posts
                                    </button>
                                    <!-- End button trigger modal -->
                                </div>
                            </div>
                            <div class="table-responsive  mt-1">
                                <table id="myTable" class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Title</th>
                                            <th>Number</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Notes</th>
                                            <th>Added By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>
                                                    <div class="d-flex ">
                                                        <div>
                                                            <h6>{{ $post->postType->name . ' (' . $post->postType->schedule_time . ')' }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6>{{ $post->number }}</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $post->amount }}</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $post->date }}</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $post->notes }}</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $post->addedBy->name }}</h6>
                                                </td>
                                                <td>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#editModalCenter" class="btn btn-warning"
                                                        data-id="{{ $post->id }}" data-title="{{ $post->title }}"
                                                        data-amount="{{ $post->amount }}" data-notes="{{ $post->notes }}"
                                                        data-number="{{ $post->number }}" data-date="{{ $post->date }}" 
                                                        onclick="getEditData(this)">
                                                        Edit
                                                    </button>
                                                    <button type="button" data-toggle="modal" class="btn btn-danger"
                                                        data-id="{{ $post->id }}" onclick="getDeleteData(this)">
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
    <!--Start Create post Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" action="post/add" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            @csrf
                                            <label for="exampleInputTitle">Title</label>
                                            <select class="form-control" id="exampleInputTitle" name="title" required>
                                                <option value="">Select Title</option>
                                                @foreach ($postTypes as $postType)
                                                    <option value="{{ $postType->id }}">{{ $postType->name }}
                                                        ({{ $postType->schedule_time }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputDate">Date</label>
                                            <input type="date" name="date" class="form-control"
                                                id="exampleInputDate" min="@php echo Date('Y-m-d'); @endphp" 
                                                max="@php echo Date('Y-m-d', strtotime(' +1 day')) @endphp"
                                                value="@php echo Date('Y-m-d'); @endphp"
                                                placeholder="Select Date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputNumber">Number</label>
                                            <input type="number" name="number" class="form-control"
                                                id="exampleInputNumber" placeholder="Enter number" min="1" max="100" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputAmount">Amount</label>
                                            <input type="number" name="amount" class="form-control"
                                                id="exampleInputAmount" placeholder="Enter amount" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputNotes">Notes</label>
                                            <input type="text" name="notes" class="form-control"
                                                id="exampleInputNotes" placeholder="Enter notes" required>
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
    <!--End Create post Modal -->

    <!--Start Edit post Modal -->
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
                <form class="forms-sample" action="post/edit" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            @csrf
                                            <input type="hidden" id="editInputId" />
                                            <label for="editInputTitle">Title</label>
                                            <select class="form-control" id="editInputTitle" name="title" required>
                                                <option value="">Select Title</option>
                                                @foreach ($postTypes as $postType)
                                                    <option value="{{ $postType->id }}">{{ $postType->name }}
                                                        ({{ $postType->schedule_time }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editInputDate">Date</label>
                                            <input type="date" name="date" class="form-control"
                                                id="editInputDate" min="@php echo Date('Y-m-d'); @endphp" 
                                                max="@php echo Date('Y-m-d', strtotime(' +1 day')) @endphp"
                                                value="@php echo Date('Y-m-d'); @endphp"
                                                placeholder="Select Date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Number</label>
                                            <input type="number" id="editInputNumber" name="number"
                                                class="form-control" placeholder="Enter number" min="1" max="100" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Amount</label>
                                            <input type="number" id="editInputAmount" name="amount"
                                                class="form-control" placeholder="Enter number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPhoneNumber">Notes</label>
                                            <input type="text" name="notes" class="form-control"
                                                id="editInputNotes" placeholder="Enter notes" required>
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
    <!--End Create post Modal -->
@endsection
<script>
    function getEditData(button) {
        const id = button.getAttribute('data-id');
        document.getElementById('editInputTitle').value = button.getAttribute('data-title');
        document.getElementById('editInputNumber').value = button.getAttribute('data-number');
        document.getElementById('editInputNotes').value = button.getAttribute('data-notes');
        document.getElementById('editInputAmount').value = button.getAttribute('data-amount');
        document.getElementById('editInputDate').value = button.getAttribute('data-date');
        document.getElementById('editInputId').value = id;

        var form = document.getElementById('editInputId').closest("form");
        if (form) {
            form.action = `post/edit/` + id;
        } else {
            console.error('No parent form found.');
        }
    }

    function getDeleteData(button) {
        if (confirm('Are you sure you want to delete this user?')) {
            const id = button.getAttribute('data-id');
            fetch(`post/delete/${id}`, {
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
