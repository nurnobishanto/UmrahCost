<form class="personal-info-form info-form" id="userOTPForm" action="{{ route('frontend.userRegisterOtpVarify') }}">
    @csrf
    <div class="row">
        <div class="col-12">
            <fieldset class="input-grp">
                <label for="otp" class="required">OTP</label>
                <input type="number" value="{{ old('otp') }}" id="otp" name="otp">
                @error('otp')
                    <p class="text-danger alert-margin">{{ $message }}</p>
                @enderror
            </fieldset>
        </div>
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

<script>
    // When the form is submitted
    $('#userOTPForm').on('submit', function(event) {
        event.preventDefault();
        $('#userOTPForm').find('.invalid-feedback').remove();
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
                }
                location.reload(true);
            },
            error: function(xhr) {
                if (xhr.status == 422) {
                    // Show validation errors
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(field, messages) {
                        var input = $('#userOTPForm').find('[name=' +
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
</script>
