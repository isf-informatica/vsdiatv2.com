$(document).ready(function () {

	$('#add_mentor_btn').on('click', function () {
        $('#add_mentor_modal').modal('show');
    });

    function ValidateName(name) {
        if (name.length > 3 && name.length < 80) {
            var re = /^([a-zA-Z]+\s)*[a-zA-Z]+$/;
            return re.test(name);
        } else {
            return false;
        }
    }

    function ValidateEmail(email) {
        if (email.length > 3 && email.length < 50) {
            var re =
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        } else {
            return false;
        }
    }

    $("#m_name").on("input", function () {
        var name = $(this).val();
        if (ValidateName(name)) {
            $(".check-m_name").addClass("d-none");
        } else {
            $(".check-m_name").removeClass("d-none");
            $(".check-m_name").html(
                '<i class="fas fa-times-circle"></i> Enter valid name'
            );
        }
    });

    $("#m_emailid").on("change", function () {
        var email = $(this).val();

        if (ValidateEmail(email)) {
            $.ajax({
                url: "Easylearn/Register_Controller/check_email",
                data: {
                    email: email,
                },
                type: "POST",
                success: function (response) {
                    var response = JSON.parse(response);
                    if (response.data == "TRUE") {
                        $(".check-m_emailid").removeClass("d-none");
                        $(".check-m_emailid").addClass("bg-danger");
                        $(".check-m_emailid").removeClass("bg-success");
                        $(".check-m_emailid").html(
                            '<i class="fas fa-times-circle"></i> Email not available'
                        );
                    } else {
                        $(".check-m_emailid").removeClass("d-none");
                        $(".check-m_emailid").removeClass("bg-danger");
                        $(".check-m_emailid").addClass("bg-success");
                        $(".check-m_emailid").html(
                            '<i class="fas fa-check-circle"></i> Email available'
                        );
                    }
                },
                error: function (response) {
                    console.log(response);
                },
            });
        } else {
            $(".check-m_emailid").removeClass("d-none");
            $(".check-m_emailid").addClass("btn-danger");
        }
    });

    $(".close").on("click", function () {
        $(".check-m_name").addClass("d-none");
        $(".check-m_emailid").addClass("d-none");
        
    });

    $("#add_mentor_modal").on("hidden.bs.modal", function (e) {
        $(this).find('form').trigger('reset');
    });

    $('#add_mentor').on('submit', function (e) {
        e.preventDefault();
        var m_token = $('#mentor_token').val();
        var m_name = $('#m_name').val();
        var m_emailid = $('#m_emailid').val();

        if (m_name != '') {   
             if (m_emailid != '') {
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
                        $(".loader").removeClass("d-none");
                        $(".register_loader").removeClass("d-none");
                        var data = new FormData();
                        data.append("m_token", m_token);
                        data.append("m_name", m_name);
                        data.append("m_emailid", m_emailid);

                        $.ajax({
                            url: "Easylearn/Register_Controller/add_mentor",
                            data: data,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                $(".loader").addClass("d-none");
                                $(".register_loader").addClass("d-none");
                                console.log(response);
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
                                $(".loader").addClass("d-none");
                                $(".register_loader").addClass("d-none");
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
                    else 
                    {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: 'Something Wents Wrong',
                        }).then((result) => {
                            // location.reload();
                        });
                    }
                });                                        
            }
            else 
            {
                $('.check-m_emailid').removeClass('d-none');
            }         
        } 
        else 
        {
            $('.check-m_name').removeClass('d-none');
        }
    });


    $("#mentor_view").DataTable({
        dom: "<'row' <'mb-15'B>><br>lftip",
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
        select: true,
        rowReorder: true,
        columnDefs: [{
            orderable: true,
            className: "reorder",
            targets: "_all"
        }, ],
        ajax: {
            url: "Easylearn/Classroom_Controller/get_mentor_details",
            type: "POST",
            dataSrc: function (json) {
                return json.data;
                console.log(json);
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
                data: "mentor_name"
            },
            {
                data: "email"
            },
            
            
        ],

    });

    $('#mentor_view tbody').on('dblclick', 'tr', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "Easylearn/Classroom_Controller/get_mentor_by_id",
            data: {
                'id': id,
            },
            type: "POST",
            success: function (response) {
                response = JSON.parse(response);
                //console.log(response);
                $('.unique_id').attr('data-id', response.data.unique_id);
                $('.m_name').text(response.data.mentor_name);
                $('.m_email').text(response.data.email);
                $('.delete_mentor').attr('data-id', response.data.unique_id);
                $('#edit_mentor_modal').modal('show');

            },
            error: function (response) {
                setTimeout(function () {
                    $(".preloader").fadeOut();

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        location.reload();
                    });
                }, 1000);
            }
        });

    });

});