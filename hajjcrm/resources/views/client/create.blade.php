
@extends('layouts.app')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{isset($client) ? 'Update' : 'Add'}} Client</h1>
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
        <form action="{{isset($client) ? route('client.update', $client->id) : route('client.store')}}" method="post">
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
                    <input type="text" name="givenName" id="givenName" class="form-control @error('givenName') is-invalid @enderror " placeholder="Name" value="{{$client->givenName ?? old('givenName')}}"/>
                    <span class="text-danger red-bold">
                        @error('givenName')
                            {{$message}}
                        @enderror
                    </span>
                </div>



                <div class="form-group col-md-4">
                    <label for="">Mobile No</label>
                    <input type="int" name="Mobile" id="Mobile" class="form-control @error('Mobile') is-invalid @enderror " placeholder="Mobile" value="{{$client->Mobile ?? old('Mobile')}}"/>
                    <span class="text-danger red-bold">
                        @error('Mobile')
                            {{$message}}
                        @enderror
                    </span>

                </div>

                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" value="{{$client->email ?? old('email')}}"/>
                    <span class="text-danger red-bold">
                        @error('email')
                            {{$message}}
                        @enderror
                    </span>
                </div>


                <div class="form-group col-md-12 ">
                    <label for="query-about">Query About</label>
                    <textarea id="queryDetails" class="form-control @error('queryDetails') is-invalid @enderror " placeholder="Query About" name="queryDetails" rows="3" cols="50">{{$client->queryDetails ?? @old('queryDetails')}}</textarea>
                    <span class="text-danger red-bold">
                        @error('queryDetails')
                            {{$message}}
                        @enderror
                    </span>
                </div>

                <div class="form-group col-md-6 ">
                    <label for="">Source Id</label>
                    <select name="source_id" id="source" class="form-control @error('source_id') is-invalid @enderror">
                        <option>select one</option>
                        @foreach($source as $c)
                        <option value="{{$c->id}}" @selected(($client->source_id ?? @old('source_id'))==$c->id)>{{$c->name}}</option>
                        @endforeach
                    </select>
                    @error('source_id')
                            {{$message}}
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="crm_id">Crm Id</label>
                    <select name="crm_id" id="crm_id" class="form-control @error('crm_id') is-invalid @enderror">
                        <option>select one</option>
                        @foreach($crm as $c)
                        <option value="{{$c->id}}" @selected( ($client->crm_id ?? @old('crm_id')) == $c->id)>{{$c->name}}</option>
                        @endforeach
                    </select>
                    @error('crm_id')
                        {{$message}}
                    @enderror
                </div>


                <div class="form-group col-md-12">
                    <label for="note">Note</label>
                    <textarea id="note" class="form-control @error('note') is-invalid @enderror " placeholder="Note"  name="note" rows="3" cols="50">{{$client->note ?? old('note')}}</textarea>
                    <span class="text-danger red-bold">
                        @error('note')
                            {{$message}}
                        @enderror
                    </span>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Number of Person</label>
                    <input type="int" name="nosofPerson" id="nosofPerson" class="form-control @error('nosofPerson') is-invalid @enderror " placeholder="No of Persons" value="{{$client->nosofPerson ?? old('nosofPerson')}}"/>
                    <span class="text-danger red-bold">
                        @error('nosofPerson')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Tour Month</label>
                    <input type="int" name="tourMonth" id="tourMonth" class="form-control @error('tourMonth') is-invalid @enderror" placeholder="Tour Month" value="{{$client->tourMonth ?? old('tourMonth')}}"/>
                    <span class="text-danger red-bold">
                        @error('tourMonth')
                            {{$message}}
                        @enderror
                    </span>
                </div>




            </div>
            <button class="btn btn-primary btn-lg">{{isset($client) ? 'Update' : 'Save'}}</button>
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
