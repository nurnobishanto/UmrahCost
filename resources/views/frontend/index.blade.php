@extends('frontend.layouts.app')
@push('title')
    Home
@endpush
@push('style')
@endpush
@section('content')
    <main class="trv-main-content">
        @auth
        <div class="text-center">
            <h6>Dear {{ auth()->user()->name }}</h6>
            <h5>Welcome to your dashboard !</h5>
            @if(Auth()->user()->user_type == 'admin')
                <a href="{{route('admin.dashboard')}}" class="btn btn-danger">Open Dashboard</a>
            @endif
        </div>
        @else
            @include('frontend.layouts.partials.banner')
            @include('frontend.layouts.partials.container')

            <section class="my-5">
                <div class="container">
                    <div class="sec-heading mb-4">
                        <h2>Welcome ! Build Your Umrah Package Yourself</h2>
                        <p>This is the first time in Bangladesh, Alhamdulillah. Powered by ZamZam Travels BD.</p>
                    </div>
                    <div class="row g-4 g-lg-0">
                        <div class="col-lg-6 pe-lg-0">
                            <div class="content">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus praesentium hic tempore
                                    quasi consequatur, quidem illum recusandae dolorum laboriosam nobis distinctio tempora
                                    et voluptate? Quos atque et eligendi sapiente earum enim eius quibusdam. Facere
                                    aspernatur commodi quisquam, nulla esse suscipit necessitatibus tempore quibusdam, nihil
                                    quos enim quam minus, dolor quo consequuntur sapiente totam officiis veniam ipsum saepe
                                    soluta provident! Soluta praesentium libero nam quidem! Quia adipisci quas ratione.
                                    Inventore officia tempora accusamus pariatur dolore itaque, deserunt possimus ab iure
                                    eum. Doloribus maiores fugit officiis enim similique dolorum eligendi accusamus libero
                                    obcaecati, quisquam iusto aut voluptatibus soluta, aliquam neque ipsam cumque!</p>
                            </div>
                        </div>
                        <div class="col-lg-6 ps-lg-0">
                            <div class="video">
                                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/ze2W50dgoJ4"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="my-5">
                <div class="container">
                    <div class="sec-heading mb-4">
                        <h2>Why You Choose Umrah Package cost Calculator</h2>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="content">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus praesentium hic tempore
                                    quasi consequatur, quidem illum recusandae dolorum laboriosam nobis distinctio tempora
                                    et voluptate? Quos atque et eligendi sapiente earum enim eius quibusdam. Facere
                                    aspernatur commodi quisquam, nulla esse suscipit necessitatibus tempore quibusdam, nihil
                                    quos enim quam minus, dolor quo consequuntur sapiente totam officiis veniam ipsum saepe
                                    soluta provident! Soluta praesentium libero nam quidem! Quia adipisci quas ratione.
                                    Inventore officia tempora accusamus pariatur dolore itaque, deserunt possimus ab iure
                                    eum. Doloribus maiores fugit officiis enim similique dolorum eligendi accusamus libero
                                    obcaecati, quisquam iusto aut voluptatibus soluta, aliquam neque ipsam cumque!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="my-5">
                <div class="container">
                    <div class="sec-heading text-center mb-4">
                        <a href="{{ route('frontend.customPackage.create') }}" class="btn-red">Umrah Package Calculator</a>
                        <h2 class="mt-2">Umrah Package From Bangladesh</h2>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="content border-0">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus praesentium hic tempore
                                    quasi consequatur, quidem illum recusandae dolorum laboriosam nobis distinctio tempora
                                    et voluptate? Quos atque et eligendi sapiente earum enim eius quibusdam. Facere
                                    aspernatur commodi quisquam, nulla esse suscipit necessitatibus tempore quibusdam, nihil
                                    quos enim quam minus, dolor quo consequuntur sapiente totam officiis veniam ipsum saepe
                                    soluta provident! Soluta praesentium libero nam quidem! Quia adipisci quas ratione.
                                    Inventore officia tempora accusamus pariatur dolore itaque, deserunt possimus ab iure
                                    eum. Doloribus maiores fugit officiis enim similique dolorum eligendi accusamus libero
                                    obcaecati, quisquam iusto aut voluptatibus soluta, aliquam neque ipsam cumque!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endauth
    </main>

    <div class="modal" id="modalRegister" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verify otp to view your package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <form class="personal-info-form info-form" id="userRegisterForm"
                        action="{{ route('frontend.userRegister') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <fieldset class="input-grp">
                                    <label for="name" class="required">Name</label>
                                    <input type="text" value="{{ old('name') }}" id="name" name="name">
                                    @error('name')
                                        <p class="text-danger alert-margin">{{ $message }}</p>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset class="input-grp">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" value="{{ old('email') }}" id="email" name="email">
                                    @error('email')
                                        <p class="text-danger alert-margin">{{ $message }}</p>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset class="input-grp">
                                    <label for="phone" class="required">Phone</label>
                                    <input type="number" value="{{ old('phone') }}" id="phone" name="phone">
                                    @error('phone')
                                        <p class="text-danger alert-margin">{{ $message }}</p>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset class="input-grp">
                                    <label for="password" class="required">Password</label>
                                    <input type="password" value="{{ old('password') }}" id="password" name="password">
                                    @error('password')
                                        <p class="text-danger alert-margin">{{ $message }}</p>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-start">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            const IS_CUSTOM_PACKAGE_CREATED = {!! session()->get('is_created_custom_package') ?? 0 !!}

            if (IS_CUSTOM_PACKAGE_CREATED == 1) {
                $('#modalRegister').modal('show');
            }

            // When the form is submitted
            $('#userRegisterForm').on('submit', function(event) {
                event.preventDefault();
                $('#userRegisterForm').find('.invalid-feedback').remove();
                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status == 200) {
                            swal(response.message, {
                                icon: "success",
                            });

                            hideUserRegisterFormAndShowOtpForm();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status == 422) {
                            // Show validation errors
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                var input = $('#userRegisterForm').find('[name=' +
                                    field + ']');
                                input.addClass('is-invalid');
                                input.parent().find('.invalid-feedback').remove();
                                $.each(messages, function(index, message) {
                                    input.parent().append(
                                        '<div class="invalid-feedback">' +
                                        message + '</div>');
                                });
                            });
                        } else if (xhr.status == 500) {
                            swal(xhr.responseJSON.message, {
                                icon: "warning",
                            });
                        } else {

                        }
                    }
                });
            });
        });

        function hideUserRegisterFormAndShowOtpForm() {
            $.ajax({
                url: '{{ route('frontend.userRegisterOtpForm') }}',
                type: 'GET',
                success: function(response) {
                    $('#modalBody').html(response);
                }
            });
        }
    </script>
@endpush
