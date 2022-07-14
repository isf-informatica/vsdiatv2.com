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

    function convertstrtodate(str) 
    {
        var date = new Date(str),
            mnth = ("0" + (date.getMonth() + 1)).slice(-2),
            day = ("0" + date.getDate()).slice(-2);

        return [date.getFullYear(), mnth, day].join("-");
    }

    if (location.pathname.split("/").slice(-1)[0] == "manageadmin") 
    {
        var phoneno = $("#admin_phone").intlTelInput({
            autoPlaceholder: true,
        });

        $("#admin_dob").datepicker({
            format: 'dd-mm-yyyy',
            endDate: '-18y',
            orientation: "bottom right",
        }).on('change', function () {

            var dob = $("#admin_dob").datepicker('getDate');
            if (dob != null) 
            {
                $('.check_admin_dob').addClass('d-none');

            } 
            else 
            {
                $('.check_admin_dob').removeClass('d-none');
            }
        });

        //Get All Countries
        $.ajax({
            url: "https://countriesnow.space/api/v0.1/countries/capital",
            type: "GET",
            headers: {
                "Accept": "application/json"
            },
            success: function (response) 
            {
                response = JSON.parse(JSON.stringify(response));

                response.data.forEach(function (Index, i) {
                    $('#region_country').append("<option value='" + response.data[i].name + "'> " + response.data[i].name + "(" + response.data[i].iso3 + ") </option>");
                    $('#edit_region_country').append("<option value='" + response.data[i].name + "'> " + response.data[i].name + "(" + response.data[i].iso3 + ") </option>");
                });
            },
            error: function (response) 
            {
                console.log(response);
            }
        });

        //Get First Country States
        $.ajax({
            url: "https://countriesnow.space/api/v0.1/countries/states",
            type: "POST",
            data: JSON.stringify({
                country: 'Afghanistan'
            }),
            headers: {
                "Content-Type": "application/json",
            },
            success: function (response) 
            {
                response = JSON.parse(JSON.stringify(response));

                response.data.states.forEach(function (Index, i) {
                    $('#region_state').append("<option value='" + response.data.states[i].name + "'> " + response.data.states[i].name + "(" + response.data.states[i].state_code + ") </option>");
                });
            },
            error: function (response) 
            {
                console.log(response);
            }
        });

        //Get First Cities of States
        $.ajax({
            url: "https://countriesnow.space/api/v0.1/countries/state/cities",
            type: "POST",
            data: JSON.stringify({
                country: 'Afghanistan',
                state: 'Badakhshan'
            }),
            headers: {
                "Content-Type": "application/json",
            },
            success: function (response) 
            {
                response = JSON.parse(JSON.stringify(response));

                response.data.forEach(function (Index, i) {
                    $('#region_city').append("<option value='" + response.data[i] + "'> " + response.data[i] + " </option>");
                });
            },
            error: function (response) 
            {
                console.log(response);
            }
        });

        //Get States from country
        $('#region_country').on('change', function () {

            $('#loader').css('display', 'block');
            var country = $(this).val();

            $.ajax({
                url: "https://countriesnow.space/api/v0.1/countries/states",
                type: "POST",
                data: JSON.stringify({
                    country: country
                }),
                headers: {
                    "Content-Type": "application/json",
                },
                success: function (response) {
                    $('#region_state').empty();
                    $('#region_city').empty();
                    response = JSON.parse(JSON.stringify(response));

                    response.data.states.forEach(function (Index, i) {
                        $('#region_state').append("<option value='" + response.data.states[i].name + "'> " + response.data.states[i].name + "(" + response.data.states[i].state_code + ") </option>");
                    });

                    $('#loader').css('display', 'none');
                },
                error: function (response) 
                {
                    $('#loader').css('display', 'none');
                    console.log(response);
                }
            });
        });

        //Get Cities from States
        $('#region_state').on('change', function () {

            $('#loader').css('display', 'block');

            var country = $('#region_country').val();
            var state = $(this).val();

            $.ajax({
                url: "https://countriesnow.space/api/v0.1/countries/state/cities",
                type: "POST",
                data: JSON.stringify({
                    country: country,
                    state: state
                }),
                headers: {
                    "Content-Type": "application/json",
                },
                success: function (response) {
                    $('#region_city').empty();
                    response = JSON.parse(JSON.stringify(response));

                    response.data.forEach(function (Index, i) {
                        $('#region_city').append("<option value='" + response.data[i] + "'> " + response.data[i] + " </option>");
                    });

                    $('#loader').css('display', 'none');
                },
                error: function (response) 
                {
                    $('#loader').css('display', 'none');
                    console.log(response);
                }
            });
        });

        $('#admin_name').on('keyup', function () {

            if (($(this).val().trim() != '')) 
            {
                $('.check_admin_name').addClass('d-none');
            } 
            else 
            {
                $('.check_admin_name').removeClass('d-none');
            }

        });

        $('input[name=admin_gender]').on('click', function () {

            if ($(this).val().trim() == '') 
            {
                $('.check_admin_gender').removeClass('d-none');
            } 
            else 
            {
                $('.check_admin_gender').addClass('d-none');
            }
        });

        $('#admin_email').on('keyup', function () {

            if (validateEmail($(this).val().trim())) 
            {
                $('.check_admin_email').addClass('d-none');
            } 
            else 
            {
                $('.check_admin_email').removeClass('d-none');
            }
        });

        $('#admin_password').on('keyup', function () {

            if (ValidatePassword($(this).val().trim())) 
            {
                $('.check_admin_password').removeClass('d-none');
            } 
            else 
            {
                $('.check_admin_password').addClass('d-none');
            }
        });

        $('#admin_image').on('change', function(){

            var file = document.getElementById('admin_image').files[0];

            if(file == null)
            {
                $('.check_admin_image').removeClass('d-none');
            }
            else
            {
                if(ValidateImage(file))
                {
                    $('.check_admin_image').addClass('d-none');
                }
                else
                {
                    $('.check_admin_image').removeClass('d-none');
                } 
            }

        });

        $('#admin_document').on('change', function(){
            var file = document.getElementById('admin_document').files[0];

            if(file == null)
            {
                $('.check_admin_document').removeClass('d-none');
            }
            else
            {
                if(ValidateDocument(file))
                {
                    $('.check_admin_document').addClass('d-none');
                }
                else
                {
                    $('.check_admin_document').removeClass('d-none');
                } 
            }
        });

        $('#admin_phone').on('keyup', function () {

            if ($(this).intlTelInput('isValidNumber')) 
            {
                $('.check_admin_phone').addClass('d-none');
            } 
            else 
            {
                $('.check_admin_phone').removeClass('d-none');
            }
        });

        $("#add_admin_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
        });

        $(".close").on("click", function () {
            $(this).find('form').trigger('reset');
            $('.check_admin_name').addClass('d-none');
            $('.check_admin_phone').addClass('d-none');
            $('.check_admin_dob').addClass('d-none');
            $('.check_admin_gender').addClass('d-none');
            $('.check_admin_email').addClass('d-none');
            $('.check_admin_password').addClass('d-none');
            $('.check_admin_image').addClass('d-none');
            $('.check_admin_document').addClass('d-none');
        });

        //Add admin
        $('#manage_admin_form').on('submit', function (e) {

            e.preventDefault();

            var manage_admin_form_token = $("#manage_admin_form_token").val().trim();
            var name                    = $('#admin_name').val().trim();
            var phone                   = $('#admin_phone').intlTelInput("getNumber");
            var dob                     = convertstrtodate($('#admin_dob').datepicker('getDate'));
            var gender                  = $("input[name=admin_gender]:checked").val().trim();
            var email_id                = $('#admin_email').val().trim();
            var password                = $('#admin_password').val().trim();
            var image                   = document.getElementById('admin_image').files[0];
            var doc                     = document.getElementById('admin_document').files[0];
            var region_type             = $('#region_type').val().trim();
            var region_country          = $('#region_country').val().trim();
            var region_state            = $('#region_state').val().trim();
            var region_city             = $('#region_city').val().trim();
            var description             = $('#admin_description').val().trim();

            var formdata = new FormData();

            if (document.getElementById('admin_image').files.length > 0) 
            {
                if (ValidateImage(image)) 
                {
                    formdata.append('admin_image', image);
                }
            }

            if (document.getElementById('admin_document').files.length > 0) 
            {
                if (ValidateDocument(doc)) 
                {
                    formdata.append('admin_document', doc);
                } 
            }

            if (name != '') 
            {
                if ($('#admin_phone').intlTelInput("isValidNumber")) 
                {
                    if (dob != '' && dob != '1970-01-01' && dob != null) 
                    {
                        if (gender != '' && gender != undefined) 
                        {
                            if (validateEmail(email_id)) 
                            {
                                if (ValidatePassword(password, password)) 
                                {
                                    if (document.getElementById('admin_image').files.length > 0) 
                                    {
                                        if (document.getElementById('admin_document').files.length > 0) 
                                        {
                                            formdata.append('manage_admin_form_token' , manage_admin_form_token);
                                            formdata.append('name'                    , name);
                                            formdata.append('phone'                   , phone);
                                            formdata.append('dob'                     , dob);
                                            formdata.append('gender'                  , gender);
                                            formdata.append('email_id'                , email_id);
                                            formdata.append('password'                , password);
                                            formdata.append('image'                   , image);
                                            formdata.append('document'                , doc);
                                            formdata.append('region_type'             , region_type);
                                            formdata.append('region_country'          , region_country);
                                            formdata.append('region_state'            , region_state);
                                            formdata.append('region_city'             , region_city);
                                            formdata.append('description'             , description);

                                            Swal.fire({
                                                title: 'Are you sure?',
                                                text: "You want to Add Admin?",
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
                                                        url: "Easylearn/Admin_Controller/manage_admin_form",
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
                                            $('#admin_document').focus();
                                            $('.check_admin_document').removeClass('d-none');
                                        }
                                    } 
                                    else 
                                    {
                                        $('#admin_image').focus();
                                        $('.check_admin_image').removeClass('d-none');
                                    }
                                } 
                                else 
                                {
                                    $('#admin_password').focus();
                                    $('.check_admin_password').removeClass('d-none');
                                }
                            } 
                            else 
                            {
                                $('#admin_email').focus();
                                $('.check_admin_email').removeClass('d-none');
                            }
                        } 
                        else 
                        {
                            $('#admin_gender').focus();
                            $('.check_admin_gender').removeClass('d-none');
                        }
                    } 
                    else 
                    {
                        $('#admin_dob').focus();
                        $('.check_admin_dob').removeClass('d-none');
                    }
                } 
                else 
                {
                    $('#admin_phone').focus();
                    $('.check_admin_phone').removeClass('d-none');
                }
            } 
            else 
            {
                $('#admin_name').focus();
                $('.check_admin_name').removeClass('d-none');
            }
        });

        //Get All Admin
        $("#admin_list").DataTable({
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
                url: "Easylearn/Admin_Controller/get_all_admin",
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
                    data: "name"
                },
                {
                    data: "email_id"
                },
                {
                    data: "region_type"
                },
                {
                    data: "region_country"
                },
                {
                    data: "region_state"
                },
                {
                    data: "region_city"
                },
            ]
        });

        //Get States from country
        $('#edit_region_country').on('change', function () {

            var country = $(this).val();

            $.ajax({
                url: "https://countriesnow.space/api/v0.1/countries/states",
                type: "POST",
                data: JSON.stringify({
                    country: country
                }),
                headers: {
                    "Content-Type": "application/json",
                },
                success: function (response) {
                    $('#edit_region_state').empty();
                    $('#edit_region_city').empty();
                    response = JSON.parse(JSON.stringify(response));

                    response.data.states.forEach(function (Index, i) {
                        $('#edit_region_state').append("<option value='" + response.data.states[i].name + "'> " + response.data.states[i].name + "(" + response.data.states[i].state_code + ") </option>");
                    });
                },
                error: function (response) 
                {
                    console.log(response);
                }
            });
        });
        
        //Get Cities from States
        $('#edit_region_state').on('change', function () {

            var country = $('#edit_region_country').val();
            var state = $(this).val();

            $.ajax({
                url: "https://countriesnow.space/api/v0.1/countries/state/cities",
                type: "POST",
                data: JSON.stringify({
                    country: country,
                    state: state
                }),
                headers: {
                    "Content-Type": "application/json",
                },
                success: function (response) {
                    $('#edit_region_city').empty();
                    response = JSON.parse(JSON.stringify(response));

                    response.data.forEach(function (Index, i) {
                        $('#edit_region_city').append("<option value='" + response.data[i] + "'> " + response.data[i] + " </option>");
                    });
                },
                error: function (response) 
                {
                    console.log(response);
                }
            });
        });

        $('#admin_list tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');
            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Admin_Controller/get_admin_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) 
                {
                    $('#loader').css('display', 'none');
                    response = JSON.parse(response);

                    $('#edit_admin_phone').intlTelInput('destroy');

                    $('.admin_image').attr('src', response.data.image);
                    $('.admin_name').html(response.data.name);
                    $('.admin_phone').html(response.data.phone);
                    $('.admin_gender').html(response.data.gender);
                    $('.admin_dob').html(response.data.dob);
                    $('.admin_email').html(response.data.email_id);
                    $('.admin_descp').html(response.data.description);
                    $('.region_type').html(response.data.region_type);
                    $('.region_country').html(response.data.region_country);
                    $('.region_state').html(response.data.region_state);
                    $('.region_city').html(response.data.region_city);

                    $('#view_admin_modal').modal('show');
                    $('.edit-admin').attr('data-id', response.data.unique_id);

                    $('#edit_admin_name').val(response.data.name);
                    $('#edit_admin_phone').val(response.data.phone);
                    $('#edit_region_type').val(response.data.region_type);
                    $('#edit_region_country').val(response.data.region_country);
                    $('#edit_admin_description').val(response.data.description);

                    $("#edit_admin_phone").intlTelInput({
                        autoPlaceholder: true,
                    });

                    $.ajax({
                        url: "https://countriesnow.space/api/v0.1/countries/states",
                        type: "POST",
                        data: JSON.stringify({
                            country: response.data.region_country
                        }),
                        headers: {
                            "Content-Type": "application/json",
                        },
                        success: function (response) {
                            $('#edit_region_state').empty();
                            $('#edit_region_city').empty();
                            response = JSON.parse(JSON.stringify(response));
        
                            response.data.states.forEach(function (Index, i) {
                                $('#edit_region_state').append("<option value='" + response.data.states[i].name + "'> " + response.data.states[i].name + "(" + response.data.states[i].state_code + ") </option>");
                            });
                        },
                        error: function (response) 
                        {
                            console.log(response);
                        }
                    });

                    setTimeout( function() { $('#edit_region_state').val(response.data.region_state); }, 3000);

                    $.ajax({
                        url: "https://countriesnow.space/api/v0.1/countries/state/cities",
                        type: "POST",
                        data: JSON.stringify({
                            country: response.data.region_country,
                            state: response.data.region_state
                        }),
                        headers: {
                            "Content-Type": "application/json",
                        },
                        success: function (response) {
                            $('#edit_region_city').empty();
                            response = JSON.parse(JSON.stringify(response));
        
                            response.data.forEach(function (Index, i) {
                                $('#edit_region_city').append("<option value='" + response.data[i] + "'> " + response.data[i] + " </option>");
                            });
                        },
                        error: function (response) 
                        {
                            console.log(response);
                        }
                    });

                    setTimeout( function() { $('#edit_region_city').val(response.data.region_city); }, 6000);
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

        $('.edit-admin').on('click', function(){
            $('#view_admin_modal').modal('hide');
            $('#edit_admin_modal').modal('show');
        }); 

        $('#edit_admin_name').on('keyup', function () {

            if (($(this).val().trim() != '')) 
            {
                $('.check_edit_admin_name').addClass('d-none');
            } 
            else 
            {
                $('.check_edit_admin_name').removeClass('d-none');
            }

        });

        $('#edit_admin_phone').on('keyup', function () {

            if ($(this).intlTelInput('isValidNumber')) 
            {
                $('.check_edit_admin_phone').addClass('d-none');
            } 
            else 
            {
                $('.check_edit_admin_phone').removeClass('d-none');
            }
        });

        $('#edit_admin_image').on('change', function(){

            var file = document.getElementById('edit_admin_image').files[0];

            if(file == null)
            {
                $('.check_edit_admin_image').addClass('d-none');
            }
            else
            {
                if(ValidateImage(file))
                {
                    $('.check_edit_admin_image').addClass('d-none');
                }
                else
                {
                    $('.check_edit_admin_image').removeClass('d-none');
                } 
            }

        });

        //Edit Admin
        $('#edit_admin_form').on('submit', function (e) {

            e.preventDefault();

            var edit_admin_form_token   = $("#edit_admin_form_token").val().trim();
            var id                      = $('.edit-admin').attr('data-id');
            var name                    = $('#edit_admin_name').val().trim();
            var phone                   = $('#edit_admin_phone').intlTelInput("getNumber");
            var image                   = document.getElementById('edit_admin_image').files[0];
            var region_type             = $('#edit_region_type').val().trim();
            var region_country          = $('#edit_region_country').val().trim();
            var region_state            = $('#edit_region_state').val().trim();
            var region_city             = $('#edit_region_city').val().trim();
            var description             = $('#edit_admin_description').val().trim();

            var formdata = new FormData();

            if (document.getElementById('edit_admin_image').files.length > 0) 
            {
                if (ValidateImage(image)) 
                {
                    formdata.append('image', image);
                }
            }

            if (name != '') 
            {
                if ($('#edit_admin_phone').intlTelInput("isValidNumber")) 
                {
                    if (region_type != '') 
                    {
                        if (region_country != '') 
                        {
                            if (region_state != '') 
                            {
                                if (region_city != '') 
                                {

                                    formdata.append('edit_admin_form_token'   , edit_admin_form_token);
                                    formdata.append('id'                      , id);
                                    formdata.append('name'                    , name);
                                    formdata.append('phone'                   , phone);
                                    formdata.append('region_type'             , region_type);
                                    formdata.append('region_country'          , region_country);
                                    formdata.append('region_state'            , region_state);
                                    formdata.append('region_city'             , region_city);
                                    formdata.append('description'             , description);

                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: "You want to Edit Admin?",
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
                                                url: "Easylearn/Admin_Controller/edit_admin_form",
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
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Select region city",
                                    });
                                }
                            } 
                            else 
                            {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Select region state",
                                });
                            }
                        } 
                        else 
                        {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Select region country",
                            });
                        }
                    } 
                    else 
                    {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Select region type",
                        });
                    }
                } 
                else 
                {
                    $('#edit_admin_phone').focus();
                    $('.check_edit_admin_phone').removeClass('d-none');
                }
            } 
            else 
            {
                $('#edit_admin_name').focus();
                $('.check_edit_admin_name').removeClass('d-none');
            }
        });

        //Delete Admin
        $('#delete_admin').on('click', function(){

            var id = $('.edit-admin').attr('data-id');

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
                        url: 'Easylearn/Admin_Controller/delete_admin',
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
});