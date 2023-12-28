@extends('frontend.layouts.app')
@push('title')
    Created Packages
@endpush
@push('style')
@endpush
@section('content')
    <main class="trv-main-content">=       
        <div class="container">
            <h2 class="mb-2">Created Packages</h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#SL</th>
                        <th scope="col">Package</th>
                        <th scope="col">Package Type</th>
                        <th scope="col">Travel Date</th>
                        <th scope="col">Traveler</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $customPackage)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $customPackage?->packageType?->package?->name }}</td>
                            <td>{{ $customPackage?->packageType?->name }}</td>
                            <td>{{ common_date_format($customPackage?->travel_date) }}</td>
                            <td>{{ $customPackage?->nos_of_traveler }}</td>
                            <td>{{ $customPackage?->roomType?->name }}</td>
                            <td>
                                <a class="btn btn-primary" target="_blank" href="{{ route('invoice.customerInvoice', encrypt($customPackage->id)) }}">Invoice</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
    </main>
@endsection
@push('script')
@endpush
