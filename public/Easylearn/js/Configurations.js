$(document).ready(function () {
    //Validation Function
    //validateEmail
    function validateEmail(email) {
        if (email.length > 3 && email.length < 50) {
            var re =
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        } else {
            return false;
        }
    }

    //ValidatePassword
    function ValidatePassword(password, confirm) {
        if (password.length > 3 && password.length < 17) {
            if (password == confirm) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //ValidateNumber
    function ValidateNumber(num) {
        var re = /^\d*$/;
        return re.test(num);
    }

    //ValidateDocument
    function ValidateDocument(file) {
        var fileType = file["type"];
        var validDocTypes = ["application/pdf", "image/jpeg", "image/png"];

        return validDocTypes.includes(fileType);
    }

    //ValidateName
    function ValidateName(name) {
        if (name.length > 3 && name.length < 50) {
            var re = /^([a-zA-Z]+\s)*[a-zA-Z]+$/;
            return re.test(name);
        } else {
            return false;
        }
    }

    function Validate_na(addr) {
        if (addr.trim() != '') {
            return true
        } else {
            return false;
        }
    }

    //ValidateImage
    function ValidateImage(file) {
        var fileType = file["type"];
        var validImageTypes = ["image/gif", "image/jpeg", "image/png"];

        return validImageTypes.includes(fileType);
    }

    //ValidatePhone
    function ValidatePhone(number) {
        var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

        if (number.length > 6 && number.length < 25) {
            return re.test(number);
        } else {
            return false;
        }
    }

    function isOver18(dateOfBirth) {
        // find the date 18 years ago
        const date18YrsAgo = new Date();
        date18YrsAgo.setFullYear(date18YrsAgo.getFullYear() - 18);
        // check if the date of birth is before that date
        return dateOfBirth <= date18YrsAgo;
    }

    function ValidateDob(m_dob) {
        var dob = m_dob;
        var dateString = new Date();
        if (dob < dateString) {
            if (isOver18(dob) == false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    //setCookie
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    //getCookie
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    if (location.pathname.split("/").slice(-1)[0] == 'managesettings') {
        $('#setting_name').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_setting_name').removeClass('d-none');
            } else {
                $('.check_setting_name').addClass('d-none');
            }
        });

        //Add Category Form
        $('#add_category_form').on('submit', function (event) {
            var manage_settings_form_token = $('#manage_settings_form_token').val().trim();
            var setting_name = $('#setting_name').val().trim();
            var setting_description = $('#setting_descp').val().trim();

            if (setting_name != '') {
                var formdata = new FormData();
                formdata.append('manage_settings_form_token', manage_settings_form_token);
                formdata.append('setting_name', setting_name);
                formdata.append('setting_descp', setting_description);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Add Setting?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#loader').css('display', 'block');

                        $.ajax({
                            url: "Easylearn/Configuration_Controller/manage_setting_form",
                            data: formdata,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                $('#loader').css('display', 'none');
                                response = JSON.parse(response);

                                if (response["data"] == "TRUE") {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Added Successfully!",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: response.data,
                                    }).then((result) => {
                                        // location.reload();
                                    });
                                }
                            },
                            error: function (response) {
                                $('#loader').css('display', 'none');

                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        });
                    }
                });
            } else {
                $('#setting_name').focus();
                $('.check_setting_name').removeClass('d-none');
            }

            event.preventDefault();
        });

        //Generate Setting List
        $("#setting_list").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            select: true,
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Configuration_Controller/get_settings_category",
                type: "POST",
                dataSrc: function (json) {
                    if (json.data == 'False') {
                        return {};
                    } else {
                        return json.data;
                    }
                },
            },
            rowId: "unique_id",
            columns: [{
                    data: "sr_no",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "category_name"
                },
                {
                    data: "description"
                },
            ]
        });

        //Double click open model
        $('#setting_list tbody').on('dblclick', 'tr', function () {
            var id = $(this).attr('id');
            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Configuration_Controller/get_setting_category_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) {
                    $('#loader').css('display', 'none');
                    response = JSON.parse(response);

                    $('#edit_setting_name').val(response.data.category_name);
                    $('#edit_setting_descp').val(response.data.description);
                    $('.edit_btn').attr('id', id);
                    $('#delete_setting').attr('data-id', id);
                    $('#edit_setting_modal').modal('show');
                },
                error: function (response) {
                    $('#loader').css('display', 'none');

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        //location.reload();
                    });
                }
            });

        });

        //Edit Setting form        
        $('#edit_setting_name').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_edit_setting_name').removeClass('d-none');
            } else {
                $('.check_edit_setting_name').addClass('d-none');
            }
        });

        $('#edit_setting_form').on('submit', function (e) {
            e.preventDefault();

            var edit_setting_form_token = $("#edit_setting_form_token").val().trim();
            var uid = $('.edit_btn').attr('id');
            var setting_name = $('#edit_setting_name').val().trim();
            var setting_descp = $('#edit_setting_descp').val().trim();
            var formdata = new FormData();

            if (setting_name != '') {
                formdata.append('edit_setting_form_token', edit_setting_form_token);
                formdata.append('uid', uid);
                formdata.append('setting_name', setting_name);
                formdata.append('setting_descp', setting_descp);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Update Setting?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#loader').css('display', 'block');

                        $.ajax({
                            url: "Easylearn/Configuration_Controller/edit_setting_category",
                            data: formdata,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                $('#loader').css('display', 'none');
                                response = JSON.parse(response);

                                if (response["data"] == "TRUE") {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated Successfully!",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: response.data,
                                    }).then((result) => {
                                        //location.reload();
                                    });
                                }
                            },
                            error: function (response) {
                                $('#loader').css('display', 'none');

                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        });
                    }
                });

            } else {
                $('#edit_setting_name').focus();
                $('.check_edit_setting_name').removeClass('d-none');
            }
        });

        //Delete Setting
        $('#delete_setting').on('click', function () {
            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Configuration_Controller/delete_setting_category',
                        data: {
                            id: id
                        },
                        type: 'POST',
                        success: function (response) {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");

                            if (response['data'] == 'TRUE') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.data,
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        },
                        error: function (response) {
                            $("#loader").css("display", "none");

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    });
                }
            });
        });

        //Edit Setting Value
        $('#setting_value').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_setting_value').removeClass('d-none');
            } else {
                $('.check_setting_value').addClass('d-none');
            }
        });

        //Add Setting Form
        $('#add_setting_value_form').on('submit', function (event) {

            var manage_settings_value_form_token = $('#manage_settings_value_form_token').val().trim();
            var setting_id = $('#setting_name_drop').val().trim();
            var setting_value = $('#setting_value').val().trim();
            var setting_purpose = $('#setting_purpose').val().trim();

            if (setting_value != '') {
                var formdata = new FormData();
                formdata.append('manage_settings_value_form_token', manage_settings_value_form_token);
                formdata.append('setting_id', setting_id);
                formdata.append('setting_value', setting_value);
                formdata.append('setting_purpose', setting_purpose);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Add Setting?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#loader').css('display', 'block');

                        $.ajax({
                            url: "Easylearn/Configuration_Controller/add_setting_value",
                            data: formdata,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                $('#loader').css('display', 'none');
                                response = JSON.parse(response);

                                if (response["data"] == "TRUE") {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Added Successfully!",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: response.data,
                                    }).then((result) => {
                                        // location.reload();
                                    });
                                }
                            },
                            error: function (response) {
                                $('#loader').css('display', 'none');

                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        });
                    }
                });
            } else {
                $('#setting_value').focus();
                $('.check_setting_value').removeClass('d-none');
            }

            event.preventDefault();
        });

        //Generate Setting Value List
        $("#setting_value_list").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            select: true,
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Configuration_Controller/get_settings",
                type: "POST",
                dataSrc: function (json) {
                    if (json.data == 'False') {
                        return {};
                    } else {
                        return json.data;
                    }
                },
            },
            rowId: "unique_id",
            columns: [{
                    data: "sr_no",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "category_name"
                },
                {
                    data: "value"
                },
                {
                    data: "purpose"
                },
            ]
        });

        //Double click open model
        $('#setting_value_list tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');
            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Configuration_Controller/get_setting_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) {
                    $('#loader').css('display', 'none');
                    response = JSON.parse(response);

                    $('#edit_setting_name_drop').val(response.data.category);
                    $('#edit_setting_value').val(response.data.value);
                    $('#edit_setting_purpose').val(response.data.purpose);
                    $('.edit_value_btn').attr('id', id);
                    $('#edit_delete_setting').attr('data-id', id);
                    $('#edit_setting_value_modal').modal('show');
                },
                error: function (response) {
                    $('#loader').css('display', 'none');

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        location.reload();
                    });
                }
            });
        });

        //Delete Setting
        $('#edit_delete_setting').on('click', function () {
            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Configuration_Controller/delete_setting',
                        data: {
                            id: id
                        },
                        type: 'POST',
                        success: function (response) {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");

                            setTimeout(function () {

                                if (response['data'] == 'TRUE') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Successfully Deleted',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: response.data,
                                    }).then((result) => {
                                        //location.reload();
                                    });
                                }
                            }, 1000);
                        },
                        error: function (response) {
                            $("#loader").css("display", "none");

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    });
                }
            });
        });

        //Edit Setting Value
        $('#edit_setting_value').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_edit_setting_value').removeClass('d-none');
            } else {
                $('.check_edit_setting_value').addClass('d-none');
            }
        });

        //Edit Setting Form
        $('#edit_setting_value_form').on('submit', function (event) {

            var uid = $('.edit_value_btn').attr('id');
            var edit_setting_value_form_token = $('#edit_setting_value_form_token').val().trim();
            var setting_id = $('#edit_setting_name_drop').val().trim();
            var setting_value = $('#edit_setting_value').val().trim();
            var setting_purpose = $('#edit_setting_purpose').val().trim();

            if (setting_value != '') {
                var formdata = new FormData();
                formdata.append('edit_setting_value_form_token', edit_setting_value_form_token);
                formdata.append('uid', uid);
                formdata.append('setting_id', setting_id);
                formdata.append('setting_value', setting_value);
                formdata.append('setting_purpose', setting_purpose);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Edit Setting?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#loader').css('display', 'block');

                        $.ajax({
                            url: "Easylearn/Configuration_Controller/edit_setting_value",
                            data: formdata,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                $('#loader').css('display', 'none');
                                response = JSON.parse(response);

                                if (response["data"] == "TRUE") {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated Successfully!",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: response.data,
                                    }).then((result) => {
                                        // location.reload();
                                    });
                                }
                            },
                            error: function (response) {
                                $('#loader').css('display', 'none');

                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        });
                    }
                });
            } else {
                $('#edit_setting_value').focus();
                $('.check_edit_setting_value').removeClass('d-none');
            }

            event.preventDefault();
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == 'managesecurity') {
        $('#security_name').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_security_name').removeClass('d-none');
            } else {
                $('.check_security_name').addClass('d-none');
            }
        });

        //Add Security Form
        $('#manage_security_form').on('submit', function (e) {

            e.preventDefault();

            var manage_security_form_token = $("#manage_security_form_token").val().trim();
            var security_name = $('#security_name').val().trim();
            var security_descp = $('#security_descp').val().trim();

            if (security_name != '') {
                var formdata = new FormData();
                formdata.append('manage_security_form_token', manage_security_form_token);
                formdata.append('security_name', security_name);
                formdata.append('security_descp', security_descp);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Add Security?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#loader').css('display', 'block');

                        $.ajax({
                            url: "Easylearn/Configuration_Controller/manage_security_form",
                            data: formdata,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                $('#loader').css('display', 'none');
                                response = JSON.parse(response);

                                if (response["data"] == "TRUE") {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Added Successfully!",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    }).then((result) => {
                                        location.href = 'managesecurity';
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: response.data,
                                    }).then((result) => {
                                        // location.reload();
                                    });
                                }
                            },
                            error: function (response) {
                                $('#loader').css('display', 'none');

                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            } else {
                $('#security_name').focus();
                $('.check_security_name').removeClass('d-none');
            }
        });

        //Generate Security List
        $("#security_list").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            select: true,
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Configuration_Controller/get_security",
                type: "POST",
                dataSrc: function (json) {

                    if (json.data == 'False') {
                        return {};
                    } else {
                        return json.data;
                    }
                },
            },
            rowId: "unique_id",
            columns: [{
                    data: "sr_no",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "security_name"
                },
                {
                    data: "security_description"
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        if (row.status == 0) {
                            return `<button type="button" style='border-radius: 20px;' data-id="${row.unique_id}" class="btn security_status btn-sm btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off">
                                    <div style='border-radius: 50%;' class="handle"></div>
                                </button>`;
                        } else {
                            return `<button type="button" style='border-radius: 20px;' data-id="${row.unique_id}" class="btn security_status btn-sm btn-toggle active" data-toggle="button" aria-pressed="false" autocomplete="off">
                                    <div style='border-radius: 50%;' class="handle"></div>
                                </button>`;
                        }
                    },
                },
            ]
        });

        //change security status
        $(document).on('click', '.security_status', function () {
            var id = $(this).attr('data-id');
            var status = 0;

            if ($(this).hasClass('active')) {
                status = 1;
            }

            $.ajax({
                url: 'Easylearn/Configuration_Controller/security_status',
                type: 'POST',
                data: {
                    'id': id,
                    'status': status
                },
                success: function (response) {},
                error: function (response) {
                    console.log(response);
                }
            });
        });

        //Double click open model
        $('#security_list tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');
            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Configuration_Controller/get_security_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) {
                    $('#loader').css('display', 'none');
                    response = JSON.parse(response);

                    $('#edit_security_name').val(response.data.security_name);
                    $('#edit_security_descp').val(response.data.security_description);
                    $('.edit_btn').attr('id', id);
                    $('#delete_security').attr('data-id', id);
                    $('#edit_security_modal').modal('show');
                },
                error: function (response) {
                    $('#loader').css('display', 'none');

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        location.reload();
                    });
                }
            });
        });

        //Edit security name
        $('#edit_security_name').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_edit_security_name').removeClass('d-none');
            } else {
                $('.check_edit_security_name').addClass('d-none');
            }
        });

        //Edit Security form
        $('#edit_security_form').on('submit', function (e) {
            e.preventDefault();

            var edit_security_form_token = $("#edit_security_form_token").val().trim();
            var uid = $('.edit_btn').attr('id');
            var security_name = $('#edit_security_name').val().trim();
            var security_descp = $('#edit_security_descp').val().trim();
            var formdata = new FormData();

            if (security_name != '') {
                formdata.append('edit_security_form_token', edit_security_form_token);
                formdata.append('uid', uid);
                formdata.append('security_name', security_name);
                formdata.append('security_descp', security_descp);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Update Document?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#loader').css('display', 'block');
                        $.ajax({
                            url: "Easylearn/Configuration_Controller/edit_security_form",
                            data: formdata,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                $('#loader').css('display', 'none');
                                response = JSON.parse(response);

                                if (response["data"] == "TRUE") {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated Successfully!",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    }).then((result) => {
                                        location.href = 'managesecurity';
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: response.data,
                                    }).then((result) => {
                                        //location.reload();
                                    });
                                }
                            },
                            error: function (response) {
                                $('#loader').css('display', 'none');

                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        });
                    }
                });
            } else {
                $('#edit_security_name').focus();
                $('.check_edit_security_name').removeClass('d-none');
            }
        });

        //delete Security
        $('#delete_security').on('click', function () {
            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loader').css('display', 'block');
                    $.ajax({
                        url: 'Easylearn/Configuration_Controller/delete_security',
                        data: {
                            id: id
                        },
                        type: 'POST',
                        success: function (response) {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");

                            if (response['data'] == 'TRUE') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.data,
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        },
                        error: function (response) {
                            $("#loader").css("display", "none");

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    });
                }
            });
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == 'managesliders') {
        $('#slider_type').on('change', function () {
            if ($(this).val().trim() == 'image') {
                $('.slider_image').toggleClass('d-none');
                $('.slider_video').toggleClass('d-none');
            } else {
                $('.slider_image').toggleClass('d-none');
                $('.slider_video').toggleClass('d-none');
            }
        });

        $('#slider_type').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_slider_type').removeClass('d-none');
            } else {
                $('.check_slider_type').addClass('d-none');
            }
        });

        $('#slider_image').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_slider_image').removeClass('d-none');
            } else {
                $('.check_slider_image').addClass('d-none');
            }
        });

        $('#slider_video').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_slider_video').removeClass('d-none');
            } else {
                $('.check_slider_video').addClass('d-none');
            }
        });

        //Add Slider
        $('#manage_slider_form').on('submit', function (e) {

            e.preventDefault();

            var manage_slider_form_token = $("#manage_slider_form_token").val().trim();
            var slider_type = $('#slider_type').val().trim();

            if (slider_type == 'image') {
                var slider_image = document.getElementById('slider_image').files[0];
                var slider_video = ''
            } else {
                var slider_image = '';
                var slider_video = $('#slider_video').val().trim();
            }

            if (slider_type != '') {

                if (slider_video != '' || document.getElementById('slider_image').files.length > 0) {
                    var formdata = new FormData();
                    formdata.append('manage_slider_form_token', manage_slider_form_token);
                    formdata.append('slider_type', slider_type);
                    formdata.append('slider_image', slider_image);
                    formdata.append('slider_video', slider_video);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to Add slider?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#loader').css('display', 'block');
                            $.ajax({
                                url: "Easylearn/Configuration_Controller/manage_slider_form",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    $('#loader').css('display', 'none');
                                    response = JSON.parse(response);

                                    if (response["data"] == "TRUE") {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Added Successfully!",
                                            showConfirmButton: false,
                                            timer: 1500,
                                        }).then((result) => {
                                            location.href = 'managesliders';
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: response.data,
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    }
                                },
                                error: function (response) {
                                    $('#loader').css('display', 'none');

                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            });
                        }
                    });
                } else {
                    $('.check_slider').removeClass('d-none');
                }
            } else {
                $('#slider_type').focus();
                $('.check_slider_type').removeClass('d-none');
            }
        });

        //get All Slider list
        $("#slider_list").DataTable({

            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            // select: true,
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Configuration_Controller/get_slider",
                type: "POST",
                dataSrc: function (json) {

                    if (json.data == 'False') {
                        return {}
                    } else {
                        return json.data;
                    }
                },
            },
            rowId: "unique_id",
            columns: [{
                    data: "unique_id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },

                {
                    data: "slider_type"
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        if (row.slider_video != '') {
                            return `<button type="button" class="btn btn-xs btn-warning view-vid" data-id="${row.slider_video}">View Video</button>`;
                        } else {
                            return `<img class="img img-responsive" style="width:150px; height: auto;" src="${row.slider_image}">`;
                        }

                    },
                }

            ]
        });

        //video view by click
        $(document).on('click', '.view-vid', function () {
            $('#view_vid_modal').modal('show');
            $('#view_vid').attr('src', $(this).attr('data-id'));
        });

        //Open edit model
        $('#slider_list tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');
            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Configuration_Controller/get_slider_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) {
                    $('#loader').css('display', 'none');
                    response = JSON.parse(response);

                    $('#edit_slider_type').val(response.data.slider_type).prop('disabled', true);
                    if (response.data.slider_type == 'image') {
                        $('.edit_slider_video').addClass('d-none');
                        $('.edit_image').removeClass('d-none');
                    } else {
                        $('.edit_slider_video').removeClass('d-none');
                        $('.edit_image').addClass('d-none');
                        $('#edit_slider_video').val(response.data.slider_video);
                    }

                    $('.edit_btn').attr('id', id);
                    $('#delete_slider').attr('data-id', id);
                    $('#edit_slider_modal').modal('show');
                },
                error: function (response) {
                    $('#loader').css('display', 'none');

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        location.reload();
                    });
                }
            });
        });

        $("#add_slider_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
            $('.check_slider_type').addClass('d-none');
            $('.check_slider_image').addClass('d-none');
            $('.check_slider_video').addClass('d-none');
        });

        $("#edit_slider_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
            $('.check_edit_slider_type').addClass('d-none');
            $('.check_edit_slider_image').addClass('d-none');
            $('.check_edit_slider_video').addClass('d-none');
        });

        //Edit Slider Form
        $('#edit_slider_form').on('submit', function (e) {
            e.preventDefault();

            var edit_slider_form_token = $("#edit_slider_form_token").val().trim();
            var slider_type = $('#edit_slider_type').val().trim();

            if (slider_type == 'image') {
                var slider_image = document.getElementById('edit_slider_image').files[0];
                var slider_video = ''
            } else {
                var slider_image = '';
                var slider_video = $('#edit_slider_video').val().trim();
            }

            if (slider_type != '') {
                if (slider_video != '' || document.getElementById('edit_slider_image').files.length > 0) {
                    formdata = new FormData();
                    formdata.append('edit_slider_form_token', edit_slider_form_token);
                    formdata.append('uid', $('.edit_btn').attr('id'));
                    formdata.append('slider_type', slider_type);
                    formdata.append('slider_image', slider_image);
                    formdata.append('slider_video', slider_video);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to Add slider?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            $('#loader').css('display', 'block');

                            $.ajax({
                                url: "Easylearn/Configuration_Controller/edit_slider_form",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    $('#loader').css('display', 'none');
                                    response = JSON.parse(response);

                                    if (response["data"] == "TRUE") {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Updated Successfully!",
                                            showConfirmButton: false,
                                            timer: 1500,
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: response.data,
                                        }).then((result) => {
                                            //location.reload();
                                        });
                                    }
                                },
                                error: function (response) {
                                    $('#loader').css('display', 'none');

                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            });
                        }
                    });
                } else {
                    $('.check_edit_slider').removeClass('d-none');
                }
            } else {
                $('#edit_slider_type').focus();
                $('.check_edit_slider_type').removeClass('d-none');
            }
        });

        //Delete Slider
        $('#delete_slider').on('click', function () {

            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Configuration_Controller/delete_slider',
                        data: {
                            id: id
                        },
                        type: 'POST',
                        success: function (response) 
                        {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");

                            if (response['data'] == 'TRUE') 
                            {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            } 
                            else 
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.data,
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        },
                        error: function (response) {
                            $("#loader").css("display", "none");

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    });
                }
            });
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == 'manageaboutus') {
        $(document).on('click', '#add_about_us', function (e) {

            e.preventDefault();

            var manage_aboutus_form_token = $("#manage_aboutus_form_token").val().trim();
            var heading = $('#heading').val().trim();
            var vision_image = document.getElementById('vision_image').files[0];
            var vision = $('#vision').val().trim();
            var mission_image = document.getElementById('mission_image').files[0];
            var mission = $('#mission').val().trim();
            var values_image = document.getElementById('values_image').files[0];
            var value_s = $('#value_s').val().trim();
            var aboutus_description1 = $('#aboutus_description1').val().trim();
            var aboutus_description2 = $('#aboutus_description2').val().trim();
            var demovideo_path = $('#demovideo_path').val().trim();

            if (heading != '') {
                if (document.getElementById('vision_image').files.length > 0) {
                    if (vision != '') {
                        if (document.getElementById('mission_image').files.length > 0) {
                            if (mission != '') {
                                if (document.getElementById('values_image').files.length > 0) {
                                    if (value_s != '') {
                                        if (aboutus_description1 != '') {
                                            if (aboutus_description2 != '') {
                                                if (demovideo_path != '') {

                                                    var formdata = new FormData();
                                                    formdata.append("manage_aboutus_form_token", manage_aboutus_form_token);
                                                    formdata.append('heading', heading);
                                                    formdata.append('vision_image', vision_image);
                                                    formdata.append('mission_image', mission_image);
                                                    formdata.append('values_image', values_image);
                                                    formdata.append('vision', vision);
                                                    formdata.append('mission', mission);
                                                    formdata.append('value_s', value_s);
                                                    formdata.append('aboutus_description1', aboutus_description1);
                                                    formdata.append('aboutus_description2', aboutus_description2);
                                                    formdata.append('demovideo_path', demovideo_path);

                                                    Swal.fire({
                                                        title: 'Are you sure?',
                                                        text: "You want to Add About Us?",
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor: '#d33',
                                                        confirmButtonText: 'Yes'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            $('#loader').css('display', 'block');
                                                            $.ajax({
                                                                url: "Easylearn/Configuration_Controller/manage_aboutus_form",
                                                                data: formdata,
                                                                type: "POST",
                                                                contentType: false,
                                                                processData: false,
                                                                success: function (response) {
                                                                    $('#loader').css('display', 'none');
                                                                    response = JSON.parse(response);

                                                                    if (response["data"] == "TRUE") {
                                                                        Swal.fire({
                                                                            icon: "success",
                                                                            title: "Added Successfully!",
                                                                            showConfirmButton: false,
                                                                            timer: 1500,
                                                                        }).then((result) => {
                                                                            location.reload();
                                                                        });
                                                                    } else {
                                                                        Swal.fire({
                                                                            icon: "error",
                                                                            title: "Oops...",
                                                                            text: response.data,
                                                                        }).then((result) => {
                                                                            //location.reload();
                                                                        });
                                                                    }
                                                                },
                                                                error: function (response) {
                                                                    $('#loader').css('display', 'none');

                                                                    Swal.fire({
                                                                        icon: "error",
                                                                        title: "Oops...",
                                                                        text: "Something went wrong!",
                                                                    }).then((result) => {
                                                                        location.reload();
                                                                    });
                                                                }
                                                            });
                                                        }
                                                    });
                                                } else {
                                                    $('.check_demovideo_path').removeClass('d-none');
                                                }
                                            } else {
                                                $('.check_aboutus_description2').removeClass('d-none');
                                            }
                                        } else {
                                            $('.check_aboutus_description1').removeClass('d-none');
                                        }
                                    } else {
                                        $('.check_value_s').removeClass('d-none');
                                    }
                                } else {
                                    $('.check_values_image').removeClass('d-none');
                                }
                            } else {
                                $('.check_mission').removeClass('d-none');
                            }
                        } else {
                            $('.check_mission_image').removeClass('d-none');
                        }
                    } else {
                        $('.check_vision').removeClass('d-none');
                    }
                } else {
                    $('.check_vision_image').removeClass('d-none');
                }
            } else {
                $('.check_heading').removeClass('d-none');
            }
        });

        $('#heading').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_heading').removeClass('d-none');
            } else {
                $('.check_heading').addClass('d-none');
            }
        });

        $('#vision_image').on('change', function () {
            if ($(this).val().trim() != '') {
                $('.check_vision_image').addClass('d-none');

            } else {
                $('.check_vision_image').text('').append(error_icon + ' Image Required! ').removeClass('d-none');

            }
        });

        $('#vision').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_vision').removeClass('d-none');
            } else {
                $('.check_vision').addClass('d-none');
            }
        });

        $('#mission_image').on('change', function () {
            if ($(this).val().trim() != '') {
                $('.check_mission_image').addClass('d-none');

            } else {
                $('.check_mission_image').text('').append(error_icon + ' Image Required! ').removeClass('d-none');

            }
        });

        $('#mission').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_mission').removeClass('d-none');
            } else {
                $('.check_mission').addClass('d-none');
            }
        });

        $('#values_image').on('change', function () {
            if ($(this).val().trim() != '') {
                $('.check_values_image').addClass('d-none');

            } else {
                $('.check_values_image').text('').append(error_icon + ' Image Required! ').removeClass('d-none');

            }
        });

        $('#value_s').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_value_s').removeClass('d-none');
            } else {
                $('.check_value_s').addClass('d-none');
            }
        });

        $('#aboutus_description1').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_aboutus_description1').removeClass('d-none');
            } else {
                $('.check_aboutus_description1').addClass('d-none');
            }
        });

        $('#aboutus_description2').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_aboutus_description2').removeClass('d-none');
            } else {
                $('.check_aboutus_description2').addClass('d-none');
            }
        });

        $('#demovideo_path').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_demovideo_path').removeClass('d-none');
            } else {
                $('.check_demovideo_path').addClass('d-none');
            }
        });

        $(document).on('click', '#update_about_us', function (e) {
            e.preventDefault();

            var manage_aboutus_form_token = $('#manage_aboutus_form_token').val().trim();
            var heading = $('#heading').val().trim();
            var vision_image = document.getElementById('vision_image').files[0];
            var vision = $('#vision').val().trim();
            var mission_image = document.getElementById('mission_image').files[0];
            var mission = $('#mission').val().trim();
            var values_image = document.getElementById('values_image').files[0];
            var value_s = $('#value_s').val().trim();
            var aboutus_description1 = $('#aboutus_description1').val().trim();
            var aboutus_description2 = $('#aboutus_description2').val().trim();
            var demovideo_path = $('#demovideo_path').val().trim();

            if (heading != '') {
                if (vision != '') {
                    if (mission != '') {
                        if (value_s != '') {
                            if (aboutus_description1 != '') {
                                if (aboutus_description2 != '') {
                                    if (demovideo_path != '') {
                                        var formdata = new FormData();
                                        formdata.append("manage_aboutus_form_token", manage_aboutus_form_token);
                                        formdata.append('heading', heading);
                                        formdata.append('vision', vision);
                                        formdata.append('mission', mission);
                                        formdata.append('value_s', value_s);
                                        formdata.append('aboutus_description1', aboutus_description1);
                                        formdata.append('aboutus_description2', aboutus_description2);
                                        formdata.append('demovideo_path', demovideo_path);

                                        if (document.getElementById('vision_image').files.length > 0) {
                                            formdata.append('vision_image', vision_image);
                                        }

                                        if (document.getElementById('mission_image').files.length > 0) {
                                            formdata.append('mission_image', mission_image);
                                        }

                                        if (document.getElementById('values_image').files.length > 0) {
                                            formdata.append('values_image', values_image);
                                        }

                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: "You want to Update About Us?",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $('#loader').css('display', 'block');

                                                $.ajax({
                                                    url: "Easylearn/Configuration_Controller/manage_aboutus_form",
                                                    data: formdata,
                                                    type: "POST",
                                                    contentType: false,
                                                    processData: false,
                                                    success: function (response) {
                                                        $('#loader').css('display', 'none');
                                                        response = JSON.parse(response);

                                                        if (response["data"] == "TRUE") {
                                                            Swal.fire({
                                                                icon: "success",
                                                                title: "Updated Successfully!",
                                                                showConfirmButton: false,
                                                                timer: 1500,
                                                            }).then((result) => {
                                                                location.reload();
                                                            });
                                                        } else {
                                                            Swal.fire({
                                                                icon: "error",
                                                                title: "Oops...",
                                                                text: response.data,
                                                            }).then((result) => {
                                                                //location.reload();
                                                            });
                                                        }
                                                    },
                                                    error: function (response) {
                                                        $('#loader').css('display', 'none');

                                                        Swal.fire({
                                                            icon: "error",
                                                            title: "Oops...",
                                                            text: "Something went wrong!",
                                                        }).then((result) => {
                                                            location.reload();
                                                        });
                                                    }
                                                });
                                            }
                                        });

                                    } else {
                                        $('.check_demovideo_path').removeClass('d-none');
                                    }
                                } else {
                                    $('.check_aboutus_description2').removeClass('d-none');
                                }
                            } else {
                                $('.check_aboutus_description1').removeClass('d-none');
                            }
                        } else {
                            $('.check_value_s').removeClass('d-none');
                        }
                    } else {
                        $('.check_mission').removeClass('d-none');
                    }
                } else {
                    $('.check_vision').removeClass('d-none');
                }
            } else {
                $('.check_heading').removeClass('d-none');
            }
        });

        $.ajax({
            url: "Easylearn/Configuration_Controller/get_about_us",
            type: "POST",
            success: function (response) {
                var response = JSON.parse(response);
                if (Object.keys(response.data).length > 0) {
                    $('#heading').val(response.data.heading);
                    if (response.data.vision_image) {
                        $('#link_vision_img').append('<a href="" id="view_img" data-id="' + response.data.vision_image + '"> View Image</a>');
                    }
                    if (response.data.mission_image) {
                        $('#link_mission_img').append('<a href="" id="view_img" data-id="' + response.data.mission_image + '"> View Image</a>');
                    }
                    if (response.data.values_image) {
                        $('#link_values_img').append('<a href="" id="view_img" data-id="' + response.data.values_image + '"> View Image</a>');
                    }
                    $('#vision').val(response.data.vision);
                    $('#mission').val(response.data.mission);
                    $('#value_s').val(response.data.value_s);
                    $('#aboutus_description1').val(response.data.aboutus_description1);
                    $('#aboutus_description2').val(response.data.aboutus_description2);
                    $('#demovideo_path').val(response.data.demovideo_path);

                    if (response.data.demovideo_path) {
                        $('#link_demovideo_vdo').append('<a href="" id="view_img" class="video" data-id="' + response.data.demovideo_path + '"> View Video</a>');
                    }
                    $('#add_about_us').addClass('d-none');
                    $('#update_about_us').removeClass('d-none');
                } else {
                    $('#update_about_us').addClass('d-none');
                    $('#add_about_us').removeClass('d-none');
                }
            },
            error: function (response) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                }).then((result) => {
                    location.reload();
                });
            }
        });

        $(document).on('click', '#view_img', function (e) {
            e.preventDefault();
            if ($(this).hasClass('video')) {
                var link = $(this).attr('data-id');
                $('#view_image').addClass('d-none');
                $('#vid').removeClass('d-none');
                $('#vid').attr('src', link);

                $('#view_img_modal').modal('show');
            } else {
                var link = $(this).attr('data-id');
                $('#view_image').attr('src', link);
                $('#view_image').removeClass('d-none');
                $('#vid').addClass('d-none');
                $('#view_img_modal').modal('show');
            }
        });

        $('#vision_image').on('change', function () {
            var img = document.getElementById('vision_image').files[0];

            if (img != null && ValidateImage(img)) {
                $('.check_vision_image').addClass('d-none');
            } else {
                $('.check_vision_image').removeClass('d-none');
            }
        });

        $('#mission_image').on('change', function () {
            var img = document.getElementById('mission_image').files[0];

            if (img != null && ValidateImage(img)) {
                $('.check_mission_image').addClass('d-none');
            } else {
                $('.check_mission_image').removeClass('d-none');
            }
        });

        $('#values_image').on('change', function () {
            var img = document.getElementById('values_image').files[0];

            if (img != null && ValidateImage(img)) {
                $('.check_values_image').addClass('d-none');
            } else {
                $('.check_values_image').removeClass('d-none');
            }
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == 'managefeatures') {
        $('#features_name').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_features_name').removeClass('d-none');
            } else {
                $('.check_features_name').addClass('d-none');
            }
        });

        $('#features_image').on('change', function () {
            var img = document.getElementById('features_image').files[0];

            if (img != null && ValidateImage(img)) {
                $('.check_features_image').addClass('d-none');
            } else {
                $('.check_features_image').removeClass('d-none');
            }
        });

        $('#features_descp').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_features_descp').removeClass('d-none');
            } else {
                $('.check_features_descp').addClass('d-none');
            }
        });

        //Add Features
        $('#manage_features_form').on('submit', function (e) {

            e.preventDefault();

            var manage_features_form_token = $("#manage_features_form_token").val().trim();
            var feature = $('#features_name').val().trim();
            var feature_image = document.getElementById('features_image').files[0];
            var feature_description = $('#features_descp').val().trim();

            if (feature != '') {
                if (document.getElementById('features_image').files.length > 0) {
                    if (feature_description != '') {
                        var formdata = new FormData();
                        formdata.append('manage_features_form_token', manage_features_form_token);
                        formdata.append('feature', feature);
                        formdata.append('feature_image', feature_image);
                        formdata.append('feature_description', feature_description);

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You want to Add features?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#loader').css('display', 'block');
                                $.ajax({
                                    url: "Easylearn/Configuration_Controller/manage_features_form",
                                    data: formdata,
                                    type: "POST",
                                    contentType: false,
                                    processData: false,
                                    success: function (response) {
                                        response = JSON.parse(response);
                                        $('#loader').css('display', 'none');

                                        if (response["data"] == "TRUE") {
                                            Swal.fire({
                                                icon: "success",
                                                title: "Added Successfully!",
                                                showConfirmButton: false,
                                                timer: 1500,
                                            }).then((result) => {
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: "error",
                                                title: "Oops...",
                                                text: response.data,
                                            }).then((result) => {
                                                //location.reload();
                                            });
                                        }
                                    },
                                    error: function (response) {
                                        $('#loader').css('display', 'none');

                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "Something went wrong!",
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    }
                                });
                            }
                        });
                    } else {
                        $('#features_descp').focus();
                        $('.check_feature_descp').removeClass('d-none');
                    }
                } else {
                    $('#features_image').focus();
                    $('.check_features_image').removeClass('d-none');
                }
            } else {
                $('#features_name').focus();
                $('.check_features_name').removeClass('d-none');
            }
        });

        //get Features List
        $("#features_list").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            select: true,
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Configuration_Controller/get_features",
                type: "POST",
                dataSrc: function (json) {
                    if (json.data == 'False') 
                    {
                        return {}
                    } 
                    else 
                    {
                        return json.data;
                    }
                },
            },
            rowId: "unique_id",
            columns: [{
                    data: "unique_id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<img class="img img-responsive" style="width: 150px; height: auto;" src="${row.feature_image}">`;
                    },
                },
                {
                    data: "feature"
                },
                {
                    data: "feature_description"
                },

            ]
        });

        //Get Feature for modal
        $('#features_list tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');
            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Configuration_Controller/get_features_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) {
                    response = JSON.parse(response);
                    $('#loader').css('display', 'none');

                    $('#edit_features_name').val(response.data.feature);
                    $('#edit_features_descp').val(response.data.feature_description);
                    $('.edit_btn').attr('id', id);
                    $('#delete_features').attr('data-id', id);
                    $('#edit_features_modal').modal('show');

                },
                error: function (response) {
                    $('#loader').css('display', 'block');

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        location.reload();
                    });
                }
            });
        });

        $("#add_features_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
            $('.check_features_name').addClass('d-none');
            $('.check_features_descp').addClass('d-none');
        });

        $("#edit_features_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
            $('.check_edit_features_name').addClass('d-none');
            $('.check_edit_features_descp').addClass('d-none');
        });

        $('#edit_features_name').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_edit_features_name').removeClass('d-none');
            } else {
                $('.check_edit_features_name').addClass('d-none');
            }
        });

        $('#edit_features_image').on('keyup', function () {

            var img = document.getElementById('edit_features_image').files[0];

            if (img != null && ValidateImage(img)) {
                $('.check_edit_features_image').removeClass('d-none');
            } else {
                $('.check_edit_features_image').addClass('d-none');
            }
        });

        $('#edit_features_descp').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_edit_features_descp').removeClass('d-none');
            } else {
                $('.check_edit_features_descp').addClass('d-none');
            }
        });

        //Edit Feature Form
        $('#edit_features_form').on('submit', function (e) {
            e.preventDefault();

            var edit_features_form_token = $("#edit_features_form_token").val().trim();
            var uid = $('.edit_btn').attr('id');
            var feature = $('#edit_features_name').val().trim();
            var feature_image = document.getElementById('edit_features_image').files[0];
            var feature_description = $('#edit_features_descp').val().trim();

            var formdata = new FormData();

            if (feature != '') {
                if (feature_description != '') {
                    formdata.append('edit_features_form_token', edit_features_form_token);
                    formdata.append('uid', uid);
                    formdata.append('feature', feature);
                    formdata.append('feature_image', feature_image);
                    formdata.append('feature_description', feature_description);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to Update features?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#loader').css('display', 'block');
                            $.ajax({
                                url: "Easylearn/Configuration_Controller/edit_features_form",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    $('#loader').css('display', 'none');
                                    response = JSON.parse(response);

                                    if (response["data"] == "TRUE") {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Updated Successfully!",
                                            showConfirmButton: false,
                                            timer: 1500,
                                        }).then((result) => {
                                            location.href = 'managefeatures';
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: response.data,
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    }
                                },
                                error: function (response) {
                                    $('#loader').css('display', 'none');

                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            });
                        }
                    });

                } else {
                    $('#edit_features_descp').focus();
                    $('.check_edit_features_descp').removeClass('d-none');
                }

            } else {
                $('#edit_features_name').focus();
                $('.check_edit_features_name').removeClass('d-none');
            }

        });

        //Delete Feature
        $('#delete_features').on('click', function () {
            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Configuration_Controller/delete_features',
                        data: {
                            id: id
                        },
                        type: 'POST',
                        success: function (response) {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");

                            if (response['data'] == 'TRUE') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.data,
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        },
                        error: function (response) {
                            $("#loader").css("display", "none");

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    });
                }
            });
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == 'managebenefits') {
        $('#benefits_name').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_benefits_name').removeClass('d-none');
            } else {
                $('.check_benefits_name').addClass('d-none');
            }
        })

        $('#benefits_descp').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_benefits_descp').removeClass('d-none');
            } else {
                $('.check_benefits_descp').addClass('d-none');
            }
        })

        //Add Benfits
        $('#manage_benefits_form').on('submit', function (e) {

            e.preventDefault();

            var manage_benefits_form_token = $("#manage_benefits_form_token").val().trim();
            var benefit = $('#benefits_name').val().trim();
            var benefit_description = $('#benefits_descp').val().trim();

            if (benefit != '') {
                if (benefit_description != '') {
                    var formdata = new FormData();
                    formdata.append('manage_benefits_form_token', manage_benefits_form_token);
                    formdata.append('benefit', benefit);
                    formdata.append('benefit_description', benefit_description);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to Add benefits?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#loader').css('display', 'block');

                            $.ajax({
                                url: "Easylearn/Configuration_Controller/manage_benefits_form",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    $('#loader').css('display', 'none');
                                    response = JSON.parse(response);

                                    if (response["data"] == "TRUE") {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Added Successfully!",
                                            showConfirmButton: false,
                                            timer: 1500,
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: response.data,
                                        }).then((result) => {
                                            //location.reload();
                                        });
                                    }
                                },
                                error: function (response) {
                                    $('#loader').css('display', 'none');

                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            });
                        }
                    });
                } else {
                    $('#benefits_descp').focus();
                    $('.check_benefit_descp').removeClass('d-none');
                }
            } else {
                $('#benefits_name').focus();
                $('.check_benefits_name').removeClass('d-none');
            }
        });

        //Get All Benefits
        $("#benefits_list").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            select: true,
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Configuration_Controller/get_benefits",
                type: "POST",
                dataSrc: function (json) {
                    if (json.data == 'False') 
                    {
                        return {}
                    } 
                    else 
                    {
                        return json.data;
                    }
                },
            },
            rowId: "unique_id",
            columns: [{
                    data: "unique_id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },

                {
                    data: "benefit"
                },
                {
                    data: "benefit_description"
                },

            ]
        });

        //Get Benefit by id
        $('#benefits_list tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');
            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Configuration_Controller/get_benefits_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) {
                    $('#loader').css('display', 'none');

                    response = JSON.parse(response);
                    $('#edit_benefits_name').val(response.data.benefit);
                    $('#edit_benefits_descp').val(response.data.benefit_description);
                    $('.edit_btn').attr('id', id);
                    $('#delete_benefits').attr('data-id', id);
                    $('#edit_benefits_modal').modal('show');
                },
                error: function (response) {
                    $('#loader').css('display', 'none');

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        //location.reload();
                    });
                }
            });
        });

        $("#add_benefits_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
            $('.check_benefits_name').addClass('d-none');
            $('.check_benefits_descp').addClass('d-none');
        });

        $("#edit_benefits_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
            $('.check_edit_benefits_name').addClass('d-none');
            $('.check_edit_benefits_descp').addClass('d-none');
        });

        $('#edit_benefits_name').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_edit_benefits_name').removeClass('d-none');
            } else {
                $('.check_edit_benefits_name').addClass('d-none');
            }
        });

        $('#edit_benefits_descp').on('keyup', function () {
            if ($(this).val().trim() == '') {
                $('.check_edit_benefits_descp').removeClass('d-none');
            } else {
                $('.check_edit_benefits_descp').addClass('d-none');
            }
        });

        //Edit Benefit
        $('#edit_benefits_form').on('submit', function (e) {
            e.preventDefault();

            var edit_benefits_form_token = $("#edit_benefits_form_token").val().trim();
            var uid = $('.edit_btn').attr('id');
            var benefit = $('#edit_benefits_name').val().trim();
            var benefit_description = $('#edit_benefits_descp').val().trim();
            var formdata = new FormData();

            if (benefit != '') {
                if (benefit_description != '') {
                    formdata.append('edit_benefits_form_token', edit_benefits_form_token);
                    formdata.append('uid', uid);
                    formdata.append('benefit', benefit);
                    formdata.append('benefit_description', benefit_description);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to Update benefits?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) 
                        {
                            $('#loader').css('display', 'block');
                            $.ajax({
                                url: "Easylearn/Configuration_Controller/edit_benefits_form",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    response = JSON.parse(response);
                                    $('#loader').css('display', 'none');

                                    if (response["data"] == "TRUE") 
                                    {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Updated Successfully!",
                                            showConfirmButton: false,
                                            timer: 1500,
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    } 
                                    else 
                                    {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: response.data,
                                        }).then((result) => {
                                            //location.reload();
                                        });
                                    }
                                },
                                error: function (response) 
                                {
                                    $('#loader').css('display', 'none');
               
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                    }).then((result) => {
                                        //location.reload();
                                    });
                                }
                            });
                        }
                    });
                }
                else
                {
                    $('#edit_benefits_descp').focus();
                    $('.check_edit_benefits_descp').removeClass('d-none');
                }
            }
            else
            {
                $('#edit_benefits_name').focus();
                $('.check_edit_benefits_name').removeClass('d-none');
            }
        });
    
        //delete Benefit
        $('#delete_benefits').on('click', function(){

            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Configuration_Controller/delete_benefits',
                        data: {
                            id: id
                        },
                        type: 'POST',
                        success: function (response) 
                        {
                            $('#loader').css('display', 'none');
                            var response = JSON.parse(response);
        
                            if(response['data'] == 'TRUE')
                            {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.data,
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        },
                        error: function (response) 
                        {
                            $("#loader").css("display", "none");
    
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    });
                }
            });
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == 'manageservices')
    {
        $('#services_name').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_services_name').removeClass('d-none');
            }
            else
            {
                $('.check_services_name').addClass('d-none');
            }
        });
    
        $('#services_image').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_services_image').removeClass('d-none');
            }
            else
            {
                $('.check_services_image').addClass('d-none');
            }
        });
    
        $('#services_descp').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_services_descp').removeClass('d-none');
            }
            else
            {
                $('.check_services_descp').addClass('d-none');
            }
        });
    
        //Add Services
        $('#manage_services_form').on('submit',function(e){
    
            e.preventDefault();

            var manage_services_form_token = $("#manage_services_form_token").val().trim();
            var service                    = $('#services_name').val().trim();
            var service_image              = document.getElementById('services_image').files[0];
            var service_description        = $('#services_descp').val().trim();
    
            if(service!= '')
            {
                if(document.getElementById('services_image').files.length >0)
                {
                    if(service_description!= '')
                    {        
                        var formdata = new FormData();
                        formdata.append('manage_services_form_token' , manage_services_form_token);
                        formdata.append('service'                    , service);
                        formdata.append('service_image'              , service_image);
                        formdata.append('service_description'        , service_description);
                                        
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You want to Add services?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            if (result.isConfirmed) 
                            {
                                $('#loader').css('display', 'block');

                                $.ajax({
                                    url: "Easylearn/Configuration_Controller/manage_services_form",
                                    data: formdata,
                                    type: "POST",
                                    contentType: false,
                                    processData: false,
                                    success: function (response) 
                                    {
                                        $('#loader').css('display', 'none');

                                        response = JSON.parse(response);
                                
                                        if (response["data"] == "TRUE") 
                                        {
                                            Swal.fire({
                                                icon: "success",
                                                title: "Added Successfully!",
                                                showConfirmButton: false,
                                                timer: 1500,
                                            }).then((result) => {
                                                location.reload();
                                            });
                                        } 
                                        else 
                                        {
                                            Swal.fire({
                                                icon: "error",
                                                title: "Oops...",
                                                text: response.data,
                                            }).then((result) => {
                                                //location.reload();
                                            });
                                        }
                                    },
                                    error: function (response) 
                                    {
                                        $('#loader').css('display', 'none');
                            
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "Something went wrong!",
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    }
                                });  
                            }
                        });        
                    }
                    else
                    {             
                        $('#services_descp').focus();
                        $('.check_service_descp').removeClass('d-none');
                    }          
                }
                else
                {  
                    $('#services_image').focus();
                    $('.check_services_image').removeClass('d-none');
                }
            }
            else
            {            
                $('#services_name').focus();
                $('.check_services_name').removeClass('d-none');         
            }           
        });
    
        //Get All Services
        $("#services_list").DataTable({
              
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            select: true,
            rowReorder: true,
            columnDefs: [
                { orderable: true, className: "reorder", targets: "_all" },
            ],
            ajax: {
                url: "Easylearn/Configuration_Controller/get_services",
                type: "POST",
                dataSrc: function (json) {
                    if (json.data == 'False') 
                    {
                        return {}
                    } 
                    else 
                    {
                        return json.data;
                    }
                },
            },
            rowId: "unique_id",
            columns: [
                { 
                    data: "unique_id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<img class="img img-responsive" style="width: 150px; height: auto;" src="${row.service_image}">`;
                    },
                },
                { data: "service" },
                { data: "service_description" },
                
            ]
        });
    
        //Get service by ID
        $('#services_list tbody').on('dblclick', 'tr', function () {
            
            var id= $(this).attr('id');

            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Configuration_Controller/get_services_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) 
                {
                    $('#loader').css('display', 'none');

                    response = JSON.parse(response);
                    $('#edit_services_name').val(response.data.service);
                    $('#edit_services_descp').val(response.data.service_description);
                    $('.edit_btn').attr('id',id);
                    $('#delete_services').attr('data-id',id);
                    $('#edit_services_modal').modal('show');
                },
                error: function (response) 
                {
                    $('#loader').css('display', 'none');

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        //location.reload();
                    });
                }
            });
        });
    
        $("#add_services_modal").on("hidden.bs.modal", function (e) {
          $(this).find('form').trigger('reset');
          $('.check_services_name').addClass('d-none');
          $('.check_services_descp').addClass('d-none');
        });
    
        $("#edit_services_modal").on("hidden.bs.modal", function (e) {
          $(this).find('form').trigger('reset');
          $('.check_edit_services_name').addClass('d-none');
          $('.check_edit_services_descp').addClass('d-none');
        });
    
        $('#edit_services_name').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_services_name').removeClass('d-none');
            }
            else
            {
                $('.check_edit_services_name').addClass('d-none');
            }
        });
    
        $('#edit_services_image').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_services_image').removeClass('d-none');
            }
            else
            {
                $('.check_edit_services_image').addClass('d-none');
            }
        });
    
        $('#edit_services_descp').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_services_descp').removeClass('d-none');
            }
            else
            {
                $('.check_edit_services_descp').addClass('d-none');
            }
        });
    
        //Edit Service Form
        $('#edit_services_form').on('submit',function(e){
            e.preventDefault();
        
            var edit_services_form_token   = $("#edit_services_form_token").val().trim(); 
            var uid                        = $('.edit_btn').attr('id');
            var service                    = $('#edit_services_name').val().trim();
            var service_image              = document.getElementById('edit_services_image').files[0];
            var service_description        = $('#edit_services_descp').val().trim();
            var formdata = new FormData();

            if(service!= '')
            {
                if(service_description!= '')
                {
                    formdata.append('edit_services_form_token'   , edit_services_form_token);
                    formdata.append('uid'                        , uid);
                    formdata.append('service'                    , service);
                    formdata.append('service_image'              , service_image);
                    formdata.append('service_description'        , service_description);
                                
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to Update services?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) 
                        {
                            $('#loader').css('display', 'block');

                            $.ajax({
                                url: "Easylearn/Configuration_Controller/edit_services_form",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) 
                                {
                                    $('#loader').css('display', 'none');
                                    response = JSON.parse(response);
                            
                                    if (response["data"] == "TRUE") 
                                    {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Updated Successfully!",
                                            showConfirmButton: false,
                                            timer: 1500,
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    } 
                                    else 
                                    {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: response.data,
                                        }).then((result) => {
                                            //location.reload();
                                        });
                                    }
                                },
                                error: function (response) 
                                {
                                    $('#loader').css('display', 'none');

                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                    }).then((result) => {
                                        //location.reload();
                                    });
                                }
                            });  
                        }
                    });
                }
                else
                { 
                    $('#edit_services_descp').focus();
                    $('.check_edit_services_descp').removeClass('d-none');
                }
            }
            else
            {
                $('#edit_services_name').focus();
                $('.check_edit_services_name').removeClass('d-none');
            }
        });
    
        //Delete Service
        $('#delete_services').on('click', function(){
            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Configuration_Controller/delete_services',
                        data: {
                            id : id
                        },
                        type: 'POST',
                        success: function (response) 
                        {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");
        
                            if(response['data'] == 'TRUE')
                            {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.data,
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        },
                        error: function (response) 
                        {
                            $("#loader").css("display", "none");
    
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    });
                }
            });
        });
    
        $('#services_image').on('change', function(){
            var img = document.getElementById('services_image').files[0];
    
            if(img != null && ValidateImage(img))
            {
                $('.check_services_image').addClass('d-none');
            }
            else
            {
                $('.check_services_image').removeClass('d-none');
            }
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == 'manageteam')
    {
        $("#team_number_1, #team_number_2").intlTelInput();

        $('#team_name').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_team_name').removeClass('d-none');
            }
            else
            {
                $('.check_team_name').addClass('d-none');
            }
        });
    
        $('#team_job_role').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_team_job_role').removeClass('d-none');
            }
            else
            {
                $('.check_team_job_role').addClass('d-none');
            }
        });
    
        $('#linkedin_txt').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_linkedin_txt').removeClass('d-none');
            }
            else
            {
                $('.check_linkedin_txt').addClass('d-none');
            }
        });
    
        $('#facebook_txt').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_facebook_txt').removeClass('d-none');
            }
            else
            {
                $('.check_facebook_txt').addClass('d-none');
            }
        });
    
        $('#instagram_txt').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_instagram_txt').removeClass('d-none');
            }
            else
            {
                $('.check_instagram_txt').addClass('d-none');
            }
        });
    
        $('#twitter_txt').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_twitter_txt').removeClass('d-none');
            }
            else
            {
                $('.check_twitter_txt').addClass('d-none');
            }
        });
    
        $('#team_image').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_team_image').removeClass('d-none');
            }
            else
            {
                $('.check_team_image').addClass('d-none');
            }
        });
    
        $('#team_email_id').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_team_email_id').removeClass('d-none');
            }
            else
            {
                $('.check_team_email_id').addClass('d-none');
            }
        });
    
        $('#team_number_1').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_team_number_1').removeClass('d-none');
            }
            else
            {
                $('.check_team_number_1').addClass('d-none');
            }
        });
    
        $('#team_number_2').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_team_number_2').removeClass('d-none');
            }
            else
            {
                $('.check_team_number_2').addClass('d-none');
            }
        });
    
        $('#team_type').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_team_type').removeClass('d-none');
            }
            else
            {
                $('.check_team_type').addClass('d-none');
            }
        });
    
        $('#team_about').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_team_about').removeClass('d-none');
            }
            else
            {
                $('.check_team_about').addClass('d-none');
            }
        });
    
        $('#linkedin').on('change',function(){
            if (this.checked) 
            {
                $('#linkedin_txt').prop('disabled', false); // If checked enable item       
            } 
            else 
            {
                $('#linkedin_txt').prop('disabled', true); // If checked disable item                   
            }
        });

        $('#facebook').on('change',function(){

            if (this.checked) 
            {
                $('#facebook_txt').prop('disabled', false); // If checked enable item       
            } 
            else 
            {
                $('#facebook_txt').prop('disabled', true); // If checked disable item                   
            }
        });

        $('#instagram').on('change',function(){

            if (this.checked) 
            {
                $('#instagram_txt').prop('disabled', false); // If checked enable item       
            } 
            else 
            {
                $('#instagram_txt').prop('disabled', true); // If checked disable item                   
            }
        });

        $('#twitter').on('change',function(){

            if (this.checked) 
            {
                $('#twitter_txt').prop('disabled', false); // If checked enable item       
            } 
            else 
            {
                $('#twitter_txt').prop('disabled', true); // If checked disable item                   
            }
        });
    
        //Add Team
        $('#manage_team_form').on('submit',function(e){
    
            e.preventDefault();

            var manage_team_form_token = $("#manage_team_form_token").val().trim();
            var name                   = $('#team_name').val().trim();
            var job_role               = $('#team_job_role').val().trim();
            var facebook               = $('#facebook_txt').val().trim();
            var twitter                = $('#twitter_txt').val().trim();
            var instagram              = $('#instagram_txt').val().trim();
            var linkedin               = $('#linkedin_txt').val().trim();
            var image_path             = document.getElementById('team_image').files[0];
            var email_id               = $('#team_email_id').val().trim();
            var telephone_1            = $('#team_number_1').intlTelInput("getNumber");
            var telephone_2            = $('#team_number_2').intlTelInput("getNumber");
            var type                   = $('#team_type').val().trim();
            var about                  = $('#team_about').val().trim();

            var social = [];

            if (!$('#facebook_txt').prop('disabled')) 
            {
                var facebook = $('#facebook_txt').val().trim();
                if (facebook!='' && facebook!=null)
                {
                    social.push(facebook);
                    $('.check_facebook_txt').addClass('d-none');
                }
                else
                {
                    $('.check_facebook_txt').removeClass('d-none');
                }
            }
            else
            {
                var facebook = ' ';
            } 
    
            if (!$('#twitter_txt').prop('disabled')) 
            {
                var twitter = $('#twitter_txt').val().trim();
                if (twitter!='' && twitter!=null)
                {
                    social.push(twitter);
                    $('.check_twitter_txt').addClass('d-none');
                }
                else
                {
                    $('.check_twitter_txt').removeClass('d-none');
                }
                social.push(twitter);
            }
            else
            {
                var twitter = ' ';
            }
    
            if (!$('#instagram_txt').prop('disabled')) 
            {
                var instagram = $('#instagram_txt').val().trim();
                if (instagram!='' && instagram!=null)
                {
                    social.push(instagram);
                    $('.check_instagram_txt').addClass('d-none');
                }
                else
                {
                    $('.check_instagram_txt').removeClass('d-none');
                }
                social.push(instagram);
            }
            else
            {
                var instagram = ' ';
            }

            if (!$('#linkedin_txt').prop('disabled')) 
            {
                var linkedin = $('#linkedin_txt').val().trim();
                if (linkedin!='' && linkedin!=null)
                {
                    social.push(linkedin);
                    $('.check_linkedin_txt').addClass('d-none');
                }
                else
                {
                    $('.check_linkedin_txt').removeClass('d-none');
                }
                social.push(linkedin);
            }
            else
            {
                var linkedin = ' ';
            }
    
            if(name!= '')
            {
                if(job_role!= '')
                {
                    if(social.length > 0)
                    {
                        if(document.getElementById('team_image').files.length >0)
                        {
                            if(email_id!= '')
                            {
                                if(telephone_1!= '')
                                {
                                    if(telephone_2!= '')
                                    {
                                        if(type!= '')
                                        {
                                            if(about!= '')
                                            {
                                                var formdata = new FormData();
                                                formdata.append('manage_team_form_token' , manage_team_form_token);
                                                formdata.append('name'                   , name);
                                                formdata.append('job_role'               , job_role);
                                                formdata.append('facebook'               , facebook);
                                                formdata.append('twitter'                , twitter);
                                                formdata.append('instagram'              , instagram);
                                                formdata.append('linkedin'               , linkedin);
                                                formdata.append('image_path'             , image_path);
                                                formdata.append('email_id'               , email_id);
                                                formdata.append('telephone_1'            , telephone_1);
                                                formdata.append('telephone_2'            , telephone_2);
                                                formdata.append('type'                   , type);
                                                formdata.append('about'                  , about);
                            
                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    text: "You want to Add Team?",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Yes'
                                                }).then((result) => {
                                                    if (result.isConfirmed) 
                                                    {
                                                        $('#loader').css('display', 'block');

                                                        $.ajax({
                                                            url: "Easylearn/Configuration_Controller/manage_team_form",
                                                            data: formdata,
                                                            type: "POST",
                                                            contentType: false,
                                                            processData: false,
                                                            success: function (response) 
                                                            {
                                                                $('#loader').css('display', 'none');

                                                                response = JSON.parse(response);
                                                        
                                                                if (response["data"] == "TRUE") 
                                                                {
                                                                    Swal.fire({
                                                                        icon: "success",
                                                                        title: "Added Successfully!",
                                                                        showConfirmButton: false,
                                                                        timer: 1500,
                                                                    }).then((result) => {
                                                                        location.reload();
                                                                    });
                                                                } 
                                                                else 
                                                                {
                                                                    Swal.fire({
                                                                        icon: "error",
                                                                        title: "Oops...",
                                                                        text: response.data,
                                                                    }).then((result) => {
                                                                        //location.reload();
                                                                    });
                                                                }
                                                            },
                                                            error: function (response) 
                                                            {
                                                                $('#loader').css('display', 'none');
                                                    
                                                                Swal.fire({
                                                                    icon: "error",
                                                                    title: "Oops...",
                                                                    text: "Something went wrong!",
                                                                }).then((result) => {
                                                                    //location.reload();
                                                                });
                                                            }
                                                        });  
                                                    }
                                                });
                                            }
                                            else
                                            {
                                                $('#team_about').focus();
                                                $('.check_team_about').removeClass('d-none');
                                            }                  
                                        }
                                        else
                                        {
                                            $('#team_type').focus();
                                            $('.check_team_type').removeClass('d-none');
                                        }               
                                    }
                                    else
                                    { 
                                        $('#team_number_2').focus();
                                        $('.check_team_number_2').removeClass('d-none');
                                    }
                                }
                                else
                                {
                                    $('#team_number_1').focus();
                                    $('.check_team_number_1').removeClass('d-none');
                                }       
                            }
                            else
                            {
                                $('#team_email_id').focus();
                                $('.check_team_email_id').removeClass('d-none');
                            }    
                        }
                        else
                        {
                            $('#team_image').focus();
                            $('.check_team_image').removeClass('d-none');
                        }
                    }
                    else
                    {
                        $('#linkedin_txt').focus();
                        $('.check_social_media').removeClass('d-none');
                    }      
                }
                else
                {
                    $('#team_job_role').focus();
                    $('.check_team_job_role').removeClass('d-none');
                }       
            }
            else
            {
                $('#team_name').focus();
                $('.check_team_name').removeClass('d-none');
            }
        });
    
        //get All Team
        $("#team_list").DataTable({
            
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            select: true,
            rowReorder: true,
            columnDefs: [
                { orderable: true, className: "reorder", targets: "_all" },
            ],
            ajax: {
                url: "Easylearn/Configuration_Controller/get_team",
                type: "POST",
                dataSrc: function (json) {
                    if (json.data == 'False') 
                    {
                        return {}
                    } 
                    else 
                    {
                        return json.data;
                    }
                },
            },
            rowId: "unique_id",
            columns: [
                { 
                    data: "unique_id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<img class="img img-responsive" style="width: 100px; height: 100px;"src="${row.image_path}">`;
                    },
                },
                { data: "name" },
                { data: "job_role" },
                { data: "email_id" },
                { data: "type" },
            ]
        });
    
        $("#add_team_modal").on("hidden.bs.modal", function (e) {
          $(this).find('form').trigger('reset');
          $('.check_team_name').addClass('d-none');
          $('.check_team_job_role').addClass('d-none');
          $('.check_facebook_txt').addClass('d-none');
          $('.check_instagram_txt').addClass('d-none');
          $('.check_twitter_txt').addClass('d-none');
          $('.check_team_email_id').addClass('d-none');
          $('.check_team_number_1').addClass('d-none');
          $('.check_team_number_2').addClass('d-none');
          $('.check_team_type').addClass('d-none');
          $('.check_team_about').addClass('d-none');
        });
    
        $("#edit_team_modal").on("hidden.bs.modal", function (e) {
          $(this).find('form').trigger('reset');
          $('.check_edit_team_name').addClass('d-none');
          $('.check_edit_team_job_role').addClass('d-none');
          $('.check_edit_facebook_txt').addClass('d-none');
          $('.check_edit_instagram_txt').addClass('d-none');
          $('.check_edit_twitter_txt').addClass('d-none');
          $('.check_edit_team_email_id').addClass('d-none');
          $('.check_edit_team_number_1').addClass('d-none');
          $('.check_edit_team_number_2').addClass('d-none');
          $('.check_edit_team_type').addClass('d-none');
          $('.check_edit_team_about').addClass('d-none');
        });
        
        //get Team by ID
        $('#team_list tbody').on('dblclick', 'tr', function () {
            
            $('#loader').css('display', 'block');
            var id= $(this).attr('id');
            
            $.ajax({
                url: "Easylearn/Configuration_Controller/get_team_by_id",
                data: {
                    'id' : id,
                },
                type: "POST",
                success: function (response) 
                {
                    $('#loader').css('display', 'none');

                    response = JSON.parse(response);
                    $('#edit_team_name').val(response.data.name);
                    $('#edit_team_job_role').val(response.data.job_role);
                    $('#edit_linkedin_txt').val(response.data.linkedin);
                    $('#edit_instagram_txt').val(response.data.instagram);
                    
                    if($.trim(response.data.linkedin)!='')
                    {
                        $('#edit_linkedin_txt').val(response.data.linkedin).prop('disabled',false);
                        $('#edit_linkedin').prop("checked", true);
                    }
                    else
                    {
                        $('#edit_linkedin').prop("checked", false);
                    }
    
                    $('#edit_facebook_txt').val(response.data.facebook);
    
                    if($.trim(response.data.facebook)!='')
                    {
                        $('#edit_facebook_txt').val(response.data.facebook).prop('disabled',false);
                        $('#edit_facebook').prop("checked", true);
                    }
                    else
                    {
                        $('#edit_facebook').prop("checked", false);
                    }
    
                    if($.trim(response.data.instagram)!='')
                    {
                        $('#edit_instagram_txt').val(response.data.instagram).prop('disabled',false);
                        $('#edit_instagram').prop("checked", true);
                    }
                    else
                    {
                        $('#edit_instagram').prop("checked", false);
                    }
    
                    $('#edit_twitter_txt').val(response.data.twitter);
    
                    if($.trim(response.data.twitter)!='')
                    {
                        $('#edit_twitter_txt').val(response.data.twitter).prop('disabled',false);
                        $('#edit_twitter').prop("checked", true);
                    }
                    else
                    {
                        $('#edit_twitter').prop("checked", false);
                    }

                    $('#edit_team_number_1').intlTelInput('destroy');
                    $('#edit_team_number_2').intlTelInput('destroy');

                    $('#edit_team_email_id').val(response.data.email_id);
                    $('#edit_team_number_1').val(response.data.telephone_1);
                    $('#edit_team_number_2').val(response.data.telephone_2);
                    $('#edit_team_type').val(response.data.type);
                    $('#edit_team_about').val(response.data.about);
                    $('.edit_btn').attr('id',id);
                    $('#delete_team').attr('data-id',id);
                    $('#edit_team_modal').modal('show');

                    $("#edit_team_number_1, #edit_team_number_2").intlTelInput();
                },
                error: function (response) 
                {
                    $('#loader').css('display', 'none');
        
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        //location.reload();
                    });
                }
            });
            
        });
    
        $('#edit_team_name').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_team_name').removeClass('d-none');
            }
            else
            {
                $('.check_edit_team_name').addClass('d-none');
            }
        });
    
        $('#edit_team_job_role').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_team_job_role').removeClass('d-none');
            }
            else
            {
                $('.check_edit_team_job_role').addClass('d-none');
            }
        });
    
        $('#edit_linkedin_txt').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_linkedin_txt').removeClass('d-none');
            }
            else
            {
                $('.check_edit_linkedin_txt').addClass('d-none');
            }
        });
    
        $('#edit_facebook_txt').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_facebook_txt').removeClass('d-none');
            }
            else
            {
                $('.check_edit_facebook_txt').addClass('d-none');
            }
        });
    
        $('#edit_instagram_txt').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_instagram_txt').removeClass('d-none');
            }
            else
            {
                $('.check_edit_instagram_txt').addClass('d-none');
            }
        });
    
        $('#edit_twitter_txt').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_twitter_txt').removeClass('d-none');
            }
            else
            {
                $('.check_edit_twitter_txt').addClass('d-none');
            }
        });
    
        $('#edit_team_image').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_team_image').removeClass('d-none');
            }
            else
            {
                $('.check_edit_team_image').addClass('d-none');
            }
        });
    
        $('#edit_team_email_id').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_team_email_id').removeClass('d-none');
            }
            else
            {
                $('.check_edit_team_email_id').addClass('d-none');
            }
        });
    
        $('#edit_team_number_1').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_team_number_1').removeClass('d-none');
            }
            else
            {
                $('.check_edit_team_number_1').addClass('d-none');
            }
        });
    
        $('#edit_team_number_2').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_team_number_2').removeClass('d-none');
            }
            else
            {
                $('.check_edit_team_number_2').addClass('d-none');
            }
        });
    
        $('#edit_team_type').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_team_type').removeClass('d-none');
            }
            else
            {
                $('.check_edit_team_type').addClass('d-none');
            }
        });
    
        $('#edit_team_about').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_team_about').removeClass('d-none');
            }
            else
            {
                $('.check_edit_team_about').addClass('d-none');
            }
        });
    
        $('#edit_linkedin').on('change',function(){
            if (this.checked) 
            {
                $('#edit_linkedin_txt').prop('disabled', false); // If checked enable item       
            } 
            else 
            {
                $('#edit_linkedin_txt').prop('disabled', true); // If checked disable item                   
            }
        });
        
        $('#edit_facebook').on('change',function(){
            if (this.checked) 
            {
                $('#edit_facebook_txt').prop('disabled', false); // If checked enable item       
            } 
            else 
            {
                $('#edit_facebook_txt').prop('disabled', true); // If checked disable item                   
            }
        });
        
        $('#edit_instagram').on('change',function(){
            if (this.checked) 
            {
                $('#edit_instagram_txt').prop('disabled', false); // If checked enable item       
            } 
            else 
            {
                $('#edit_instagram_txt').prop('disabled', true); // If checked disable item                   
            }
        });
        
        $('#edit_twitter').on('change',function(){
            if (this.checked) 
            {
                $('#edit_twitter_txt').prop('disabled', false); // If checked enable item       
            } 
            else 
            {
                $('#edit_twitter_txt').prop('disabled', true); // If checked disable item                   
            }
        });
        
        //Edit Team
        $('#edit_team_form').on('submit',function(e){
            e.preventDefault();
            
            var edit_team_form_token   = $("#edit_team_form_token").val().trim(); 
            var uid                    = $('.edit_btn').attr('id');
            var name                   = $('#edit_team_name').val().trim();
            var job_role               = $('#edit_team_job_role').val().trim();
            var facebook               = $('#edit_facebook_txt').val().trim();
            var twitter                = $('#edit_twitter_txt').val().trim();
            var instagram              = $('#edit_instagram_txt').val().trim();
            var linkedin               = $('#edit_linkedin_txt').val().trim();
            var image_path             = document.getElementById('edit_team_image').files[0];
            var email_id               = $('#edit_team_email_id').val().trim();
            var telephone_1            = $('#edit_team_number_1').intlTelInput("getNumber");
            var telephone_2            = $('#edit_team_number_2').intlTelInput("getNumber");
            var type                   = $('#edit_team_type').val().trim();
            var about                  = $('#edit_team_about').val().trim();
      
            var social = [];

            if (!$('#edit_facebook_txt').prop('disabled')) 
            {
                var facebook = $('#edit_facebook_txt').val().trim();
                if (facebook!='' && facebook!=null)
                {
                    social.push(facebook);
                    $('.check_edit_facebook_txt').addClass('d-none');
                }
                else
                {
                    $('.check_edit_facebook_txt').removeClass('d-none');
                } 
            }
            else
            {
                var facebook = '';
            } 
    
            if (!$('#edit_twitter_txt').prop('disabled')) 
            {
                var twitter = $('#edit_twitter_txt').val().trim();
                if (twitter!='' && twitter!=null)
                {
                    social.push(twitter);
                    $('.check_edit_twitter_txt').addClass('d-none');
                }
                else
                {
                    $('.check_edit_twitter_txt').removeClass('d-none');
                }
            }
            else
            {
                var twitter = '';
            }
    
            if (!$('#edit_instagram_txt').prop('disabled')) 
            {
                var instagram = $('#edit_instagram_txt').val().trim();
                if (instagram!='' && instagram!=null)
                {
                    social.push(instagram);
                    $('.check_edit_instagram_txt').addClass('d-none');
                }
                else
                {
                    $('.check_edit_instagram_txt').removeClass('d-none');
                }
            }
            else
            {
                var instagram = '';
            }
    
            if (!$('#edit_linkedin_txt').prop('disabled')) 
            {
                var linkedin = $('#edit_linkedin_txt').val().trim();
                if (linkedin!='' && linkedin!=null)
                {
                    social.push(linkedin);
                    $('.check_edit_linkedin_txt').addClass('d-none');
                }
                else
                {
                    $('.check_edit_linkedin_txt').removeClass('d-none');
                }

            }
            else
            {
                var linkedin = '';
            }
        
            if(name!= '')
            {
                if(job_role!= '')
                {
                    if(social.length > 0)
                    {
                        if(email_id!= '')
                        {
                            if(telephone_1!= '')
                            {
                                if(telephone_2!= '')
                                {
                                    if(type!= '')
                                    {
                                        if(about!= '')
                                        {
                                            var formdata = new FormData();
 
                                            formdata.append('edit_team_form_token'   , edit_team_form_token);
                                            formdata.append('uid'                    ,uid);
                                            formdata.append('name'                   , name);
                                            formdata.append('job_role'               , job_role);
                                            formdata.append('facebook'               , facebook);
                                            formdata.append('twitter'                , twitter);
                                            formdata.append('instagram'              , instagram);
                                            formdata.append('linkedin'               , linkedin);
                                            formdata.append('image_path'             , image_path);
                                            formdata.append('email_id'               , email_id);
                                            formdata.append('telephone_1'            , telephone_1);
                                            formdata.append('telephone_2'            , telephone_2);
                                            formdata.append('type'                   , type);
                                            formdata.append('about'                  , about);
                                
                                            Swal.fire({
                                                title: 'Are you sure?',
                                                text: "You want to Update Team?",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Yes'
                                            }).then((result) => {
                                                if (result.isConfirmed) 
                                                {
                                                    $('#loader').css('display', 'block');

                                                    $.ajax({
                                                        url: "Easylearn/Configuration_Controller/edit_team_form",
                                                        data: formdata,
                                                        type: "POST",
                                                        contentType: false,
                                                        processData: false,
                                                        success: function (response) 
                                                        {
                                                            response = JSON.parse(response);
                                                            $('#loader').css('display', 'none');

                                                            if (response["data"] == "TRUE") 
                                                            {
                                                                Swal.fire({
                                                                    icon: "success",
                                                                    title: "Updated Successfully!",
                                                                    showConfirmButton: false,
                                                                    timer: 1500,
                                                                }).then((result) => {
                                                                    location.reload();
                                                                });
                                                            } 
                                                            else 
                                                            {
                                                                Swal.fire({
                                                                    icon: "error",
                                                                    title: "Oops...",
                                                                    text: response.data,
                                                                }).then((result) => {
                                                                    //location.reload();
                                                                });
                                                            }
                                                        },
                                                        error: function (response) 
                                                        {
                                                            $('#loader').css('display', 'none');
                                                
                                                            Swal.fire({
                                                                icon: "error",
                                                                title: "Oops...",
                                                                text: "Something went wrong!",
                                                            }).then((result) => {
                                                                // location.reload();
                                                            });
                                                        }
                                                    });  
                                                }
                                            });
                                        }
                                        else
                                        {
                                            $('#edit_team_about').focus();
                                            $('.check_edit_team_about').removeClass('d-none');
                                        }         
                                    }
                                    else
                                    {
                                    
                                    }          
                                }
                                else
                                {
                                    $('#edit_team_number_2').focus();
                                    $('.check_edit_team_number_2').removeClass('d-none');
                                }
                            }
                            else
                            {
                                $('#edit_team_number_1').focus();
                                $('.check_edit_team_number_1').removeClass('d-none');
                            }
                        }
                        else
                        {
                            $('#edit_team_email_id').focus();
                            $('.check_edit_team_email_id').removeClass('d-none');
                        }                        
                    }
                    else
                    {
                        $('#edit_linkedin_txt').focus();
                        $('.check_social_media').removeClass('d-none');
                    }   
                }
                else
                {
                    $('#edit_team_job_role').focus();
                    $('.check_edit_team_job_role').removeClass('d-none');
                }
            }
            else
            {
                $('#edit_team_name').focus();
                $('.check_edit_team_name').removeClass('d-none');
            }
        });
        
        //Delete Team
        $('#delete_team').on('click', function(){

            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Configuration_Controller/delete_team',
                        data: {
                            id : id
                        },
                        type: 'POST',
                        success: function (response) 
                        {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");
        
                            if(response['data'] == 'TRUE')
                            {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.data,
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        },
                        error: function (response) 
                        {
                            $("#loader").css("display", "none");
    
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    });
                }
            });
        });
        
        $('#team_image').on('change', function(){
            var img = document.getElementById('team_image').files[0];
    
            if(img != null && ValidateImage(img))
            {
                $('.check_team_image').addClass('d-none');
            }
            else
            {
                $('.check_team_image').removeClass('d-none');
            }
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == 'managenewsfeed')
    {
        $('#newsfeed_headline').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_newsfeed_headline').removeClass('d-none');
            }
            else
            {
                $('.check_newsfeed_headline').addClass('d-none');
            }
        });
    
        $('#newsfeed_link').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_newsfeed_link').removeClass('d-none');
            }
            else
            {
                $('.check_newsfeed_link').addClass('d-none');
            }
        });
    
        //Add NewsFeed
        $('#manage_newsfeed_form').on('submit',function(e){
    
            e.preventDefault();
    
            var manage_newsfeed_form_token = $("#manage_newsfeed_form_token").val().trim();
            var newsfeed_headline          = $('#newsfeed_headline').val().trim();
            var newsfeed_link              = $('#newsfeed_link').val().trim();
    
            if(newsfeed_headline!= '')
            {
                if(newsfeed_link!= '')
                {           
                    var formdata = new FormData();
                    formdata.append('manage_newsfeed_form_token' , manage_newsfeed_form_token);
                    formdata.append('newsfeed_headline'          , newsfeed_headline);
                    formdata.append('newsfeed_link'              , newsfeed_link);
                    
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to Add newsfeed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) 
                        {
                            $('#loader').css('display', 'block');

                            $.ajax({
                                url: "Easylearn/Configuration_Controller/manage_newsfeed_form",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) 
                                {
                                    $('#loader').css('display', 'none');
                                    response = JSON.parse(response);
                            
                                    if (response["data"] == "TRUE") 
                                    {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Added Successfully!",
                                            showConfirmButton: false,
                                            timer: 1500,
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    } 
                                    else 
                                    {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: response.data,
                                        }).then((result) => {
                                            //location.reload();
                                        });
                                    }
                                },
                                error: function (response) 
                                {
                                    $('#loader').css('display', 'none');
                            
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                    }).then((result) => {
                                        //location.reload();
                                    });
                                }
                            });  
                        }
                    });
                }
                else
                {
                    $('.check_newsfeed_headline_descp').removeClass('d-none');
                }              
            }
            else
            {
                $('#newsfeed_headline').focus();
                $('.check_newsfeed_headline').removeClass('d-none');
            }           
        });
    
        //Get All Newsfeed
        $("#newsfeed_list").DataTable({

            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            select: true,
            rowReorder: true,
            columnDefs: [
                { orderable: true, className: "reorder", targets: "_all" },
            ],
            ajax: {
                url: "Easylearn/Configuration_Controller/get_newsfeed",
                type: "POST",
                dataSrc: function (json) {
                    if (json.data == 'False') 
                    {
                        return {}
                    } 
                    else 
                    {
                        return json.data;
                    }
                },
            },
            rowId: "unique_id",
            columns: [
                { 
                    data: "unique_id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                
                { data: "newsfeed_headline" },
                { data: "newsfeed_rsslink" },  
            ]
        });
    
        //Get NewsFeed by ID
        $('#newsfeed_list tbody').on('dblclick', 'tr', function () {
            
            $('#loader').css('display', 'block');
            var id= $(this).attr('id');

            $.ajax({
                url: "Easylearn/Configuration_Controller/get_newsfeed_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) 
                {
                    $('#loader').css('display', 'none');

                    response = JSON.parse(response);
                    $('#edit_newsfeed_headline').val(response.data.newsfeed_headline);
                    $('#edit_newsfeed_link').val(response.data.newsfeed_rsslink);
                    $('.edit_btn').attr('id',id);
                    $('#delete_newsfeed').attr('data-id',id);
                    $('#edit_newsfeed_modal').modal('show');
                },
                error: function (response) 
                {
                    $('#loader').css('display', 'none');
        
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        //location.reload();
                    });
                }
            });
        });
    
        $("#add_newsfeed_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
            $('.check_newsfeed_headline').addClass('d-none');
            $('.check_newsfeed_link').addClass('d-none');
        });
    
        $("#edit_newsfeed_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
            $('.check_edit_newsfeed_headline').addClass('d-none');
            $('.check_edit_newsfeed_link').addClass('d-none');
        });
    
        $('#edit_newsfeed_headline').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_newsfeed_headline').removeClass('d-none');
            }
            else
            {
                $('.check_edit_newsfeed_headline').addClass('d-none');
            }
        });
    
        $('#edit_newsfeed_link').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_newsfeed_link').removeClass('d-none');
            }
            else
            {
                $('.check_edit_newsfeed_link').addClass('d-none');
            }
        });
    
        //Edit NewsFeed
        $('#edit_newsfeed_form').on('submit',function(e){
            e.preventDefault();

            var edit_newsfeed_form_token   = $("#edit_newsfeed_form_token").val().trim(); 
            var uid                        = $('.edit_btn').attr('id');
            var newsfeed_headline          = $('#edit_newsfeed_headline').val().trim();
            var newsfeed_link              = $('#edit_newsfeed_link').val().trim();

            var formdata = new FormData();
    
            if(newsfeed_headline!= '')
            {
                if(newsfeed_link!= '')
                {
                    formdata.append('edit_newsfeed_form_token'   , edit_newsfeed_form_token);
                    formdata.append('uid'                        ,uid);
                    formdata.append('newsfeed_headline'          , newsfeed_headline);
                    formdata.append('newsfeed_link'              , newsfeed_link);
                                
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to Update NewsFeed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) 
                        {
                            $('#loader').css('display', 'block');

                            $.ajax({
                                url: "Easylearn/Configuration_Controller/edit_newsfeed_form",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) 
                                {
                                    $('#loader').css('display', 'none');

                                    response = JSON.parse(response);
                            
                                    if (response["data"] == "TRUE") 
                                    {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Updated Successfully!",
                                            showConfirmButton: false,
                                            timer: 1500,
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    } 
                                    else 
                                    {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: response.data,
                                        }).then((result) => {
                                            //location.reload();
                                        });
                                    }
                                },
                                error: function (response) 
                                {
                                    $('#loader').css('display', 'none');
                        
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                    }).then((result) => {
                                        //location.reload();
                                    });
                                }
                            });  
                        }
                    });
                }
                else
                {    
                    $('#edit_newsfeed_link').focus();
                    $('.check_edit_newsfeed_link').removeClass('d-none');
                }
            }
            else
            {    
                $('#edit_newsfeed_headline').focus();
                $('.check_edit_newsfeed_headline').removeClass('d-none');
            }
        });
    
        //delete NewsFeed
        $('#delete_newsfeed').on('click', function(){
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Configuration_Controller/delete_newsfeed',
                        data: {
                            id : id
                        },
                        type: 'POST',
                        success: function (response) 
                        {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");
        
                            if(response['data'] == 'TRUE')
                            {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.data,
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        },
                        error: function (response) 
                        {
                            $("#loader").css("display", "none");
    
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    });
                }
            });
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == 'managetestimonials')
    {
        $('#testimonial_name').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_testimonial_name').removeClass('d-none');
            }
            else
            {
                $('.check_testimonial_name').addClass('d-none');
            }
        });
    
        $('#testimonial_job_role').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_testimonial_job_role').removeClass('d-none');
            }
            else
            {
                $('.check_testimonial_job_role').addClass('d-none');
            }
        });
    
        $('#testimonial_image').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_testimonial_image').removeClass('d-none');
            }
            else
            {
                $('.check_testimonial_image').addClass('d-none');
            }
        });
    
        $('#testimonial_companywebsite').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_testimonial_companywebsite').removeClass('d-none');
            }
            else
            {
                $('.check_testimonial_companywebsite').addClass('d-none');
            }
        });
    
        $('#testimonial_description').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_testimonial_description').removeClass('d-none');
            }
            else
            {
                $('.check_testimonial_description').addClass('d-none');
            }
        });
    
        //Add Testimonial
        $('#manage_testimonial_form').on('submit',function(e){
    
            e.preventDefault();
    
            var manage_testimonial_form_token = $("#manage_testimonial_form_token").val().trim();
            var name                          = $('#testimonial_name').val().trim();
            var job_role                      = $('#testimonial_job_role').val().trim();
            var image_path                    = document.getElementById('testimonial_image').files[0];
            var companywebsite                = $('#testimonial_companywebsite').val().trim();
            var description                   = $('#testimonial_description').val().trim();
    
            if(name!= '')
            {
                if(job_role!= '')
                {    
                    if(document.getElementById('testimonial_image').files.length >0)
                    {
                        if(companywebsite!= '')
                        {
                            if(description!= '')
                            {
                                var formdata = new FormData();
                                formdata.append('manage_testimonial_form_token' , manage_testimonial_form_token);
                                formdata.append('name'                          , name);
                                formdata.append('job_role'                      , job_role);
                                formdata.append('image_path'                    , image_path);
                                formdata.append('companywebsite'                , companywebsite);
                                formdata.append('description'                   , description);
                            
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "You want to Add testimonial?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes'
                                }).then((result) => {
                                    if (result.isConfirmed) 
                                    {
                                        $('#loader').css('display', 'block');

                                        $.ajax({
                                            url: "Easylearn/Configuration_Controller/manage_testimonial_form",
                                            data: formdata,
                                            type: "POST",
                                            contentType: false,
                                            processData: false,
                                            success: function (response) 
                                            {
                                                $('#loader').css('display', 'none');

                                                response = JSON.parse(response);
                                        
                                                if (response["data"] == "TRUE") 
                                                {
                                                    Swal.fire({
                                                        icon: "success",
                                                        title: "Added Successfully!",
                                                        showConfirmButton: false,
                                                        timer: 1500,
                                                    }).then((result) => {
                                                        location.reload();
                                                    });
                                                } 
                                                else 
                                                {
                                                    Swal.fire({
                                                        icon: "error",
                                                        title: "Oops...",
                                                        text: response.data,
                                                    }).then((result) => {
                                                        //location.reload();
                                                    });
                                                }
                                            },
                                            error: function (response) {
                                                $('#loader').css('display', 'none');
                                        
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Oops...",
                                                    text: "Something went wrong!",
                                                }).then((result) => {
                                                    location.reload();
                                                });
                                            }
                                        });  
                                    }
                                });       
                            }
                            else
                            {
                                $('#testimonial_description').focus();
                                $('.check_testimonial_description').removeClass('d-none');
                            }
                        }
                        else
                        {
                            $('#testimonial_companywebsite').focus();
                            $('.check_testimonial_companywebsite').removeClass('d-none');
                        }         
                    }
                    else
                    {
                        $('#testimonial_image').focus();
                        $('.check_testimonial_image').removeClass('d-none');
                    }
                }
                else
                {
                    $('#testimonial_job_role').focus();
                    $('.check_testimonial_job_role').removeClass('d-none');
                }            
            }
            else
            {
                $('#testimonial_name').focus();
                $('.check_testimonial_name').removeClass('d-none');
            }
        });
    
        //get All testimonial
        $("#testimonial_list").DataTable({
            
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            select: true,
            rowReorder: true,
            columnDefs: [
                { orderable: true, className: "reorder", targets: "_all" },
            ],
            ajax: {
                url: "Easylearn/Configuration_Controller/get_testimonial",
                type: "POST",
                dataSrc: function (json) {
                    if (json.data == 'False') 
                    {
                        return {}
                    } 
                    else 
                    {
                        return json.data;
                    }
                },
            },
            rowId: "unique_id",
            columns: [
                { 
                    data: "unique_id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<img class="img img-responsive" style="width: 150px; height: auto;"src="${row.testimonial_image}">`;
                    },
                },
                { data: "testimonial_name" },
                { data: "testimonial_jobrole" },
                { data: "testimonial_companywebsite" },
                
            ]
        });
    
        $("#add_testimonial_modal").on("hidden.bs.modal", function (e) {
          $(this).find('form').trigger('reset');
          $('.check_testimonial_name').addClass('d-none');
          $('.check_testimonial_job_role').addClass('d-none');
          $('.check_testimonial_companywebsite').addClass('d-none');
          $('.check_testimonial_description').addClass('d-none');
        });
    
        $("#edit_testimonial_modal").on("hidden.bs.modal", function (e) {
          $(this).find('form').trigger('reset');
          $('.check_edit_testimonial_name').addClass('d-none');
          $('.check_edit_testimonial_job_role').addClass('d-none');
          $('.check_edit_testimonial_companywebsite').addClass('d-none');
          $('.check_edit_testimonial_description').addClass('d-none');
        });
        
        //Get Testimonial by ID
        $('#testimonial_list tbody').on('dblclick', 'tr', function () {
            
            var id= $(this).attr('id');

            $.ajax({
                url: "Easylearn/Configuration_Controller/get_testimonial_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) 
                {
                    response = JSON.parse(response);
                    $('#edit_testimonial_name').val(response.data.testimonial_name);
                    $('#edit_testimonial_job_role').val(response.data.testimonial_jobrole);
                    $('#edit_testimonial_companywebsite').val(response.data.testimonial_companywebsite);
                    $('#edit_testimonial_description').val(response.data.testimonial_description);
                    $('.edit_btn').attr('id',id);
                    $('#delete_testimonial').attr('data-id',id);
                    $('#edit_testimonial_modal').modal('show');
                },
                error: function (response) 
                {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        location.reload();
                    });
                }
            });
        });
    
        $('#edit_testimonial_name').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_testimonial_name').removeClass('d-none');
            }
            else
            {
                $('.check_edit_testimonial_name').addClass('d-none');
            }
        })
    
        $('#edit_testimonial_job_role').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_testimonial_job_role').removeClass('d-none');
            }
            else
            {
                $('.check_edit_testimonial_job_role').addClass('d-none');
            }
        })
    
        $('#edit_testimonial_image').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_testimonial_image').removeClass('d-none');
            }
            else
            {
                $('.check_edit_testimonial_image').addClass('d-none');
            }
        })
    
        $('#edit_testimonial_companywebsite').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_testimonial_companywebsite').removeClass('d-none');
            }
            else
            {
                $('.check_edit_testimonial_companywebsite').addClass('d-none');
            }
        })
    
        $('#edit_testimonial_description').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_testimonial_description').removeClass('d-none');
            }
            else
            {
                $('.check_edit_testimonial_description').addClass('d-none');
            }
        })
    
        //Edit Testimonial
        $('#edit_testimonial_form').on('submit',function(e){
            e.preventDefault();
    
            var edit_testimonial_form_token   = $("#edit_testimonial_form_token").val().trim(); 
            var uid                           = $('.edit_btn').attr('id');
            var name                          = $('#edit_testimonial_name').val().trim();
            var job_role                      = $('#edit_testimonial_job_role').val().trim();
            var image_path                    = document.getElementById('edit_testimonial_image').files[0];
            var companywebsite                = $('#edit_testimonial_companywebsite').val().trim();
            var description                   = $('#edit_testimonial_description').val().trim();
    
            if(name!= '')
            {
                if(job_role!= '')
                {
                    if(companywebsite!= '')
                    {
                        if(description!= '')
                        {
                            var formdata = new FormData();
                            formdata.append('edit_testimonial_form_token'   , edit_testimonial_form_token);
                            formdata.append('uid'                           ,uid);
                            formdata.append('name'                          , name);
                            formdata.append('job_role'                      , job_role);
                            formdata.append('image_path'                    , image_path);
                            formdata.append('companywebsite'                , companywebsite);
                            formdata.append('description'                   , description);
            
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You want to Update testimonial?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) 
                                {
                                    $('#loader').css('display', 'block');

                                    $.ajax({
                                        url: "Easylearn/Configuration_Controller/edit_testimonial_form",
                                        data: formdata,
                                        type: "POST",
                                        contentType: false,
                                        processData: false,
                                        success: function (response) 
                                        {
                                            $('#loader').css('display', 'none');
                                            response = JSON.parse(response);
                                    
                                            if (response["data"] == "TRUE") 
                                            {
                                                Swal.fire({
                                                    icon: "success",
                                                    title: "Updated Successfully!",
                                                    showConfirmButton: false,
                                                    timer: 1500,
                                                }).then((result) => {
                                                    location.reload();
                                                });
                                            } 
                                            else 
                                            {
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Oops...",
                                                    text: response.data,
                                                }).then((result) => {
                                                    //location.reload();
                                                });
                                            }
                                        },
                                        error: function (response) {
                                            $('#loader').css('display', 'none');
                                
                                            Swal.fire({
                                                icon: "error",
                                                title: "Oops...",
                                                text: "Something went wrong!",
                                            }).then((result) => {
                                                location.reload();
                                            });
                                        }
                                    });  
                                }
                            });
                        }
                        else
                        {
                            $('#edit_testimonial_description').focus();
                            $('.check_edit_testimonial_description').removeClass('d-none');
                        }  
                    }
                    else
                    {
                        $('#edit_testimonial_companywebsite').focus();
                        $('.check_edit_testimonial_companywebsite').removeClass('d-none');
                    }
                }
                else
                {
                    $('#edit_testimonial_job_role').focus();
                    $('.check_edit_testimonial_job_role').removeClass('d-none');
                }
            }
            else
            {
                $('#edit_testimonial_name').focus();
                $('.check_edit_testimonial_name').removeClass('d-none');
            }
        });
    
        //delete testimonial
        $('#delete_testimonial').on('click', function(){
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $('#loader').css('display', 'none');

                    $.ajax({
                        url: 'Easylearn/Configuration_Controller/delete_testimonial',
                        data: {
                            id : id
                        },
                        type: 'POST',
                        success: function (response) 
                        {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");
    
                            if(response['data'] == 'TRUE')
                            {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.data,
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        },
                        error: function (response) 
                        {
                            $("#loader").css("display", "none");
    
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    });
                }
            });
        });
    
        $('#testimonial_image').on('change', function(){
            var img = document.getElementById('testimonial_image').files[0];
    
            if(img != null && ValidateImage(img))
            {
                $('.check_testimonial_image').addClass('d-none');
            }
            else
            {
                $('.check_testimonial_image').removeClass('d-none');
            }
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == 'managedocuments')
    {
        $('#document_name').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_document_name').removeClass('d-none');
            }
            else
            {
                $('.check_document_name').addClass('d-none');
            }
        })
    
        $('#document_image').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_document_image').removeClass('d-none');
            }
            else
            {
                $('.check_document_image').addClass('d-none');
            }
        })
    
        $('#document_link').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_document_link').removeClass('d-none');
            }
            else
            {
                $('.check_document_link').addClass('d-none');
            }
        })
    
        //Add Document
        $('#manage_document_form').on('submit',function(e){
    
            e.preventDefault();

            var manage_document_form_token  = $("#manage_document_form_token").val().trim();
            var document_name               = $('#document_name').val().trim();
            var document_image              = document.getElementById('document_image').files[0];
            var document_link               = $('#document_link').val().trim();
    
            if(document_name!= '')
            {
                if(document.getElementById('document_image').files.length >0)
                {
                    if(document_link!= '')
                    {
                        var formdata = new FormData();
                        formdata.append('manage_document_form_token'  , manage_document_form_token);
                        formdata.append('document_name'               , document_name);
                        formdata.append('document_image'              , document_image);
                        formdata.append('document_link'               , document_link);
                                        
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You want to Add Document?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            if (result.isConfirmed) 
                            {
                                $('#loader').css('display', 'block');

                                $.ajax({
                                    url: "Easylearn/Configuration_Controller/manage_document_form",
                                    data: formdata,
                                    type: "POST",
                                    contentType: false,
                                    processData: false,
                                    success: function (response) 
                                    {
                                        $('#loader').css('display', 'none');
                                        response = JSON.parse(response);
                                
                                        if (response["data"] == "TRUE") 
                                        {
                                            Swal.fire({
                                                icon: "success",
                                                title: "Added Successfully!",
                                                showConfirmButton: false,
                                                timer: 1500,
                                            }).then((result) => {
                                                location.reload();
                                            });
                                        } 
                                        else 
                                        {
                                            Swal.fire({
                                                icon: "error",
                                                title: "Oops...",
                                                text: response.data,
                                            }).then((result) => {
                                                //location.reload();
                                            });
                                        }
                                    },
                                    error: function (response) {
                                        $('#loader').css('display', 'block');

                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "Something went wrong!",
                                        }).then((result) => {
                                            //location.reload();
                                        });
                                    },
                                });  
                            }
                        });       
                    }
                    else
                    {
                        $('#document_link').focus();
                        $('.check_document_link').removeClass('d-none');
                    }
                }
                else
                {
                    $('#document_image').focus();
                    $('.check_document_image').removeClass('d-none');
                }    
            }
            else
            {    
                $('#document_name').focus();
                $('.check_document_name').removeClass('d-none');
            }          
        });
    
        //Get All Document
        $("#document_list").DataTable({
            
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            select: true,
            rowReorder: true,
            columnDefs: [
                { orderable: true, className: "reorder", targets: "_all" },
            ],
            ajax: {
                url: "Easylearn/Configuration_Controller/get_document",
                type: "POST",
                dataSrc: function (json) {
                    if (json.data == 'False') 
                    {
                        return {}
                    } 
                    else 
                    {
                        return json.data;
                    }
                },
            },
            rowId: "unique_id",
            columns: [
                { 
                    data: "unique_id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                { data: "document_name" },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<img class="img img-responsive" style="width: 150px; height: auto;" src="${row.document_image}">`;
                    },
                },
                { data: "document_link" },
            ]
        });
    
        //get Document by ID
        $('#document_list tbody').on('dblclick', 'tr', function () {
            
            var id= $(this).attr('id');

            $.ajax({
                url: "Easylearn/Configuration_Controller/get_document_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) {
                    response = JSON.parse(response);
                    $('#edit_document_name').val(response.data.document_name);
                    $('#edit_document_link').val(response.data.document_link);
                    $('.edit_btn').attr('id',id);
                    $('#delete_document').attr('data-id',id);
                    $('#edit_document_modal').modal('show');
                },
                error: function (response) 
                {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        //location.reload();
                    });
                }
            });
        });
    
        $("#add_document_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
            $('.check_document_name').addClass('d-none');
            $('.check_document_link').addClass('d-none');
        });
    
        $("#edit_document_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
            $('.check_edit_document_name').addClass('d-none');
            $('.check_edit_document_link').addClass('d-none');
        });
    
        $('#edit_document_name').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_document_name').removeClass('d-none');
            }
            else
            {
                $('.check_edit_document_name').addClass('d-none');
            }
        });
    
        $('#edit_document_image').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_document_image').removeClass('d-none');
            }
            else
            {
                $('.check_edit_document_image').addClass('d-none');
            }
        });
    
        $('#edit_document_link').on('keyup', function(){
            if($(this).val().trim() == '')
            {
                $('.check_edit_document_link').removeClass('d-none');
            }
            else
            {
                $('.check_edit_document_link').addClass('d-none');
            }
        });
    
        //Edit Document
        $('#edit_document_form').on('submit',function(e){
            e.preventDefault();
    
            var edit_document_form_token   = $("#edit_document_form_token").val().trim(); 
            var uid                        = $('.edit_btn').attr('id');
            var document_name              = $('#edit_document_name').val().trim();
            var document_image             = document.getElementById('edit_document_image').files[0];
            var document_link              = $('#edit_document_link').val().trim();

            var formdata = new FormData();
    
            if(document!= '')
            {
                if(document_link!= '')
                {
                    formdata.append('edit_document_form_token'   , edit_document_form_token);
                    formdata.append('uid'                        ,uid);
                    formdata.append('document_name'              , document_name);
                    formdata.append('document_image'             , document_image);
                    formdata.append('document_link'              , document_link);
                                
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to Update Document?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) 
                        {
                            $('#loader').css('display', 'block');

                            $.ajax({
                                url: "Easylearn/Configuration_Controller/edit_document_form",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) 
                                {
                                    $('#loader').css('display', 'none');
                                    response = JSON.parse(response);
                            
                                    if (response["data"] == "TRUE") 
                                    {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Updated Successfully!",
                                            showConfirmButton: false,
                                            timer: 1500,
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    } 
                                    else 
                                    {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: response.data,
                                        }).then((result) => {
                                            //location.reload();
                                        });
                                    }
                                },
                                error: function (response) 
                                {
                                    $('#loader').css('display', 'none');
                        
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                    }).then((result) => {
                                        //location.reload();
                                    });
                                }
                            });  
                        }
                    });
                }
                else
                {        
                    $('#edit_document_link').focus();   
                    $('.check_edit_document_link').removeClass('d-none');
                }
            }
            else
            {     
                $('#edit_document_name').focus();
                $('.check_edit_document_name').removeClass('d-none');
            }
        });
    
        //Delete Document
        $('#delete_document').on('click', function(){
            var id = $(this).attr('data-id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Configuration_Controller/delete_document',
                        data: {
                            id : id
                        },
                        type: 'POST',
                        success: function (response) 
                        {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");
        
                            if(response['data'] == 'TRUE')
                            {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.data,
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        },
                        error: function (response) 
                        {
                            $("#loader").css("display", "none");
    
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    });
                }
            });
        });
    
        $('#document_image').on('change', function(){
            var img = document.getElementById('document_image').files[0];
    
            if(img != null && ValidateImage(img))
            {
                $('.check_document_image').addClass('d-none');
            }
            else
            {
                $('.check_document_image').removeClass('d-none');
            }
        });
    }
});