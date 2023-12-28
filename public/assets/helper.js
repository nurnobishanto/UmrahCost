function show_crud_modal(title, link, style = '') {
    $(function () {
        $('#modal').modal('show');
        $('#modal-title').html(title);
        $('#modal-body').html('<h1 class="text-center"><strong>Please Wait...</strong></h1>');
        $('#modal-dialog').attr('style', style);
        $.ajax({
            url: link,
            type: 'GET',
            data: {},
        })
            .done(function (response) {
                $('#modal-body').html(response);
            });
    });
}

function showCommonModal(title, link, style = '') {

    // alert();
    $('#commonModal').modal('show');
    $('#common-modal-title').html(title);
    $('#common-modal-body').html('<h1 class="text-center"><strong>Please Wait...</strong></h1>');
    $('#common-modal-dialog').attr('style', style);
    $.ajax({
        url: link,
        type: 'GET',
        data: {},
    })
        .done(function (response) {
            $('#common-modal-body').html(response);
        });
}

function change_status(id, status, link) {
    var formData = new FormData();
    formData.append('id', id)
    formData.append('status', status)
    $.ajax({
        method: 'POST',
        url: link,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.type == 'success') {
                swal(data.message, {
                    icon: "success",
                });
                setTimeout(function () {
                    location.reload();
                }, 600); //
            } else {
                swal(data.message, {
                    icon: "warning",
                });
            }
        },
        error: function (xhr) {
            var errorMessage = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorMessage += ('' + value + '\n');
            });

            if (xhr.responseJSON.message) {
                errorMessage += ('' + xhr.responseJSON.message + '<br>');
            }
            swal(errorMessage, {
                icon: "warning",
            });
        },
    });
}


function ErrorMessage(key, value) {
    if (key == 'box_count') {
        $('#box_count_error').text(value);
    }
    if (key == 'rn_count') {
        $('#rn_count_error').text(value);
    }
}

function ErrorMessageClear() {
    $('#box_count_error').text('');
    $('#rn_count_error').text('');
}
$(".logout-btn").click(function () {
    swal({
        title: "Are you sure?",
        text: "You can login again in this system!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willLogout) => {
        if (willLogout) {
            swal("Successfully logout from this system.", {
                icon: "success",
            });
            setTimeout(function () {
                document.getElementById('logout-form').submit();
            }, 1000); //2 second
        } else {
            //swal("Your imaginary file is safe!");
        }
    });
});
ErrorMessageClear();


function delete_function(id) {
    let url = $('#helper_delete' + id).attr('value');
    console.log('url', url);

    swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                method: 'DELETE',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.type == 'success') {
                        swal("Deleted!", {
                            icon: "success",
                        });
                        if (data.url) {
                            setTimeout(function () {
                                location.replace(data.url);
                            }, 800); //
                        } else {
                            setTimeout(function () {
                                location.reload();
                            }, 800); //
                        }
                    } else {
                        swal('Whoops! something went wrong ! ' + data.message, {
                            icon: "warning",
                        });
                    }
                },
            })
        } else {
            //swal("Your imaginary file is safe!");
        }
    });
}
