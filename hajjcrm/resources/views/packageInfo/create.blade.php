
@extends('layouts.app')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{isset($packageInfo) ? 'Update' : 'Add'}} Packge Info</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Package Info</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid form-client client-registration">
        <form action="{{isset($packageInfo) ? route('packageinfo.update', $packageInfo->id) : route('packageinfo.store')}}" method="post">
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
                                <label for=""> name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror " placeholder="name" value="{{$packageInfo->name ?? old('name')}}"/>
                                <span class="text-danger red-bold">
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Mak Hotel</label>
                                <input type="text" name="mak_hotel" id="mak_hotel" class="form-control @error('mak_hotel') is-invalid @enderror " placeholder="mak_hotel" value="{{$packageInfo->mak_hotel ?? old('mak_hotel')}}"/>
                                <span class="text-danger red-bold">
                                    @error('mak_hotel')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                                <div class="form-group col-md-6">
                                    <label for="">Mak Hotek Desc</label>
                                    <input type="text" name="mak_hotel_desc" id="mak_hotel_desc" class="form-control @error('mak_hotel_desc') is-invalid @enderror " placeholder="mak_hotel_desc" value="{{$packageInfo->mak_hotel_desc ?? old('mak_hotel_desc')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('mak_hotel_desc')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">mad_hotel</label>
                                    <input type="text" name="mad_hotel" id="mad_hotel" class="form-control @error('mad_hotel') is-invalid @enderror " placeholder="mad_hotel" value="{{$packageInfo->mad_hotel ?? old('mad_hotel')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('mad_hotel')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Mad Hotel Desc</label>
                                    <input type="text" name="mad_hotel_desc" id="mad_hotel_desc" class="form-control @error('mad_hotel_desc') is-invalid @enderror " placeholder="mad_hotel_desc" value="{{$packageInfo->mad_hotel_desc ?? old('mad_hotel_desc')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('mad_hotel_desc')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>






                        </div>
                            <button class="btn btn-primary btn-lg">{{isset($packageInfo) ? 'Update' : 'Save'}}</button>
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
