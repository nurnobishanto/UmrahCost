
@extends('layouts.app')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{isset($source) ? 'Update' : 'Add'}} Source</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Source</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid form-client client-registration">
        <form action="{{isset($source) ? route('source.update', $source->id) : route('source.store')}}" method="post">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif
             @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror " placeholder="Name" value="{{$source->name ?? old('name')}}"/>
                    <span class="text-danger red-bold">
                        @error('name')
                            {{$message}}
                        @enderror
                    </span>
                </div>

            </div>
            <button class="btn btn-primary btn-lg">{{isset($source) ? 'Update' : 'Save'}}</button>
        </form>
    </div>
</sectioin>

@endsection

@push('js')
<script>
$(function () {
    $('#ppIssueDate, #ppExpiryDate, #dateofBirth').datetimepicker({
        format: 'L'
    });
})


</script>
<script type="text/javascript">
    $('#note, #queryDetails').summernote({
        height: 250
    });
</script>
@endpush
