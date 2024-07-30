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
                            </div>
                            <div class="table-responsive mt-1">
                                <table id="myTable" class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Number</th>
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
