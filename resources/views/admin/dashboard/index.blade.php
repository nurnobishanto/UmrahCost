@extends('admin.layouts.app')
@push('title')
    Dashboard
@endpush
@push('style')
@endpush
@section('content')
    <div class="ams-info-boxes-wpr">
        <div class="ams-info-boxes ams-content-boxes">
            <div class="container">
                <div class="row">
                    @php
                        $backgroundArray = ['bg-red','bg-orange','bg-violate','bg-aquamarine','bg-slateblue','bg-lightorange','bg-lightblack','bg-blue'];
                    @endphp
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="#" class="single-info-box bg-blue">
                            <div class="info-box-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="info-box-content">
                                <h1>{{ $allClients }}</h1>
                                <p>All Clients</p>
                            </div>
                        </a>
                    </div>
                    @foreach ($clientsByStatus as $key => $status)
                        @if($key < 8)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <a href="#" class="single-info-box {{ $backgroundArray[$key] }}">
                                    <div class="info-box-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="info-box-content">
                                        <h1>{{ $status->total }}</h1>
                                        <p>{{ $status?->clientStatus?->name ?? 'Others' }}</p>
                                    </div>
                                </a>
                            </div>                        
                        @endif
                    @endforeach
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="#" class="single-info-box bg-lightorange">
                            <div class="info-box-icon">
                                <i class="fa fa-handshake"></i>
                            </div>
                            <div class="info-box-content">
                                <h1>{{ $crms }}</h1>
                                <p>CRM</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="#" class="single-info-box bg-lightblack">
                            <div class="info-box-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="info-box-content">
                                <h1>{{ $packageCreated }}</h1>
                                <p>Total Package Created</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>

    </script>
@endpush
@push('chart_script')
    {{-- @include('admin.layouts.includes.chart-script') --}}
@endpush
