@extends('admin.layouts.app')
@push('title')
    Role List
@endpush
@push('style')
@endpush
@section('content')
<div class="ams-panel-wpr">
    <div class="ams-panel">
        <div class="panel-heading">
            <h5 class="panel-title">Edit Role</h5>
            <div>
                @if (check_permission('Role List'))
                <a href="{{ route('admin.role.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> Role List</a>
                @endif
            </div>
        </div>
        <div class="panel-body">
            <div class="role-select">
                <form action="{{ route('admin.role.update') }}" method="POST">
                    @csrf
                    <fieldset class="ams-input input-verticle">
                        <label for="role_name" class="my-3">Role Name</label>
                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                        <input type="text" id="role_name" name="role_name" placeholder="Enter Role Name" readonly value="{{ strtoupper($role->name) }}">
                    </fieldset>
                    <div class="ams-selct-box-wpr">
                        <h6 class="mb-4 mt-3">Permission</h6>
                        <div class="row">
                            @foreach ($permissionGroups as $permissionGroup)
                                <div class="col-lg-6">
                                    <div class="single-select-box">
                                        <p>{{ $permissionGroup->name }}</p>
                                        <div class="check-options">
                                            @foreach ($permissionGroup->permissions as $permission)
                                                <label for="permission{{ $permission->id }}">
                                                    <input name="permissions[]" @checked(check_role_has_permission($role->slug,$permission->name)) value="{{ $permission->id }}" id="permission{{ $permission->id }}" type="checkbox">
                                                    {{ $permission->name }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
      
    </script>
@endpush
