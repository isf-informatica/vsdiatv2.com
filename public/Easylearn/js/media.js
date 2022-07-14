$(document).ready(function () {

    var error_txt = '<i class="fas fa-times-circle"></i> ';

    function ValidateImage(file) {

        if (file) {

            var fileType = file["type"];
            var validImageTypes = ["image/gif", "image/jpeg", "image/png"];

            return validImageTypes.includes(fileType);

        } else {

            return FALSE;

        }

    }

    function convertstrtodate(str) {
        var date = new Date(str),
            mnth = ("0" + (date.getMonth() + 1)).slice(-2),
            day = ("0" + date.getDate()).slice(-2);
        return [date.getFullYear(), mnth, day].join("-");
    }


    function ValidateTwoDate(start_date, end_date) {

        if (Date.parse(start_date) > Date.parse(end_date)) {

            return false;

        } else if (Date.parse(start_date) == Date.parse(end_date)) {

            return false;

        } else {

            return true;

        }

    }


    function convertTime12to24(str) {

        const [time, modifier] = str.split(' ');

        let [hours, minutes] = time.split(':');

        if (hours === '12') {
            hours = '00';
        }

        if (modifier === 'PM') {
            hours = parseInt(hours, 10) + 12;
        }

        return `${hours}:${minutes}:00`;
    }


    if (location.pathname.split('/').slice(-1)[0] == 'managenews') {

        $('#news_list').DataTable({

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
            select: true,
            ajax: {
                url: "Easylearn/Classroom_Controller/get_news",
                type: "POST",
                dataSrc: function (json) {
                    if(json.data!='FALSE'){
                        return json.data;
                    }else{
                        return {};
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
                data: null,
                render: function (data, type, row, meta) {
                    return `<img src="${row.topic_img}" alt="Image" style="height:50px;width:50px;">`;
                },
            },
            {
                data: "topic",

            },
            {
                data: "news",
            },
            {
                data: "start_date",
            },
            {
                data: "end_date",
            }

            ],

        });

        $("#start_date").datepicker({

            startDate: '-0m',
            format: 'dd-mm-yyyy',
            orientation: 'bottom',

        }).on('changeDate', function (ev) {

            var endDate = $('#end_date').datepicker('getDate');
            var startDate = $("#start_date").datepicker('getDate');
            if (Date.parse(startDate) >= Date.parse(endDate)) {

                $('.check-end_date').text('').append(error_txt + ' Invalid End Date!').removeClass('d-none');
                $('.check-start_date').text('').append(error_txt + 'Invalid Start Date!').removeClass('d-none');
            } else {
                $(".check-end_date").addClass("d-none");
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
            if (Date.parse(startDate) >= Date.parse(endDate)) {

                $('.check-end_date').text('').append(error_txt + ' Invalid End Date!').removeClass('d-none');
                $('.check-start_date').text('').append(error_txt + 'Invalid Start Date!').removeClass('d-none');
            } else {
                $(".check-end_date").addClass("d-none");
                $(".check-start_date").addClass("d-none");
            }

        });

        $("#edit_start_date").datepicker({

            format: 'dd-mm-yyyy',
            orientation: 'bottom',

        }).on('changeDate', function (ev) {

            var endDate = $('#edit_end_date').datepicker('getDate');
            var startDate = $("#edit_start_date").datepicker('getDate');
            if (Date.parse(startDate) >= Date.parse(endDate)) {

                $('.check-edit_end_date').text('').append(error_txt + ' Invalid End Date!').removeClass('d-none');
                $('.check-edit_start_date').text('').append(error_txt + 'Invalid Start Date!').removeClass('d-none');
            } else {
                $(".check-edit_end_date").addClass("d-none");
                $(".check-edit_start_date").addClass("d-none");
            }

        });

        $("#edit_end_date").datepicker({

            format: 'dd-mm-yyyy',
            orientation: 'bottom',

        }).on('changeDate', function (ev) {

            var endDate = $('#edit_end_date').datepicker('getDate');
            var startDate = $("#edit_start_date").datepicker('getDate');
            if (Date.parse(startDate) >= Date.parse(endDate)) {

                $('.check-edit_end_date').text('').append(error_txt + ' Invalid End Date!').removeClass('d-none');
                $('.check-edit_start_date').text('').append(error_txt + 'Invalid Start Date!').removeClass('d-none');
            } else {
                $(".check-edit_end_date").addClass("d-none");
                $(".check-edit_start_date").addClass("d-none");
            }

        });

        $('#add_news_btn').on('click', function () {
            $('#add_news_modal').modal('show');
        });

        $('#topic').on('keyup', function () {

            var topic_nm = $(this).val();

            if (topic_nm.trim() != '') {

                $('.check-news_name').addClass('d-none');

            } else {

                $('.check-news_name').text('').append(error_txt + ' Topic Cannot be Blank').removeClass('d-none');

            }

        });

        $('#edit_topic').on('keyup', function () {

            var topic_nm = $('#edit_topic').val();

            if (topic_nm.trim() != '') {

                $('.check-edit_topic').addClass('d-none');

            } else {

                $('.check-edit_topic').text('').append(error_txt + ' Topic Cannot be Blank').removeClass('d-none');

            }

        });

        $('#news_text').on('keyup', function () {

            var news_text = $('#news_text').val();

            if (news_text.trim() != '') {

                $('.check-news_text').addClass('d-none');

            } else {

                $('.check-news_text').text('').append(error_txt + ' News Field is Required!').removeClass('d-none');


            }
        });

        $('#edit_news_text').on('keyup', function () {

            var news_text = $('#edit_news_text').val();

            if (news_text.trim() != '') {

                $('.check-edit_news_text').addClass('d-none');

            } else {

                $('.check-edit_news_text').text('').append(error_txt + ' News Field is Required!').removeClass('d-none');


            }
        });

        $('#news_img').on('change', function () {

            var topic_img = document.getElementById('news_img').files[0];

            if (document.getElementById('news_img').files.length > 0) {

                if (ValidateImage(topic_img)) {

                    $('.check-news_img').addClass('d-none');

                } else {

                    $('.check-news_img').text('').append(error_txt + ' Image Must be in JPG/PNG').removeClass('d-none');

                }

            } else {

                $('.check-news_img').text('').append(error_txt + ' Image Required!').removeClass('d-none');

            }

        });

        $('#edit_news_img').on('change', function () {

            var topic_img = document.getElementById('edit_news_img').files[0];

            if (document.getElementById('edit_news_img').files.length > 0) {

                if (ValidateImage(topic_img)) {

                    $('.check-edit_news_img').addClass('d-none');

                } else {

                    $('.check-edit_news_img').text('').append(error_txt + ' Image Must be in JPG/PNG').removeClass('d-none');

                }

            } else {

                $('.check-edit_news_img').addClass('d-none');

            }

        });

        $('#add_news_form').on('submit', function (e) {
            e.preventDefault();
            var news_token = $('#news_token').val();
            var topic_nm = $('#topic').val();
            var topic_img = document.getElementById('news_img').files[0];
            var news_text = $('#news_text').val();
            var start_date = $('#start_date').datepicker('getDate');
            var end_date = $('#end_date').datepicker('getDate');

            if (topic_nm.trim() != '') {

                if (document.getElementById('news_img').files.length > 0) {

                    if (ValidateImage(topic_img)) {

                        if (news_text.trim() != '') {

                            if (start_date != null) {

                                $('.check-start_date').addClass('d-none');

                                if (end_date != null) {

                                    $('.check-end_date').addClass('d-none');

                                    if (ValidateTwoDate(start_date, end_date)) {

                                        var formdata = new FormData();
                                        formdata.append('news_token', news_token);
                                        formdata.append('topic_nm', topic_nm);
                                        formdata.append('topic_img', topic_img);
                                        formdata.append('news_text', news_text);
                                        formdata.append('start_date', convertstrtodate(start_date));
                                        formdata.append('end_date', convertstrtodate(end_date));

                                        $.ajax({
                                            url: "Easylearn/Classroom_Controller/add_news",
                                            data: formdata,
                                            type: "POST",
                                            contentType: false,
                                            processData: false,
                                            success: function (response) {
                                                // console.log(response);
                                                response = JSON.parse(response);
                                                if (response.data == 'TRUE') {
                                                    Swal.fire({
                                                        icon: "success",
                                                        text: "Added Succesfully",
                                                    }).then((result) => {
                                                        location.reload();
                                                    });
                                                } else {
                                                    Swal.fire({
                                                        icon: "error",
                                                        title: "Oops...",
                                                        text: "Something went wrong!",
                                                    }).then((result) => {
                                                        location.reload();
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
                                                        location.reload();
                                                    });
                                                }, 1000);
                                            }
                                        });

                                        $('.check-end_date').addClass('d-none');
                                        $('.check-start_date').addClass('d-none');

                                    } else {

                                        $('.check-end_date').text('').append(error_txt + ' Invalid End Date!').removeClass('d-none');
                                        $('.check-start_date').text('').append(error_txt + 'Invalid Start Date!').removeClass('d-none');

                                    }

                                } else {

                                    $('.check-end_date').text('').append(error_txt + ' End Date is Required!').removeClass('d-none');

                                }

                            } else {

                                $('.check-start_date').text('').append(error_txt + ' Start Date is Required!').removeClass('d-none');

                            }

                            $('.check-news_text').addClass('d-none');

                        } else {

                            $('.check-news_text').text('').append(error_txt + ' News Field is Required!').removeClass('d-none');

                        }

                        $('.check-news_img').addClass('d-none');

                    } else {

                        $('.check-news_img').text('').append(error_txt + ' Image Must be in JPG/PNG').removeClass('d-none');

                    }

                } else {

                    $('.check-news_img').text('').append(error_txt + ' Image Required!').removeClass('d-none');

                }

                $('.check-news_name').addClass('d-none');

            } else {

                $('.check-news_name').text('').append(error_txt + ' Topic Cannot be Blank').removeClass('d-none');

            }

        });

        $('#news_list tbody').on('dblclick', 'tr', function () {

            var id = $(this).attr('id');

            var formdata = new FormData();
            formdata.append('id', id);
            $.ajax({
                url: "Easylearn/Classroom_Controller/get_news_id",
                data: formdata,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (response) {

                    resp = JSON.parse(response);
                    if(resp.data != 'FALSE'){

                        $('#edit_topic').val(resp.data.topic);
                        $('#edit_news_text').val(resp.data.news);
                        $('#edit_start_date').datepicker('setDate', resp.data.start_date);
                        $('#edit_end_date').datepicker('setDate', resp.data.end_date);
                        $('.del_btn').attr('id', id);
                        $('#edit_news_modal').modal('show');
                        

                    }else{

                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: resp.data,
                        }).then((result) => {
                            location.reload();
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
                            location.reload();
                        });
                    }, 1000);
                }
            });



        });

        $('.del_btn').on('click', function () {

            var formdata = new FormData();
            formdata.append('id', $(this).attr('id'));

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to proceed further!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "Easylearn/Classroom_Controller/del_news",
                        data: formdata,
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: function (response) {

                            resp = JSON.parse(response);

                            if (resp.data == 'TRUE') {
                                Swal.fire({
                                    icon: "success",
                                    text: "Deleted Succesfully!",
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                }).then((result) => {
                                    location.reload();
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
                                    location.reload();
                                });
                            }, 1000);
                        }
                    });

                }
            });


        });


        $('#edit_news_form').on('submit', function (e) {

            e.preventDefault();

            var edit_news_token = $('#edit_news_token').val();
            var topic_nm = $('#edit_topic').val();
            var topic_img = document.getElementById('edit_news_img').files[0];
            var news_text = $('#edit_news_text').val();
            var start_date = $('#edit_start_date').datepicker('getDate');
            var end_date = $('#edit_end_date').datepicker('getDate');
            var array = [];

            if (document.getElementById('edit_news_img').files.length > 0) {

                if (ValidateImage(topic_img)) {

                    $('.check-edit_news_img').removeClass('d-none');

                } else {

                    $('.check-edit_news_img').text('').append(error_txt + ' Image Must be in JPG/PNG').removeClass('d-none');
                    array.push('yes');
                }

            }


            if (topic_nm.trim() != 0) {

                $('.check-edit_topic').addClass('d-none');

                if (array.length == 0) {

                    if (news_text.trim() != '') {

                        $('.check-edit_news_text').addClass('d-none');

                        if (start_date != null) {

                            $('.check-edit_start_date').addClass('d-none');

                            if (end_date != null) {

                                $('.check-edit_end_date').addClass('d-none');

                                if (ValidateTwoDate(start_date, end_date)) {

                                    var formdata = new FormData();
                                    formdata.append('edit_news_token', edit_news_token);
                                    formdata.append('topic_nm', topic_nm);
                                    formdata.append('topic_img', topic_img);
                                    formdata.append('news_text', news_text);
                                    formdata.append('start_date', convertstrtodate(start_date));
                                    formdata.append('end_date', convertstrtodate(end_date));
                                    formdata.append('id', $('.del_btn').attr('id'));

                                    $.ajax({
                                        url: "Easylearn/Classroom_Controller/edit_news",
                                        data: formdata,
                                        type: "POST",
                                        contentType: false,
                                        processData: false,
                                        success: function (response) {
                                            // console.log(response);
                                            response = JSON.parse(response);
                                            if (response.data == 'TRUE') {
                                                Swal.fire({
                                                    icon: "success",
                                                    text: "Updated Succesfully",
                                                }).then((result) => {
                                                    location.reload();
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Oops...",
                                                    text: "Something went wrong!",
                                                }).then((result) => {
                                                    location.reload();
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
                                                    location.reload();
                                                });
                                            }, 1000);
                                        }
                                    });

                                    $('.check-edit_end_date').addClass('d-none');
                                    $('.check-edit_start_date').addClass('d-none');

                                } else {

                                    $('.check-edit_end_date').text('').append(error_txt + ' Invalid End Date!').removeClass('d-none');
                                    $('.check-edit_start_date').text('').append(error_txt + ' Invalid Start Date !').removeClass('d-none');

                                }

                            } else {

                                $('.check-edit_end_date').text('').append(error_txt + ' End Date is Required!').removeClass('d-none');

                            }

                        } else {

                            $('.check-edit_start_date').text('').append(error_txt + ' Start Date is Required!').removeClass('d-none');

                        }




                    } else {

                        $('.check-edit_news_text').text('').append(error_txt + ' News Field is Required!').removeClass('d-none');

                    }
                }



            } else {

                $('.check-edit_topic').text('').append(error_txt + ' Topic Cannot be Blank').removeClass('d-none');

            }

        });

    }

    if (location.pathname.split('/').slice(-1)[0] == 'manageannouncements') {


        $('#anc_list').DataTable({

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
            select: true,
            ajax: {
                url: "Easylearn/Classroom_Controller/get_anc",
                type: "POST",
                dataSrc: function (json) {

                    if(json.data != 'FALSE'){

                        return json.data;

                    }else{

                        return {};

                    }
                    
                },
            },
            rowId: "id",
            columns: [
                {
                    data: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "announcement_topic",

                },
                {
                    data: "announcement",
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return `${row.announcement_date} ${row.announcement_time}`;
                    },
                }

            ],
        });


        $('#anc_list tbody').on('dblclick', 'tr', function () {
            var id = $(this).attr('id');
            $('#edit_anc_modal').modal('show');
            var formdata = new FormData();
            formdata.append('id', id);

            $.ajax({
                url: "Easylearn/Classroom_Controller/get_anc_id",
                data: formdata,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (response) {

                    // console.log(response);
                    response = JSON.parse(response);
                    $('#edit_topic').val(response.data.announcement_topic);
                    $('#edit_anc_date').datepicker('setDate', response.data.announcement_date);
                    $('#edit_anc_time').val(response.data.announcement_time);
                    $('#edit_announcements').val(response.data.announcement);
                    $('.del_anc_btn').attr('id', id);

                },
                error: function (response) {
                    // console.log(response);
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

        $('#anc_time').timepicker({
            showInputs: false
        });

        $('#edit_anc_time').timepicker({
            showInputs: false
        });

        $('#topic').on('keyup', function () {

            if ($(this).val().trim() != '') {

                $('.check-topic').addClass('d-none');

            } else {

                $('.check-topic').text('').append(error_txt + ' Topic Cannot Be Blank').removeClass('d-none');

            }
        });

        $('#edit_topic').on('keyup', function () {

            if ($(this).val().trim() != '') {

                $('.check-edit_topic').addClass('d-none');

            } else {

                $('.check-edit_topic').text('').append(error_txt + ' Topic Cannot Be Blank').removeClass('d-none');

            }
        });


        $('#announcements').on('keyup', function () {
            
            if ($(this).val().trim() != '') {

                $('.check-announcements').addClass('d-none');

            } else {

                $('.check-announcements').text('').append(error_txt + ' Announcements Cannot Be Blank').removeClass('d-none');

            }

        });

        $('#edit_announcements').on('keyup', function () {
            
            if ($(this).val().trim() != '') {

                $('.check-edit_announcements').addClass('d-none');

            } else {

                $('.check-edit_announcements').text('').append(error_txt + ' Announcements Cannot Be Blank').removeClass('d-none');

            }

        });

        $('#add_anc_btn').on('click', function () {
            $('#add_anc_modal').modal('show');
            $("#anc_date").datepicker('setDate', new Date());
        });

        $("#anc_date").datepicker({
            startDate: '-0m',
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
        });

        $("#edit_anc_date").datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
        });

        $('#add_anc_form').on('submit', function (e) {

            e.preventDefault();
            var anc_token = $('#anc_token').val();
            var topic = $('#topic').val();
            var anc_date = $('#anc_date').datepicker('getDate');
            var anc_time = $('#anc_time').val();
            var announcements = $('#announcements').val();
            if (topic.trim() != '') {

                $('.check-topic').addClass('d-none');

                if (anc_date) {

                    $('.check-anc_date').addClass('d-none');

                    if (anc_time) {

                        $('.check-anc_time').addClass('d-none');

                        if (announcements.trim() != '') {

                            $('.check-announcements').addClass('d-none');

                            var formdata = new FormData();
                            formdata.append('anc_token', anc_token);
                            formdata.append('topic', topic);
                            formdata.append('anc_date', convertstrtodate(anc_date));
                            formdata.append('anc_time', convertTime12to24(anc_time));
                            formdata.append('announcements', announcements);

                            $.ajax({
                                url: "Easylearn/Classroom_Controller/add_anc",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) {

                                    response = JSON.parse(response);
                                    if (response.data == 'TRUE') {
                                        Swal.fire({
                                            icon: "success",
                                            text: "Added Succesfully",
                                        }).then((result) => {
                                            location.reload();
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
                                    // console.log(response);
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

                        } else {

                            $('.check-announcements').text('').append(error_txt + ' Announcements Cannot Be Blank').removeClass('d-none');
                        }

                    } else {

                        $('.check-anc_time').text('').append(error_txt + ' Time Cannot Be Blank').removeClass('d-none');

                    }

                } else {

                    $('.check-anc_date').text('').append(error_txt + ' Date Cannot Be Blank').removeClass('d-none');

                }

            } else {

                $('.check-topic').text('').append(error_txt + ' Topic Cannot Be Blank').removeClass('d-none');

            }
        });


        $('#edit_anc_form').on('submit', function (e) {

            e.preventDefault();
            var edit_anc_token = $('#edit_anc_token').val();
            var topic = $('#edit_topic').val();
            var anc_date = $('#edit_anc_date').datepicker('getDate');
            var anc_time = $('#edit_anc_time').val();
            var announcements = $('#edit_announcements').val();

            if (topic.trim() != '') {

                $('.check-edit_topic').addClass('d-none');

                if (anc_date) {
                    $('.check-edit_anc_date').addClass('d-none');

                    if (anc_time) {

                        $('.check-edit_anc_time').addClass('d-none');

                        if (announcements.trim() != '') {

                            $('.check-edit_announcements').addClass('d-none');

                            var formdata = new FormData();
                            formdata.append('edit_anc_token', edit_anc_token);
                            formdata.append('topic', topic);
                            formdata.append('anc_date', convertstrtodate(anc_date));
                            formdata.append('anc_time', convertTime12to24(anc_time));
                            formdata.append('announcements', announcements);
                            formdata.append('id', $('.del_anc_btn').attr('id'));
                            // console.log(anc_date);
                            $.ajax({
                                url: "Easylearn/Classroom_Controller/edit_anc",
                                data: formdata,
                                type: "POST",
                                contentType: false,
                                processData: false,
                                success: function (response) {

                                    response = JSON.parse(response);
                                    if (response.data == 'TRUE') {
                                        Swal.fire({
                                            icon: "success",
                                            text: "Updated Succesfully",
                                        }).then((result) => {
                                            location.reload();
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
                                    // console.log(response);
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

                        } else {

                            $('.check-edit_announcements').text('').append(error_txt + ' Announcements Cannot Be Blank').removeClass('d-none');

                        }

                    } else {

                        $('.check-edit_anc_time').text('').append(error_txt + ' Time Cannot Be Blank').removeClass('d-none');

                    }

                } else {
                    $('.check-edit_anc_date').text('').append(error_txt + ' Date Cannot Be Blank').removeClass('d-none');
                }

            } else {

                $('.check-edit_topic').text('').append(error_txt + ' Topic Cannot Be Blank').removeClass('d-none');

            }

        });


        $('.del_anc_btn').on('click', function () {

            var id = $(this).attr('id');

            var formdata = new FormData();
            formdata.append('id', id);

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to proceed further!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "Easylearn/Classroom_Controller/del_anc",
                        data: formdata,
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: function (response) {

                            response = JSON.parse(response);
                            if (response.data == 'TRUE') {
                                Swal.fire({
                                    icon: "success",
                                    text: "Deleted Succesfully",
                                }).then((result) => {
                                    location.reload();
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
                            // console.log(response);
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
                }

            });

        });

    }

});