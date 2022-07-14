$(document).ready(function() {

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

    if (location.pathname.split('/').slice(-1)[0] == 'text_speech') 
    {
        $('#text_to_speech').on('click', function () {
            var text_speech_textarea = $('#text_speech_textarea').val().trim();

            if (text_speech_textarea.trim() != null) 
            {
                $("#loader").css("display", 'block');

                $.ajax({
                    url: "Easylearn/Classroom_Controller/text_to_speech",
                    data: {
                        text: text_speech_textarea
                    },
                    type: "POST",
                    success: function (response) 
                    {
                        $("#loader").css("display", 'none');

                        if (response != 'FALSE') 
                        {
                            $('#text_speech_audio').attr('src', 'data:audio/mpeg;base64,' + response);
                        } 
                        else 
                        {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Cant able to procees your request",
                            }).then((result) => {
                                // location.reload();
                            });
                        }
                    },
                    error: function (response) 
                    {
                        $("#loader").css("display", 'none');

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
            else 
            {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please enter data to convert",
                });
            }
        });

        const recordAudio = () =>
            new Promise(async resolve => {
                const stream = await navigator.mediaDevices.getUserMedia({
                    audio: true
                });
                const mediaRecorder = new MediaRecorder(stream);
                const audioChunks = [];

                mediaRecorder.addEventListener("dataavailable", event => {
                    audioChunks.push(event.data);
                });

                const start = () => mediaRecorder.start();

                const stop = () =>
                    new Promise(resolve => {
                        mediaRecorder.addEventListener("stop", () => {
                            const audioBlob = new Blob(audioChunks, {
                                type: "audio/mp3"
                            });
                            const audioUrl = URL.createObjectURL(audioBlob);
                            const audio = new Audio(audioUrl);
                            const play = () => audio.play();
                            resolve({
                                audioBlob,
                                audioUrl,
                                play
                            });

                            var a = document.createElement("a");
                            document.body.appendChild(a);
                            a.style = "display: none";

                            a.href = audioUrl;
                            a.download = 'audio.mp3';
                            a.click();
                            window.URL.revokeObjectURL(audioUrl);
                        });

                        mediaRecorder.stop();
                    });

                resolve({
                    start,
                    stop
                });
            });

        var recorder = null;
        var interval = null;

        function timeout(time) 
        {
            interval = setInterval(function () {
                time = time + 1;

                hour = Math.floor(time / 3600);
                min = Math.floor((time % 3600) / 60);
                sec = Math.floor((time % 3600) % 60);

                if (hour <= 9) {
                    hour = "0" + hour;
                }
                if (min <= 9) {
                    min = "0" + min;
                }
                if (sec <= 9) {
                    sec = "0" + sec;
                }

                $('#current_time').html(hour + ':' + min + ':' + sec);

            }, 1000);
        }

        $('#play_button').on('click', function () {
            if ($(this).children().eq(0).hasClass('fa-play')) 
            {
                $(this).children().eq(0).removeClass('fa-play');
                $(this).children().eq(0).addClass('fa-pause');
                $(".audio_record-icon").addClass('active');

                (async () => {
                    recorder = await recordAudio();
                    recorder.start();
                })();

                timeout(0);
            } 
            else 
            {
                $(this).children().eq(0).removeClass('fa-pause');
                $(this).children().eq(0).addClass('fa-play');
                $(".audio_record-icon").removeClass('active');

                (async () => {
                    await recorder.stop();
                })();

                $('#current_time').html('00:00:00');
                clearInterval(interval);
            }
        });

        $('#speech_to_text').on('click', function () {
            var audio = document.getElementById("choose_audio").files[0];

            if (audio != null) 
            {
                var formdata = new FormData();
                formdata.append('audio', audio);

                $("#loader").css("display", "block");

                $.ajax({
                    url: "Easylearn/Classroom_Controller/speech_to_text",
                    data: formdata,
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function (response) 
                    {
                        $("#loader").css("display", "none");

                        if (response != 'Choose vaild audio file' && response != 'Choose audio file to continue') 
                        {
                            response = JSON.parse(response);

                            $('#speech_text_textarea').val(response['text']);
                            $('.confidence').html('Confidence Precentage : - &nbsp' + response['confidence'] + "%");
                        } 
                        else 
                        {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response,
                            }).then((result) => {
                                // location.reload();
                            });
                        }
                    },
                    error: function (response) 
                    {
                        $("#loader").css("display", "none");

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
            else 
            {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please choose audio file",
                });
            }
        });
    }

    if (location.pathname.split('/').slice(-1)[0] == 'manage_document') 
    {
        $('#add_doc_btn').on('click', function () {
            $('#add_doc_modal').modal('show');
        });

        //Add Document
        $('#add_doc_form').on('submit', function (e) {
            e.preventDefault();

            var doc_token     = $('#doc_token').val().trim();
            var doc_nm        = $('#doc_nm').val().trim();
            var document_file = document.getElementById('document_file').files[0];

            if (doc_nm != '')
            {
                if (document.getElementById('document_file').files.length > 0) 
                {
                    var formdata = new FormData();
                    formdata.append('doc_token'    , doc_token);
                    formdata.append('doc_nm'       , doc_nm);
                    formdata.append('document_file', document_file);

                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: "Easylearn/Classroom_Controller/add_doc",
                        data: formdata,
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: function (response) 
                        {
                            $('#loader').css('display', 'none');
                            response = JSON.parse(response);
                            if (response.data == 'TRUE') 
                            {
                                Swal.fire({
                                    icon: "success",
                                    title: "Added Succesfully",
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
                                    // location.reload();
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
                else 
                {
                    $('.check_document_file').removeClass('d-none');
                }
            } 
            else 
            {
                $('.check_doc_nm').removeClass('d-none');
            }
        });

        $('.view_pdf').on('click', function () {
            var myWindow = window.open($(this).attr('id'), "__blank");
        });

        //Delete Document
        $('.del_doc').on('click', function () {
            var formdata = new FormData();
            formdata.append('id', $(this).attr('id'));

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to proceed further",
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
                        url: "Easylearn/Classroom_Controller/del_doc",
                        data: formdata,
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: function (response) 
                        {
                            $('#loader').css('display', 'none');

                            response = JSON.parse(response);
                            if (response.data == 'TRUE') 
                            {
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted Succesfully",
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
                                    // location.reload();
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
        });

        $('#doc_nm').on('keyup', function () {

            var doc_nm = $(this).val().trim();
            if (doc_nm.trim() != '') 
            {
                $('.check-doc_nm').addClass('d-none');

            } 
            else 
            {
                $('.check-doc_nm').removeClass('d-none');
            }
        });

        $('#document_file').on('change', function () {

            if (document.getElementById('document_file').files.length > 0) 
            {
                $('.check-document_file').addClass('d-none');
            } 
            else 
            {
                $('.check-document_file').removeClass('d-none');
            }
        });
    }

    if (location.pathname.split('/').slice(-1)[0] == 'manage_training_material') {

        $('.tm_card').on('click', function () 
        {
            var id = $(this).attr('id');

            var formdata = new FormData();
            formdata.append('id', id);

            $.ajax({
                url: "Easylearn/Classroom_Controller/get_tm_id",
                data: formdata,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (response) 
                {
                    response = JSON.parse(response);
                    console.log(response);
                    if (response.data != 'FALSE') 
                    {
                        $('#tm_id').val(id);
                        $('#edit_doc_nm').val(response.data.document_name);
                        $('#edit_training_descp').val(response.data.training_description);
                        $('#edit_tm_modal').modal('show');
                    }
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

        $('#add_tm_btn').on('click', function () {
            $('#add_tm_modal').modal('show');
        });

        //View PDF
        $('.view_pdf').on('click', function () {
            var myWindow = window.open($(this).attr('id'), "__blank");
        });

        $("#doc_nm").on("keyup", function () {
            var name = $(this).val().trim();
            if (name == null || name == "") 
            {
                $(".check-doc_nm").removeClass("d-none");
            }
             else
             {
                if (ValidateName(name)) 
                {
                    $(".check-doc_nm").addClass("d-none");
                } 
                else 
                {
                    $(".check-doc_nm").removeClass("d-none");
                }
            }
        });

        //Add Training Material
        $('#add_tm_form').on('submit', function (e) {

            e.preventDefault();
            var tm_token          = $('#tm_token').val().trim();
            var doc_nm            = $('#doc_nm').val().trim();
            var tm_img            = document.getElementById('tm_img').files[0];
            var training_material = document.getElementById('training_material').files[0];
            var training_descp    = $('#training_descp').val().trim();

            if (doc_nm.trim() != '') 
            {
                if (document.getElementById('tm_img').files.length > 0) 
                {
                    if (ValidateImage(tm_img)) 
                    {
                        if (document.getElementById('training_material').files.length > 0) 
                        {
                            if (ValidateDocument(training_material)) 
                            {
                                var formdata = new FormData();
                                formdata.append('tm_token'         , tm_token);
                                formdata.append('doc_nm'           , doc_nm);
                                formdata.append('tm_img'           , tm_img);
                                formdata.append('training_material', training_material);
                                formdata.append('training_descp'   , training_descp);

                                $.ajax({
                                    url: "Easylearn/Classroom_Controller/add_tm",
                                    data: formdata,
                                    type: "POST",
                                    contentType: false,
                                    processData: false,
                                    success: function (response) 
                                    {
                                        response = JSON.parse(response);
                                        if (response.data == 'TRUE') 
                                        {
                                            Swal.fire({
                                                icon: "success",
                                                title: "Added Succesfully",
                                            }).then((result) => {
                                                location.reload();
                                            });
                                        } 
                                        else 
                                        {
                                            Swal.fire({
                                                icon: "error",
                                                title: "Oops...",
                                                text: "Something went wrong!",
                                            }).then((result) => {
                                                //location.reload();
                                            });
                                        }
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
                            } 
                            else 
                            {
                                $('.check-training_material').removeClass('d-none');
                            }
                        }
                        else 
                        {
                            $('.check-training_material').removeClass('d-none');
                        }
                    } 
                    else 
                    {
                        $('.check-tm_img').text('').removeClass('d-none');
                    }
                } 
                else 
                {
                    $('.check-tm_img').removeClass('d-none');
                }
            } 
            else 
            {
                $('.check-doc_nm').removeClass('d-none');
            }
        });

        $('#tm_img').on('change', function () 
        {
            if ($(this).val().trim() != '') 
            {
                $('.check-tm_img').addClass('d-none');

            } 
            else 
            {
                $('.check-tm_img').removeClass('d-none');
            }
        });

        $('#training_material').on('change', function () {
            if ($(this).val().trim() != '') 
            {
                $('.check-training_material').addClass('d-none');
            } 
            else 
            {
                $('.check-training_material').removeClass('d-none');
            }
        });

        $("#add_tm_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
        });

        $(".close").on("click", function () {
            $(".check-doc_nm").addClass("d-none");
            $(".check-tm_img").addClass("d-none");
            $(".check-training_material").addClass("d-none");
        });

        $("#edit_doc_nm").on("input", function () {
            var name = $(this).val().trim();
            if (name == null || name == "") 
            {
                $(".check-edit_doc_nm").removeClass("d-none");
            }
            else
            {
                if (ValidateName(name)) 
                {
                    $(".check-edit_doc_nm").addClass("d-none");
                } 
                else 
                {
                    $(".check-edit_doc_nm").removeClass("d-none");
                }
            }
        });

        //Edit Training Material
        $('#edit_tm_form').on('submit', function (e) {

            e.preventDefault();
            var edit_tm_token     = $('#edit_tm_token').val().trim();
            var id                = $('#tm_id').val().trim();
            var doc_nm            = $('#edit_doc_nm').val().trim();
            var tm_img            = document.getElementById('edit_tm_img').files[0];
            var training_material = document.getElementById('edit_training_material').files[0];
            var training_descp    = $('#edit_training_descp').val().trim();
            var errors            = [];

            var formdata = new FormData();

            if (document.getElementById('edit_tm_img').files.length > 0) 
            {
                if (ValidateImage(tm_img)) 
                {
                    $('.check-edit_tm_img').addClass('d-none');
                    formdata.append('tm_img', tm_img);
                } 
                else 
                {
                    $('.check-edit_tm_img').removeClass('d-none');
                    errors.push('yes');
                }
            }

            if (document.getElementById('edit_training_material').files.length > 0) 
            {
                if (ValidateDocument(training_material)) 
                {
                    $('.check-edit_training_material').addClass('d-none');
                    formdata.append('training_material', training_material);

                } 
                else 
                {
                    $('.check-edit_training_material').removeClass('d-none');
                    errors.push('yes');
                }
            }

            formdata.append('edit_tm_token' , edit_tm_token);
            formdata.append('doc_nm'        , doc_nm);
            formdata.append('training_descp', training_descp);
            formdata.append('tm_id'         , id);

            if (doc_nm.trim() != '') 
            {
                if (errors.length == 0) 
                {
                    $.ajax({
                        url: "Easylearn/Classroom_Controller/edit_tm",
                        data: formdata,
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: function (response) 
                        {
                            response = JSON.parse(response);

                            if (response.data == 'TRUE') 
                            {
                                Swal.fire({
                                    icon: "success",
                                    title: "Updated Succesfully",
                                }).then((result) => {
                                    location.reload();
                                });
                            } 
                            else 
                            {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                }).then((result) => {
                                    // location.reload();
                                });
                            }
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
                }
            } 
            else 
            {
                $('.check-doc_nm').text('').append('Document Name Required! ').removeClass('d-none');
            }
        });

        $('#edit_doc_nm').on('keyup', function () 
        {
            if ($(this).val().trim() != '') 
            {
                $('.check-edit_doc_nm').addClass('d-none');
            } 
            else 
            {
                $('.check-edit_doc_nm').text('').append(error_icon + ' Document Name Required! ').removeClass('d-none');
            }
        });

        $('#edit_training_material').on('change', function () {
            if ($(this).val().trim() != '') 
            {
                $('.check-edit_training_material').addClass('d-none');
            } 
            else 
            {
                $('.check-edit_training_material').text('').append(error_icon + ' Document Required! ').removeClass('d-none');
            }
        });

        $(".close").on("click", function () {
            $(".check-edit_doc_nm").addClass("d-none");
            $(".check-edit_training_material").addClass("d-none");
        });

        $("#edit_tm_form").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
        });

        //Delete Training Material
        $('#del_tm').on('click', function () {
            var id       = $('#tm_id').val().trim();

            var formdata = new FormData();
            formdata.append('id', id);

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
                    $.ajax({
                        url: "Easylearn/Classroom_Controller/del_tm",
                        data: formdata,
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: function (response) 
                        {
                            response = JSON.parse(response);
                            if (response.data == 'TRUE') 
                            {
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted Succesfully",
                                }).then((result) => {
                                    location.reload();
                                });
                            } 
                            else 
                            {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
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
                }
            });
        });
    }

    if (location.pathname.split('/').slice(-1)[0] == 'addStudents') {

        $('.dropify').dropify();
        $('#Single_StudentContactNo, #Single_ParentContactNo').intlTelInput();

        $("#SingleStudentDOB").datepicker({
            format: 'dd-mm-yyyy',
            endDate: '-5y',
            orientation: "bottom right",
        });

        $("#SingleStudentDOB").on("change", function () {
            var dob = $(this).datepicker('getDate');
            var dateString = new Date();
            if (dob <= dateString) 
            {
                $(".check-StudentDob").addClass("d-none");
            } 
            else 
            {
                $(".check-StudentDob").removeClass("d-none");
                $("#dateofbirth").val("");
            }
        });

        //Name Validations
        $("#Single_StudentName").on("keyup", function () {
            var name = $(this).val().trim();

            if (name == null || name == "") {
                $(".check-StudentName").removeClass("d-none");
            } 
            else 
            {
                if (ValidateName(name)) 
                {
                    $(".check-StudentName").addClass("d-none");
                } 
                else 
                {
                    $(".check-StudentName").removeClass("d-none");
                }
            }
        });

        //Nationality Validations
        $("#Single_StudentNationality").on("keyup", function () {
            var name = $(this).val().trim();

            if (name == null || name == "") 
            {
                $(".check-StudentNationality").removeClass("d-none");
            } 
            else 
            {
                if (ValidateName(name)) 
                {
                    $(".check-StudentNationality").addClass("d-none");
                } 
                else 
                {
                    $(".check-StudentNationality").removeClass("d-none");
                }
            }
        });

        //Contact Number
        $("#Single_StudentContactNo").on("keyup", function () {
            
            if ($("#Single_StudentContactNo").intlTelInput("isValidNumber")) 
            {
                $(".check-StudentContactNo").addClass("d-none");
            } 
            else 
            {
                $(".check-StudentContactNo").removeClass("d-none");
            }
        });

        //Parent Name
        $("#Single_ParentName").on("keyup", function () {
            var name = $(this).val().trim();

            if (name == null || name == "") 
            {
                $(".check-ParentName").removeClass("d-none");
            } 
            else 
            {
                if (ValidateName(name)) 
                {
                    $(".check-ParentName").addClass("d-none");
                } 
                else 
                {
                    $(".check-ParentName").removeClass("d-none");
                }
            }
        });

        //Contact Number
        $("#Single_ParentContactNo").on("keyup", function () {

            if ($("#Single_ParentContactNo").intlTelInput("isValidNumber")) {
                $(".check-ParentContact").addClass("d-none");
            } 
            else 
            {
                $(".check-ParentContact").removeClass("d-none");
            }
        });

        $("#Single_StudentEmailID").on("keyup", function () {
            var StudentEmailID = $("#Single_StudentEmailID").val().trim();

            if(validateEmail(StudentEmailID))
            {
                formdata = new FormData();
                formdata.append("email", StudentEmailID);

                $.ajax({
                    url: "Easylearn/Register_Controller/check_email",
                    data: formdata,
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function (response) 
                    {
                        var response = JSON.parse(response);
                        if (response.data == "TRUE") 
                        {
                            $(".check-StudentEmailID").removeClass("d-none");
                            $(".check-StudentEmailID").addClass("bg-danger");
                            $(".check-StudentEmailID").removeClass("bg-success");
                            $(".check-StudentEmailID").html(
                                '<i class="fas fa-times-circle"></i> Email not available'
                            );
                        } 
                        else 
                        {
                            $(".check-StudentEmailID").removeClass("d-none");
                            $(".check-StudentEmailID").removeClass("bg-danger");
                            $(".check-StudentEmailID").addClass("bg-success");
                            $(".check-StudentEmailID").html(
                                '<i class="fas fa-check-circle"></i> Email available'
                            );
                        }
                    },
                    error: function (response) 
                    {
                        console.log("Error: " + response);
                    },
                });
            }
            else
            {
                $(".check-StudentEmailID").removeClass("d-none");
                $(".check-StudentEmailID").addClass("bg-danger");
                $(".check-StudentEmailID").removeClass("bg-success");
                $(".check-StudentEmailID").html(
                    '<i class="fas fa-times-circle"></i> Enter Valid Email'
                );
            }
        });

        $('#Single_StudentRollNo').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-StudentRollNo').removeClass('d-none');
            } 
            else 
            {
                $('.check-StudentRollNo').addClass('d-none');
            }
        });

        $('#Single_StudentBloodGroup').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-StudentBloodgroup').removeClass('d-none');
            } 
            else 
            {
                $('.check-StudentBloodgroup').addClass('d-none');
            }
        });

        $('#Single_ParentEmailID').on('keyup', function () {
            if (validateEmail($(this).val().trim())) 
            {
                $('.check-ParentEmailID').addClass('d-none');
            } 
            else 
            {
                $('.check-ParentEmailID').addClass('d-none');
            }
        });

        $('#Single_ParentOccupation').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-ParentOccupation').removeClass('d-none');
            } 
            else 
            {
                $('.check-ParentOccupation').addClass('d-none');
            }
        });

        $('input[name=AllGender]').on('click', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-StudentGender').removeClass('d-none');
            } 
            else 
            {
                $('.check-StudentGender').addClass('d-none');
            }
        });

        //Add Student
        $('#Single_AddStudent').on('submit', function (e) {
            e.preventDefault();

            var student_add_token  = $('#student_add_token').val().trim();
            var studentName        = $("#Single_StudentName").val().trim();
            var AllGender          = $("input[name=AllGender]:checked").val().trim();
            var studentDob         = convertstrtodate($('#SingleStudentDOB').datepicker('getDate'));
            var studentNationality = $("#Single_StudentNationality").val().trim();
            var studentEmailID     = $("#Single_StudentEmailID").val().trim();
            var studentDialCode    = $("#Single_StudentContactNo").intlTelInput("getNumber");
            var studentRollNo      = $("#Single_StudentRollNo").val().trim();
            var studentBloodGroup  = $("#Single_StudentBloodGroup").val().trim();
            var studentImage       = document.getElementById('Single_Studentimage').files[0];
            var studentDescription = $("#Single_StudentDescription").val().trim();
            var parentName         = $("#Single_ParentName").val().trim();
            var parentEmailID      = $("#Single_ParentEmailID").val().trim();
            var ParentContactNo    = $("#Single_ParentContactNo").intlTelInput("getNumber");
            var parentOccupation   = $("#Single_ParentOccupation").val().trim();
            var parentAddress      = $("#Single_ParentAddress").val().trim();

            if (studentName != '') 
            {
                if (AllGender != '' && AllGender != undefined) 
                {
                    if (studentDob != '' && studentDob != '1970-01-01') 
                    {
                        if (studentNationality != '') 
                        {
                            if (validateEmail(studentEmailID)) 
                            {
                                if ($("#Single_StudentContactNo").intlTelInput("isValidNumber")) 
                                {
                                    if (studentRollNo != '') 
                                    {
                                        if (studentBloodGroup != '') 
                                        {
                                            if(document.getElementById('Single_Studentimage').files.length > 0 && ValidateImage(studentImage))
                                            {
                                                if (parentName != '') 
                                                {
                                                    if (validateEmail(parentEmailID)) 
                                                    {
                                                        if ($("#Single_ParentContactNo").intlTelInput("isValidNumber")) 
                                                        {
                                                            if (parentOccupation != '') 
                                                            {
                                                                if (parentAddress != '') 
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
                                                                            $("#loader").css("display", 'block');

                                                                            formdata = new FormData();
                                                                            formdata.append('student_add_token'       , student_add_token);
                                                                            formdata.append('studentName'             , studentName);
                                                                            formdata.append('studentGender'           , AllGender);
                                                                            formdata.append('studentDob'              , studentDob);
                                                                            formdata.append('studentNationality'      , studentNationality);
                                                                            formdata.append('studentEmailID'          , studentEmailID);
                                                                            formdata.append('studentContactNo'        , studentDialCode);
                                                                            formdata.append('studentRollNo'           , studentRollNo);
                                                                            formdata.append('studentBloodGroup'       , studentBloodGroup);
                                                                            formdata.append('studentImage'            , studentImage);
                                                                            formdata.append('studentDescription'      , studentDescription);
                                                                            formdata.append('studentParentName'       , parentName);
                                                                            formdata.append('studentParentEmailID'    , parentEmailID);
                                                                            formdata.append('studentParentContactNo'  , ParentContactNo);
                                                                            formdata.append('studentParentOccupation' , parentOccupation);
                                                                            formdata.append('studentParentAddress'    , parentAddress);

                                                                            $.ajax({
                                                                                url: "Easylearn/Classroom_Controller/Add_Student",
                                                                                data: formdata,
                                                                                type: "POST",
                                                                                contentType: false,
                                                                                processData: false,
                                                                                success: function (response) 
                                                                                {
                                                                                    $("#loader").css("display", 'none');

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
                                                                                            // location.reload();
                                                                                        });
                                                                                    }
                                                                                },
                                                                                error: function (response) 
                                                                                {
                                                                                    $("#loader").css("display", 'none');

                                                                                    Swal.fire({
                                                                                        icon: "error",
                                                                                        title: "Oops...",
                                                                                        text: 'Something Went Wrong',
                                                                                    }).then((result) => {
                                                                                        // location.reload();
                                                                                    });
                                                                                },
                                                                            });

                                                                        } 
                                                                    });
                                                                } 
                                                                else 
                                                                {
                                                                    $('.check-ParentAddress').removeClass('d-none');
                                                                }
                                                            } 
                                                            else 
                                                            {
                                                                $('.check-ParentOccupation').removeClass('d-none');
                                                            }
                                                        } 
                                                        else 
                                                        {
                                                            $('.check-ParentContact').removeClass('d-none');
                                                        }
                                                    } 
                                                    else 
                                                    {
                                                        $('.check-ParentEmailID').removeClass('d-none');
                                                    }
                                                } 
                                                else 
                                                {
                                                    $('.check-ParentName').removeClass('d-none');
                                                }
                                            }
                                            else
                                            {
                                                $('.check-Single_Studentimage').removeClass('d-none');
                                            }
                                        } 
                                        else 
                                        {
                                            $('.check-StudentBloodgroup').removeClass('d-none');
                                        }
                                    } 
                                    else 
                                    {
                                        $('.check-StudentRollNo').removeClass('d-none');
                                    }
                                } 
                                else 
                                {
                                    $('.check-StudentContactNo').removeClass('d-none');
                                }
                            } 
                            else 
                            {
                                $('.check-StudentEmailID').removeClass('d-none');
                                $(".check-StudentEmailID").addClass("bg-danger");
                                $(".check-StudentEmailID").removeClass("bg-success");
                            }
                        } 
                        else 
                        {
                            $('.check-StudentNationality').removeClass('d-none');
                        }
                    } 
                    else 
                    {
                        $('.check-StudentDob').removeClass('d-none');
                    }
                } 
                else 
                {
                    $('.check-StudentGender').removeClass('d-none');
                }
            } 
            else 
            {
                $('.check-StudentName').removeClass('d-none');
            }
        });

        $('#Multiple_StudentAdd').on('click', function (e) {
            e.preventDefault();

            var multi_data_file = document.getElementById("Multiple_Student").files[0];

            var formdata = new FormData();
            formdata.append('multi_data_file', multi_data_file);

            $.ajax({
                url: "HTMLtoCSV/multi_student_insert",
                data: formdata,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (response) 
                {
                    resp = JSON.parse(response);

                    if (resp.data > 0) 
                    {
                        if(resp.not_insert.length > 1)
                        {
                            let csvContent = "data:text/csv;charset=utf-8," + resp.not_insert.map(e => e.join(",")).join("\n");

                            var encodedUri = encodeURI(csvContent);
                            window.open(encodedUri);
                        }

                        Swal.fire({
                            icon: "success",
                            title: resp.data + " Students added Successfully",
                            text: "Please check your mail for further details",
                        }).then((result) => {
                            location.reload();
                        });
                    } 
                    else 
                    {
                        if(resp.not_insert.length > 1)
                        {
                            let csvContent = "data:text/csv;charset=utf-8," + resp.not_insert.map(e => e.join(",")).join("\n");

                            var encodedUri = encodeURI(csvContent);
                            window.open(encodedUri);
                        }
                        
                        Swal.fire({
                            icon: "error",
                            title: "oops!..",
                            text: resp.data,
                        });
                    }
                },
                error: function (response) {
                    console.log("Error: " + response);
                }
            });
        });
    }

    if (location.pathname.split('/').slice(-1)[0] == 'manageClassroom') 
    {
        $('#classroom_phone').intlTelInput();

        //ValidateName
        function ValidateName1(name) {
            if (name.length > 3 && name.length < 50) {
                var re = /^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/;
                return re.test(name);
            } else {
                return false;
            }
        }


        //Classname Validations
        $("#classroom_name").on("input", function () {
          var name = $(this).val().trim();

          if (name == null || name == "") {
            $(".check_classroom_name").removeClass("d-none");
          } else {
            if (ValidateName1(name)) {
              $(".check_classroom_name").addClass("d-none");
            } else {
              $(".check_classroom_name").removeClass("d-none");
            }
          }
        });

        //Classroom Check Image
        $("#classroom_image").on("change", function () {
            var file = this.files[0];

            if (ValidateImage(file)) {
              $(".check_classroom_image").addClass("d-none");
            } else {
              $(".check_classroom_image").removeClass("d-none");
            }
        });

        //Classroom Check Phone Number
        $("#classroom_phone").on("keyup", function () {
            var number = $("#classroom_phone").intlTelInput("getNumber");

            if (ValidatePhone(number)) {
              $(".check_classroom_phone").addClass("d-none");
            } else {
              $(".check_classroom_phone").removeClass("d-none");
            }
        });

        //Classname Administrator
        $("#administrator_name").on("input", function () {
          var name = $(this).val().trim();

          if (name == null || name == "") {
            $(".check_administrator_name").removeClass("d-none");
          } else {
            if (ValidateName1(name)) {
              $(".check_administrator_name").addClass("d-none");
            } else {
              $(".check_administrator_namee").removeClass("d-none");
            }
          }
        });

        $("#administrator_email").on("keyup", function () {
            var email = $(this).val().trim();
            if (validateEmail(email)) {
              $.ajax({
                url: "Easylearn/Register_Controller/check_email",
                data: {
                  email: email,
                },
                type: "POST",
                success: function (response) {
                  response = JSON.parse(response);

                  if (response.data == "TRUE") {
                    $(".check_administrator_email").removeClass("d-none");
                    $(".check_administrator_email").addClass("bg-danger");
                    $(".check_administrator_email").removeClass("bg-success");
                    $(".check_administrator_email").html(
                      '<i class="fas fa-times-circle"></i> Email not available'
                    );
                  } else {
                    $(".check_administrator_email").removeClass("d-none");
                    $(".check_administrator_email").removeClass("bg-danger");
                    $(".check_administrator_email").addClass("bg-success");
                    $(".check_administrator_email").html(
                      '<i class="fas fa-check-circle"></i> Email available'
                    );
                  }
                },
                error: function (response) {
                  console.log(response);
                },
              });
            } else {
              $(".check_administrator_email").removeClass("d-none");
              $(".check_administrator_email").addClass("bg-danger");
              $(".check_administrator_email").html(
                '<i class="fas fa-times-circle"></i> Invalid Email'
              );
            }
          });

        //Login Check Password
        $("#administrator_password").on("change", function () {
            var password = $("#administrator_password").val().trim();
            var confirm = $("#administrator_password").val().trim();

            if (ValidatePassword(password, confirm)) {
              $(".check_administrator_password").addClass("d-none");
            } else {
              $(".check_administrator_password").removeClass("d-none");
              $(".check_administrator_password").addClass("btn-danger");
              $(".check_administrator_password").html(
                '<i class="fas fa-times-circle"></i> Password length between 4 to 16'
              );
            }
        });




        $('#manage_classroom_form').on('submit', function (e) {
            e.preventDefault();
            var manage_classroom_form_token     = $('#manage_classroom_form_token').val().trim();
            var classroom_name                  = $('#classroom_name').val().trim();
            var classroom_image                 = document.getElementById('classroom_image').files[0];
            var classroom_phone                 = $("#classroom_phone").intlTelInput("getNumber");
            var administrator_name              = $('#administrator_name').val().trim();
            var administrator_email             = $('#administrator_email').val().trim();
            var administrator_password          = $('#administrator_password').val().trim();
            var classroom_descp                 = $('#classroom_descp').val().trim();
            
            if(classroom_name != '') {
                if(classroom_image != ''){
                    if(classroom_phone != ''){
                        if(administrator_name != ''){
                            if(administrator_email != ''){
                                if(administrator_password != ''){
                                    if(classroom_descp != ''){

                                        $('.check_classroom_descp').addClass('d-none');
                                        Swal.fire({
                                          title: "Are you sure?",
                                          text: "You want to proceed further!",
                                          icon: "warning",
                                          showCancelButton: true,
                                          confirmButtonColor: "#3085d6",
                                          cancelButtonColor: "#d33",
                                          confirmButtonText: "Yes",
                                        }).then((result) => {
                                          if (result.isConfirmed) {
                                            $("#loader").css("display", 'block');

                                            formdata = new FormData();
                                            formdata.append('manage_classroom_form_token'   ,manage_classroom_form_token);
                                            formdata.append('classroom_name'                ,classroom_name);
                                            formdata.append('classroom_image'               ,classroom_image);
                                            formdata.append('classroom_phone'               ,classroom_phone);
                                            formdata.append('administrator_name'            ,administrator_name);
                                            formdata.append('administrator_email'           ,administrator_email);
                                            formdata.append('administrator_password'        ,administrator_password);
                                            formdata.append('classroom_descp'               ,classroom_descp);
                                            $.ajax({
                                              url: "Easylearn/Classroom_Controller/Add_Classroom",
                                              data: formdata,
                                              type: "POST",
                                              contentType: false,
                                              processData: false,
                                              success: function (response) {

                                                $("#loader").css("display", 'none');

                                                response = JSON.parse(response);
                                                setTimeout(function () {
                                                  if (response.data == "TRUE") {
                                                    Swal.fire({
                                                      icon: "success",
                                                      title: "Successfully Registered",
                                                      text: "Please check your mail for further details",
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
                                                }, 1000);
                                              },
                                              error: function (response) {
                                                $("#loader").css("display", 'none');

                                                Swal.fire({
                                                  icon: "error",
                                                  title: "Oops...",
                                                  text: 'data not gone',
                                                }).then((result) => {
                                                  // location.reload();
                                                });
                                              },
                                            });
                                        }
                                        });

                                    }
                                    else{
                                        $('.check_classroom_descp').removeClass('d-none');
                                    }
                                }
                                else{
                                    $('.check_administrator_password').removeClass('d-none');
                                }
                            }
                            else{
                                $('.check_administrator_email').removeClass('d-none');
                            }
                        }
                        else{
                            $('.check_administrator_name').removeClass('d-none');
                        }
                    }
                    else{
                        $('.check_classroom_phone').removeClass('d-none');
                    }
                }
                else{
                    $('.check_classroom_image').removeClass('d-none');
                }
            }
            else{
                $('.check_classroom_name').removeClass('d-none');
            }
        });

        $("#classroom_list").DataTable({
            
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
                url: "Easylearn/Classroom_Controller/get_classroom",
                type: "POST",
                dataSrc: function (json) {
                    if(json.data!='No Data'){
                        return json.data;
                    }
                    else{
                        return {};
                    }
                    
                },
            },
            rowId: "unique_id",
            columns: [
                { data: "unique_id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                { data: "classroom_name" },
                { data: "administration_name" },
                { data: "administration_email" },
                { data: "classroom_description" },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<a class="waves-effect waves-light btn btn-rounded btn-primary d-sm-inline-flex mb-5" href="assignClassroom?id=${row.unique_id}"><i class="fas fa-user-plus align-self-center"></i> &nbsp;Students</a>`;
                }
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<a class="waves-effect waves-light btn btn-rounded btn-primary d-sm-inline-flex mb-5" href="assignClassroomcourse?id=${row.unique_id}"><i class="fas fa-user-plus align-self-center"></i> &nbsp;Courses</a>`;
                },   
            },  
            ]
        });

        $('#classroom_list tbody').on('dblclick', 'tr', function () {
            var id = $(this).attr('id');
            final_cls(id);
        });

        function final_cls(row_id) {
            $("#edit_classroom_modal").modal("show");
            $.ajax({
                url: "Easylearn/Classroom_Controller/get_classroom_details",
                type: "POST",
                data: {
                    id: row_id
                },
                success: function (response) {
                    response = JSON.parse(response);
                    //console.log(response);
                    $(".cls_name").text(response.data.classroom_name);
                    $('.delete-classroom').attr('data-id', response.data.unique_id);
                    $('.save-classroom').attr('data-id', response.data.unique_id);
                    $(".adm_name").text(response.data.administration_name);
                    $(".cls_email").text(response.data.administration_email);
                    $(".cls_phone").text(response.data.phone_number);
                    $(".cls_desc").text(response.data.classroom_description);
                    $("#cls_name").val(response.data.classroom_name);
                    $("#adm_name").val(response.data.administration_name);
                    $("#cls_phone").val(response.data.phone_number);
                    $("#cls_desc").val(response.data.classroom_description);
                    $("#cls_img").attr("src", response.data.classroom_image);
                    $(".edit-classroom").attr('data-id', response.data.unique_id);
                },
                error: function (response) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        location.reload();
                    });
                },
            });
        }

        $('.edit-classroom').on('click', function () {
           hide_class_elements()
        });

         $('.cancel-classroom').on('click', function () {
           show_class_elements()
        });

        function hide_class_elements() {
            $(".cancel-classroom").parent().removeClass("d-none");
            $(".edit-classroom").addClass("d-none");
            $(".cls_span").addClass("d-none");
            $(".input_class").removeClass("d-none");
            $("#cls_phone").intlTelInput();
        }

        function show_class_elements() {
            $(".cancel-classroom").parent().addClass("d-none");
            $(".edit-classroom").removeClass("d-none");
            $(".cls_span").removeClass("d-none");
            $(".input_class").addClass("d-none");
            $("#cls_phone").intlTelInput('destroy');
        }

        $("#cls_phone").on("keyup", function () {
          if($("#cls_phone").intlTelInput("isValidNumber")){
            $('.check_edit_cls_phone').addClass('d-none');
          }
          else{
            $('.check_edit_cls_phone').removeClass('d-none');
          }
        });

        //Classroom Check Image
        $("#edit_classroom_img").on("change", function () {
            var file = this.files[0];

            if (ValidateImage(file)) {
              $(".check_edit_cls_image").addClass("d-none");
            } else {
              $(".check_edit_cls_image").removeClass("d-none");
            }
        });

        //Check Edit Classname Validations
        $("#cls_name").on("input", function () {
          var name = $(this).val().trim();

          if (name == null || name == "") {
            $(".check_edit_cls_name").removeClass("d-none");
          } else {
            if (ValidateName1(name)) {
              $(".check_edit_cls_name").addClass("d-none");
            } else {
              $(".check_edit_cls_name").removeClass("d-none");
            }
          }
        });

        //Check Edit Classname Administrator
        $("#adm_name").on("input", function () {
          var name = $(this).val().trim();

          if (name == null || name == "") {
            $(".check_edit_adm_name").removeClass("d-none");
          } else {
            if (ValidateName1(name)) {
              $(".check_edit_adm_name").addClass("d-none");
            } else {
              $(".check_edit_adm_name").removeClass("d-none");
            }
          }
        });

        $('#edit_classroom_modal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
            $('.check_edit_cls_desc').addClass('d-none');
            $('.check_edit_cls_phone').addClass('d-none');
            $('.check_edit_adm_name').addClass('d-none');
            $('.check_edit_cls_name').addClass('d-none');
            $(".check_edit_cls_image").addClass("d-none");  
        });

        $('#edit_classroom').on('submit', function (e) {
            e.preventDefault();
            var error=[];
            var formdata                = new FormData();
            var id                      = $('.save-classroom').attr('data-id');
            var edit_classroom_token    = $('#edit_classroom_token').val().trim();
            var cls_name                = $('#cls_name').val().trim();
            var adm_name                = $('#adm_name').val().trim();
            var cls_img                 = document.getElementById('edit_classroom_img').files[0];
            var cls_phone               = $("#cls_phone").intlTelInput("getNumber");
            var cls_desc                = $('#cls_desc').val().trim();

            if (document.getElementById('edit_classroom_img').files.length > 0) {
                if (ValidateImage(cls_img)) {
                    formdata.append('cls_img', cls_img);
                }
                else{
                    error.push('yes');
                    $(".check_edit_cls_image").removeClass("d-none");
                }
            }

            if (cls_name != '') {
                if (adm_name != '') {
                    if (cls_phone != '') {
                        if(cls_desc != ''){
                            if(error.length == 0){
                            formdata.append('id'                    , id);
                            formdata.append('edit_classroom_token'  , edit_classroom_token);
                            formdata.append('cls_name'              , cls_name);
                            formdata.append('adm_name'              , adm_name);
                            formdata.append('cls_phone'             , cls_phone);
                            formdata.append('cls_desc'              , cls_desc);
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You want to Update Classroom",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: "Easylearn/Classroom_Controller/edit_classroom",
                                        data: formdata,
                                        type: "POST",
                                        contentType: false,
                                        processData: false,
                                        success: function (response) {

                                            response = JSON.parse(response);
                                            //console.log(response);

                                            if (response["data"] == "TRUE") {
                                                Swal.fire({
                                                    icon: "success",
                                                    title: "Classroom Updated Successfully!",
                                                    showConfirmButton: false,
                                                    timer: 1500,
                                                }).then((result) => {
                                                    location.href = "manageClassroom";
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
                                            setTimeout(function () {
                                                $(".preloader").fadeOut();

                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Oops...",
                                                    text: "Something went wrong!",
                                                }).then((result) => {
                                                    // location.reload();
                                                });
                                            }, 1000);
                                        }
                                    });
                                }
                            });
                        }
                        }
                        else
                        {
                            $('.check_edit_cls_desc').removeClass('d-none');
                            $('#cls_desc').focus();
                        }
                    }
                    else
                    {
                        
                        $('.check_edit_cls_phone').removeClass('d-none');
                        $('#cls_phone').focus();
                    }
                }
                else
                {
                   
                    $('.check_edit_adm_name').removeClass('d-none');
                    $('#adm_name').focus();
                }
            }
            else
            {
                $('.check_edit_cls_name').removeClass('d-none');
                $('#cls_name').focus();
            }

        });

        $(".delete-classroom").on("click", function () {
            Swal.fire({
                title: "Are you sure?",
                text: "You want to Delete Classroom!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).attr('data-id');
                    $.ajax({
                        url: 'Easylearn/Classroom_Controller/delete_classroom',
                        type: 'POST',
                        data: {
                            'id': id
                        },
                        success: function (response) {
                            response = JSON.parse(response);
                            setTimeout(function () {
                                if (response.data == "TRUE") {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Successfully Deleted",
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    $(".loader").addClass("d-none");
                                    $(".register_loader").addClass("d-none");
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: response.data,
                                    }).then((result) => {
                                        // location.reload();
                                    });
                                }
                            }, 1000);
                            
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: 'Something Wents Wrong',
                    }).then((result) => {
                        // location.reload();
                    });

                }
            });
        }); 
    }

    if (location.pathname.split('/').slice(-1)[0] == 'assignClassroom') 
    {
        $('.dropify').dropify();
        var unique_id = (location.search.split(name + '=')[1] || '').split('&')[0];

        assignclassroom_list = $("#assignclassroom_list").DataTable({
            rowReorder: true,
            select: {
                style: 'multi'
            },
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Classroom_Controller/get_all_students_for_classroom",
                type: "POST",
                dataSrc: function (json) 
                {
                    if (json.data != 'FALSE') 
                    {
                        return json.data;
                    } 
                    else 
                    {
                        return json.data = {};
                    }
                },
            },
            rowId: "id",
            // rowDefs:[{className: "assignbatch_list"}],
            columns: [{
                    data: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "username"
                },
                {
                    data: "email"
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('assignclassroom_list');
            },

        });

        $('.save-assign-classroom').on('click', function () {
            var selected_id = [];
            var selected = assignclassroom_list.rows('.selected').data();

            for (let i = 0; i < selected.length; i++) 
            {
                selected_id.push(selected[i]['id']);
            }

            if (selected_id.length == 0) 
            {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Select the Student",
                });
            } 
            else 
            {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Update Classroom",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $('#loader').css('display', 'block');

                        var formdata = new FormData();
                        formdata.append('unique_id', unique_id);
                        formdata.append('selected_id', JSON.stringify(selected_id));

                        $.ajax({
                            url: "Easylearn/Classroom_Controller/assign_classroom_students",
                            data: formdata,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function (response) 
                            {
                                $('#loader').css('display', 'none');
                                response = JSON.parse(response);

                                if (response["data"] > 0) 
                                {
                                    Swal.fire({
                                        icon: "success",
                                        title: response["data"] + " Assigned Successfully!",
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
                                        // location.reload();
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
        });

        var assigned_classroom_member = $("#assignclassroom_memberlist").DataTable({
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Classroom_Controller/assigned_classroom_memberlist",
                type: "POST",
                data: {
                    unique_id: unique_id
                },
                dataSrc: function (json) {
                    if (json.data != 'FALSE') 
                    {
                        return json.data;
                    } 
                    else 
                    {
                        return json.data = [];
                    }
                },
            },
            rowId: "id",
            columns: [{
                    data: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "username"
                },
                {
                    data: "email"
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<a href="#" class="waves-effect waves-light btn btn-rounded btn-danger delete_assignmember_classroom mb-5" data-id="${row.id}"><i class="fas fa-trash-alt"></i></a>`;
                    },
                },

            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('assignclassroom_memberlist');
            },

        });

        $(document).on('click', '.delete_assignmember_classroom', function () {
            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Remove Student",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $.ajax({
                        url: 'Easylearn/Classroom_Controller/delete_assignmember_classroom',
                        type: 'POST',
                        data: 
                        {
                            'id': id,
                        },
                        success: function (response) 
                        {
                            assigned_classroom_member.row("#" + id).remove().draw();
                        },
                        error: function (response) 
                        {
                            console.log(response);
                        }
                    });
                }
            });
        });

        //Assign CSV Student Submit
        $('#csv_assign_student_classroom_submit').on('click', function (e) {
            e.preventDefault();

            var multi_data_file = document.getElementById("csv_assign_student_classroom").files[0];
            var unique_id       = (location.search.split(name + '=')[1] || '').split('&')[0];

            var formdata = new FormData();
            formdata.append('multi_data_file', multi_data_file);
            formdata.append('unique_id'      , unique_id);

            $('#loader').css('display', 'block');
            $.ajax({
                url: "HTMLtoCSV/csv_assign_student_classroom",
                data: formdata,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (response) 
                {
                    $('#loader').css('display', 'none');
                    resp = JSON.parse(response);

                    if (resp.data > 0) 
                    {
                        if(resp.not_inserted.length > 1)
                        {
                            let csvContent = "data:text/csv;charset=utf-8," + resp.not_inserted.map(e => e.join(",")).join("\n");

                            var encodedUri = encodeURI(csvContent);
                            window.open(encodedUri);
                        }

                        Swal.fire({
                            icon: "success",
                            title: resp.data + " Students added Successfully",
                        }).then((result) => {
                            location.reload();
                        });
                    } 
                    else 
                    {
                        if(resp.not_inserted.length > 1)
                        {
                            let csvContent = "data:text/csv;charset=utf-8," + resp.not_inserted.map(e => e.join(",")).join("\n");

                            var encodedUri = encodeURI(csvContent);
                            window.open(encodedUri);
                        }
                        
                        Swal.fire({
                            icon: "error",
                            title: "oops!..",
                            text: resp.data,
                        });
                    }
                },
                error: function (response) 
                {
                    $('#loader').css('display', 'none');
                    console.log("Error: " + response);
                }
            });
        });
    }

    if (location.pathname.split('/').slice(-1)[0] == 'assignClassroomcourse') 
    {
        var unique_id = (location.search.split(name + '=')[1] || '').split('&')[0];

        assignclassroomcourse_list = $("#assignclassroomcourse_list").DataTable({
            rowReorder: true,
            select: {
                style: 'multi'
            },
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Classroom_Controller/get_all_courses_for_classroom",
                type: "POST",
                data : {
                    'unique_id' : unique_id
                },
                dataSrc: function (json) 
                {
                    if (json.data != 'FALSE') 
                    {
                        return json.data;
                    } 
                    else 
                    {
                        return json.data = {};
                    }
                },
            },
            rowId: "id",
            // rowDefs:[{className: "assignbatch_list"}],
            columns: [{
                    data: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "course_name"
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('assignclassroomcourse_list');
            },

        });

        $('.save-assign-classroom-course').on('click', function () {
            var selected_id = [];
            var selected = assignclassroomcourse_list.rows('.selected').data();

            for (let i = 0; i < selected.length; i++) 
            {
                selected_id.push(selected[i]['id']);
            }

            if (selected_id.length == 0) 
            {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Select the Course",
                });
            } 
            else 
            {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Update Classroom",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $('#loader').css('display', 'block');

                        var formdata = new FormData();
                        formdata.append('unique_id', unique_id);
                        formdata.append('selected_id', JSON.stringify(selected_id));

                        $.ajax({
                            url: "Easylearn/Classroom_Controller/assign_classroom_course",
                            data: formdata,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function (response) 
                            {
                                $('#loader').css('display', 'none');
                                response = JSON.parse(response);

                                if (response["data"] > 0) 
                                {
                                    Swal.fire({
                                        icon: "success",
                                        title: response["data"] + " Assigned Successfully!",
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
                                        // location.reload();
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
        });

        var assigned_classroom_course = $("#assignclassroom_courselist").DataTable({
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Classroom_Controller/assigned_classroom_courselist",
                type: "POST",
                data: {
                    unique_id: unique_id
                },
                dataSrc: function (json) {
                    if (json.data != 'FALSE') 
                    {
                        return json.data;
                    } 
                    else 
                    {
                        return json.data = [];
                    }
                },
            },
            rowId: "id",
            columns: [{
                    data: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "course_name"
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<a href="#" class="waves-effect waves-light btn btn-rounded btn-danger delete_assigncourse_classroom mb-5" data-id="${row.id}"><i class="fas fa-trash-alt"></i></a>`;
                    },
                },

            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('assignclassroom_memberlist');
            },

        });

        $(document).on('click', '.delete_assigncourse_classroom', function () {
            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Remove Course",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $.ajax({
                        url: 'Easylearn/Classroom_Controller/delete_assigncourse_classroom',
                        type: 'POST',
                        data: 
                        {
                            'id': id,
                        },
                        success: function (response) 
                        {
                            assigned_classroom_course.row("#" + id).remove().draw();
                        },
                        error: function (response) 
                        {
                            console.log(response);
                        }
                    });
                }
            });
        });
    }

    if (location.pathname.split('/').slice(-1)[0] == 'manageAttendance') 
    {
        $("#attendance_list").DataTable({
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
                url: "Easylearn/Classroom_Controller/get_all_schedule_attendance_list",
                type: "POST",
                dataSrc: function (json) 
                {
                    if(json.data == 'False')
                    {
                        return {};
                    }
                    else
                    {
                        return json.data;
                    }
                },
            },
            rowId: "schedule_id",
            columns: [{
                    data: "schedule_id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "title"
                },
                {
                    data: "start_date"
                },
                {
                    data: "start_time"
                },
                {
                    data: "end_time"
                },
                {
                    data: "id"
                }
            ]
        });

        $('#attendance_list tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');

            location.href = "schedule_attendance?id=" + id;
        });
    }

    if (location.pathname.split('/').slice(-1)[0] == 'schedule_attendance') 
    {
        var unique_id = (location.search.split(name + '=')[1] || '').split('&')[0];

        $("#schedule_attendance_list").DataTable({
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
                url: "Easylearn/Classroom_Controller/get_schedule_attendance_list",
                type: "POST",
                data: {
                    unique_id: unique_id
                },
                dataSrc: function (json) 
                {
                    if(json.data == 'False')
                    {
                        return {};
                    }
                    else
                    {
                        return json.data;
                    }
                },
            },
            rowId: "id",
            columns: [{
                    data: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "username"
                },
                {
                    data: "email"
                },
                {
                    data: "permissions"
                },
                {
                    data: "time_min"
                },
            ]
        });

        var attendance_students_list = $("#attendance_students_list").DataTable({
            rowReorder: true,
            select: {
                style: 'multi'
            },
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Classroom_Controller/get_attendance_students",
                type: "POST",
                data: {
                    unique_id: unique_id
                },
                dataSrc: function (json) {
                    if (json.data != 'FALSE') 
                    {
                        return json.data;
                    }
                    else 
                    {
                        return json.data = {};
                    }
                },
            },
            rowId: "id",
            columns: [{
                    data: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "username"
                },
                {
                    data: "email"
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('attendance_students_list');
            },

        });

        $('#add_attendance').on('submit', function (event) {
            var attendance_token = $('#attendance_token').val().trim();
            var attendance_status = $('#attendance_status').val().trim();

            var selected_id = [];
            var selected = attendance_students_list.rows('.selected').data();

            for (let i = 0; i < selected.length; i++) {
                selected_id.push(selected[i]['id']);
            }

            if (selected_id.length == 0) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Select the Students",
                });
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Add Attendance",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {

                    if (result.isConfirmed) 
                    {
                        var formdata = new FormData();
                        formdata.append('unique_id', unique_id);
                        formdata.append('attendance_token', attendance_token);
                        formdata.append('attendance_status', attendance_status);
                        formdata.append('selected_id', JSON.stringify(selected_id));

                        $('#loader').css('display', 'block');

                        $.ajax({
                            url: "Easylearn/Classroom_Controller/add_attendance",
                            data: formdata,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function (response) 
                            {
                                response = JSON.parse(response);
                                $('#loader').css('display', 'none');

                                if (response["data"] > 0) 
                                {
                                    Swal.fire({
                                        icon: "success",
                                        title: response["data"] + " Added Successfully!",
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
                                        // location.reload();
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

            event.preventDefault();
        });

        $('#schedule_attendance_list tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');

            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete",
            }).then((result) => {

                if (result.isConfirmed) 
                {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Classroom_Controller/delete_schedule_attendance',
                        type: 'POST',
                        data: {
                            'id': id
                        },
                        success: function (response) 
                        {
                            $('#loader').css('display', 'none');
                            response = JSON.parse(response);

                            if (response.data == "TRUE") 
                            {
                                Swal.fire({
                                    icon: "success",
                                    title: "Successfully Deleted",
                                }).then((result) => {
                                    location.reload();
                                });
                            } 
                            else 
                            {
                                $('#loader').css('display', 'none');
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: response.data,
                                }).then((result) => {
                                    // location.reload();
                                });
                            }
                        },
                        error: function (response) 
                        {
                            $('#loader').css('display', 'none');
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.data,
                            }).then((result) => {
                                // location.reload();
                            });
                        }
                    });
                }
            });
        });
    }

    if (location.pathname.split('/').slice(-1)[0] == 'managelabinstance') 
    {
        $('#multiple_lab_instance').dropify();

        $.ajax({
            url: "Easylearn/Classroom_Controller/get_batch_users_byid",
            type: "POST",
            data : {
                id : $('#batch_name').val()
            },
            success: function (response) 
            {
                response = JSON.parse(response);

                if(response.data != 'FALSE')
                {
                    response.data.forEach(function (Index, i) {
                        $('#student_nm').append("<option value='" + response.data[i].id + "'> " + response.data[i].username + "&nbsp;(" + response.data[i].email + ") </option>");
                    });
                }
            },
            error: function (response) 
            {
                console.log(response);
            }
        });

        $('#lab_instance_name').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-lab_instance_name').removeClass('d-none');
            } 
            else 
            {
                $('.check-lab_instance_name').addClass('d-none');
            }
        });
    
        $('#lab_instance_ip').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-lab_instance_ip').removeClass('d-none');
            } 
            else 
            {
                $('.check-lab_instance_ip').addClass('d-none');
            }
        });

        $('#batch_name').on('change', function() {
            var id = $(this).val();

            $.ajax({
                url: "Easylearn/Classroom_Controller/get_batch_users_byid",
                type: "POST",
                data : {
                    id : id
                },
                success: function (response) 
                {
                    $('#student_nm').empty();
                    response = JSON.parse(response);
                    
                    if(response.data != 'FALSE')
                    {
                        response.data.forEach(function (Index, i) {
                            $('#student_nm').append("<option value='" + response.data[i].id + "'> " + response.data[i].username + "&nbsp;(" + response.data[i].email + ") </option>");
                        });
                    }
                },
                error: function (response) 
                {
                    console.log(response);
                }
            });
        });
    
        $('#add_lab_instance_form').on('submit', function (e) {
            e.preventDefault();

            var lab_instance_token = $('#lab_instance_token').val().trim();
            var lab_instance_name  = $('#lab_instance_name').val().trim();
            var lab_instance_ip    = $('#lab_instance_ip').val().trim();
            var lab_username       = $('#lab_username').val().trim();
            var lab_pwd            = $('#lab_pwd').val().trim();
            var batch_name         = $('#batch_name').val().trim();
            var student_nm         = $('#student_nm').val().trim();
            var lab_instance_descp = $('#lab_instance_descp').val().trim();
    
            if (lab_instance_name.trim() != '') 
            {
                if (lab_instance_ip.trim() != '') 
                {
                    if(student_nm != '')
                    {
                        var formdata = new FormData();
                        formdata.append('lab_instance_token', lab_instance_token);
                        formdata.append('lab_instance_name' , lab_instance_name);
                        formdata.append('lab_instance_ip'   , lab_instance_ip);
                        formdata.append('lab_username'      , lab_username);
                        formdata.append('lab_pwd'           , lab_pwd);
                        formdata.append('batch_id'          , batch_name);
                        formdata.append('student_nm'        , student_nm);
                        formdata.append('lab_instance_descp', lab_instance_descp);
        
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You want to add this lab instance?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            if (result.isConfirmed) 
                            {
                                $.ajax({
                                    url: "Easylearn/Classroom_Controller/add_lab_instance",
                                    data: formdata,
                                    type: "POST",
                                    contentType: false,
                                    processData: false,
                                    success: function (response) {
                                        var response = JSON.parse(response);

                                        if (response.data == "TRUE") 
                                        {
                                            Swal.fire({
                                                icon: "success",
                                                title: "Added Successfully!",
                                            }).then((result) => {
                                                location.reload();
                                            });
                                        } 
                                        else
                                        {
                                            Swal.fire({
                                                icon: "error",
                                                title: response.data,
                                            });
                                        }
                                    },
                                    error: function (response) 
                                    {
                                        console.log("Error: " + response);
                                    },
                                });
                            }
                        });
                    }
                    else
                    {
                        $('.check-student_nm').removeClass('d-none');
                    }
                }
                else 
                {
                    $('.check-lab_instance_ip').removeClass('d-none');
                }    
            } 
            else 
            {
                $('.check-lab_instance_name').removeClass('d-none');
            }
    
        });

        var labinstance_list = $('#labinstance_list').DataTable({
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i>',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i>',
                    titleAttr: 'CSV'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>',
                    titleAttr: 'Print'
                }
    
            ],
            rowReorder: true,
            select: true,
            ajax: {
                url: "Easylearn/Classroom_Controller/get_lab_instance",
                type: "POST",
                dataSrc: function (json) {
                    if(json.data == 'False')
                    {
                        return {};
                    }
                    else
                    {
                        return json.data;
                    }
                },
            },
            rowId: "id",
            columns: [{
                    data: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "lab_name"
                },
                {
                    data : "batch_name"
                },
                {
                    data: "username"
                },
                {
                    data: "lab_ip"
                },
            ],
        });

        $('#labinstance_list tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');
    
            $.ajax({
                url: "Easylearn/Classroom_Controller/get_lab_instance_id",
                data: {
                    id : id
                },
                type: "POST",
                success: function (response) 
                {
                    response = JSON.parse(response);

                    if(response.data != 'False')
                    {
                        $('#edit_lab_id').val(id);
                        $('#edit_lab_instance_name').val(response.data.lab_name);
                        $('#edit_lab_instance_ip').val(response.data.lab_ip);
                        $('#edit_lab_username').val(response.data.lab_username);
                        $('#edit_lab_pwd').val(response.data.lab_password);
                        $('#edit_batch_name').val(response.data.batch_id);
                        $('#edit_lab_instance_descp').val(response.data.lab_description);
                        $('.del_lab').attr('id', id);
                        $('#edit_lab_instance_modal').modal('show');

                        $.ajax({
                            url: "Easylearn/Classroom_Controller/get_batch_users_byid",
                            type: "POST",
                            data : {
                                id : response.data.batch_id
                            },
                            success: function (response1) 
                            {
                                response1 = JSON.parse(response1);
                                $('#edit_student_nm').empty();

                                if(response.data != 'FALSE')
                                {
                                    response1.data.forEach(function (Index, i) {
                                        $('#edit_student_nm').append("<option value='" + response1.data[i].id + "'> " + response1.data[i].username + "&nbsp;(" + response1.data[i].email + ") </option>");
                                    });

                                    $('#edit_student_nm').val(response.data.account_id);
                                }
                            },
                            error: function (response) 
                            {
                                console.log(response);
                            }
                        });
                    }
                },
                error: function (response) 
                {
                    console.log("Error: " + response);
                },
            });
        });

        $("#edit_lab_instance_modal").on("hidden.bs.modal", function (e) {
            $(this).find('form').trigger('reset');
            $('.check-edit_lab_instance_name').addClass('d-none');
            $('.check-edit_lab_instance_ip').addClass('d-none');
        });
    
        $(".close").on("click", function () {
            $(".check-lab_instance_name").addClass("d-none");
            $(".check-lab_instance_ip").addClass("d-none");
        });
    
        $(".close").on("click", function () {
            $(".check-edit_lab_instance_name").addClass("d-none");
            $(".check-edit_lab_instance_ip").addClass("d-none");
        });

        $('#edit_lab_instance_name').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-edit_lab_instance_name').removeClass('d-none');
            } 
            else 
            {
                $('.check-edit_lab_instance_name').addClass('d-none');
            }
        });
    
        $('#edit_lab_instance_ip').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-edit_lab_instance_ip').removeClass('d-none');
            } 
            else 
            {
                $('.check-edit_lab_instance_ip').addClass('d-none');
            }
        });

        $('#edit_batch_name').on('change', function() {
            var id = $(this).val();

            $.ajax({
                url: "Easylearn/Classroom_Controller/get_batch_users_byid",
                type: "POST",
                data : {
                    id : id
                },
                success: function (response) 
                {
                    $('#edit_student_nm').empty();
                    response = JSON.parse(response);
                    
                    if(response.data != 'FALSE')
                    {
                        response.data.forEach(function (Index, i) {
                            $('#edit_student_nm').append("<option value='" + response.data[i].id + "'> " + response.data[i].username + "&nbsp;(" + response.data[i].email + ") </option>");
                        });
                    }
                },
                error: function (response) 
                {
                    console.log(response);
                }
            });
        });

        $('#edit_lab_instance_form').on('submit', function (e) {
            e.preventDefault();

            var edit_lab_instance_token = $('#edit_lab_instance_token').val();
            var lab_id                  = $('#edit_lab_id').val();
            var lab_instance_name       = $('#edit_lab_instance_name').val();
            var lab_instance_ip         = $('#edit_lab_instance_ip').val();
            var lab_username            = $('#edit_lab_username').val();
            var lab_pwd                 = $('#edit_lab_pwd').val();
            var batch_name              = $('#edit_batch_name').val().trim();
            var student_nm              = $('#edit_student_nm').val();
            var lab_instance_descp      = $('#edit_lab_instance_descp').val();
    
            if (lab_instance_name.trim() != '') 
            {
                if (lab_instance_ip.trim() != '') 
                {
                    if(student_nm != '')
                    {
                        var formdata = new FormData();
                        formdata.append('edit_lab_instance_token', edit_lab_instance_token);
                        formdata.append('id'                     , lab_id);
                        formdata.append('lab_instance_name'      , lab_instance_name);
                        formdata.append('lab_instance_ip'        , lab_instance_ip);
                        formdata.append('lab_username'           , lab_username);
                        formdata.append('lab_pwd'                , lab_pwd);
                        formdata.append('batch_id'               , batch_name);
                        formdata.append('student_nm'             , student_nm);
                        formdata.append('lab_instance_descp'     , lab_instance_descp);
        
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You want to Edit this lab instance ?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            if (result.isConfirmed) 
                            {
                                $.ajax({
                                    url: "Easylearn/Classroom_Controller/edit_lab_instance",
                                    data: formdata,
                                    type: "POST",
                                    contentType: false,
                                    processData: false,
                                    success: function (response) 
                                    {
                                        var response = JSON.parse(response);
                                        if (response.data == "TRUE") 
                                        {
                                            Swal.fire({
                                                icon: "success",
                                                title: "Updated Successfully!",
                                            }).then((result) => {
                                                location.reload();
                                            });
                                        } 
                                        else 
                                        {
                                            Swal.fire({
                                                icon: "error",
                                                title: response.data,
                                            });
                                        }
                                    },
                                    error: function (response) 
                                    {
                                        console.log("Error: " + response);
                                    },
                                });
                            }
                        });
                    }
                    else
                    {
                        $('.check-edit_student_nm').removeClass('d-none');
                    }    
                } 
                else 
                {
                    $('.check-edit_lab_instance_ip').removeClass('d-none');
                }    
            } 
            else 
            {
                $('.check-edit_lab_instance_name').removeClass('d-none');
            }
        });

        $('.del_lab').on('click', function () {

            var id = $(this).attr('id');
    
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this lab instance ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $.ajax({
                        url: "Easylearn/Classroom_Controller/del_lab_instance",
                        data: {
                            id : id
                        },
                        type: "POST",
                        success: function (response) 
                        {
                            var response = JSON.parse(response);

                            if (response.data == "TRUE") 
                            {
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted Successfully!",
                                }).then((result) => {
                                    location.reload();
                                });
                            } 
                            else 
                            {
                                Swal.fire({
                                    icon: "error",
                                    title: response.data,
                                });
                            }
    
                        },
                        error: function (response) 
                        {
                            console.log("Error: " + response);
                        },
                    });
                }
            });
        });

        $('.add_mlab_instance').on('click', function () {

            var mlab_file = document.getElementById('multiple_lab_instance').files[0];
    
            if (document.getElementById('multiple_lab_instance').files.length > 0) 
            {
                var formdata = new FormData();
                formdata.append('mlab_file', mlab_file);
                formdata.append('batch_id' , $('#multiple_batch_name').val());

                $.ajax({
                    url: "HTMLtoCSV/add_mlab_instance",
                    data: formdata,
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function (response) 
                    {
                        var response = JSON.parse(response);
                        if (response.data == "TRUE") 
                        {
                            Swal.fire({
                                icon: "success",
                                title: response.inserted+" Added Successfully!",
                            }).then((result) => {

                                let csvContent = "data:text/csv;charset=utf-8," + response.not_insert.map(e => e.join(",")).join("\n");
    
                                var encodedUri = encodeURI(csvContent);
                                var link = document.createElement("a");
                                link.setAttribute("href", encodedUri);
                                link.setAttribute("download", "error_lab_list.csv");
                                document.body.appendChild(link); 
                                link.click();
    
                                location.reload();
                            });
                        } 
                        else 
                        {
                            Swal.fire({
                                icon: "error",
                                title: response.data,
                            }).then((result) => {
    
                                let csvContent = "data:text/csv;charset=utf-8" + response.not_insert.map(e => e.join(",")).join("\n");
    
                                var encodedUri = encodeURI(csvContent);
                                var link = document.createElement("a");
                                link.setAttribute("href", encodedUri);
                                link.setAttribute("download", "error_lab_list.csv");
                                document.body.appendChild(link); 
                                link.click();
    
                                location.reload();
                            });
                        }
                    },
                    error: function (response) 
                    {
                        console.log("Error: " + response);
                    },
                });
            } 
            else 
            {
                Swal.fire({
                    icon: "error",
                    title: "Upload File!",
                });
            }
    
        });
    }
});