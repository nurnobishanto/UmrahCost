
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
            <h1>Package Rate List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Package Rate</li>
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
                <a href="{{route('hotel.create')}}" class="btn btn-md btn-primary">Add</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    
                    <th>city</th>
                    <th>Name</th>
                    <th>code</th>
                    <th>Distance</th>
                    <th>Double</th>
                    <th>Triple</th>
                    <th>Quad</th>
                    <th>Valid</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($hotelInfos as $key => $hi)
                  <tr>
                    <td>{{$hi->city}}</td> 
                    <td>{{$hi->name}}</td>
                    <td>{{$hi->code}}</td>
                    <td>{{$hi->distance }}</td>
                    <td>{{$hi->double_price}}</td>
                    <td>{{$hi->triple}}</td>                                        
                    <td>{{$hi->quad}}</td>                                        
                    <td>{{$hi->valid}}</td>                                        
                    <td>
                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{route('hotel.edit', $hi->id)}}" class="btn btn-md btn-primary mr-1">Edit</a>
                        <form action="{{route('hotel.destroy', $hi->id)}}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-md btn-danger">Delete</button>

                        </form>
                      </div>
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