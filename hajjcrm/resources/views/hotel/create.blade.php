
@extends('layouts.app')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{isset($hotelInfo) ? 'Update' : 'Add'}} Hotel Info</h1>
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
        <form action="{{isset($hotelInfo) ? route('hotel.update', $hotelInfo->id) : route('hotel.store')}}" method="post">
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
                                <label for="">City</label>
                                <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror " placeholder="city" value="{{$hotelInfo->city ?? old('city')}}"/>
                                <span class="text-danger red-bold">
                                    @error('city')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>   
                            <div class="form-group col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror " placeholder="name" value="{{$hotelInfo->name ?? old('name')}}"/>
                                <span class="text-danger red-bold">
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Package Info</label>
                                
                                <select class="form-control" id="package_info_id" name="package_info_id">
                                    <option value="">Please Select</option>
                                    @foreach($packageInfos as $packageInfo)
                                    <option value="{{ $packageInfo->id}}" {{($packageInfo->id==$hotelInfo->package_info_id) ? 'selected':''}}>{{ $packageInfo->name}}</option>
                                    @endforeach  
                                </select>

                                <span class="text-danger red-bold">
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">code</label>
                                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror " placeholder="code" value="{{$hotelInfo->code ?? old('code')}}"/>
                                <span class="text-danger red-bold">
                                    @error('code')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>   
                            <div class="form-group col-md-6">
                                <label for="">type</label>
                                <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror " placeholder="type" value="{{$hotelInfo->type ?? old('type')}}"/>
                                <span class="text-danger red-bold">
                                    @error('type')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>   
                                <div class="form-group col-md-6">
                                    <label for="">Distance</label>
                                    <input type="text" name="distance" id="distance" class="form-control @error('distance') is-invalid @enderror " placeholder="distance" value="{{$hotelInfo->distance ?? old('distance')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('distance')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">double_price</label>
                                    <input type="number" name="double_price" id="double_price" class="form-control @error('double_price') is-invalid @enderror " placeholder="double_price" value="{{$hotelInfo->double_price ?? old('double_price')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('double_price')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Triple</label>
                                    <input type="number" name="triple" id="triple" class="form-control @error('triple') is-invalid @enderror " placeholder="triple" value="{{$hotelInfo->triple ?? old('triple')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('triple')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">quad</label>
                                    <input type="number" name="quad" id="quad" class="form-control @error('quad') is-invalid @enderror " placeholder="quad" value="{{$hotelInfo->quad ?? old('quad')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('quad')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">BB</label>
                                    <input type="number" name="bb" id="bb" class="form-control @error('bb') is-invalid @enderror " placeholder="bb" value="{{$hotelInfo->bb ?? old('bb')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('bb')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Lunch</label>
                                    <input type="number" name="lunch" id="lunch" class="form-control @error('lunch') is-invalid @enderror " placeholder="lunch" value="{{$hotelInfo->lunch ?? old('lunch')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('lunch')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Dinner</label>
                                    <input type="number" name="dinner" id="dinner" class="form-control @error('dinner') is-invalid @enderror " placeholder="dinner" value="{{$hotelInfo->dinner ?? old('dinner')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('dinner')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Full</label>
                                    <input type="number" name="full" id="full" class="form-control @error('full') is-invalid @enderror " placeholder="full" value="{{$hotelInfo->full ?? old('full')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('full')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Offerd</label>
                                    <input type="text" name="offerd" id="offerd" class="form-control @error('offerd') is-invalid @enderror " placeholder="offerd" value="{{$hotelInfo->offerd ?? old('offerd')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('offerd')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">notes</label>
                                    <input type="text" name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror " placeholder="notes" value="{{$hotelInfo->notes ?? old('notes')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('notes')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">googleMap</label>
                                    <input type="text" name="googleMap" id="googleMap" class="form-control @error('googleMap') is-invalid @enderror " placeholder="googleMap" value="{{$hotelInfo->googleMap ?? old('googleMap')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('googleMap')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                
                       
                          
                            
                           
                            
                        </div>
                            <button class="btn btn-primary btn-md">{{isset($hotelInfo) ? 'Update' : 'Save'}}</button>
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