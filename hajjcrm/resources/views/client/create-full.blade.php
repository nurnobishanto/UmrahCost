
@extends('layouts.app')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{isset($client) ? 'Update' : 'Add'}} Client Registration</h1>
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
            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Group name</label>
                                <input type="text" name="groupName" id="groupName" class="form-control @error('groupName') is-invalid @enderror " placeholder="groupName" value="{{$client->groupName ?? old('groupName')}}"/>
                                <span class="text-danger red-bold">
                                    @error('groupName')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Group No</label>
                                <input type="text" name="groupNo" id="groupNo" class="form-control @error('groupNo') is-invalid @enderror " placeholder="groupNo" value="{{$client->groupNo ?? old('groupNo')}}"/>
                                <span class="text-danger red-bold">
                                    @error('groupNo')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>   
                                <div class="form-group col-md-6">
                                    <label for="">Given Name</label>
                                    <input type="text" name="givenName" id="givenName" class="form-control @error('givenName') is-invalid @enderror " placeholder="givenName" value="{{$client->givenName ?? old('givenName')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('givenName')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Surname</label>
                                    <input type="text" name="surName" id="surName" class="form-control @error('surName') is-invalid @enderror " placeholder="surName" value="{{$client->surName ?? old('surName')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('surName')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Passport NO</label>
                                    <input type="text" name="passportNo" id="passportNo" class="form-control @error('passportNo') is-invalid @enderror " placeholder="passportNo" value="{{$client->passportNo ?? old('passportNo')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('passportNo')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Passport Type</label>
                                    <input type="text" name="passportType" id="passportType" class="form-control @error('passportType') is-invalid @enderror " placeholder="passportType" value="{{$client->passportType ?? old('passportType')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('passportType')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Issuing Country</label>                                    
                                    <input type="text" name="issuingCountry"   id="issuingCountry" class="form-control @error('issuingCountry') is-invalid @enderror" placeholder="issuingCountry" value="{{$client->issuingCountry ?? old('issuingCountry')}}"/>
                                    <span class="text-danger red-bold">
                                        @error('issuingCountry')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>    
                                <div class="form-group col-md-6">
                                    <label for="">PP Issu eDate</label>
                                    <div class="input-group date" id="ppIssueDate" data-target-input="nearest">
                                        <input type="text" name="ppIssueDate"  data-target="#ppIssueDate" class="form-control @error('ppIssueDate') is-invalid @enderror  datetimepicker-input" placeholder="ppIssueDate" value="{{$client->ppIssueDate ?? old('ppIssueDate')}}"/>
                                        <div class="input-group-append" data-target="#ppIssueDate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>                                    
                                    <span class="text-danger red-bold">
                                        @error('ppIssueDate')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">PP Expiry Date</label>
                                    <div class="input-group date" id="ppExpiryDate" data-target-input="nearest">
                                        <input type="text" name="ppExpiryDate"  data-target="#ppExpiryDate" class="form-control @error('ppExpiryDate') is-invalid @enderror  datetimepicker-input" placeholder="ppExpiryDate" value="{{$client->ppExpiryDate ?? old('ppExpiryDate')}}"/>
                                        <div class="input-group-append" data-target="#ppExpiryDate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <span class="text-danger red-bold">
                                        @error('ppExpiryDate')
                                            {{$message}}
                                        @enderror
                                    </span>
                                                                    
                                </div>
                            <div class="form-group col-md-6">
                                <label for="">Date of Birth</label>
                                <div class="input-group date" id="dateofBirth" data-target-input="nearest">
                                    <input type="text" name="dateofBirth"  data-target="#dateofBirth" class="form-control @error('dateofBirth') is-invalid @enderror  datetimepicker-input" placeholder="dateofBirth" value="{{$client->dateofBirth ?? old('dateofBirth')}}"/>
                                    <div class="input-group-append" data-target="#dateofBirth" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <span class="text-danger red-bold">
                                    @error('dateofBirth')
                                        {{$message}}
                                    @enderror
                                </span>
                                                            
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Mobile no</label>
                                <input type="int" name="Mobile" id="Mobile" class="form-control @error('Mobile') is-invalid @enderror " placeholder="Mobile" value="{{$client->Mobile ?? old('Mobile')}}"/>
                                <span class="text-danger red-bold">
                                    @error('Mobile')
                                        {{$message}}
                                    @enderror
                                </span>
                                                            
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Emergency Mobile</label>
                                <input type="int" name="emergencyMobile" id="emergencyMobile" class="form-control @error('emergencyMobile') is-invalid @enderror " placeholder="emergencyMobile" value="{{$client->emergencyMobile ?? old('emergencyMobile')}}"/>
                                <span class="text-danger red-bold">
                                    @error('emergencyMobile')
                                        {{$message}}
                                    @enderror
                                </span>
                                                            
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" value="{{$client->email ?? old('email')}}"/>
                                <span class="text-danger red-bold">
                                    @error('email')
                                        {{$message}}
                                    @enderror
                                </span>                                
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Number of Person</label>
                                <input type="int" name="nosofPerson" id="nosofPerson" class="form-control @error('nosofPerson') is-invalid @enderror " placeholder="nosofPerson" value="{{$client->nosofPerson ?? old('nosofPerson')}}"/>
                                <span class="text-danger red-bold">
                                    @error('nosofPerson')
                                        {{$message}}
                                    @enderror
                                </span>                                
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Tour Month</label>
                                <input type="int" name="tourMonth" id="tourMonth" class="form-control @error('tourMonth') is-invalid @enderror" placeholder="tourMonthT our Month" value="{{$client->tourMonth ?? old('tourMonth')}}"/>
                                <span class="text-danger red-bold">
                                    @error('tourMonth')
                                        {{$message}}
                                    @enderror
                                </span>                                
                            </div>
                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="new" @selected(($client->status ?? @old('status'))=='New')>New</option>
                                    </select>
                                    <span class="text-danger red-bold">
                                    @error('status')
                                        {{$message}}
                                    @enderror
                                </span> 
                        </div>
                            <div class="form-group col-md-6">
                                <label for="note">Note</label>
                                <textarea id="note" class="form-control @error('note') is-invalid @enderror " placeholder="note"  name="note" rows="4" cols="50">{{$client->note ?? old('note')}}</textarea>
                                <span class="text-danger red-bold">
                                    @error('note')
                                        {{$message}}
                                    @enderror
                                </span> 
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="query-about">Query About</label>
                                <textarea id="queryDetails" class="form-control @error('queryDetails') is-invalid @enderror " placeholder="Query About" name="queryDetails" rows="4" cols="50">{{$client->queryDetails ?? @old('queryDetails')}}</textarea>
                                <span class="text-danger red-bold">
                                    @error('queryDetails')
                                        {{$message}}
                                    @enderror
                                </span> 
                            </div>
                            <div class="form-group col-md-6">
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
@endpush