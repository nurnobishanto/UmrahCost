@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ __('Verify') }}
@endsection

@section('title')
    <i class="fa fa fa-check fa-fw" aria-hidden="true"></i>
    {{ __('Verify') }}
@endsection

@section('container')
    <div class="tabs tabs-full">

        <form method="post" action="{{ route('LaravelInstaller::vericationMatch') }}" class="tabs-wrap"
            enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group {{ $errors->has('user_id') ? ' has-error ' : '' }}">
                <label for="user_id">
                    {{ __('Evanto User ID') }}
                </label>
                <input type="text" name="user_id" id="user_id" value="" placeholder="{{ __('User ID') }}" />
                @if ($errors->has('user_id'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('user_id') }}
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('purchase_key') ? ' has-error ' : '' }}">
                <label for="purchase_key">
                    {{ __('Purchase Key') }}
                </label>
                <input type="text" name="purchase_key" id="purchase_key" value=""
                    placeholder="{{ __('Purchase Key') }}" />
                @if ($errors->has('purchase_key'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('purchase_key') }}
                    </span>
                @endif
            </div>

            <div class="buttons">
                <button class="button" onclick="showDatabaseSettings();return false">
                    {{ trans('installer_messages.environment.wizard.form.buttons.setup_database') }}
                    <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                </button>
            </div>

        </form>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function checkEnvironment(val) {
            var element = document.getElementById('environment_text_input');
            if (val == 'other') {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        }

        function showDatabaseSettings() {
            document.getElementById('tab2').checked = true;
        }

        function showApplicationSettings() {
            document.getElementById('tab3').checked = true;
        }
    </script>
@endsection
