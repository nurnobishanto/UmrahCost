@extends('admin.layouts.app')
@push('title')
    Edit Client
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
     <div class="ams-panel-wpr">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Edit Client</h5>
                <div>
                    @if (check_permission('Client List'))
                        <a href="{{ route('admin.client.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> Client List</a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.client.update', $user->id) }}" enctype="multipart/form-data" class="ams-form" >
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <fieldset class="ams-input">
                                <label for="name">Name<sup class="required">*</sup> </label>
                                <input type="text" value="{{ old('name', $user->name) }}" name="name" id="name" placeholder="Enter Name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="email">Email<sup class="required">*</sup> </label>
                                <input type="email" value="{{ old('email', $user->email) }}" name="email" id="email" placeholder="Enter Email" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="phone">Phone<sup class="required">*</sup> </label>
                                <input type="number" value="{{ old('phone', $user->phone) }}" name="phone" id="phone" placeholder="Enter Phone" required>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="address">Address </label>
                                <input type="text" value="{{ old('address', $user->address) }}" name="address" id="address" placeholder="Enter Address">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="query_about">Query About</label>
                                <select class="unit-select-box" name="query_about" id="query_about">
                                    <option value="">Select One</option>
                                    @foreach ($queryAbouts as $queryAbout)
                                        <option @if (old('query_about', $user->query_about_id) == $queryAbout->id) selected @endif
                                            value="{{ $queryAbout->id }}">{{ $queryAbout->name }}</option>
                                    @endforeach
                                </select>
                                @error('query_about')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="client_source">Source</label>
                                <select required class="unit-select-box" name="client_source" id="client_source">
                                    <option value="">Select One</option>
                                    @foreach ($clientSources as $clientSource)
                                        <option @if (old('client_source', $user->client_source_id) == $clientSource->id) selected @endif
                                            value="{{ $clientSource->id }}">{{ $clientSource->name }}</option>
                                    @endforeach
                                </select>
                                @error('client_source')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="query_details">Query Details</label>
                                <textarea name="query_details" id="query_details" cols="30" rows="2">{{ old('query_details', $user->query_details) }}</textarea>
                                @error('query_details')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="notes">Notes</label>
                                <textarea name="notes" id="notes" cols="30" rows="2">{{ old('notes', $user->notes) }}</textarea>
                                @error('notes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="crm">CRM<sup class="required">*</sup> </label>
                                <select required class="unit-select-box" name="crm" id="crm" required>
                                    <option value="">Select One</option>
                                    @foreach ($crms as $crm)
                                        <option @if (old('crm', $user->crm_id) == $crm->id) selected @endif
                                            value="{{ $crm->id }}">{{ $crm->name }}</option>
                                    @endforeach
                                </select>
                                @error('crm')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="status">Status</label>
                                <select required class="unit-select-box" name="status" id="status">
                                    <option value="">Select One</option>
                                    @foreach ($statuses as $status)
                                        <option @if (old('status', $user->status_id) == $status->id) selected @endif
                                            value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="client_status">Client Status</label>
                                <select required class="unit-select-box" name="client_status" id="client_status">
                                    <option value="">Select One</option>
                                    @foreach ($clientStatuses as $clientStatus)
                                        <option @if (old('client_status', $user->client_status_id) == $clientStatus->id) selected @endif
                                            value="{{ $clientStatus->id }}">{{ $clientStatus->name }}</option>
                                    @endforeach
                                </select>
                                @error('client_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="client_feedback">Client Feedback</label>
                                <select class="unit-select-box" name="client_feedback" id="client_feedback">
                                    <option value="">Select One</option>
                                    @foreach ($clientFeedbacks as $clientFeedback)
                                        <option @if (old('client_feedback', $user->client_feedback_id) == $clientFeedback->id) selected @endif
                                            value="{{ $clientFeedback->id }}">{{ $clientFeedback->name }}</option>
                                    @endforeach
                                </select>
                                @error('client_feedback')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="number_of_person">Nos Person<sup class="required">*</sup> </label>
                                <input type="number" value="{{ old('number_of_person', $user->number_of_person) }}" name="number_of_person" id="number_of_person" placeholder="Enter Nos person" required>
                                @error('number_of_person')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="tour_month">Tour Month<sup class="required">*</sup> </label>
                                <input type="month" value="{{ old('tour_month', $user->tour_month) }}" name="tour_month" id="tour_month" placeholder="Enter Tour Month" required>
                                @error('tour_month')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="password">Password</label>
                                <input type="text" value="{{ old('password') }}" name="password" id="password" placeholder="Enter Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="avatar">Avatar</label>
                                <img src="{{ asset($user->avatar ?? 'assets/no_image.jpg') }}" id="avatar_review" alt="Preview Avatar" width="150" height="150" />
                                <input type="file" accept="image/png, image/jpeg, image/jpg" name="avatar" id="avatar" onchange="document.getElementById('avatar_review').src = window.URL.createObjectURL(this.files[0])">
                                @error('avatar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
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
    <script type="text/javascript">
        $(document).ready(function() {
        
        });
    </script>
@endpush
