
@extends('layouts.app')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{isset($suportCost) ? 'Update' : 'Add'}} Support Cost Info</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
<section class="content">
    <div class="container-fluid form-client client-registration">
        <form action="{{isset($suportCost) ? route('supportcost.update', $suportCost->id) : route('supportcost.store')}}" method="post">
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
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror " placeholder="name" value="{{$suportCost->name ?? old('name')}}"/>
                    <span class="text-danger red-bold">
                        @error('name')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="">City</label>
                    <input type="text" name="cost" id="cost" class="form-control @error('cost') is-invalid @enderror " placeholder="cost" value="{{$suportCost->cost ?? old('cost')}}"/>
                    <span class="text-danger red-bold">
                        @error('cost')
                            {{$message}}
                        @enderror
                    </span>
                </div>  
            </div>
            <button class="btn btn-primary btn-md">{{isset($suportCost) ? 'Update' : 'Save'}}</button>
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
@endpush