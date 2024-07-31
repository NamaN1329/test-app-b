@extends('_layouts.app')
@section('pageTitle', 'Winner')

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
                                @if (auth()->user()->role === 1)
                                    <div>
                                        <!-- Button trigger modal -->
                                        <button class="btn btn-primary btn-lg text-white mb-0 me-0" data-toggle="modal"
                                            data-target="#exampleModalCenter" type="button">
                                            <i class="mdi mdi-account-plus"></i>
                                            Add Winner
                                        </button>
                                        <!-- End button trigger modal -->
                                    </div>
                                    <!--Start Create Winner Modal -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Add Winner</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="winners/store" method="POST">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 grid-margin stretch-card">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                            @csrf
                                                                            <label for="exampleInputTitle">Post Type</label>
                                                                            <select class="form-control"
                                                                                id="exampleInputTitle" name="post_type"
                                                                                required>
                                                                                <option value="">Select Title</option>
                                                                                @foreach ($postTypes as $postType)
                                                                                    <option value="{{ $postType->id }}">
                                                                                        {{ $postType->name }}
                                                                                        ({{ $postType->schedule_time }})
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputDate">Date</label>
                                                                            <input type="date" name="date"
                                                                                class="form-control" id="exampleInputDate"
                                                                                min="@php echo Date('Y-m-d'); @endphp"
                                                                                max="@php echo Date('Y-m-d') @endphp"
                                                                                value="@php echo Date('Y-m-d'); @endphp"
                                                                                placeholder="Select Date" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputNumber">Number</label>
                                                                            <input type="number" name="number"
                                                                                class="form-control" id="exampleInputNumber"
                                                                                placeholder="Enter number" min="1"
                                                                                max="100" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Create Winner Modal -->
                                @endif
                            </div>
                            <div class="table-responsive mt-1">
                                <table id="myTable" class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Number</th>
                                            <th>Mannual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($winners as $winner)
                                            <tr>
                                                <td>
                                                    <div>
                                                        <div>
                                                            <h6>{{ $winner->postType->name . ' (' . $winner->postType->schedule_time . ')' }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6>{{ $winner->date }}</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $winner->number }}</h6>
                                                </td>
                                                @if (auth()->user()->role === 1)
                                                    <td>
                                                        <h6>{{ $winner->is_mannual ? 'Yes' : 'No' }}</h6>
                                                    </td>
                                                @endif
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
@endsection
