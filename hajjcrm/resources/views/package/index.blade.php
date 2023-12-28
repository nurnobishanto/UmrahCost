
@extends('layouts.app')
@push('css')
<!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@endpush

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Package List
            <a href="{{route('package.create')}}" class="btn btn-sm btn-info"><small>Add</small></a>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Package</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">list</h3> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>

                    <th>Client</th>
                    <th>Package Info</th>
                    <th>Makkah Days</th>
                    <th>Madinah Days</th>
                    <th>Total</th>
                    <th>Flight</th>
                    <th>Room</th>
                    <th>Cost </th>
                    <th>Cost BDT</th>

                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($packages as $key => $hi)
                  <tr>
                      <td> {{$hi->client->givenName}}</td>
                      <td>{{$hi->packageInfo->name}}</td>
                    <td>{{$hi->mak_stays}}</td>
                    <td>{{$hi->mad_stays}}</td>
                    <td>{{$hi->total_stays}}</td>
                    <td>{{$hi->flightInfo->name}}</td>
                    <td>{{$hi->mak_room_type }}</td>
                    <td>{{$hi->total_rel}}</td>
                    <td>{{$hi->total_bdt}}</td>

                    <td width="15%">
                        <!-- <a href="{{route('package.edit', $hi->id)}}" class="btn btn-sm btn-primary">Edit</a> -->
                        <a href="{{route('package.showPdf', $hi->id)}}" target="_NEW" class="btn btn-sm btn-secondary">PDF</a>
                        <!-- <form action="{{route('hotel.destroy', $hi->id)}}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-sm btn-danger">Delete</button>

                        </form> -->

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
    </section>


@endsection
@push('js')

<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


<script>

$(function () {
    $("#dataTable").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

</script>
@endpush
