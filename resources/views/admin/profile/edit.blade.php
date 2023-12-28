@extends('admin.layouts.app')
@push('title')
    User Profile
@endpush
@push('style')

@endpush
@section('content')
    <!--  User Profile -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">User Profile</h5>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data"
                        class="ams-form">
                        @csrf
                        @method('PUT')
                            <fieldset class="ams-input input-verticle">
                                <label for="name">Name<sup class="required">*</sup></label>
                                <input type="text" value="{{ old('name',$user->name) }}" name="name" id="name"
                                    placeholder="Enter Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input input-verticle">
                                <label for="email">Email</label>
                                <input type="text" value="{{ $user->email }}" name="email" id="email"
                                    placeholder="Enter Email" readonly>
                                @error('email')
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

    <script>
        $(document).ready(function() {
            $('.client').hide();
            @error('client')
                $('.client').show();
            @enderror
            $('#role').change(function() {
                var roleID = $(this).val();
                if (roleID == 9) {
                    $('.client').show();
                }else{
                    $('.client').hide();
                }
            });
        });
    </script>
@endpush
