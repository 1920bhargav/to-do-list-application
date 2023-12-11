$(function () {

    if(ajax_url != null) {
        $('.dataTables_length').addClass('mb-3');

        var table = $('#userTable').DataTable({
            dom: "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +"<'table-responsive'tr>" +"<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            language: {
                searchPlaceholder: "Search records"
            },
            processing: true,
            serverSide: true,
            ajax: ajax_url,
            columns: [
                {data: 'full_name', name: "full_name"},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'address', name: 'address'},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    }

    $("#createUser").validate({
        rules: {
            full_name: {
				required: true
			},
			email: {
				required: true,
                email: true
			},
			phone: {
				required: true,
                number: true,
				maxlength: 11
			},
            password: {
                required: true
            },
            address: {
                required: true
            },
            profile_picture: {
                required: true,
            }
        },
        messages: {
			full_name: {
				required: "Please enter full name"
			},
			email: {
				required: "Please enter email",
                email: "Please enter valid email"
			},
			phone: {
				required: "Please enter phone number",
                number: "Please enter only numeric value",
				maxlength: "Phone number allows maximum 11 characters"
			},
            password: {
                required: "Please enter password"
            },
            address: {
                required: "Please enter address"
            },
            profile_picture: {
                required: "Please select profile picture image",
            }
		},
        errorElement: 'span',
		errorPlacement: function(error, element) {
			error.addClass('invalid-feedback');
            if(element.attr("name") == "profile_picture") {
                error.appendTo("#profile_picture_error") 
            } else {
                element.closest('.form-group').append(error);
            } 
		},
		highlight: function(element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
    });

    $("#editeUser").validate({
        rules: {
            full_name: {
				required: true
			},
			email: {
				required: true,
                email: true
			},
			phone: {
				required: true,
                number: true,
				maxlength: 11
			},
            password: {
                required: true
            },
            address: {
                required: true
            },
        },
        messages: {
			full_name: {
				required: "Please enter full name"
			},
			email: {
				required: "Please enter email",
                email: "Please enter valid email"
			},
			phone: {
				required: "Please enter phone number",
                number: "Please enter only numeric value",
				maxlength: "Phone number allows maximum 11 characters"
			},
            password: {
                required: "Please enter password"
            },
            address: {
                required: "Please enter address"
            },
		},
        errorElement: 'span',
		errorPlacement: function(error, element) {
			error.addClass('invalid-feedback');
            if(element.attr("name") == "profile_picture") {
                error.appendTo("#profile_picture_error") 
            } else {
                element.closest('.form-group').append(error);
            } 
		},
		highlight: function(element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
    });

    $('#profile_picture').on('change',function() {
        $('#profile_picture_preview').parent().removeClass('d-none');
        readURL(this,'#profile_picture_preview');
    });

    var user_id;
    $(document).on('click', '.delete', function() {
        var $this = $(this);
        var user_id = $(this).attr('data-user_id');
        var token = csrf_token;
        console.log(user_id);
        $this.attr('disabled', true).html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Processing...');
        $.confirm({
            title: 'Alert!',
            content: 'Are you sure you want to delete this user?',
            type: 'red',
            buttons: {
                delete: {
                    text: 'Yes, Delete',
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            type: "POST",
                            url: delete_url,
                            data: { user_id: user_id, _token: token },
                            dataType: "json",
                            success: function (response) {
                                if (response.status == 1) {
                                    $.confirm({
                                        title: 'Success!',
                                        content: response.message,
                                        type: 'green',
                                        buttons: {
                                            ok: function () {
                                                var oTable = $('#userTable').dataTable();
                                                oTable.fnDraw(false);
                                            }
                                        }
                                    });
                                } else {
                                    $.confirm({
                                        title: 'Failed!',
                                        content: response.message,
                                        type: 'red',
                                        buttons: {
                                            ok: function () {
                                                // dtUsers.ajax.reload(null, false);
                                            }
                                        }
                                    });
                                }
                            },
                        });
                    }
                },
                cancel: function () {
                    $this.attr('disabled', false).html('Delete');
                }
            }
        });
    });

    $(document).on('click', '.status', function() {     
        var user_id = $(this).attr('data-user_id');
        var status = $(this).attr('data-status');
        var token = csrf_token;
        console.log(user_id, status);
        $.ajax({
            type: "POST",
            url: change_status_url,
            data: { user_id: user_id, status: status, _token: token },
            dataType: "json",
            success: function (response) {
                if(response.status == 1) {
                    $("#status_"+user_id).attr('data-status', response.active);
                    $.growl({ title: "Success!", message: response.message, size: 'large' });
                } else {
                    if(status == 0) {
                        $("#status_"+user_id).prop('checked', false);
                    } else {
                        $("#status_"+user_id).prop('checked', true);
                    }
                    $.growl.error({ message: response.message, size: 'large' });
                }
            },
        });
    }); 
})