$(document).ready(function () {

    function convertstrtodate(str) {
        var date = new Date(str),
            mnth = ("0" + (date.getMonth() + 1)).slice(-2),
            day = ("0" + date.getDate()).slice(-2);

        return [date.getFullYear(), mnth, day].join("-");
    }

    if (location.pathname.split('/').slice(-1)[0] == 'addfeestructure') {

        var dataset = [];

        var fee_structure_tbl = $('#add_fee_structure_tbl').DataTable({
            dom: '',
            data: dataset,
            rowId: "id",
            columns: [{
                data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                data: 'particulars',
            },
            {
                data: "price",
            },
            {
                data: null,
                render: function (data, type, row, meta) {
                    return `<button class="btn btn-xs btn-danger rm_btn" id="${row.id}">&times;</button>`;
                },
            },
            ],
        });

        $('.total_price').text(fee_structure_tbl.column(2).data().sum());

        $('#add_btn').on('click', function (e) {
            e.preventDefault();

            var particulars = $('#particulars').val().trim();
            var price = $('#price').val().trim();

            if (particulars != '') {

                $('.check_particulars').addClass('d-none');

                if (price != '') {

                    $('.check_price').addClass('d-none');
                    var json = {
                        'id': dataset.length,
                        'particulars': particulars,
                        'price': price
                    };
                    dataset.push(json);

                    fee_structure_tbl.clear().draw();
                    fee_structure_tbl.rows.add(dataset).draw();
                    $('.total_price').text(fee_structure_tbl.column(2).data().sum());
                    $('#particulars').val('');
                    $('#price').val('');


                } else {

                    $('.check_price').removeClass('d-none');

                }

            } else {

                $('.check_particulars').removeClass('d-none');

            }


        });

        $(document).on('click', '.rm_btn', function () {

            var id = $(this).attr('id');
            dataset = dataset.filter(function (item) {
                return item.id != id;
            });
            fee_structure_tbl.clear().draw();
            fee_structure_tbl.rows.add(dataset).draw();
            $('.total_price').text(fee_structure_tbl.column(2).data().sum());

        });


        $('#add_particulars').on('submit', function () {
            alert('okay');
        });

        $('.save_fee_structure').on('click', function () {

            var tbl_data = fee_structure_tbl.data();
            var data = [];
            for (let index = 0; index < tbl_data.length; index++) {
                var dat = tbl_data[index];
                data.push(dat);

            }
            var batch_id = $('#batch').val();
            var term = $('#term').val();
            var total_price = $('.total_price').text();

            if (data.length > 0) {

                var formdata = new FormData();
                formdata.append('batch_id', batch_id);
                formdata.append('term', term);
                formdata.append('total_price', total_price);
                formdata.append('fee_structure', JSON.stringify(data));

                $.ajax({
                    url: "Easylearn/Classroom_Controller/add_fee_structure",
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
                                location.reload();;
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

            } else {

                Swal.fire({
                    icon: "error",
                    text: "No Data",
                }).then((result) => {
                    //location.reload();
                });

            }


        });

    }

    if (location.pathname.split('/').slice(-1)[0] == 'feeStructure') {

        var batch_fee_list = $('#batch_fee_list').DataTable({

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
            rowReorder: true,
            ajax: {
                url: "Easylearn/Classroom_Controller/get_fee_structure",
                type: "POST",
                dataSrc: function (json) {

                    if (json.data != 'FALSE') {
                        return json.data;
                    } else {
                        return {};
                    }


                },
            },
            rowId: 'id',
            columns: [
                {
                    data: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "batch_name",
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `Term ${row.term}`;
                    },
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<button class="btn btn-danger btn-xs">&times;</button>`;
                    },
                }

            ]
        });

        $('#batch_fee_list tbody').on('dblclick', 'tr', function () {

            var tbl_data = batch_fee_list.row(this).data();
            var id = $(this).attr('id');
            var batch_nm = tbl_data.batch_name;
            var term = tbl_data.term;
            var formdata = new FormData();
            formdata.append('id', id);


            $.ajax({
                url: "Easylearn/Classroom_Controller/get_batch_fee_by_id",
                data: formdata,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#loader').css('display', 'none');
                    resp = JSON.parse(response);
                    if (resp.data != "FALSE") {
                        var text = '';
                        var counter = 0;

                        $('#view_feestructure').modal('show');
                        var data = resp.data.fee_details;
                        data.forEach(i => {
                            counter++;
                            text += `<tr><td>${counter}</td><td>${i.particulars}</td><td>${i.price} Rs</td></tr>`;

                        });
                        $('.tbody_fee').html(text);
                        $('.total_price').html(resp.data.total_fees + ' Rs');
                        $('.batch_nm').text(batch_nm);
                        $('.term').text(term);

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
                        //location.reload();
                    });
                }
            });
        });

    }


    if (location.pathname.split('/').slice(-1)[0] == 'manageHostel') {

        $('#hostel_list').DataTable({

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
            rowReorder: true,
            ajax: {
                url: "Easylearn/Classroom_Controller/get_hostel",
                type: "POST",
                dataSrc: function (json) {

                    if (json.data != 'FALSE') {
                        return json.data;
                    } else {
                        return {};
                    }


                },
            },
            rowId: 'unique_id',
            columns: [
                {
                    data: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "hostel_name",
                },
                {
                    data: "hostel_type",
                },
                {
                    data: "no_of_rooms",
                },
                {
                    data: "ppl_capacity_per_rm",
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<a href="assignHostelStudent?id=${row.unique_id}" class="btn btn-primary btn-rounded btn-md">Assign Student</a>`
                    },
                },


            ]

        });

        $('.add_hostel').on('click', function () {
            $('#add_hostel').modal('show');
        });

        $('#hostel_nm').on('keyup', function () {

            var hostel_nm = $('#hostel_nm').val().trim();

            if (hostel_nm != '') {

                $('.check_hostel_nm').addClass('d-none');

            } else {

                $('.check_hostel_nm').removeClass('d-none');

            }
        });

        $('#no_of_rooms').on('keyup', function () {

            var no_of_rooms = $('#no_of_rooms').val();
            if (no_of_rooms > 0) {

                $('.check_no_of_rooms').addClass('d-none');

            } else {

                $('.check_no_of_rooms').removeClass('d-none');

            }

        });

        $('#room_capcity').on('keyup', function () {

            var no_of_rooms = $('#room_capcity').val();
            if (no_of_rooms > 0) {

                $('.check_room_capcity').addClass('d-none');

            } else {

                $('.check_room_capcity').removeClass('d-none');

            }

        });

        $('#add_hostel_form').on('submit', function (e) {

            e.preventDefault();
            var hostel_add_token = $('#hostel_add_token').val();
            var hostel_nm = $('#hostel_nm').val().trim();
            var hostel_type = $('#hostel_type').val().trim();
            var no_of_rooms = $('#no_of_rooms').val().trim();
            var room_capcity = $('#room_capcity').val().trim();


            if (hostel_nm != '') {

                $('.check_hostel_nm').addClass('d-none');

                if (no_of_rooms > 0) {

                    $('.check_no_of_rooms').addClass('d-none');

                    if (room_capcity > 0) {

                        $('.check_room_capcity').addClass('d-none');

                        var formdata = new FormData();
                        formdata.append('hostel_add_token', hostel_add_token);
                        formdata.append('hostel_nm', hostel_nm);
                        formdata.append('hostel_type', hostel_type);
                        formdata.append('no_of_rooms', no_of_rooms);
                        formdata.append('room_capcity', room_capcity);

                        $.ajax({
                            url: "Easylearn/Classroom_Controller/add_hostel",
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
                                        location.reload();;
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

                    } else {
                        $('.check_room_capcity').removeClass('d-none');

                    }
                } else {

                    $('.check_no_of_rooms').removeClass('d-none');
                }
            } else {

                $('.check_hostel_nm').removeClass('d-none');

            }


        });

        $('#hostel_list tbody').on('dblclick', 'tr', function () {

            var unique_id = $(this).attr('id');

            var formdata = new FormData();
            formdata.append('unique_id', unique_id);

            $.ajax({
                url: "Easylearn/Classroom_Controller/get_hostel_by_id",
                data: formdata,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (response) {

                    resp = JSON.parse(response);
                    if (resp.data != 'FALSE') {

                        $('#edit_hostel').modal('show');
                        $('#edit_hostel_nm').val(resp.data.hostel_name);
                        $('#edit_hostel_type').val(resp.data.hostel_type);
                        $('#edit_no_of_rooms').val(resp.data.no_of_rooms);
                        $('#edit_room_capcity').val(resp.data.ppl_capacity_per_rm);
                        $('.edit_btn').attr('id', resp.data.id);
                        $('.del_btn').attr('id', resp.data.id);
                    } else {

                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });

                    }
                },
                error: function (response) {

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

        $('#edit_hostel_form').on('submit', function (e) {
            e.preventDefault();

            var hostel_edit_token = $('#hostel_edit_token').val();
            var hostel_nm = $('#edit_hostel_nm').val().trim();
            var hostel_type = $('#edit_hostel_type').val().trim();
            var no_of_rooms = $('#edit_no_of_rooms').val().trim();
            var room_capcity = $('#edit_room_capcity').val().trim();


            if (hostel_nm != '') {

                $('.check_edit_hostel_nm').addClass('d-none');

                if (no_of_rooms > 0) {

                    $('.check_edit_no_of_rooms').addClass('d-none');

                    if (room_capcity > 0) {

                        $('.check_edit_room_capcity').addClass('d-none');

                        var formdata = new FormData();
                        formdata.append('hostel_edit_token', hostel_edit_token);
                        formdata.append('id', $('.edit_btn').attr('id'));
                        formdata.append('hostel_nm', hostel_nm);
                        formdata.append('hostel_type', hostel_type);
                        formdata.append('no_of_rooms', no_of_rooms);
                        formdata.append('room_capcity', room_capcity);


                        $.ajax({
                            url: "Easylearn/Classroom_Controller/edit_hostel",
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
                                        location.reload();;
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

                    } else {
                        $('.check_edit_room_capcity').removeClass('d-none');

                    }
                } else {

                    $('.check_edit_no_of_rooms').removeClass('d-none');
                }
            } else {

                $('.check_edit_hostel_nm').removeClass('d-none');

            }

        });

        $('.del_btn').on('click', function () {

            var formdata = new FormData();
            formdata.append('id', $(this).attr('id'));

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to proceed further?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "Easylearn/Classroom_Controller/del_hostel",
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
                                    title: "Deleted Successfully!",
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then((result) => {
                                    location.reload();;
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
        });
    }

    if (location.pathname.split('/').slice(-1)[0] == 'assignHostelStudent') {

        var unique_id = (location.search.split(name + '=')[1] || '').split('&')[0];
        var hostel_id = '';
        var no_of_rooms = '';
        var no_of_compartment = '';
        var assign_hostel = '';

        var formdata = new FormData();
        formdata.append('unique_id', unique_id);

        $.ajax({
            url: "Easylearn/Classroom_Controller/get_hostel_by_id",
            data: formdata,
            type: "POST",
            contentType: false,
            processData: false,
            success: function (response) {

                resp = JSON.parse(response);
                var rooms_txt = '';
                if (resp.data != 'FALSE') {

                    hostel_id = resp.data.id;
                    no_of_rooms = resp.data.no_of_rooms;
                    no_of_compartment = resp.data.ppl_capacity_per_rm;

                    $('.hostel_nm').text(resp.data.hostel_name);
                    for (let i = 1; i <= resp.data.no_of_rooms; i++) {
                        rooms_txt += '<option value="' + i + '"> Room ' + i + '</option>'
                    }
                    $('#room_no').append(rooms_txt);
                    no_of_compartment = resp.data.ppl_capacity_per_rm;


                    var compartment_txt = '';
                    for (let i = 1; i <= resp.data.ppl_capacity_per_rm; i++) {
                        compartment_txt += '<option value="' + i + '"> Compartment ' + i + '</option>'
                    }

                    $('#cmpt_no').append(compartment_txt);

                } else {

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });

                }
            },
            error: function (response) {

                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                }).then((result) => {
                    //location.reload();
                });
            }
        });
        // console.log(hostel_id);
        setTimeout(function () {
            assign_hostel = $('#assign_student_hostel_list').DataTable({

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
                rowReorder: true,
                ajax: {
                    url: "Easylearn/Classroom_Controller/get_assign_rooms",
                    type: "POST",
                    data: {
                        'hostel_id': hostel_id,
                    },
                    dataSrc: function (json) {

                        console.log(json.data);

                        if (json.data != 'FALSE') {
                            return json.data;
                        } else {
                            return {};
                        }


                    },
                },
                rowId: 'id',
                columns: [
                    {
                        data: "id",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: "room_no",
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return `${row.student_name} (${row.student_emailid})`;
                        },
                    },
                    {
                        data: "student_gender",
                    },
                    {
                        data: "compartment",
                    },
                    {
                        data: "start_date",
                    },
                    {
                        data: "end_date",
                    }


                ]

            });
        }, 1000);


        $('.assign_student').on('click', function () {

            var room_no = $('#room_no').val();
            var formdata = new FormData();
            formdata.append('room_no', room_no);
            formdata.append('hostel_id', hostel_id);
            $.ajax({
                url: "Easylearn/Classroom_Controller/get_room_students",
                data: formdata,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (response) {

                    resp = JSON.parse(response);
                    console.log(resp);
                    $('#assign_student').modal('show');
                    if (resp.data != "FALSE") {
                        var cmpt_no = [];
                        resp.data.forEach(dat => {
                            cmpt_no.push(dat.compartment);
                        });

                        var compartment_txt = '';
                        for (let i = 1; i <= no_of_compartment; i++) {
                            if (!cmpt_no.includes(i.toString())) {
                                compartment_txt += '<option value="' + i + '"> Compartment ' + i + '</option>'
                            }
                        }

                        $('#cmpt_no').html(compartment_txt);

                    } else {

                        var compartment_txt = '';
                        for (let i = 1; i <= no_of_compartment; i++) {
                            compartment_txt += '<option value="' + i + '"> Compartment ' + i + '</option>'
                        }

                        $('#cmpt_no').html(compartment_txt);

                    }

                },
                error: function (response) {

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

        $('#check_in').datepicker({
            format: 'dd-mm-yyyy',
            orientation: "bottom right",
        });

        $('#check_out').datepicker({
            format: 'dd-mm-yyyy',
            orientation: "bottom right",
        });


        $('#room_no').on('change', function () {

            var room_no = $(this).val();
            var formdata = new FormData();
            formdata.append('room_no', room_no);
            formdata.append('hostel_id', hostel_id);

            $.ajax({
                url: "Easylearn/Classroom_Controller/get_room_students",
                data: formdata,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (response) {

                    resp = JSON.parse(response);
                    if (resp.data != "FALSE") {
                        var cmpt_no = [];
                        resp.data.forEach(dat => {
                            cmpt_no.push(dat.compartment);
                        });

                        var compartment_txt = '';
                        for (let i = 1; i <= no_of_compartment; i++) {
                            if (!cmpt_no.includes(i.toString())) {
                                compartment_txt += '<option value="' + i + '"> Compartment ' + i + '</option>'
                            }
                        }

                        if (compartment_txt == '') {
                            compartment_txt += '<option value=""> No Compartment </option>'
                        }

                        $('#cmpt_no').html(compartment_txt);

                    } else {

                        var compartment_txt = '';
                        for (let i = 1; i <= no_of_compartment; i++) {
                            compartment_txt += '<option value="' + i + '"> Compartment ' + i + '</option>'
                        }

                        $('#cmpt_no').html(compartment_txt);

                    }

                },
                error: function (response) {

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

        $('#edit_check_in').datepicker({
            format: 'dd-mm-yyyy',
            orientation: "bottom right",
        });

        $('#edit_check_out').datepicker({
            format: 'dd-mm-yyyy',
            orientation: "bottom right",
        });

        $(document).on('dblclick', '#assign_student_hostel_list tbody tr', function () {

            var id = $(this).attr('id');
            var room_no1 = '';

            var rooms_txt = '';
            for (let i = 1; i <= no_of_rooms; i++) {
                rooms_txt += '<option value="' + i + '"> Room ' + i + '</option>'
            }
            $('#edit_room_no').html(rooms_txt);

            var formdata1 = new FormData();
            formdata1.append('id', id);

            $.ajax({
                url: "Easylearn/Classroom_Controller/get_room_student",
                data: formdata1,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (response) {

                    resp = JSON.parse(response);
                    console.log(resp);
                    if (resp.data != "FALSE") {

                        room_no1 = resp.data.room_no;

                        var formdata = new FormData();
                        formdata.append('room_no', room_no1);
                        formdata.append('hostel_id', hostel_id);
                        $.ajax({

                            url: "Easylearn/Classroom_Controller/get_room_students",
                            data: formdata,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function (response) {

                                resp = JSON.parse(response);
                                console.log(resp);
                                if (resp.data != "FALSE") {
                                    var cmpt_no = [];
                                    resp.data.forEach(dat => {
                                        cmpt_no.push(dat.compartment);
                                    });

                                    var compartment_txt = '';
                                    for (let i = 1; i <= no_of_compartment; i++) {
                                        if (!cmpt_no.includes(i.toString())) {
                                            compartment_txt += '<option value="' + i + '"> Compartment ' + i + '</option>'
                                        }
                                    }

                                    if (compartment_txt == '') {
                                        compartment_txt += '<option value=""> No Compartment </option>'
                                    }

                                    $('#edit_cmpt_no').html(compartment_txt);

                                } else {

                                    var compartment_txt = '';
                                    for (let i = 1; i <= no_of_compartment; i++) {
                                        compartment_txt += '<option value="' + i + '"> Compartment ' + i + '</option>'
                                    }

                                    $('#edit_cmpt_no').html(compartment_txt);

                                }
                                $('#edit_assign_student').modal('show');
                            },
                            error: function (response) {

                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                }).then((result) => {
                                    //location.reload();
                                });
                            }
                        });
                        // var cmpt_no = [];
                        // resp.data.forEach(dat => {
                        //     cmpt_no.push(dat.compartment);
                        // });

                        // var compartment_txt = '';
                        // for (let i = 1; i <= no_of_compartment; i++) {
                        //     if(!cmpt_no.includes(i.toString())){
                        //         compartment_txt += '<option value="'+i+'"> Compartment '+i+'</option>'
                        //     }
                        // }

                        // if(compartment_txt == ''){
                        //     compartment_txt += '<option value=""> No Compartment </option>'
                        // }

                        // $('#edit_cmpt_no').html(compartment_txt);

                    } else {

                        // var compartment_txt = '';
                        // for (let i = 1; i <= no_of_compartment; i++) {
                        //     compartment_txt += '<option value="'+i+'"> Compartment '+i+'</option>'
                        // }

                        // $('#edit_cmpt_no').html(compartment_txt);

                    }

                },
                error: function (response) {

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

        $('#assign_hostel_student').on('submit', function (e) {
            e.preventDefault();

            var room_no = $('#room_no').val();
            var cmpt_no = $('#cmpt_no').val();
            var student_id = $('#student_id').val();
            var check_in = convertstrtodate($('#check_in').datepicker('getDate'));
            var check_out = convertstrtodate($('#check_out').datepicker('getDate'));

            if (student_id != '') {

                var formdata = new FormData();
                formdata.append('hostel_id', hostel_id);
                formdata.append('room_no', room_no);
                formdata.append('cmpt_no', cmpt_no);
                formdata.append('student_id', student_id);
                formdata.append('check_in', check_in);
                formdata.append('check_out', check_out);

                $.ajax({
                    url: "Easylearn/Classroom_Controller/assign_room_student",
                    data: formdata,
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        resp = JSON.parse(response);

                        if (resp.data == 'TRUE') {

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
                                text: "Something went wrong!",
                            });

                        }
                    },
                    error: function (response) {

                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        }).then((result) => {
                            //location.reload();
                        });
                    }
                });

            } else {
                Swal.fire({
                    icon: "warning",
                    text: "No Student Select",
                }).then((result) => {
                    //location.reload();
                });
            }



        });

    }


});