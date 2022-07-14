$(document).ready(function () {

    //ValidateName
    function ValidateName(name) {
        if (name.length > 3 && name.length < 50) {
            var re = /^([a-zA-Z]+\s)*[a-zA-Z]+$/;
            return re.test(name);
        } else {
            return false;
        }
    }

    if(location.pathname.split('/').slice(-1)[0] == 'manageStudents')
    {
        $("#student_list").DataTable({
            
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
                url: "Easylearn/Classroom_Controller/get_student",
                type: "POST",
                dataSrc: function (json) {
                    if(json.data == 'False')
                    {
                        return {}
                    }
                    else{
                        return json.data;
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
                { data: "student_name" },
                { data: "student_gender" },
                { data: "student_emailid" },
                { data: "student_contactno" },
                { data: "parent_name" },
                { data: "parent_emailid" },
                { data: "parent_contactno" },
            ]
        });

        $('#student_list tbody').on('dblclick', 'tr', function () {
            var id= $(this).attr('id');

            $.ajax({
                url: "Easylearn/Classroom_Controller/student_by_id",
                data: {
                    'id': id,
                },
                type: "POST",
                success: function (response) 
                {
                    response = JSON.parse(response);

                    $('.unique_id').attr('data-id',response.data.unique_id);
                    $('.s_name').text(response.data.student_name);
                    $('.s_dob').text(response.data.student_dob);
                    $('.s_gender').text(response.data.student_gender);
                    $('.s_nationality').text(response.data.student_nationality);
                    $('.s_email').text(response.data.student_emailid); 
                    $('.s_contact').text(response.data.student_contactno);
                    $('.s_rollno').text(response.data.student_rollno);
                    $('.s_bloodgrp').text(response.data.student_bloodgroup);
                    $('.s_descp').text(response.data.student_description); 
                    $('.p_name').text(response.data.parent_name);             
                    $('.p_email').text(response.data.parent_emailid);               
                    $('.p_contact').text(response.data.parent_contactno);                 
                    $('.p_occupation').text(response.data.parent_occupation);              
                    $('.student_image').attr('src',response.data.profile_image);    
                    $('.s_address').text(response.data.parent_address);
                    $('.edit-student').attr("href", "studentView?id="+response.data.unique_id);                  
                    $('#view_student_modal').modal('show');
                },
                error: function (response) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    }).then((result) => {
                        //Hello;
                    });
                }
            });
        });
    }

    if (location.pathname.split('/').slice(-1)[0] == 'studentView') 
    {
        $('#student_contactno, #parent_contactno').intlTelInput();

        $("#student_name").on("input", function () {
            var name = $(this).val().trim();

            if (name == null || name == "") 
            {
                $(".edit_check_StudentName").removeClass("d-none");
            } 
            else 
            {
                if (ValidateName(name)) 
                {
                    $(".edit_check_StudentName").addClass("d-none");
                } 
                else 
                {
                    $(".edit_check_StudentName").removeClass("d-none");
                }
            }
        });

        $("#student_contactno").on("change", function () {

            if ($('#student_contactno').intlTelInput("isValidNumber")) 
            {
                $(".edit_check_StudentContactNo").addClass("d-none");
            } 
            else 
            {
                $(".edit_check_StudentContactNo").removeClass("d-none");
            }
        });

        $("#parent_name").on("input", function () {
            var name = $(this).val().trim();

            if (name == null || name == "") 
            {
                $(".edit_check_ParentName").removeClass("d-none");
            } 
            else 
            {
                if (ValidateName(name)) 
                {
                    $(".edit_check_ParentName").addClass("d-none");
                } 
                else 
                {
                    $(".edit_check_ParentName").removeClass("d-none");
                }
            }
        });

        //Contact Number
        $("#parent_contactno").on("change", function () {
            
            if ($('#parent_contactno').intlTelInput('isValidNumber')) 
            {
                $(".edit_check_ParentContact").addClass("d-none");
            } 
            else 
            {
                $(".edit_check_ParentContact").removeClass("d-none");
            }
        });

        $('#student_rollno').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.edit_check_StudentRollNo').removeClass('d-none');
            } 
            else 
            {
                $('.edit_check_StudentRollNo').addClass('d-none');
            }
        });

        $('#student_bloodgroup').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.edit_check_StudentBloodgroup').removeClass('d-none');
            } 
            else 
            {
                $('.edit_check_StudentBloodgroup').addClass('d-none');
            }
        });

        $('#parent_occupation').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.edit_check_ParentOccupation').removeClass('d-none');
            } 
            else 
            {
                $('.edit_check_ParentOccupation').addClass('d-none');
            }
        });

        $('#parent_address').on('keyup', function () {
            if ($(this).val().trim() == '') 
            {
                $('.edit_check_ParentAddress').removeClass('d-none');
            } 
            else 
            {
                $('.edit_check_ParentAddress').addClass('d-none');
            }
        });

        $('#edit_student').on('submit', function (e) {
            e.preventDefault();

            var edit_student_token  = $('#edit_student_token').val().trim();
            var unique_id           = (location.search.split(name + '=')[1] || '').split('&')[0];
            var parent_name         = $("#parent_name").val().trim();
            var parent_contactno    = $('#parent_contactno').intlTelInput("getNumber");
            var parent_occupation   = $("#parent_occupation").val().trim();
            var parent_address      = $('#parent_address').val().trim();
            var student_name        = $("#student_name").val().trim();
            var student_rollno      = $("#student_rollno").val().trim();
            var student_contactno   = $("#student_contactno").intlTelInput("getNumber");
            var student_bloodgroup  = $("#student_bloodgroup").val().trim();
            var student_description = $("#student_description").val().trim();

            if (student_name != '') 
            {
                if ($("#student_contactno").intlTelInput("isValidNumber")) 
                {
                    if (student_rollno != '') 
                    {
                        if (student_bloodgroup != '') 
                        {
                            if (parent_name != '') 
                            {
                                if ($("#parent_contactno").intlTelInput("isValidNumber")) 
                                {
                                    if (parent_occupation != '') 
                                    {
                                        if (parent_address != '') 
                                        {
                                            var formdata = new FormData();
                                            formdata.append('edit_student_token'  , edit_student_token);
                                            formdata.append('unique_id'           , unique_id);
                                            formdata.append('parent_name'         , parent_name);
                                            formdata.append('parent_contactno'    , parent_contactno);
                                            formdata.append('parent_occupation'   , parent_occupation);
                                            formdata.append('parent_address'      , parent_address);
                                            formdata.append('student_name'        , student_name);
                                            formdata.append('student_rollno'      , student_rollno);
                                            formdata.append('student_contactno'   , student_contactno);
                                            formdata.append('student_bloodgroup'  , student_bloodgroup);
                                            formdata.append('student_description' , student_description);

                                            Swal.fire({
                                                title: 'Are you sure?',
                                                text: "You want to update student?",
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
                                                        url: "Easylearn/Classroom_Controller/update_student",
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
                                                                    location.reload();;
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
                                            $('#parent_address').focus();
                                            $('.edit_check_ParentAddress').removeClass('d-none');
                                        }
                                    } 
                                    else 
                                    {
                                        $("#parent_occupation").focus();
                                        $('.edit_check_ParentOccupation').removeClass('d-none');
                                    }
                                } 
                                else 
                                {
                                    $('#parent_contactno').focus();
                                    $('.edit_check_ParentContact').removeClass('d-none');
                                }
                            } 
                            else 
                            {
                                $("#parent_name").focus();
                                $('.edit_check_ParentName').removeClass('d-none');
                            }
                        }
                        else 
                        {
                            $("#student_bloodgroup").focus();
                            $('.edit_check_StudentBloodgroup').removeClass('d-none');
                        }
                    } 
                    else 
                    {
                        $("#student_rollno").focus();
                        $('.edit_check_StudentRollNo').removeClass('d-none');
                    }
                } 
                else 
                {
                    $("#student_contactno").focus();
                    $('.edit_check_StudentContactNo').removeClass('d-none');
                }
            } 
            else 
            {
                $("#student_name").focus();
                $('.edit_check_StudentName').removeClass('d-none');
            }
        });

        $('.delete-student').on('click', function() {
            var unique_id  = (location.search.split(name + '=')[1] || '').split('&')[0];

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete student?",
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
                        url: "Easylearn/Classroom_Controller/delete_student",
                        data: {
                            id : unique_id
                        },
                        type: "POST",
                        success: function (response) 
                        {
                            $('#loader').css('display', 'none');
                            response = JSON.parse(response);

                            if (response["data"] == "TRUE") 
                            {
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted Successfully!",
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then((result) => {
                                    location.href = 'manageStudents'
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
        });
    }
});