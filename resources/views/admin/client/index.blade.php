
@extends('admin.layouts.app')
@push('title')
    Client List
@endpush
@push('style')
@endpush
@section('content')
    <!-- Client Datatable -->
    <div class="ams-panel-wpr">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title"> Client List</h5>
                @if (check_permission('Client Create'))
                    <a href="{{ route('admin.client.create') }}" class="panel-item">+ Add New Client</a>    
                @endif
            </div>
            <div class="panel-body">
                <form id="table-search-form" action="{{ route('admin.client.index') }}" method="GET"
                enctype="multipart/form-data">
                    @method('GET')
                    <div class="panel-search">
                        <div class="panel-search-box">
                            <div>
                                <fieldset class="ams-input input-verticle">
                                    <label for="client_status_id">Client Status :</label>
                                    <select class="unit-select-box form-select" name="client_status_id" id="client_status_id">
                                        <option value="">All</option>
                                        @foreach ($clientStatuses->sortBy('name') as $clientStatus)
                                            <option value="{{ $clientStatus->id }}" @selected(request()->client_status_id == $clientStatus->id)>
                                                {{ ucwords($clientStatus->name) }}
                                            </option>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>C. Status</th>
                                <th>CRM</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $clients->firstItem() + $loop->index }}</td>
                                    <td>{{ $client->name ?? '' }}</td>
                                    <td>{{ $client->email ?? '' }}</td>
                                    <td>{{ $client->phone ?? '' }}</td>
                                    <td><span class="badge" style="background-color: {{ $client->customStatus?->color }};">{{ $client->customStatus?->name ?? '' }}</span></td>
                                    <td>{{ $client->clientStatus?->name ?? '' }}</td>
                                    <td>{{ $client->crm?->name ?? '' }}</td>
                                    <td>
                                        <div class="edit-icons">
                                            <div class="action-buttons">
                                                <label class="toggle">
                                                </label>
                                                @if (check_permission('Client Edit'))
                                                    <a href="{{ route('admin.client.edit', $client->id) }}">
                                                        <i class="far fa-edit bg-info"></i>
                                                    </a>
                                                @endif
                                                @if (check_permission('Client To Package Create'))
                                                    <a href="{{ route('admin.client.package.create', $client->id) }}">
                                                        <i class="fa fa-pen bg-info"></i>
                                                    </a>
                                                @endif
                                                @if (check_permission('Client View'))
                                                    <a target="_blank" href="{{ route('invoice.clientPreview', encrypt($client->id)) }}">
                                                        <i class="fa fa-eye bg-info"></i>
                                                    </a>
                                                @endif
                                                @if (check_permission('Client Delete'))
                                                    <a href="#" id="helper_delete{{ $client->id }}"
                                                        onclick="delete_function({{ $client->id }})"
                                                        value="{{ route('admin.client.destroy', $client->id) }}">
                                                        <i class="fa fa-trash bg-lightdanger"></i>
                                                    </a>
                                                @endif
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
                        Showing {{ $clients->firstItem() }} to {{ $clients->lastItem() }} of
                        {{ $clients->total() }}
                        entries
                    </div>
                    <div class="dataTable-pagination" id="supplierList-pagination">
                        {{ $clients->appends(Request::all())->links('pagination::bootstrap-4') }}
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

        function exportData(type){
            let EL_form = document.getElementById("table-search-form");
            let ExportUrl = '{{ route('admin.client.index', '#') }}';
            EL_form.action = ExportUrl.replace('#', type);
            EL_form.submit();
            EL_form.action = '{{ route('admin.client.index') }}';
            $('#table_search').focus();
        }
    </script>
@endpush

