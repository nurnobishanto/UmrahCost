
@extends('layouts.app')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{isset($generalSettings) ? 'Update' : 'Add'}} Hotel Info</h1>
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
        <form action="{{route('generalsetting.update', $generalSettings->id)}}" method="post">
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
                    <label for="">Visa Cost</label>
                    <input type="text" name="visa_cost" id="visa_cost" class="form-control @error('visa_cost') is-invalid @enderror " placeholder="Visa Cost" value="{{$generalSettings->visa_cost ?? old('visa_cost')}}"/>
                    <span class="text-danger red-bold">
                        @error('visa_cost')
                            {{$message}}
                        @enderror
                    </span>
                </div>   
                <div class="form-group col-md-6">
                    <label for="">Service Charge</label>
                    <input type="text" name="service_charge" id="service_charge" class="form-control @error('service_charge') is-invalid @enderror " placeholder="Service Charge" value="{{$generalSettings->service_charge ?? old('service_charge')}}"/>
                    <span class="text-danger red-bold">
                        @error('service_charge')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Conversion Rate</label>
                    <input type="text" name="conversion_rate" id="conversion_rate" class="form-control @error('conversion_rate') is-invalid @enderror " placeholder="Conversion Rate" value="{{$generalSettings->conversion_rate ?? old('conversion_rate')}}"/>
                    <span class="text-danger red-bold">
                        @error('conversion_rate')
                            {{$message}}
                        @enderror
                    </span>
                </div><br>
                <div class="form-group col-md-12">
                <button class="btn btn-primary btn-md">{{isset($generalSettings) ? 'Update' : 'Save'}}</button>
                </div>
            </div>
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