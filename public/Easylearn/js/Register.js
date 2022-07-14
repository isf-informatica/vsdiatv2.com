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

        if(file){
            var fileType = file["type"];
            var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
    
            return validImageTypes.includes(fileType);
        }else{
            return false;
        }

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

    function convertstrtodate(str) 
    {
        var date = new Date(str),
            mnth = ("0" + (date.getMonth() + 1)).slice(-2),
            day = ("0" + date.getDate()).slice(-2);

        return [date.getFullYear(), mnth, day].join("-");
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

    function get_user_time() {
        var currentdate = new Date();
        var datetime =
            currentdate.getFullYear() +
            "/" +
            (currentdate.getMonth() + 1) +
            "/" +
            currentdate.getDate() +
            " " +
            currentdate.getHours() +
            ":" +
            currentdate.getMinutes() +
            ":" +
            currentdate.getSeconds();

        return datetime;
    }

    if (location.pathname.split("/").slice(-1)[0] == "login") {
        //Login
        $("#login_form").on("submit", function (event) {
            var captcha = $('#captcha').val().trim();

            if (captcha == 1) {
                grecaptcha.ready(function () {
                    grecaptcha
                        .execute("6LeTr3MeAAAAABZ8Bv4UlIEPnntleUGtD0IKKCoJ", {
                            action: "submit",
                        })
                        .then(function (captcha_token) {
                            var login_token = $("#login_token").val().trim();
                            var login_email = $("#login_email").val().trim();
                            var login_password = $("#login_password").val().trim();

                            if (validateEmail(login_email) && ValidatePassword(login_password, login_password)) {
                                $(".loader").removeClass("d-none");

                                formdata = new FormData();
                                formdata.append("login_token", login_token);
                                formdata.append("login_email", login_email);
                                formdata.append("login_password", login_password);
                                formdata.append("captcha", captcha);
                                formdata.append("captcha_token_v3", captcha_token);
                                formdata.append("captcha_token_v2", grecaptcha.getResponse());

                                $.ajax({
                                    url: "Easylearn/Register_Controller/login_user",
                                    data: formdata,
                                    type: "POST",
                                    contentType: false,
                                    processData: false,
                                    success: function (response) {
                                        var response = JSON.parse(response);
                                        $(".loader").addClass("d-none");

                                        if (response["data"] == "TRUE") {
                                            Swal.fire({
                                                icon: "success",
                                                title: "Login Successful",
                                                showConfirmButton: false,
                                                timer: 1500,
                                            }).then((result) => {
                                                location.href = "dashboard";
                                            });
                                        } else if (response["data"] == "MFA") {
                                            $('.login-box').slideUp();
                                            $('.otp-box').slideDown();
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
                                        $(".loader").addClass("d-none");

                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "Something went wrong!",
                                        }).then((result) => {
                                            //location.reload();
                                        });
                                    },
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Entered Details are wrong!",
                                });
                            }
                        });
                });
            } else {
                var login_token = $("#login_token").val().trim();
                var login_email = $("#login_email").val().trim();
                var login_password = $("#login_password").val().trim();

                if (validateEmail(login_email) && ValidatePassword(login_password, login_password)) {
                    $(".loader").removeClass("d-none");

                    formdata = new FormData();
                    formdata.append("login_token", login_token);
                    formdata.append("login_email", login_email);
                    formdata.append("login_password", login_password);
                    formdata.append("captcha", captcha);

                    $.ajax({
                        url: "Easylearn/Register_Controller/login_user",
                        data: formdata,
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            var response = JSON.parse(response);
                            $(".loader").addClass("d-none");

                            if (response["data"] == "TRUE") {
                                Swal.fire({
                                    icon: "success",
                                    title: "Login Successful",
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then((result) => {
                                    location.href = "dashboard";
                                });
                            } else if (response["data"] == "MFA") {
                                $('.login-box').slideUp();
                                $('.otp-box').slideDown();
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
                            $(".loader").addClass("d-none");

                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something went wrong!",
                            }).then((result) => {
                                //location.reload();
                            });
                        },
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Entered Details are wrong!",
                    });
                }
            }
            event.preventDefault();
        });

        //OTP Form
        $('#otp_form').on('submit', function (e) {

            $(".loader").removeClass('d-none');

            $.ajax({
                url: "Easylearn/Register_Controller/validate_qr",
                data: {
                    otp: $(".otp").val().trim(),
                },
                type: "POST",
                success: function (response) {
                    $(".loader").addClass('d-none');
                    response = JSON.parse(response);

                    if (response["data"] == "TRUE") {
                        Swal.fire({
                            icon: "success",
                            title: "Login Successful",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then((result) => {
                            location.href = "dashboard";
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
                    $(".preloader").fadeOut();

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        //location.reload();
                    });
                },
            });
            e.preventDefault();
        });

        //Forgot
        $('#forgetpwd').on('click', function () {
            $('.login-box').slideUp();
            $('.forget-box').slideDown();
        });

        //Forgot Email form
        $('#forgot_form').on('submit', function (e) {
            $(".loader").removeClass('d-none');
            var email = $("#forgot_email").val().trim();

            if (validateEmail(email)) {
                $.ajax({
                    url: "Easylearn/Register_Controller/forget_email_send_otp",
                    data: {
                        email: email,
                    },
                    type: "POST",
                    success: function (response) {
                        $(".loader").addClass('d-none');
                        response = JSON.parse(response);

                        if (response["data"] == "TRUE") {
                            $('.forget-box').slideUp();
                            $('.forgot-otp-box').slideDown();
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Email Id Does not Exist",
                                text: "Try again",
                            }).then((result) => {
                                //location.reload();
                            });
                        }
                    },
                    error: function (response) {
                        $(".loader").addClass('d-none');

                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        }).then((result) => {
                            //location.reload();
                        });
                    },
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Invalid Email Id",
                    text: "Try again",
                }).then((result) => {
                    //location.reload();
                });
            }
            e.preventDefault();
        });

        //Resend otp form
        $('#resendotp').on('click', function (e) {
            $(".loader").removeClass('d-none');

            $.ajax({
                url: "Easylearn/Register_Controller/forget_email_send_otp",
                data: {
                    email: $("#forgot_email").val().trim(),
                },
                type: "POST",
                success: function (response) {
                    $(".loader").addClass('d-none');
                    response = JSON.parse(response);

                    if (response["data"] == "TRUE") {
                        $('.forget-box').slideUp();
                        $('.forgot-otp-box').slideDown();

                        Swal.fire({
                            icon: 'success',
                            title: 'OTP Sent',
                            text: 'OTP Sent Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            //location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Email Id',
                            text: 'Try again',
                        }).then((result) => {
                            //location.reload();
                        });
                    }
                },
                error: function (response) {
                    $(".loader").addClass('d-none');

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    }).then((result) => {
                        //location.reload();
                    });
                },
            });
            e.preventDefault();
        });

        //Forgot OTP Form
        $('#forget_otp_form').on('submit', function (e) {
            $(".loader").removeClass('d-none');

            $.ajax({
                url: "Easylearn/Register_Controller/check_otp",
                data: {
                    otp: $("#forgot_otp").val().trim(),
                },
                type: "POST",
                success: function (response) {
                    $(".loader").addClass('d-none');
                    response = JSON.parse(response);

                    if (response['data'] != 'FALSE') {
                        $('.forgot-otp-box').slideUp();
                        $('.new_pwd-box').slideDown();
                        $('.frgt_email').text(response["data"]);

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid OTP',
                            text: 'Try again',
                        }).then((result) => {
                            //location.reload();
                        });
                    }
                },
                error: function (response) {
                    $(".loader").addClass('d-none');

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        //location.reload();
                    });
                },
            });
            e.preventDefault();
        });

        //New password Form
        $('#new_pwd_form').on('submit', function (e) {
            var email = $('.frgt_email').text().trim();
            var pwd = $("#new_pwd").val().trim();
            var edit_new_pwd_token = $('#edit_new_pwd_token').val().trim();
            var password = $("#new_pwd").val().trim();
            var confirm = $("#conf_pwd").val().trim();

            if (ValidatePassword(password, confirm)) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to change your password!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Do it!'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $(".loader").removeClass('d-none');

                        $.ajax({
                            url: 'Easylearn/Register_Controller/new_pwd_form',
                            data: {
                                edit_new_pwd_token: edit_new_pwd_token,
                                email: email,
                                pass: pwd
                            },
                            type: 'POST',
                            success: function (response) {
                                var response = JSON.parse(response);
                                $(".loader").addClass('d-none');

                                if (response['data'] == 'TRUE') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Successfully Changed Password',
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
                                $(".loader").addClass('d-none');

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
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })
            }

            e.preventDefault();
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == "signup") {
        var phoneno = $("#school_contactnumber1, #school_contactnumber2").intlTelInput({
            autoPlaceholder: true,
        });

        //Get All Countries
        $.ajax({
            url: "https://countriesnow.space/api/v0.1/countries/capital",
            type: "GET",
            headers: {
                "Accept": "application/json"
            },
            success: function (response) {
                response = JSON.parse(JSON.stringify(response));

                response.data.forEach(function (Index, i) {
                    $('#school_country').append("<option value='" + response.data[i].name + "'> " + response.data[i].name + "(" + response.data[i].iso3 + ") </option>");
                    $('#jr_college_country').append("<option value='" + response.data[i].name + "'> " + response.data[i].name + "(" + response.data[i].iso3 + ") </option>");
                    $('#mentor_country').append("<option value='" + response.data[i].name + "'> " + response.data[i].name + "(" + response.data[i].iso3 + ") </option>");
                });
            },
            error: function (response) {
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
            success: function (response) {
                response = JSON.parse(JSON.stringify(response));

                response.data.states.forEach(function (Index, i) {
                    $('#school_state').append("<option value='" + response.data.states[i].name + "'> " + response.data.states[i].name + "(" + response.data.states[i].state_code + ") </option>");
                    $('#jr_college_state').append("<option value='" + response.data.states[i].name + "'> " + response.data.states[i].name + "(" + response.data.states[i].state_code + ") </option>");
                    $('#mentor_state').append("<option value='" + response.data.states[i].name + "'> " + response.data.states[i].name + "(" + response.data.states[i].state_code + ") </option>");
                });
            },
            error: function (response) {
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
            success: function (response) {
                response = JSON.parse(JSON.stringify(response));

                response.data.forEach(function (Index, i) {
                    $('#school_city').append("<option value='" + response.data[i] + "'> " + response.data[i] + " </option>");
                    $('#jr_college_city').append("<option value='" + response.data[i] + "'> " + response.data[i] + " </option>");
                    $('#mentor_city').append("<option value='" + response.data[i] + "'> " + response.data[i] + " </option>");
                });
            },
            error: function (response) {
                console.log(response);
            }
        });

        $('#school_name').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check_institute_name').removeClass('d-none');
            } 
            else 
            {
                $('.check_institute_name').addClass('d-none');
            }
        });

        $('#school_code').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check_school_code').removeClass('d-none');
            } 
            else 
            {
                $('.check_school_code').addClass('d-none');
            }
        });

        $('#school_logo').on('change', function () {
            if (document.getElementById('school_logo').files.length > 0 && ValidateImage(document.getElementById('school_logo').files[0])) 
            {
                $('.check_school_logo').addClass('d-none');
            } 
            else 
            {
                $('.check_school_logo').removeClass('d-none');
            }
        });

        $('#school_image').on('change', function () 
        {
            if (document.getElementById('school_image').files.length > 0 && ValidateImage(document.getElementById('school_image').files[0])) 
            {
                $('.check_school_image').addClass('d-none');
            } 
            else 
            {
                $('.check_school_image').removeClass('d-none');
            }
        });

        $('#school_contactnumber1').on('keyup', function () {
            if ($('#school_contactnumber1').intlTelInput("isValidNumber")) 
            {
                $('.check_school_contactnumber1').addClass('d-none');
            } 
            else 
            {
                $('.check_school_contactnumber1').removeClass('d-none');
            }
        });

        $('#school_contactnumber2').on('keyup', function () {
            if ($('#school_contactnumber2').intlTelInput("isValidNumber")) 
            {
                $('.check_school_contactnumber2').addClass('d-none');
            } 
            else
            {
                $('.check_school_contactnumber2').removeClass('d-none');
            }
        });

        $('#school_administratorname').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check_school_administratorname').removeClass('d-none');
            } 
            else 
            {
                $('.check_school_administratorname').addClass('d-none');
            }
        });

        $('#school_administratoremail').on('keyup', function () {
            if (validateEmail($(this).val())) 
            {
                $('.check_school_administratoremail').addClass('d-none');
            } 
            else 
            {
                $('.check_school_administratoremail').removeClass('d-none');
            }
        });

        $('#school_password').on('keyup', function () {
            if (ValidatePassword($(this).val().trim(), $(this).val().trim())) 
            {
                $('.check_school_password').addClass('d-none');

                if ( ValidatePassword($('#school_password').val().trim(), $('#school_confirmpassword').val().trim())) 
                {
                    $('.check_school_confirmpassword').addClass('d-none');
                } 
                else 
                {
                    $('.check_school_confirmpassword').removeClass('d-none');
                }
            } 
            else
            {
                $('.check_school_password').removeClass('d-none');
            }
        });

        $('#school_confirmpassword').on('keyup', function () {
            if ( ValidatePassword($('#school_password').val().trim(), $(this).val().trim())) 
            {
                $('.check_school_confirmpassword').addClass('d-none');
            } 
            else 
            {
                $('.check_school_confirmpassword').removeClass('d-none');
            }
        });

        $('#school_addressline1').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check_school_addressline1').removeClass('d-none');
            } 
            else 
            {
                $('.check_school_addressline1').addClass('d-none');
            }
        });

        $('#school_addressline2').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check_school_addressline2').removeClass('d-none');
            } 
            else 
            {
                $('.check_school_addressline2').addClass('d-none');
            }
        });

        $('#school_postal_code').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check_school_postal_code').removeClass('d-none');
            } 
            else 
            {
                $('.check_school_postal_code').addClass('d-none');
            }
        });

        //Get States from country
        $('#school_country').on('change', function () {

            $('.loader').removeClass('d-none');
            var country = $(this).val().trim();

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
                    $('#school_state').empty();
                    $('#school_city').empty();
                    response = JSON.parse(JSON.stringify(response));

                    response.data.states.forEach(function (Index, i) {
                        $('#school_state').append("<option value='" + response.data.states[i].name + "'> " + response.data.states[i].name + "(" + response.data.states[i].state_code + ") </option>");
                    });

                    $('.loader').addClass('d-none');
                },
                error: function (response) 
                {
                    $('.loader').addClass('d-none');
                    console.log(response);
                }
            });
        });

        //Get Cities from States
        $('#school_state').on('change', function () {

            $('.loader').removeClass('d-none');

            var country = $('#school_country').val().trim();
            var state = $(this).val().trim();

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
                    $('#school_city').empty();
                    response = JSON.parse(JSON.stringify(response));

                    response.data.forEach(function (Index, i) {
                        $('#school_city').append("<option value='" + response.data[i] + "'> " + response.data[i] + " </option>");
                    });

                    $('.loader').addClass('d-none');
                },
                error: function (response) {
                    $('.loader').addClass('d-none');
                    console.log(response);
                }
            });
        });

        $('#is_coed').on('click', function () {
            if (document.getElementById('is_coed').checked) 
            {
                $('#school_gender_type').attr('disabled', true);
            } 
            else 
            {
                $('#school_gender_type').attr('disabled', false);
            }
        });

        $('#school_register').on('submit', function (e) {

            e.preventDefault();

            var school_token     = $("#school_token").val().trim();
            var name             = $('#school_name').val().trim();
            var school_type      = $('#school_type').val().trim();
            var board_type       = $('#board_type').val().trim();
            var medium           = $('#school_medium').val().trim();
            var school_code      = $('#school_code').val().trim();
            var gender           = $('#school_gender_type').val().trim();
            var image_l          = document.getElementById('school_logo').files[0];
            var image            = document.getElementById('school_image').files[0];
            var contact_1        = $('#school_contactnumber1').intlTelInput("getNumber");
            var contact_2        = $('#school_contactnumber2').intlTelInput("getNumber");
            var description      = $('#school_description').val().trim();
            var admin_name       = $('#school_administratorname').val().trim();
            var admin_email      = $('#school_administratoremail').val().trim();
            var password         = $('#school_password').val().trim();
            var confirm_password = $('#school_confirmpassword').val().trim();
            var address1         = $('#school_addressline1').val().trim();
            var address2         = $('#school_addressline2').val().trim();
            var country          = $('#school_country').val().trim();
            var state            = $('#school_state').val().trim();
            var city             = $('#school_city').val().trim();
            var postal_code      = $('#school_postal_code').val().trim();

            if (document.getElementById('is_coed').checked) 
            {
                var is_coed = 1;
            }
            else
            {
                var is_coed = 0;
            }

            if (name != '') 
            {
                if (school_code != '') 
                {
                    if (document.getElementById('school_logo').files.length > 0) 
                    {
                        if (document.getElementById('school_image').files.length > 0) 
                        {
                            if ($('#school_contactnumber1').intlTelInput("isValidNumber")) 
                            {
                                if ($('#school_contactnumber2').intlTelInput("isValidNumber")) 
                                {
                                    if (admin_name != '') 
                                    {
                                        if (validateEmail(admin_email)) 
                                        {
                                            if (password != '') 
                                            {
                                                if (ValidatePassword(password, confirm_password)) 
                                                {
                                                    if (address1 != '') 
                                                    {
                                                        if (address2 != '') 
                                                        {
                                                            if (postal_code != '') 
                                                            {
                                                                var formdata = new FormData();
                                                                formdata.append('school_token'     , school_token);
                                                                formdata.append('name'             , name);
                                                                formdata.append('school_type'      , school_type);
                                                                formdata.append('board_type'       , board_type);
                                                                formdata.append('medium'           , medium);
                                                                formdata.append('school_code'      , school_code);
                                                                formdata.append('is_coed'          , is_coed);
                                                                formdata.append('gender'           , gender);
                                                                formdata.append('image_l'          , image_l);
                                                                formdata.append('image'            , image);
                                                                formdata.append('contact_1'        , contact_1);
                                                                formdata.append('contact_2'        , contact_2);
                                                                formdata.append('description'      , description);
                                                                formdata.append('admin_name'       , admin_name);
                                                                formdata.append('admin_email'      , admin_email);
                                                                formdata.append('password'         , password);
                                                                formdata.append('address1'         , address1);
                                                                formdata.append('address2'         , address2);
                                                                formdata.append('country'          , country);
                                                                formdata.append('state'            , state);
                                                                formdata.append('state'            , state);
                                                                formdata.append('city'             , city);
                                                                formdata.append('postal_code'      , postal_code);

                                                                Swal.fire({
                                                                    title: 'Are you sure?',
                                                                    text: "You want to Proceed further?",
                                                                    icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: '#3085d6',
                                                                    cancelButtonColor: '#d33',
                                                                    confirmButtonText: 'Yes'
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) 
                                                                    {
                                                                        $('#loader').css("display", 'block');

                                                                        $.ajax({
                                                                            url: "Easylearn/Register_Controller/school_register",
                                                                            data: formdata,
                                                                            type: "POST",
                                                                            contentType: false,
                                                                            processData: false,
                                                                            success: function (response) 
                                                                            {
                                                                                $('#loader').css("display", 'none');
                                                                                response = JSON.parse(response);

                                                                                if (response["data"] == "TRUE") 
                                                                                {
                                                                                    Swal.fire({
                                                                                        icon: "success",
                                                                                        title: "Registered Successfully!",
                                                                                        showConfirmButton: false,
                                                                                        timer: 1500,
                                                                                    }).then((result) => 
                                                                                    {
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
                                                                                $('#loader').css("display", 'none');

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
                                                                $('#school_postal_code').focus();
                                                                $('.check_school_postal_code').removeClass('d-none');
                                                            }
                                                        } 
                                                        else 
                                                        {
                                                            $('#school_addressline2').focus();
                                                            $('.check_school_addressline2').removeClass('d-none');
                                                        }
                                                    } 
                                                    else 
                                                    {
                                                        $('#school_addressline1').focus();
                                                        $('.check_school_addressline1').removeClass('d-none');
                                                    }
                                                } 
                                                else 
                                                {
                                                    $('#school_confirmpassword').focus();
                                                    $('.check_school_confirmpassword').removeClass('d-none');
                                                }
                                            } 
                                            else 
                                            {
                                                $('#school_password').focus();
                                                $('.check_school_password').removeClass('d-none');
                                            }
                                        } 
                                        else 
                                        {
                                            $('#school_administratoremail').focus();
                                            $('.check_school_administratoremail').removeClass('d-none');
                                        }
                                    } 
                                    else 
                                    {
                                        $('#school_administratorname').focus();
                                        $('.check_school_administratorname').removeClass('d-none');
                                    }
                                } 
                                else 
                                {
                                    $('#school_contactnumber2').focus();
                                    $('.check_school_contactnumber2').removeClass('d-none');
                                }
                            } 
                            else 
                            {
                                $('#school_contactnumber1').focus();
                                $('.check_school_contactnumber1').removeClass('d-none');
                            }
                        } 
                        else 
                        {
                            $('#school_image').focus();
                            $('.check_school_image').removeClass('d-none');
                        }
                    } 
                    else 
                    {
                        $('#school_logo').focus();
                        $('.check_school_logo').removeClass('d-none');
                    }
                } 
                else 
                {
                    $('#school_code').focus();
                    $('.check_school_code').removeClass('d-none');
                }
            } 
            else 
            {
                $('#school_name').focus();
                $('.check_institute_name').removeClass('d-none');
            }

        });

        //College Form
        //Get States from country
        $('#jr_college_country').on('change', function () {

            $('.loader').removeClass('d-none');
            var country = $(this).val().trim();

            $.ajax({
                url: "https://countriesnow.space/api/v0.1/countries/states",
                type: "POST",
                data: JSON.stringify({
                    country: country
                }),
                headers: {
                    "Content-Type": "application/json",
                },
                success: function (response) 
                {
                    $('#jr_college_state').empty();
                    $('#jr_college_city').empty();
                    response = JSON.parse(JSON.stringify(response));

                    response.data.states.forEach(function (Index, i) {
                        $('#jr_college_state').append("<option value='" + response.data.states[i].name + "'> " + response.data.states[i].name + "(" + response.data.states[i].state_code + ") </option>");
                    });

                    $('.loader').addClass('d-none');
                },
                error: function (response) {
                    $('.loader').addClass('d-none');
                    console.log(response);
                }
            });
        });

        //Get Cities from States
        $('#jr_college_state').on('change', function () {

            $('.loader').removeClass('d-none');

            var country = $('#jr_college_country').val().trim();
            var state = $(this).val().trim();

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
                    $('#jr_college_city').empty();
                    response = JSON.parse(JSON.stringify(response));

                    response.data.forEach(function (Index, i) {
                        $('#jr_college_city').append("<option value='" + response.data[i] + "'> " + response.data[i] + " </option>");
                    });

                    $('.loader').addClass('d-none');
                },
                error: function (response) {
                    $('.loader').addClass('d-none');
                    console.log(response);
                }
            });
        });

        $('#jr_college_is_coed').on('click', function () {
            if (document.getElementById('jr_college_is_coed').checked) 
            {
                $('#jr_college_gender_type').attr('disabled', true);
            } 
            else 
            {
                $('#jr_college_gender_type').attr('disabled', false);
            }
        });

        var jrclg_phoneno = $("#jr_college_contactnumber1, #jr_college_contactnumber2").intlTelInput({
            autoPlaceholder: true,
        });

        $('#jr_college_name').on('keyup',function(){

            var jrclg_name = $(this).val().trim(); 
            if(jrclg_name != ''){
                
                $('.check_jr_college_name').addClass('d-none');

            }else{

                $('.check_jr_college_name').removeClass('d-none');

            }

        });

        $('#jr_college_code').on('keyup',function(){

            var jrclg_code = $(this).val().trim(); 
            if(jrclg_code != ''){
                
                $('.check_jr_college_code').addClass('d-none');

            }else{

                $('.check_jr_college_code').removeClass('d-none');

            }

        });
        
        $('#jr_college_logo').on('change',function(){

            var file = document.getElementById('jr_college_logo').files[0];
            if(ValidateImage(file)){

                $('.check_jr_college_logo').addClass('d-none');

            }else{

                $('.check_jr_college_logo').removeClass('d-none');

            }
        });

        $('#jr_college_image').on('change',function(){

            var file = document.getElementById('jr_college_image').files[0];
            if(ValidateImage(file)){

                $('.check_jr_college_image').addClass('d-none');

            }else{

                $('.check_jr_college_image').removeClass('d-none');

            }

        });

        $('#jr_college_contactnumber1').on('keyup',function(){

            if($('#jr_college_contactnumber1').intlTelInput("isValidNumber")){
                
                $('.check_jr_college_contactnumber1').addClass('d-none');

            }else{

                $('.check_jr_college_contactnumber1').removeClass('d-none');

            }

        });

        $('#jr_college_contactnumber2').on('keyup',function(){

            if($('#jr_college_contactnumber2').intlTelInput("isValidNumber")){
                
                $('.check_jr_college_contactnumber2').addClass('d-none');

            }else{

                $('.check_jr_college_contactnumber2').removeClass('d-none');

            }

        });

        $('#jr_college_administratorname').on('keyup',function(){

            var jrclg_adnm = $(this).val().trim(); 
            if(jrclg_adnm != ''){
                
                $('.check_jr_college_administratorname').addClass('d-none');

            }else{

                $('.check_jr_college_administratorname').removeClass('d-none');

            }

        });

        $('#jr_college_administratoremail').on('keyup',function(){

            var jrclg_email = $(this).val().trim(); 
            if(validateEmail(jrclg_email)){
                
                $('.check_jr_college_administratoremail').addClass('d-none');

            }else{

                $('.check_jr_college_administratoremail').removeClass('d-none');

            }

        });

        $('#jr_college_addressline1').on('keyup',function(){

            var jrclg_addr1 = $(this).val().trim(); 
            if(jrclg_addr1 != ''){
                
                $('.check_jr_college_addressline1').addClass('d-none');

            }else{

                $('.check_jr_college_addressline1').removeClass('d-none');

            }

        });

        $('#jr_college_addressline2').on('keyup',function(){

            var jrclg_addr2 = $(this).val().trim(); 
            if(jrclg_addr2 != ''){
                
                $('.check_jr_college_addressline2').addClass('d-none');

            }else{

                $('.check_jr_college_addressline2').removeClass('d-none');

            }

        });

        $('#jr_college_postal_code').on('keyup',function(){

            var jrclg_pcode = $(this).val().trim(); 
            if(jrclg_pcode != ''){
                
                $('.check_jr_college_postal_code').addClass('d-none');

            }else{

                $('.check_jr_college_postal_code').removeClass('d-none');

            }

        });

        $('#jr_college_password').on('keyup',function(){

            var jrclg_pwd = $(this).val().trim(); 
            var jrclg_cpwd = $('#jr_college_confirmpassword').val().trim(); 

            if(ValidatePassword(jrclg_pwd, jrclg_pwd))
            {
                $('.check_jr_college_password').addClass('d-none');

                if(ValidatePassword(jrclg_pwd , jrclg_cpwd))
                {
                    $('.check_jr_college_confirmpassword').addClass('d-none');
                }
                else
                {
                    $('.check_jr_college_confirmpassword').removeClass('d-none');
                }
            }
            else
            {
                $('.check_jr_college_password').removeClass('d-none');
            }
        });

        $('#jr_college_confirmpassword').on('keyup',function(){

            var jrclg_pwd = $('#jr_college_password').val().trim(); 
            var jrclg_cpwd = $(this).val().trim(); 
           
            if(ValidatePassword(jrclg_pwd , jrclg_cpwd))
            {
                $('.check_jr_college_confirmpassword').addClass('d-none');
            }
            else
            {
                $('.check_jr_college_confirmpassword').removeClass('d-none');
            }
        });

        $('#jr_college_register').on('submit',function(e){
            e.preventDefault();

            var jr_college_token = $('#jr_college_token').val().trim();
            var jr_college_name = $('#jr_college_name').val().trim();
            var college_type = $('#college_type').val().trim();
            var college_board_type = $('#college_board_type').val().trim();
            var jr_college_medium = $('#jr_college_medium').val().trim();
            var jr_college_code = $('#jr_college_code').val().trim();
            var is_coed = $('#jr_college_is_coed').is(':checked') ? 1 : 0;
            var jr_college_gender_type = $('#jr_college_is_coed').is(':checked') ? "" : $('#jr_college_gender_type').val().trim();
            var jr_college_logo = document.getElementById('jr_college_logo').files[0];
            var jr_college_image = document.getElementById('jr_college_image').files[0];
            var jr_college_contactnumber1 = $('#jr_college_contactnumber1').intlTelInput('getNumber');
            var jr_college_contactnumber2 = $('#jr_college_contactnumber2').intlTelInput('getNumber');
            var jr_college_description = $('#jr_college_description').val().trim();
            var jr_college_administratorname = $('#jr_college_administratorname').val().trim();
            var jr_college_administratoremail = $('#jr_college_administratoremail').val().trim();
            var jrclg_pwd = $('#jr_college_password').val().trim();
            var jrclg_cpwd = $('#jr_college_confirmpassword').val().trim(); 

            var jr_college_addressline1 = $('#jr_college_addressline1').val().trim();
            var jr_college_addressline2 = $('#jr_college_addressline2').val().trim();
            var jr_college_country = $('#jr_college_country').val().trim();
            var jr_college_state  = $('#jr_college_state').val().trim();
            var jr_college_city  = $('#jr_college_city').val().trim();
            var jr_college_postal_code = $('#jr_college_postal_code').val().trim();

            var jr_stream = [];

            $("input:checkbox[name=jr_clg_stream]:checked").each(function() {
                jr_stream.push($(this).val());
            });

            if(jr_college_name != ''){

                $('.check_jr_college_name').addClass('d-none');

                if(jr_college_code != ''){

                    $('.check_jr_college_code').addClass('d-none');
                    
                    if(ValidateImage(jr_college_logo)){

                        $('.check_jr_college_logo').addClass('d-none');

                        if(ValidateImage(jr_college_image)){

                            $('.check_jr_college_image').addClass('d-none');
                            
                            if($('#jr_college_contactnumber1').intlTelInput('isValidNumber')){

                                $('.check_jr_college_contactnumber1').addClass('d-none');

                                if($('#jr_college_contactnumber2').intlTelInput('isValidNumber')){

                                    $('.check_jr_college_contactnumber2').addClass('d-none');

                                    if(jr_stream.length !=0 ){

                                        $('.check_jr_college_stream').addClass('d-none');

                                        if(jr_college_administratorname != ''){

                                            $('.check_jr_college_administratorname').addClass('d-none');

                                            if(validateEmail(jr_college_administratoremail)){

                                                $('.check_jr_college_administratoremail').addClass('d-none');

                                                if(jrclg_pwd != ''){

                                                    $('.check_jr_college_password').addClass('d-none');

                                                    if(jrclg_cpwd != ''){

                                                        $('.check_jr_college_confirmpassword').addClass('d-none');

                                                        if(ValidatePassword(jrclg_pwd,jrclg_cpwd)){
                
                                                            $('.check_jr_college_confirmpassword').addClass('d-none');

                                                            if(jr_college_addressline1 != ''){

                                                                $('.check_jr_college_addressline1').addClass('d-none');

                                                                if(jr_college_addressline2 != ''){

                                                                    $('.check_jr_college_addressline2').addClass('d-none');

                                                                    if(jr_college_postal_code != ''){

                                                                        $('.check_jr_college_postal_code').addClass('d-none');


                                                                        var formdata = new FormData();
                                                                        formdata.append('jr_college_token',jr_college_token);
                                                                        formdata.append('jr_college_name',jr_college_name);
                                                                        formdata.append('college_type',college_type);
                                                                        formdata.append('college_board_type',college_board_type);
                                                                        formdata.append('jr_college_medium',jr_college_medium);
                                                                        formdata.append('jr_college_code',jr_college_code);
                                                                        formdata.append('is_coed',is_coed);
                                                                        formdata.append('jr_college_gender_type',jr_college_gender_type);
                                                                        formdata.append('jr_college_logo',jr_college_logo);
                                                                        formdata.append('jr_college_image',jr_college_image);
                                                                        formdata.append('jr_college_contactnumber1',jr_college_contactnumber1);
                                                                        formdata.append('jr_college_contactnumber2',jr_college_contactnumber2);
                                                                        formdata.append('jr_college_administratorname',jr_college_administratorname);
                                                                        formdata.append('jr_college_administratoremail',jr_college_administratoremail);
                                                                        formdata.append('jrclg_pwd',jrclg_pwd);
                                                                        formdata.append('jr_college_addressline1',jr_college_addressline1);
                                                                        formdata.append('jr_college_addressline2',jr_college_addressline2);
                                                                        formdata.append('jr_college_country',jr_college_country);
                                                                        formdata.append('jr_college_state',jr_college_state);
                                                                        formdata.append('jr_college_city',jr_college_city);
                                                                        formdata.append('jr_college_postal_code',jr_college_postal_code);
                                                                        formdata.append('jr_stream',JSON.stringify(jr_stream));
                                                                        formdata.append('jr_college_description',jr_college_description);

                                                                        $.ajax({
                                                                            url: "Easylearn/Register_Controller/jr_clg_register",
                                                                            data: formdata,
                                                                            type: "POST",
                                                                            contentType: false,
                                                                            processData: false,
                                                                            success: function (response) 
                                                                            {
                                                                                $('#loader').css("display", 'none');
                                                                                response = JSON.parse(response);

                                                                                if (response["data"] == "TRUE") 
                                                                                {
                                                                                    Swal.fire({
                                                                                        icon: "success",
                                                                                        title: "Registered Successfully!",
                                                                                        showConfirmButton: false,
                                                                                        timer: 1500,
                                                                                    }).then((result) => 
                                                                                    {
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
                                                                                $('#loader').css("display", 'none');

                                                                                Swal.fire({
                                                                                    icon: "error",
                                                                                    title: "Oops...",
                                                                                    text: "Something went wrong!",
                                                                                }).then((result) => {
                                                                                    //location.reload();
                                                                                });
                                                                            }
                                                                        });

                                                                        
                                                                    }else{

                                                                        $('#jr_college_postal_code').focus();
                                                                        $('.check_jr_college_postal_code').removeClass('d-none');
        
                                                                    }
                                                                }else{

                                                                    $('#jr_college_addressline2').focus();
                                                                    $('.check_jr_college_addressline2').removeClass('d-none');
                                                                    
                                                                }

                                                            }else{

                                                                $('#jr_college_addressline1').focus();
                                                                $('.check_jr_college_addressline1').removeClass('d-none');

                                                            }
                                                        }else{

                                                            $('#jr_college_confirmpassword').focus();
                                                            $('.check_jr_college_confirmpassword').removeClass('d-none');
                                            
                                                        }

                                                    }else{

                                                        $('#jr_college_confirmpassword').focus();
                                                        $('.check_jr_college_confirmpassword').removeClass('d-none');

                                                    }

                                                }else{

                                                    $('#jr_college_password').focus();
                                                    $('.check_jr_college_password').removeClass('d-none');
                                                }
    
                                            }else{
    
                                                $('#jr_college_administratoremail').focus();
                                                $('.check_jr_college_administratoremail').removeClass('d-none');
    
                                            }

                                        }else{

                                            $('#jr_college_administratorname').focus();
                                            $('.check_jr_college_administratorname').removeClass('d-none');

                                        }

                                    }else{

                                        $('.check_jr_college_stream').removeClass('d-none');

                                    }

                                }else{
    
                                    $('#jr_college_contactnumber2').focus();
                                    $('.check_jr_college_contactnumber2').removeClass('d-none');
    
                                }

                            }else{

                                $('#jr_college_contactnumber1').focus();
                                $('.check_jr_college_contactnumber1').removeClass('d-none');

                            }

                        }else{

                            $('#jr_college_image').focus();
                            $('.check_jr_college_image').removeClass('d-none');

                        }

                    }else{
                        
                        $('#jr_college_logo').focus();
                        $('.check_jr_college_logo').removeClass('d-none');

                    }

                }else{

                    $('#jr_college_code').focus();
                    $('.check_jr_college_code').removeClass('d-none');

                }

            }else{

                $('#jr_college_name').focus();
                $('.check_jr_college_name').removeClass('d-none');

            }



        });
      
        //Mentor Registration
        $('#mentorName').on('keyup', function() {
            if($(this).val().trim() != '')
            {
                $('.check_mentor_mentorName').addClass('d-none');
            }
            else
            {
                $('.check_mentor_mentorName').removeClass('d-none');
            }
        });

        $('#mentoryearsofexperience').on('keyup', function() {
            if( ValidateNumber($(this).val().trim()))
            {
                $('.check_mentor_yearsofexperience').addClass('d-none');
            }
            else
            {
                $('.check_mentor_yearsofexperience').removeClass('d-none');
            }
        });

        $("#mentordateofbirth").datepicker({
            format: 'dd-mm-yyyy',
            endDate: '-18y',
            orientation: "bottom right",
        }).on('change', function () {

            var dob = $("#mentordateofbirth").datepicker('getDate');

            if (dob != null) 
            {
                $('.check-mentor-dateofbirth').addClass('d-none');
            } 
            else 
            {
                $('.check-mentor-dateofbirth').removeClass('d-none');
            }
        });

        $('#fieldofexperience').on('keyup', function() {
            if($(this).val().trim() != null)
            {
                $('.check-mentor-fieldofexperience').addClass('d-none');
            }
            else
            {
                $('.check-mentor-fieldofexperience').removeClass('d-none');
            }
        });

        var input = document.querySelector("#mentor_skills");
        tagify = new Tagify(input);

        $('#mentor_skills').on('change', function() {

            if( $(this).val().trim() != '')
            {
                $('.check-mentor_skills').addClass('d-none');
            }
            else
            {
                $('.check-mentor_skills').removeClass('d-none');
            }
        });

        $('#mentor_mentorbriefdescription').on('keyup', function() {
            if( $(this).val().trim() != '')
            {
                $('.check-mentor-mentorbriefdescription').addClass('d-none');
            }
            else
            {
                $('.check-mentor-mentorbriefdescription').removeClass('d-none');
            }
        });
        
        $('#mentor_incubatorAdminEmail').on('keyup', function() {
            if( validateEmail($(this).val().trim()))
            {
                $('.check_mentor_incubatorAdminEmail').addClass('d-none');
            }
            else
            {
                $('.check_mentor_incubatorAdminEmail').removeClass('d-none');
            }
        });

        $('#mentor_password').on('keyup', function() {
            if( ValidatePassword($(this).val().trim(), $(this).val().trim()))
            {
                $('.check_mentor_password').addClass('d-none');

                if(ValidatePassword($(this).val().trim(), $('#mentor_confirmpassword').val().trim()))
                {
                    $('.check_mentor_confirm_password').addClass('d-none');
                }
                else
                {
                    $('.check_mentor_confirm_password').removeClass('d-none');
                }
            }
            else
            {
                $('.check_mentor_password').removeClass('d-none');
            }
        });

        $('#mentor_confirmpassword').on('keyup', function() {
            if( ValidatePassword($(this).val().trim(), $('#mentor_password').val().trim()))
            {
                $('.check_mentor_confirm_password').addClass('d-none');
            }
            else
            {
                $('.check_mentor_confirm_password').removeClass('d-none');
            }
        });

        $("#mentor_ContactNo1").intlTelInput();
        $("#mentor_ContactNo2").intlTelInput();

        $("#mentor_ContactNo1").on("keyup", function () {
            if($('#mentor_ContactNo1').intlTelInput('isValidNumber'))
            {
                $(".check_mentor_mentorContactNo1").addClass("d-none");
            }
            else
            {
                $(".check_mentor_mentorContactNo1").removeClass("d-none");
            }
        });

        $("#mentor_ContactNo2").on("keyup", function () {
            if($('#mentor_ContactNo2').intlTelInput('isValidNumber'))
            {
                $(".check_mentor_mentorContactNo2").addClass("d-none");
            }
            else
            {
                $(".check_mentor_mentorContactNo2").removeClass("d-none");
            }
        });

        $('#mentor_addressline1').on('keyup', function() {
            if($(this).val().trim() != null)
            {
                $('.check_mentor_addressline1').addClass('d-none');
            }
            else
            {
                $('.check_mentor_addressline1').removeClass('d-none');
            }
        });

        $('#mentor_addressline2').on('keyup', function() {
            if($(this).val().trim() != null)
            {
                $('.check_mentor_addressline2').addClass('d-none');
            }
            else
            {
                $('.check_mentor_addressline2').removeClass('d-none');
            }
        });

        //Get States from country
        $('#mentor_country').on('change', function () {

            $('.loader').removeClass('d-none');
            var country = $(this).val().trim();

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
                    $('#mentor_state').empty();
                    $('#mentor_city').empty();
                    response = JSON.parse(JSON.stringify(response));

                    response.data.states.forEach(function (Index, i) {
                        $('#mentor_state').append("<option value='" + response.data.states[i].name + "'> " + response.data.states[i].name + "(" + response.data.states[i].state_code + ") </option>");
                    });

                    $('.loader').addClass('d-none');
                },
                error: function (response) {
                    $('.loader').addClass('d-none');
                    console.log(response);
                }
            });
        });
        
        //Get Cities from States
        $('#mentor_state').on('change', function () {

            $('.loader').removeClass('d-none');

            var country = $('#mentor_country').val().trim();
            var state = $(this).val().trim();

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
                    $('#mentor_city').empty();
                    response = JSON.parse(JSON.stringify(response));

                    response.data.forEach(function (Index, i) {
                        $('#mentor_city').append("<option value='" + response.data[i] + "'> " + response.data[i] + " </option>");
                    });

                    $('.loader').addClass('d-none');
                },
                error: function (response) {
                    $('.loader').addClass('d-none');
                    console.log(response);
                }
            });
        });

        $('#mentor_postal_code').on('keyup', function() {
            if($(this).val().trim() != null)
            {
                $('.check_mentor_postal_code').addClass('d-none');
            }
            else
            {
                $('.check_mentor_postal_code').removeClass('d-none');
            }
        });

        $('#mentor_photo_Uplode').on('change', function() {
            if(ValidateImage(this.files[0]))
            {
                $('.check_mentor_photo_Uplode').addClass('d-none');
            }
            else
            {
                $('.check_mentor_photo_Uplode').removeClass('d-none');
            }
        });

        $('#mentor-resume-uplode').on('change', function() {
            if(ValidateDocument(this.files[0]))
            {
                $('.check_mentor-resume-uplode').addClass('d-none');
            }
            else
            {
                $('.check_mentor-resume-uplode').removeClass('d-none');
            }
        });

        $("#mentor-register").on("submit", function (event) {
            event.preventDefault();

            var m_token   = $('#mentor_token').val().trim();
            var m_name    = $('#mentorName').val().trim();
            var m_exp     = $('#mentoryearsofexperience').val().trim();
            var m_dob     = $('#mentordateofbirth').datepicker('getDate');
            var m_expt    = $('#fieldofexperience').val().trim();
            var m_skills  = $('#mentor_skills').val().trim();
            var m_descp   = $('#mentor_mentorbriefdescription').val().trim();
            var m_email   = $('#mentor_incubatorAdminEmail').val().trim();
            var m_pass    = $('#mentor_password').val().trim();
            var m_cpass   = $('#mentor_confirmpassword').val().trim();
            var m_con1    = $('#mentor_ContactNo1').intlTelInput("getNumber");
            var m_con2    = $('#mentor_ContactNo2').intlTelInput("getNumber");
            var m_addr1   = $('#mentor_addressline1').val().trim();
            var m_addr2   = $('#mentor_addressline2').val().trim();
        
            var m_st      = $('#mentor_state').val().trim();
            var m_pcode   = $('#mentor_postal_code').val().trim();
            var m_country = $('#mentor_country').val().trim();
            var m_city    = $('#mentor_city').val().trim();
            var m_pic     = document.getElementById("mentor_photo_Uplode").files[0];
            var m_resume  = document.getElementById("mentor-resume-uplode").files[0];

            if(m_name != null)
            {
                if(ValidateNumber(m_exp))
                {
                    if(m_dob != null)
                    {
                        if(m_expt != null)
                        {
                            if(m_skills != null)
                            {
                                if(m_descp != null)
                                {
                                    if(m_email != null)
                                    {
                                        if(ValidatePassword(m_pass, m_cpass))
                                        {
                                            if($('#mentor_ContactNo1').intlTelInput("isValidNumber"))
                                            {
                                                if($('#mentor_ContactNo2').intlTelInput("isValidNumber"))
                                                {
                                                    if(m_addr1 != null)
                                                    {
                                                        if(m_addr2 != null)
                                                        {
                                                            if(m_pcode != null)
                                                            {
                                                                if(ValidateImage(m_pic))
                                                                {
                                                                    if(ValidateDocument(m_resume))
                                                                    {
                                                                        Swal.fire({
                                                                            title: "Are you sure?",
                                                                            text: "You want to proceed further!",
                                                                            icon: "warning",
                                                                            showCancelButton: true,
                                                                            confirmButtonColor: "#3085d6",
                                                                            cancelButtonColor: "#d33",
                                                                            confirmButtonText: "Yes",
                                                                        }).then((result) => {
                                                                            if (result.isConfirmed) 
                                                                            {
                                                                                $(".loader").removeClass("d-none");
                                                                                var data = new FormData();

                                                                                data.append("m_token"   , m_token);
                                                                                data.append("m_name"    , m_name);
                                                                                data.append("m_exp"     , m_exp);
                                                                                data.append("m_dob"     , convertstrtodate(m_dob));
                                                                                data.append("m_expt"    , m_expt);
                                                                                data.append('m_skills'  , m_skills);
                                                                                data.append("m_descp"   , m_descp);
                                                                                data.append("m_email"   , m_email);
                                                                                data.append("m_pass"    , m_pass);
                                                                                data.append("m_cpass"   , m_cpass);
                                                                                data.append("m_con1"    , m_con1);
                                                                                data.append("m_con2"    , m_con2);
                                                                                data.append("m_addr1"   , m_addr1);
                                                                                data.append("m_addr2"   , m_addr2);
                                                                                data.append("m_st"      , m_st);
                                                                                data.append("m_pcode"   , m_pcode);
                                                                                data.append("m_country" , m_country);
                                                                                data.append("m_city"    , m_city);
                                                                                data.append("m_pic"     , m_pic);
                                                                                data.append("m_resume"  , m_resume);
                                                                    
                                                                                $.ajax({
                                                                                    url: "Easylearn/Register_Controller/register_mentor",
                                                                                    data: data,
                                                                                    type: "POST",
                                                                                    contentType: false,
                                                                                    processData: false,
                                                                                    success: function (response) 
                                                                                    {
                                                                                        $(".loader").addClass("d-none");
                                                                                        response = JSON.parse(response);

                                                                                        if (response.data == "TRUE") 
                                                                                        {
                                                                                            Swal.fire({
                                                                                                icon: "success",
                                                                                                title: "Successfully Registered",
                                                                                                text: "Please check your mail for further details",
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
                                                                                        $(".loader").addClass("d-none");

                                                                                        Swal.fire({
                                                                                            icon: "error",
                                                                                            title: "Oops...",
                                                                                            text: 'data not gone',
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
                                                                        $('#mentor-resume-uplode').focus();
                                                                        $('.check_mentor-resume-uplode').removeClass('d-none');
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $('#mentor_photo_Uplode').focus();
                                                                    $('.check_mentor_photo_Uplode').removeClass('d-none');
                                                                }
                                                            }
                                                            else
                                                            {
                                                                $('#mentor_postal_code').focus();
                                                                $('.check_mentor_postal_code').removeClass('d-none');
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $('#mentor_addressline2').focus();
                                                            $('.check_mentor_addressline2').removeClass('d-none');
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $('#mentor_addressline1').focus();
                                                        $('.check_mentor_addressline1').removeClass('d-none');
                                                    }
                                                }
                                                else
                                                {
                                                    $('#mentor_ContactNo2').focus();
                                                    $('.check_mentor_mentorContactNo2').removeClass('d-none');
                                                }
                                            }
                                            else
                                            {
                                                $('#mentor_ContactNo1').focus();
                                                $(".check_mentor_mentorContactNo1").removeClass("d-none");
                                            }
                                        }
                                        else
                                        {
                                            $('#mentor_confirmpassword').focus();
                                            $('.check_mentor_confirm_password').removeClass('d-none');
                                        }
                                    }
                                    else
                                    {
                                        $('#mentor_incubatorAdminEmail').focus();
                                        $('.check_mentor_incubatorAdminEmail').removeClass('d-none');
                                    }
                                }
                                else
                                {
                                    $('#mentor_mentorbriefdescription').focus();
                                    $('.check-mentor-mentorbriefdescription').removeClass('d-none');
                                }
                            }
                            else
                            {
                                $('#mentor_skills').focus();
                                $('.check-mentor_skills').removeClass('d-none');
                            }
                        }
                        else
                        {
                            $('#fieldofexperience').focus();
                            $('.check-mentor-fieldofexperience').removeClass('d-none');
                        }
                    }
                    else
                    {
                        $('#mentordateofbirth').focus();
                        $('.check-mentor-dateofbirth').removeClass('d-none');
                    }
                }
                else
                {
                    $('#mentoryearsofexperience').focus();
                    $('.check_mentor_yearsofexperience').removeClass('d-none');
                }
            }
            else
            {
                $('#mentorName').focus();
                $('.check_mentor_mentorName').removeClass('d-none');
            }
        });
    }
});