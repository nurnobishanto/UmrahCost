@extends('admin.layouts.app')
@push('title')
    Add Package
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  New Package -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Add Package</h5>
                <div>
                    @if (check_permission('Package List'))
                    <a href="{{ route('admin.package.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> Package List</a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.package.store') }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
                        <fieldset class="ams-input input-verticle">
                            <label for="name">Name<sup class="required">*</sup></label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" placeholder="Enter Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="currency">Select Currency<sup class="required">*</sup></label>
                            <select name="currency" id="currency" class="form-control" required >
                                <option value="">Select One</option>
                                @foreach ($currencies as $currency)
                                    <option @if($currency->id == old('currency')) selected @endif value="{{ $currency->id }}">{{ $currency->name }} ({{ $currency->sign }})</option>
                                @endforeach
                            </select>
                            @error('currency')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="cost_of_visa">Cost of Visa (In package currency)<sup class="required">*</sup></label>
                            <input type="number" step="any" value="{{ old('cost_of_visa') }}" name="cost_of_visa" id="cost_of_visa" placeholder="Enter Cost of Visa">
                            @error('cost_of_visa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="food_cost">Food Cost (In package currency)<sup class="required">*</sup></label>
                            <input type="number" step="any" value="{{ old('food_cost') }}" name="food_cost" id="food_cost" placeholder="Enter Food Cost">
                            @error('food_cost')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="p">Invoice Note</label>
                            <textarea name="invoice_note" id="invoice_note" cols="30" class="ckeditor" rows="2">{{ old('invoice_note') }}</textarea>
                            @error('invoice_note')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="text-end">
                            <button type="submit" class="submit-btn btn"><i class="far fa-save"></i> Save</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
           
        });
    </script>
@endpush
