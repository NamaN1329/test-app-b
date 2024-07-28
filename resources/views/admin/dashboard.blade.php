@extends('_layouts.app')
@section('pageTitle', 'Dashboard')

@section('content')

    <div class="row">
        {{-- <div class="col-sm-12">
            <div class="statistics-details d-flex align-items-center justify-content-between">
                <div>
                    <p class="statistics-title">Bounce Rate</p>
                    <h3 class="rate-percentage">32.53%</h3>
                    <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                </div>
                <div>
                    <p class="statistics-title">Page Views</p>
                    <h3 class="rate-percentage">7,682</h3>
                    <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                </div>
                <div>
                    <p class="statistics-title">New Sessions</p>
                    <h3 class="rate-percentage">68.8</h3>
                    <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                </div>
                <div class="d-none d-md-block">
                    <p class="statistics-title">Avg. Time on Site</p>
                    <h3 class="rate-percentage">2m:35s</h3>
                    <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                </div>
                <div class="d-none d-md-block">
                    <p class="statistics-title">New Sessions</p>
                    <h3 class="rate-percentage">68.8</h3>
                    <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                </div>
                <div class="d-none d-md-block">
                    <p class="statistics-title">Avg. Time on Site</p>
                    <h3 class="rate-percentage">2m:35s</h3>
                    <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-lg-12 d-flex flex-column">
            <div class="row flex-grow">
                @foreach ($slots as $slot)
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title card-title-dash">Market Overview (@php
                                            echo Date('d-m-Y');
                                        @endphp)</h4>
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                    <h2><?php echo $slot['postType']['name']; ?> (<?php echo $slot['postType']['schedule_time']; ?>)</h2>
                                    <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                        <h2 class="me-2 fw-bold">{{ $slot->total_amount }}</h2>
                                        <h4 class="me-2">INR</h4>
                                    </div>
                                    <div class="me-3">
                                        <div id="marketingOverview-legend"></div>
                                    </div>
                                </div>
                                <div class="chartjs-bar-wrapper mt-3">
                                    <canvas id="marketingOverview<?php echo $slot->title; ?>"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <input type="hidden" id="slots" value="{{$slots}}">
        </div>
    </div>

    <!-- main-panel ends -->
@endsection
