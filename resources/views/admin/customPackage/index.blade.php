@extends('admin.layouts.app')
@push('title')
    Custom Package List
@endpush
@push('style')
<style>
    .btn-group-sm>.btn, .btn-sm {
        padding : 0 .5rem !important;
    }
    .dropdown-menu {
        min-width: 200px !important;
    }
    .dropdown-item{
        display: block;
        height: auto;
        min-width: 200px;
    }
</style>
@endpush
@section('content')
    <!-- Client Datatable -->
    <div class="ams-panel-wpr">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title"> Custom Package List</h5>
                {{-- <a href="{{ route('admin.customPackage.create') }}" class="panel-item">+ Add New Client</a> --}}

            
            </div>
            <div class="panel-body">
                <form id="table-search-form" action="{{ route('admin.customPackage.index') }}" method="GET"
                    enctype="multipart/form-data">
                    @method('GET')
                    <div class="panel-search">
                        <div class="panel-search-box">
                            <div>
                                <fieldset class="ams-input input-verticle">
                                    <label for="date">Date :</label>
                                    <div class="payment-date">
                                        <input type="text" value="{{ request('datetimes') }}" name="datetimes"
                                            id="date" autocomplete="off" />
                                        <i class="fas fa-calendar-alt"></i>
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                </fieldset>
                                <fieldset class="ams-input input-verticle">
                                    <label for="client_id">Client :</label>
                                    <select class="unit-select-box form-select" name="client_id" id="client_id">
                                        <option value="">All</option>
                                        @foreach ($clients->sortBy('name') as $client)
                                            <option value="{{ $client->id }}" @selected(request()->client_id == $client->id)>
                                                {{ ucwords($client->name) }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                                <div class="search-btns">
                                    <button type="submit" class="panel-srch-btn"><i class="fas fa-search"></i>
                                        Search</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-toolbar py-3">
                        <div class="dataTable-length">
                            <label for="show_length">Show
                                <select id="show_length" name="show">
                                    <option @selected(request()->get('show') == '10') value="10">10</option>
                                    <option @selected(request()->get('show') == '25') value="25">25</option>
                                    <option @selected(request()->get('show') == '50') value="50">50</option>
                                    <option @selected(request()->get('show') == '100') value="100">100</option>
                                </select>
                                Entries
                            </label>
                        </div>
                        {{-- <div class="panel-toolbar-menu btn-group">
                            <a href="#" class="toolbar-item active" onclick="exportData('csv')">CSV</a>
                            <a href="#" class="toolbar-item" onclick="exportData('pdf')">Pdf</a>
                        </div> --}}
                        <div class="dataTable-filter">
                            <label for="table_search" class="visually-hidden"></label>
                            <input type="text" placeholder="Search Here" id="table_search"
                                value="{{ request()->get('table_search') ?? '' }}" name="table_search" />
                        </div>
                    </div>
                </form>
                <div class="dataTable border-0">
                    <table id="supplierList" class="table table-bordered table-responsive" style="width: 100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Package</th>
                                <th>Package Type</th>
                                <th>Travel Date</th>
                                <th>Traveler</th>
                                <th>Client Name</th>
                                <th>Client Email</th>
                                <th>Client Phone</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Mail Sent By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customPackages as $customPackage)
                                <tr>
                                    <td>{{ $customPackages->firstItem() + $loop->index }}</td>
                                    <td>{{ $customPackage?->packageType?->package?->name }}</td>
                                    <td>{{ $customPackage?->packageType?->name }}</td>
                                    <td>{{ common_date_format($customPackage?->travel_date) }}</td>
                                    <td>{{ $customPackage?->nos_of_traveler }}</td>
                                    <td>{{ $customPackage?->client?->name }}</td>
                                    <td>{{ $customPackage?->client?->email }}</td>
                                    <td>{{ $customPackage?->client?->phone }}</td>
                                    <td><span class="badge" style="background-color: {{ $customPackage->status?->color }};">{{ $customPackage->status?->name ?? '' }}</span></td>
                                    <td>{{ common_date_time_format($customPackage?->created_at) }}</td>
                                    <td>{{ $customPackage?->mailSentBy?->name }}</td>
                                    <td>
                                        <div class="edit-icons">
                                            <div class="action-buttons">
                                                <label class="toggle">
                                                </label>
                                                <a target="_blank"
                                                    href="{{ route('invoice.customPackage', encrypt($customPackage->id)) }}">
                                                    <i class="fa fa-list bg-info"></i>
                                                </a>

                                                <a target="_blank"
                                                    href="{{ route('invoice.customerInvoice', encrypt($customPackage->id)) }}">
                                                    <i class="fas fa-share bg-success"></i>
                                                </a>
                                                <div class="btn-group btn-sm" style="justify-content: flex-end;">
                                                    <button type="button"class="btn btn-info dropdown-toggle waves-effect btn-sm" data-bs-toggle="dropdown" aria-expanded="false" style="margin-top: 0px !important;"> Change Status <span class="caret"></span> </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">       
                                                            @foreach ($statuses as $status)
                                                                <a href="@if($status->id == $customPackage->status_id) # @else {{ route('admin.customPackage.changeStatus',[$customPackage->id,$status->id]) }} @endif" class="dropdown-item">{{ $status->name }}</a>
                                                            @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr></tr>
                        </tfoot>
                    </table>
                </div>
                <div class="dataTable-info-wpr">
                    <div class="dataTable-info" id="supplierList-info">
                        Showing {{ $customPackages->firstItem() }} to {{ $customPackages->lastItem() }} of
                        {{ $customPackages->total() }}
                        entries
                    </div>
                    <div class="dataTable-pagination" id="supplierList-pagination">
                        {{ $customPackages->appends(Request::all())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            let keyupTimer;
            let wait = 500;
            $('#show_length').on('change', function() {
                $("#table-search-form").submit();
            });

            $('#table_search').on('keyup paste', function() {
                clearTimeout(keyupTimer);
                keyupTimer = setTimeout(function() {
                    $("#table-search-form").submit();
                }, wait);
            });
        });

        function exportData(type) {
            let EL_form = document.getElementById("table-search-form");
            let ExportUrl = '{{ route('admin.customPackage.index', '#') }}';
            EL_form.action = ExportUrl.replace('#', type);
            EL_form.submit();
            EL_form.action = '{{ route('admin.customPackage.index') }}';
            $('#table_search').focus();
        }
    </script>
@endpush
