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
            var re = /^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/;
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

    
    function ValidateDate(start_date, end_date) 
    {
        if (start_date != null & end_date != null) 
        {
            if ((Date.parse(start_date) > Date.parse(end_date)) & (Date.parse(start_date) < Date.parse(end_date))) 
            {
                return false;
            } 
            else 
            {
                return true;
            }
        } 
        else 
        {
            return false;
        }
    }

    if (location.pathname.split('/').slice(-1)[0] == 'manageBatch') 
    {
        $("#start_date").datepicker({
            startDate: '-0m',
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
        }).on('changeDate', function (ev) {
            var endDate = $('#end_date').datepicker('getDate');
            var startDate = $("#start_date").datepicker('getDate');

            if (Date.parse(startDate) > Date.parse(endDate)) 
            {
                $("#start_date").val('');
                $(".check-start_date").removeClass("d-none");
                $(".check-start_date").addClass("btn-danger");
                $(".check-start_date").html(
                    '<i class="fas fa-times-circle"></i> Enter valid Date'
                );
            } 
            else 
            {
                $(".check-start_date").addClass("d-none");
            }
        });
    
        $("#end_date").datepicker({
            startDate: '-0m',
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
        }).on('changeDate', function (ev) {
            var endDate = $('#end_date').datepicker('getDate');
            var startDate = $("#start_date").datepicker('getDate');

            if (Date.parse(startDate) > Date.parse(endDate)) 
            {
                $(".check-end_date").removeClass("d-none");
                $(".check-end_date").addClass("btn-danger");
                $(".check-end_date").html(
                    '<i class="fas fa-times-circle"></i> Enter valid Date'
                );
                $("#end_date").val('');
            } 
            else if (!startDate) 
            {
                $(".check-end_date").removeClass("d-none");
                $(".check-end_date").addClass("btn-danger");
                $(".check-end_date").html(
                    '<i class="fas fa-times-circle"></i>Enter Start Date'
                );
                $("#end_date").val('');
            } 
            else 
            {
                $(".check-end_date").addClass("d-none");
            }
        });

        $('#batch_name').on('keyup', function () 
        {
            if ($(this).val().trim() == '') 
            {
                $('.check-batch_name').removeClass('d-none');
            } 
            else 
            {
                $('.check-batch_name').addClass('d-none');
            }
        });

        $('#start_date').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-start_date').removeClass('d-none');
            } 
            else 
            {
                $('.check-start_date').addClass('d-none');
            }
        });

        $('#end_date').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-end_date').removeClass('d-none');
            } 
            else 
            {
                $('.check-end_date').addClass('d-none');
            }
        });

        $('#batch_descp').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-batch_descp').removeClass('d-none');
            } 
            else 
            {
                $('.check-batch_descp').addClass('d-none');
            }
        });

        //Batch Check Image
        $("#batch_img").on("change", function () {

            var file = this.files[0];

            if (ValidateImage(file)) 
            {
              $(".check-batch_img").addClass("d-none");
            } 
            else 
            {
              $(".check-batch_img").removeClass("d-none");
            }
        });

        //Add Batch
        $('#add_batch').on('submit', function (e) {
            e.preventDefault();

            var batch_token  = $('#batch_token').val().trim();
            var classroom_id = $('#classroom_id').val().trim();
            var batch_nm     = $('#batch_name').val().trim();
            var batch_img    = document.getElementById('batch_img').files[0];
            var endDate      = $('#end_date').datepicker('getDate');
            var startDate    = $("#start_date").datepicker('getDate');
            var batch_descp  = $('#batch_descp').val().trim();

            if (batch_nm != '') 
            {
                if (batch_img != '' && ValidateImage(batch_img)) 
                {
                    if (startDate != '' && startDate != null)
                    {
                        if (endDate != '' && endDate != null) 
                        {
                            var formdata = new FormData();
                            formdata.append('batch_token'  , batch_token);
                            formdata.append('classroom_id' , classroom_id);
                            formdata.append('batch_nm'     , batch_nm);
                            formdata.append('batch_img'    , batch_img);
                            formdata.append('startDate'    , convertstrtodate(startDate));
                            formdata.append('endDate'      , convertstrtodate(endDate));
                            formdata.append('batch_descp'  , batch_descp);

                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You want to Add Batch",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) 
                                {
                                    $('#loader').css('display', 'block');

                                    if (ValidateDate(startDate, endDate)) 
                                    {
                                        $.ajax({
                                            url: "Easylearn/Classroom_Controller/add_batch",
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
                                                        text: "Something went wrong!",
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
                                }
                            });
                        } 
                        else 
                        {
                            $('.check-end_date').removeClass('d-none');
                        }
                    } 
                    else 
                    {
                        $('.check-start_date').removeClass('d-none');
                    }
                } 
                else 
                {
                    $('.check-batch_img').removeClass('d-none');
                }
            } 
            else 
            {
                $('.check-batch_name').removeClass('d-none');
            }
        });

        //Get All Batches
        $("#batch_list").DataTable({
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
                url: "Easylearn/Classroom_Controller/get_batches",
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
            rowId: "unique_id",
            columns: [{
                    data: "unique_id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "classroom_name"
                },
                {
                    data: "batch_name"
                },
                {
                    data: "start_date"
                },
                {
                    data: "end_date"
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        if (row.visibility == 1) {
                            return `<button type="button" style='border-radius: 20px;' class="btn batch_visibility1 btn-sm btn-toggle  focus active" data-id="${row.unique_id}" data-toggle="button" aria-pressed="true" autocomplete="off">
                                            <div style='border-radius: 50%;' class="handle"></div>
                                        </button>`;
                        } else {
                            return `<button type="button" style='border-radius: 20px;' class="btn batch_visibility1 btn-sm btn-toggle" data-id="${row.unique_id}" data-toggle="button" aria-pressed="false" autocomplete="off">
                                            <div style='border-radius: 50%;' class="handle"></div>
                                        </button>`;
                        }

                    },
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<a class="waves-effect waves-light btn btn-rounded btn-primary mb-5 d-sm-inline-flex" href="assignBatch?id=${row.unique_id}&batch=${row.batch_name}"><i class="fas fa-user-plus align-self-center"></i> &nbsp;&nbsp;Students</a>`;
                    },
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<a class="waves-effect waves-light btn btn-rounded btn-primary mb-5 d-sm-inline-flex" href="assignCourse?id=${row.unique_id}&batch=${row.batch_name}"><i class="fas fa-user-plus align-self-center"></i> &nbsp;&nbsp;Courses</a>`;
                    },
                },
            ],

        });

        //Get Batch by id
        $('#batch_list tbody').on('dblclick', 'tr', function () {
            var id = $(this).attr('id');

            $.ajax({
                url: "Easylearn/Classroom_Controller/batch_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) {
                    response = JSON.parse(response);

                    $('.unique_id').attr('data-id', response.data.unique_id);
                    $('#edit_classroom_id').val(response.data.classroom_id);
                    $('#edit_batch_name').val(response.data.batch_name);
                    $('#edit_start_date').datepicker('setDate', response.data.start_date);
                    $('#edit_end_date').datepicker('setDate', response.data.end_date);
                    $('#batch_description').val(response.data.description);
                    $('.edit-batch').attr('id', id);

                    if (response.data.batch_image.trim() != null) 
                    {
                        $('#view_batch_image').attr('src', response.data.batch_image);
                    }

                    $('#edit_batch_modal').modal('show');
                    $(".cancel-batch").parent().addClass("d-none");
                    $(".edit-batch").removeClass("d-none");
                    $('.error').addClass('d-none');
                    $(".check-edit_batch_name").addClass("d-none");
                    $(".check-edit_batch_img").addClass("d-none");
                    $(".check-edit_start_date").addClass("d-none");
                    $(".check-edit_end_date").addClass("d-none");
                    show_batchs_elements();
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

        //Enable Disable Batch
        $(document).on('click', '.batch_visibility1', function () {
            var id = $(this).attr('data-id');
            var visibility = 0;

            if ($(this).hasClass('active')) 
            {
                visibility = 1;
            }

            $.ajax({
                url: 'Easylearn/Classroom_Controller/show_hide_batch',
                type: 'POST',
                data: {
                    'id': id,
                    'visibility': visibility
                },
                success: function (response) {

                },
                error: function (response) {
                    console.log(response);
                }
            });
        });

        function hide_batchs_elements() 
        {
            $('#edit_batch_name').attr('disabled', false);
            $('#edit_batch_img').attr('disabled', false);
            $('#edit_start_date').attr('disabled', false);
            $('#edit_end_date').attr('disabled', false);
            $('#batch_description').attr('disabled', false);
            $('#edit_classroom_id').attr('disabled', false);
            $('.input_batch').removeClass('d-none');
            $('.batch_detail').addClass('d-none');
        }
    
        function show_batchs_elements() 
        {
            $('#edit_batch_name').attr('disabled', true);
            $('#edit_batch_img').attr('disabled', true);
            $('#edit_start_date').attr('disabled', true);
            $('#edit_end_date').attr('disabled', true);
            $('#batch_description').attr('disabled', true);
            $('#edit_classroom_id').attr('disabled', true);
            $('.batch_detail').removeClass('d-none');
            $('.input_batch').addClass('d-none');
        }
    
        $(".edit-batch").on("click", function () {
            $(".cancel-batch").parent().removeClass("d-none");
            $(".edit-batch").addClass("d-none");

            hide_batchs_elements();
        });
    
        $(".cancel-batch").on("click", function () {
            $(".cancel-batch").parent().addClass("d-none");
            $(".edit-batch").removeClass("d-none");
            $('.error').addClass('d-none');

            show_batchs_elements();
        });

        $("#edit_start_date").datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
        }).on('changeDate', function (ev) {
            var endDate   = $('#edit_end_date').datepicker('getDate');
            var startDate = $("#edit_start_date").datepicker('getDate');

            if (Date.parse(startDate) > Date.parse(endDate)) 
            {
                $(".check-edit_start_date").removeClass("d-none");
                $(".check-edit_start_date").addClass("btn-danger");
                $(".check-edit_start_date").html(
                    '<i class="fas fa-times-circle"></i> Enter valid Date'
                );
            } 
            else 
            {
                $(".check-edit_start_date").addClass("d-none");
            }
        });
    
        $("#edit_end_date").datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
        }).on('changeDate', function (ev) {
            var endDate = $('#edit_end_date').datepicker('getDate');
            var startDate = $("#edit_start_date").datepicker('getDate');
            if (Date.parse(startDate) > Date.parse(endDate)) 
            {
                $(".check-edit_end_date").removeClass("d-none");
                $(".check-edit_end_date").addClass("btn-danger");
                $(".check-edit_end_date").html(
                    '<i class="fas fa-times-circle"></i> Enter valid Date'
                );
                //$("#edit_end_date").val('');
            } 
            else if (!startDate) 
            {
                $(".check-edit_end_date").removeClass("d-none");
                $(".check-edit_end_date").addClass("btn-danger");
                $(".check-edit_end_date").html(
                    '<i class="fas fa-times-circle"></i>Enter Start Date'
                );
                //$("#edit_end_date").val('');
            } 
            else 
            {
                $(".check-edit_end_date").addClass("d-none");
            }
        });
    
        $('#edit_batch_img').on('change', function () {
            var file = this.files[0];
    
            if (file == null) 
            {
                $('.check-edit_batch_img').addClass('d-none');
                $('#view_batch_image').attr('src', '');
            } 
            else 
            {
                if (ValidateImage(file)) 
                {
                    $('.check-edit_batch_img').addClass('d-none');
                    $('#view_batch_image').attr('src', URL.createObjectURL(file));
                } 
                else 
                {
                    $('.check-edit_batch_img').removeClass('d-none');
                    $('#view_batch_image').attr('src', '');
                }
            }
        });
    
        //Edit Batch
        $('#edit_batch').on('submit', function (e) {
            e.preventDefault();
            var error=[];
            var formdata = new FormData();
            var id               = $('.unique_id').attr('data-id');
            var edit_batch_token = $('#edit_batch_token').val().trim();
            var classroom_id     = $('#edit_classroom_id').val().trim();
            var batch_nm         = $('#edit_batch_name').val().trim();
            var batch_img        = document.getElementById('edit_batch_img').files[0];
            var endDate          = $('#edit_end_date').datepicker('getDate');
            var startDate        = $("#edit_start_date").datepicker('getDate');
            var batch_descp      = $('#batch_description').val().trim();

            if (document.getElementById('edit_batch_img').files.length > 0) {
                if (ValidateImage(batch_img)) {
                    formdata.append('batch_img', batch_img);
                }
                else{
                    error.push('yes');
                    $(".check-edit_batch_img").removeClass("d-none");
                }
            }
    
            if (batch_nm != '') 
            {    
                if (startDate != '' && startDate != null) 
                {
                    if (endDate != '' && endDate != null) 
                    {
                        if(error.length == 0)
                        {
                            formdata.append('id'           , id);
                            formdata.append('batch_token'  , edit_batch_token);
                            formdata.append('classroom_id' , classroom_id);
                            formdata.append('batch_nm'     , batch_nm);
                            formdata.append('startDate'    , convertstrtodate(startDate));
                            formdata.append('endDate'      , convertstrtodate(endDate));
                            formdata.append('batch_descp'  , batch_descp);
        
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You want to Update Batch",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) 
                                {
                                    if (ValidateDate(startDate, endDate)) 
                                    {
                                        $('#loader').css('display', 'block');

                                        $.ajax({
                                            url: "Easylearn/Classroom_Controller/edit_batch",
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
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "Please Enter Details Properly",
                                        });
                                    }
                                }
                            });
                        }
                        else{
                            $('.check-edit_batch_img').removeClass('d-none');
                        }
                    } 
                    else 
                    {
                        $('.check-edit_end_date').removeClass('d-none');
                    }
                } 
                else 
                {
                    $('.check-edit_start_date').removeClass('d-none');
                }
            } 
            else 
            {
                $('.check-edit_batch_name').removeClass('d-none');
            }
        });
    
        $('#edit_batch_name').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-edit_batch_name').removeClass('d-none');
            } 
            else 
            {
                $('.check-edit_batch_name').addClass('d-none');
            }
        });
    
        $('#edit_start_date').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-edit_start_date').removeClass('d-none');
            } 
            else 
            {
                $('.check-edit_start_date').addClass('d-none');
            }
        });
    
        $('#edit_end_date').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.check-edit_end_date').removeClass('d-none');
            } 
            else 
            {
                $('.check-edit_end_date').addClass('d-none');
            }
        });

        $('.delete-batch').on('click', function(){
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
                    var id = $('.unique_id').attr('data-id');

                    $.ajax({
                        url: 'Easylearn/Classroom_Controller/delete_batch',
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

    if (location.pathname.split("/").slice(-1)[0] == 'assignBatch') 
    {
        $('.dropify').dropify();
        var unique_id = (location.search.split(name + '=')[1] || '').split('&')[0];

        $(document).on('click', '.showotherbatch_member', function () {
            var table = $('#assignbatch_list').DataTable();
            table.destroy();

            if ($(this).hasClass('active')) 
            {
                assign_batch = $("#assignbatch_list").DataTable({
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
                        url: "Easylearn/Classroom_Controller/get_allbatch_users_byunique",
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
                        // {data:"email"},

                    ],
                    createdRow: function (row, data, dataIndex) {
                        $(row).addClass('assignbatch_list');
                    },
                })
            } 
            else 
            {
                assign_batch = $("#assignbatch_list").DataTable({
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
                        url: "Easylearn/Classroom_Controller/get_batch_users_byunique",
                        type: "POST",
                        data: {
                            'unique_id' : unique_id,
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
                            //console.log(json);
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
                        // {data:"email"},

                    ],
                    createdRow: function (row, data, dataIndex) {
                        $(row).addClass('assignbatch_list');
                    },

                });
            }
        });

        var assign_batch = $("#assignbatch_list").DataTable({
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
                url: "Easylearn/Classroom_Controller/get_batch_users_byunique",
                type: "POST",
                data: {
                    'unique_id' : unique_id,
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
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('assignbatch_list');
            },
        });

        $('.save-assign-batch').on('click', function () {
            var unique_id = (location.search.split(name + '=')[1] || '').split('&')[0];
            var selected_id = [];
            var selected = assign_batch.rows('.selected').data();

            for (let i = 0; i < selected.length; i++) {
                selected_id.push(selected[i]['id']);
            }

            if (selected_id.length == 0) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Select the Student",
                });
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Update Batch",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {

                        if (selected_id.length != 0) {

                            var formdata = new FormData();
                            formdata.append('unique_id', unique_id);
                            formdata.append('selected_id', JSON.stringify(selected_id));

                            $.ajax({
                                url: "Easylearn/Classroom_Controller/assign_batchStudents",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) {

                                    response = JSON.parse(response);

                                    if (response["data"] > 0) {
                                        Swal.fire({
                                            icon: "success",
                                            title: response["data"] + " Assigned Successfully!",
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
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Please Enter Details Properly",
                            });
                        }
                    }
                });
                // console.log(selected_id);
                // console.log(unique_id);
            }
        });

        var assign_batch_member = $("#assignbatch_memberlist").DataTable({
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Classroom_Controller/get_batch_member",
                type: "POST",
                data: {
                    unique_id: unique_id
                },
                dataSrc: function (json) {
                    if (json.data != 'FALSE') {
                        //console.log(json.data);
                        return json.data;
                    } else {
                        return json.data = [];
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
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<a href="#" class="waves-effect waves-light btn btn-rounded btn-danger delete_assignmember mb-5" data-id="${row.id}" data-account-id="${row.account_id}" ><i class="fas fa-trash-alt"></i></a>`;
                    },
                },

            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('assignbatch_memberlist');
            },

        })

        $(document).on('click', '.delete_assignmember', function () {
            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Remove Student",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Remove'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $.ajax({
                        url: 'Easylearn/Classroom_Controller/delete_assignmember',
                        type: 'POST',
                        data: {
                            'id': id,
                        },
                        success: function (response) {
                            assign_batch_member.row("#" + id).remove().draw();
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                }
            });
        });

        //Assign CSV Student Submit
        $('#csv_assign_Student_submit').on('click', function (e) {
            e.preventDefault();

            var multi_data_file = document.getElementById("csv_assign_Student").files[0];

            if ($('#another_batch').hasClass('active')) 
            {
                var another_batch = 1;
            } 
            else 
            {
                var another_batch = 0;
            }

            var formdata = new FormData();
            formdata.append('multi_data_file' , multi_data_file);
            formdata.append('another_batch'   , another_batch);
            formdata.append('unique_id'       , unique_id);

            $('#loader').css('display', 'block');
            
            $.ajax({
                url: "HTMLtoCSV/csv_assign_student",
                data: formdata,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (response) {
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
                error: function (response) {
                    $('#loader').css('display', 'none');
                    console.log("Error: " + response);
                }
            });
        });
    }

    if (location.pathname.split("/").slice(-1)[0] == 'assignCourse') 
    {
        var unique_id = (location.search.split(name + '=')[1] || '').split('&')[0];

        //Generate assign course table
        var assign_course = $("#assigncourse_list").DataTable({
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
                url: "Easylearn/Classroom_Controller/get_batch_course_byunique",
                type: "POST",
                data: {
                    unique_id : unique_id
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
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('assigncourse_list');
            },
        });

        //save assign course
        $('.save-assign-course').on('click', function () {
            var selected_id = [];
            var selected = assign_course.rows('.selected').data();

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
                    text: "You want to Update Batch",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        if (selected_id.length != 0) 
                        {
                            var formdata = new FormData();
                            formdata.append('unique_id', unique_id);
                            formdata.append('selected_id', JSON.stringify(selected_id));

                            $('#loader').css('display', 'block');

                            $.ajax({
                                url: "Easylearn/Classroom_Controller/assign_batchcourses",
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
                        else 
                        {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Please Enter Details Properly",
                            });
                        }
                    }
                });
            }
        });

        //Assigned batch course list
        var assign_batch_course = $("#assignedcourse_list").DataTable({
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: "reorder",
                targets: "_all"
            }, ],
            ajax: {
                url: "Easylearn/Classroom_Controller/get_batch_course",
                type: "POST",
                data: {
                    unique_id: unique_id
                },
                dataSrc: function (json) {
                    if (json.data != 'FALSE') {
                        return json.data;
                    } else {
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
                        return `<a href="#" class="waves-effect waves-light btn btn-rounded btn-danger delete_assigncourse mb-5" data-id="${row.id}"><i class="fas fa-trash-alt"></i></a>`;
                    },
                },

            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('assignbatch_courselist');
            },

        });

        //delete assigned course
        $(document).on('click', '.delete_assigncourse', function () {
            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Remove Course",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Remove'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $.ajax({
                        url: 'Easylearn/Classroom_Controller/delete_assigncourse',
                        type: 'POST',
                        data: {
                            'id': id,
                        },
                        success: function (response) 
                        {
                            assign_batch_course.row("#" + id).remove().draw();
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                }
            });
        });
    }
});