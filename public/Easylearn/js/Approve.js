$(document).ready(function () {

    Object.defineProperty(String.prototype, 'capitalize', {
        value: function () {
            return this.charAt(0).toUpperCase() + this.slice(1);
        },
        enumerable: false
    });

    //School Requests
    if (location.pathname.split("/").slice(-1)[0] == "schoolrequests") {

        $("#first_school_requests").DataTable({
            rowReorder: true,
            columnDefs: [
                { orderable: true, className: "reorder", targets: "_all" },
            ],
            ajax: {
                url: "Easylearn/Approve_Controller/schoolrequests",
                type: "POST",
                data: {
                    status: 'Unverified',
                },
                dataSrc: function (json) {
                    if (json.data == 'False') {
                        return {}
                    }
                    else {
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
                { data: "school_name" },
                { data: "school_type" },
                { data: "board_type" },
                { data: "school_medium" },
                { data: "school_code" },
            ],
        });

        $("#final_school_requests").DataTable({
            rowReorder: true,
            columnDefs: [
                { orderable: true, className: "reorder", targets: "_all" },
            ],
            ajax: {
                url: "Easylearn/Approve_Controller/schoolrequests",
                type: "POST",
                data: {
                    status: 'Document Unverified',
                },
                dataSrc: function (json) {
                    if (json.data == 'False') {
                        return {}
                    }
                    else {
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
                { data: "school_name" },
                { data: "school_type" },
                { data: "board_type" },
                { data: "school_medium" },
                { data: "school_code" },
            ],
        });

        //Open View model
        $('#first_school_requests tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');
            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Approve_Controller/schoolrequests_id",
                data: {
                    id: id,
                },
                type: "POST",
                success: function (response) {
                    $('#loader').css('display', 'none');
                    response = JSON.parse(response);

                    $('#school_disapprove').attr('data-id', id);
                    $('#school_approve').attr('data-id', id);

                    $('#school_disapprove').attr('data-email', response.data.administrator_email);
                    $('#school_approve').attr('data-email', response.data.administrator_email);

                    $('.school_logo').attr('src', response.data.school_logo);
                    $('.school_image').attr('src', response.data.school_image);
                    $('.school_name').html(response.data.school_name);
                    $('.school_type').html(response.data.school_type);
                    $('.board_type').html(response.data.board_type);
                    $('.school_medium').html(response.data.school_medium);
                    $('.school_code').html(response.data.school_code);

                    if (response.data.is_coed == 1) {
                        $('.is_coed').html('Yes');
                        $('.gender_type').parent().addClass('d-none');
                    }
                    else {
                        $('.is_coed').html('No');
                        $('.gender_type').parent().removeClass('d-none');
                        $('.gender_type').html(response.data.gender_type);
                    }

                    $('.contact_number_1').html(response.data.phone_1);
                    $('.contact_number_2').html(response.data.phone_2);
                    $('.administrator_name').html(response.data.administrator_name);
                    $('.administrator_email').html(response.data.administrator_email);

                    $('.address_line_1').html(response.data.address_line_1);
                    $('.address_line_2').html(response.data.address_line_2);
                    $('.school_country').html(response.data.country);
                    $('.school_state').html(response.data.state);
                    $('.school_city').html(response.data.city);
                    $('.postal_code').html(response.data.postal_code);

                    $('.description').html(response.data.school_description);

                    $('.pl_doc').parent().parent().addClass('d-none');
                    $('.uac_doc').parent().parent().addClass('d-none');

                    $('#view_school_modal').modal('show');
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

        //Open View model
        $('#final_school_requests tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');
            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Approve_Controller/schoolrequests_id",
                data: {
                    id: id,
                },
                type: "POST",
                success: function (response) {
                    $('#loader').css('display', 'none');
                    response = JSON.parse(response);

                    $('#school_disapprove').attr('data-id', id);
                    $('#school_approve').attr('data-id', id);

                    $('#school_disapprove').attr('data-email', response.data.administrator_email);
                    $('#school_approve').attr('data-email', response.data.administrator_email);

                    $('.school_logo').attr('src', response.data.school_logo);
                    $('.school_image').attr('src', response.data.school_image);
                    $('.school_name').html(response.data.school_name);
                    $('.school_type').html(response.data.school_type);
                    $('.board_type').html(response.data.board_type);
                    $('.school_medium').html(response.data.school_medium);
                    $('.school_code').html(response.data.school_code);

                    if (response.data.is_coed == 1) {
                        $('.is_coed').html('Yes');
                        $('.gender_type').parent().addClass('d-none');
                    }
                    else {
                        $('.is_coed').html('No');
                        $('.gender_type').parent().removeClass('d-none');
                        $('.gender_type').html(response.data.gender_type);
                    }

                    $('.contact_number_1').html(response.data.phone_1);
                    $('.contact_number_2').html(response.data.phone_2);
                    $('.administrator_name').html(response.data.administrator_name);
                    $('.administrator_email').html(response.data.administrator_email);

                    $('.address_line_1').html(response.data.address_line_1);
                    $('.address_line_2').html(response.data.address_line_2);
                    $('.school_country').html(response.data.country);
                    $('.school_state').html(response.data.state);
                    $('.school_city').html(response.data.city);
                    $('.postal_code').html(response.data.postal_code);

                    $('.description').html(response.data.school_description);

                    $('.pl_doc').parent().parent().removeClass('d-none');
                    $('.uac_doc').parent().parent().removeClass('d-none');

                    $('.pl_doc').attr('href', response.data.pl_doc);
                    $('.uac_doc').attr('href', response.data.uac_doc);

                    $('#view_school_modal').modal('show');
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

        //School Disapprove
        $('#school_disapprove').on('click', function () {
            var id = $(this).attr('data-id');
            var email = $(this).attr('data-email');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to disapprove!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Disapprove'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Approve_Controller/school_disapprove',
                        data: {
                            id    : id,
                            email : email
                        },
                        type: 'POST',
                        success: function (response) {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");

                            if (response['data'] == 'TRUE') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Disapproved',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                            else {
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

        //School Approve
        $('#school_approve').on('click', function () {
            var id = $(this).attr('data-id');
            var email = $(this).attr('data-email');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Approve!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Approve_Controller/school_approve',
                        data: {
                            id: id,
                            email: email
                        },
                        type: 'POST',
                        success: function (response) {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");

                            if (response['data'] == 'TRUE') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Approved',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                            else {
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

    //Jr College Requests
    if (location.pathname.split("/").slice(-1)[0] == "jrcollegerequests") {

        $("#first_jrclg_requests").DataTable({
            rowReorder: true,
            columnDefs: [
                { orderable: true, className: "reorder", targets: "_all" },
            ],
            ajax: {
                url: "Easylearn/Approve_Controller/jrclg_requests",
                type: "POST",
                data: {
                    status: 'Unverified',
                },
                dataSrc: function (json) {
                    if (json.data == 'False') {
                        return {}
                    }
                    else {
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
                { data: "clg_name" },
                { data: "clg_type" },
                { data: "clg_board_type" },
                { data: "clg_medium" },
                { data: "clg_code" },
            ],
        });

        $("#final_jrclg_requests").DataTable({

            rowReorder: true,
            columnDefs: [
                { orderable: true, className: "reorder", targets: "_all" },
            ],
            ajax: {
                url: "Easylearn/Approve_Controller/jrclg_requests",
                type: "POST",
                data: {
                    status: 'Document Unverified',
                },
                dataSrc: function (json) {
                    if (json.data == 'False') {
                        return {}
                    }
                    else {
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
                { data: "clg_name" },
                { data: "clg_type" },
                { data: "clg_board_type" },
                { data: "clg_medium" },
                { data: "clg_code" },
            ],

        });

        $('#first_jrclg_requests tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');
            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Approve_Controller/jrclgrequests_id",
                data: {
                    id: id,
                },
                type: "POST",
                success: function (response) {
                    $('#loader').css('display', 'none');
                    response = JSON.parse(response);
                    $('#jrclg_disapprove').attr('data-id', id);
                    $('#jrclg_approve').attr('data-id', id);

                    $('#jrclg_disapprove').attr('data-email', response.data.admin_email);
                    $('#jrclg_approve').attr('data-email', response.data.admin_email);

                    $('.jrclg_logo').attr('src', response.data.clg_logo);
                    $('.jrclg_image').attr('src', response.data.clg_image);
                    $('.jrclg_name').html(response.data.clg_name);
                    $('.jrclg_type').html(response.data.clg_type);
                    $('.board_type').html(response.data.clg_board_type);
                    $('.jrclg_medium').html(response.data.clg_medium);
                    $('.jrclg_code').html(response.data.clg_code);
                    var clg_streams = response.data.clg_streams
                    var i = 1;
                    var streams = ''
                    clg_streams.forEach(element => {

                        streams += element.capitalize();
                        if (clg_streams.length != i) {
                            streams += ' - '
                            i++;
                        }

                    });

                    $('.jrclg_streams').html(streams);
                    if (response.data.is_coed == 1) {
                        $('.is_coed').html('Yes');
                        $('.gender_type').parent().addClass('d-none');
                    }
                    else {
                        $('.is_coed').html('No');
                        $('.gender_type').parent().removeClass('d-none');
                        $('.gender_type').html(response.data.clg_gender_type);
                    }

                    $('.contact_number_1').html(response.data.phone_1);
                    $('.contact_number_2').html(response.data.phone_2);
                    $('.administrator_name').html(response.data.admin_name);
                    $('.administrator_email').html(response.data.admin_email);

                    $('.address_line_1').html(response.data.addr1);
                    $('.address_line_2').html(response.data.addr2);
                    $('.jrclg_country').html(response.data.country);
                    $('.jrclg_state').html(response.data.state);
                    $('.jrclg_city').html(response.data.city);
                    $('.postal_code').html(response.data.pcode);

                    $('.description').html(response.data.clg_descp);

                    $('.pl_doc').parent().parent().addClass('d-none');
                    $('.uac_doc').parent().parent().addClass('d-none');

                    $('#view_jrclg_modal').modal('show');
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

        $('#final_jrclg_requests tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');
            $('#loader').css('display', 'block');

            $.ajax({
                url: "Easylearn/Approve_Controller/jrclgrequests_id",
                data: {
                    id: id,
                },
                type: "POST",
                success: function (response) {
                    $('#loader').css('display', 'none');
                    response = JSON.parse(response);
                    $('#jrclg_disapprove').attr('data-id', id);
                    $('#jrclg_approve').attr('data-id', id);

                    $('#jrclg_disapprove').attr('data-email', response.data.admin_email);
                    $('#jrclg_approve').attr('data-email', response.data.admin_email);

                    $('.jrclg_logo').attr('src', response.data.clg_logo);
                    $('.jrclg_image').attr('src', response.data.clg_image);
                    $('.jrclg_name').html(response.data.clg_name);
                    $('.jrclg_type').html(response.data.clg_type);
                    $('.board_type').html(response.data.clg_board_type);
                    $('.jrclg_medium').html(response.data.clg_medium);
                    $('.jrclg_code').html(response.data.clg_code);
                    var clg_streams = response.data.clg_streams
                    var i = 1;
                    var streams = ''
                    clg_streams.forEach(element => {

                        streams += element.capitalize();
                        if (clg_streams.length != i) {
                            streams += ' - '
                            i++;
                        }

                    });

                    $('.jrclg_streams').html(streams);
                    if (response.data.is_coed == 1) {
                        $('.is_coed').html('Yes');
                        $('.gender_type').parent().addClass('d-none');
                    }
                    else {
                        $('.is_coed').html('No');
                        $('.gender_type').parent().removeClass('d-none');
                        $('.gender_type').html(response.data.clg_gender_type);
                    }

                    $('.contact_number_1').html(response.data.phone_1);
                    $('.contact_number_2').html(response.data.phone_2);
                    $('.administrator_name').html(response.data.admin_name);
                    $('.administrator_email').html(response.data.admin_email);

                    $('.address_line_1').html(response.data.addr1);
                    $('.address_line_2').html(response.data.addr2);
                    $('.jrclg_country').html(response.data.country);
                    $('.jrclg_state').html(response.data.state);
                    $('.jrclg_city').html(response.data.city);
                    $('.postal_code').html(response.data.pcode);

                    $('.description').html(response.data.clg_descp);

                    $('.pl_doc').parent().parent().removeClass('d-none');
                    $('.uac_doc').parent().parent().removeClass('d-none');

                    $('.pl_doc').attr('href', response.data.pl_doc);
                    $('.uac_doc').attr('href', response.data.uac_doc);

                    $('#view_jrclg_modal').modal('show');
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

        //Jr College Approve
        $('#jrclg_approve').on('click', function () {
            var id = $(this).attr('data-id');
            var email = $(this).attr('data-email');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Approve!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Approve_Controller/jrclg_approve',
                        data: {
                            id: id,
                            email: email
                        },
                        type: 'POST',
                        success: function (response) {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");

                            if (response['data'] == 'TRUE') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Approved',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                            else {
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

        //Jr College Disapprove
        $('#jrclg_disapprove').on('click', function () {
            var id = $(this).attr('data-id');
            var email = $(this).attr('data-email');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to disapprove!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Disapprove'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: 'Easylearn/Approve_Controller/jrclg_disapprove',
                        data: {
                            id    : id,
                            email : email
                        },
                        type: 'POST',
                        success: function (response) {
                            var response = JSON.parse(response);
                            $("#loader").css("display", "none");

                            if (response['data'] == 'TRUE') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Disapproved',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                            else {
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

    //mentorrequests
    if (location.pathname.split("/").slice(-1)[0] == "mentorRequests") 
    {
        const mentor_requests = $("#mentor_requests").DataTable(
        {
            rowReorder: true,
            columnDefs: [
                { orderable: true, className: "reorder", targets: [0, 1, 2, 3,4] },
                { orderable: false, targets: "_all" },
            ],
            ajax: {
                url: "Easylearn/Approve_Controller/mentorrequests",
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
            rowId: "unique_id",
            columns: [
                { data: "id",
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                { data: "mentor_name" },
                { data: "dob" },
                { data: "field_of_expertise" },
                { data: "experience" }
            ],
        });

        $('#mentor_requests tbody').on('dblclick', 'tr', function () {
            var id = $(this).attr('id');

            view_mentor(id)
        });

        function view_mentor(row_id) 
        {
            $("#viewmentor").modal("show");

            $.ajax({
                url: "Easylearn/Approve_Controller/getmentorrequests",
                type: "POST",
                data: { 
                    id: row_id 
                },
                success: function (response) 
                {
                    response = JSON.parse(response);

                    $('.m_name').text(response.data.mentor_name);
                    $('.m_expt').text(response.data.field_of_expertise);
                    $('.m_dob').text(response.data.dob);
                    $('.m_contact').text(response.data.contact_number1 +' , '+response.data.contact_number2);
                    $('.m_email').text(response.data.email);
                    $('.m_exp').text(response.data.experience+ " Years");

                    skills = JSON.parse(response.data.skills);
                    m_skills = '';
                    skills.forEach(function(skill) {
                        m_skills += '<li>'+skill+'</li>'
                    });

                    $('.m_skils').html(m_skills);
                    $('.m_descp').text(response.data.description);
                    $('.m_addr').html(response.data.address_line1+',<br>'+response.data.address_line2+',<br>'+response.data.city+',<br>'+response.data.state+',<br>'+response.data.country+" - "+ response.data.pincode);
                    $('.mentor_image').attr('src',response.data.photo_url);
                    $('.m_resume').attr('href',response.data.resume_url);
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
                },
            });
        }

        $('.mentor_disapprove').on('click',function(event){
            var email = $(".m_email").text();

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to disapprove!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Disapprove'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loader').css('display', 'block');

                    $.ajax({
                        url: "Easylearn/Approve_Controller/disapprovementorrequests",
                        type: "POST",
                        data: { 
                            email: email
                        },

                        success: function (response) 
                        {
                            $('#loader').css('display', 'none');

                            $("#viewmentor").modal("hide");
                            response = JSON.parse(response);

                            Swal.fire({
                                icon: "success",
                                title: "Disapproved",
                            }).then((result) => {
                                location.reload();
                            });
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
                        },
                    });
                }
            });
        });

        $('.mentor_approve').on('click',function(event){
            var email = $(".m_email").text();

            $.ajax({
                url: "Easylearn/Approve_Controller/updatementorrequests",
                type: "POST",
                data: {
                    email: email
                },
                success: function (response) 
                {
                    $("#viewmentor").modal("hide");
                    response = JSON.parse(response);

                    Swal.fire({
                        icon: "success",
                        title: "Approved",
                    }).then((result) => {
                        location.reload();
                    });
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
                },
            });
        });
    }
});