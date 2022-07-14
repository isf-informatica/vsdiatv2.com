
$(document).ready(function(){

    function convertstrtodate(str) 
    {
        var date = new Date(str),
            mnth = ("0" + (date.getMonth() + 1)).slice(-2),
            day = ("0" + date.getDate()).slice(-2);

        return [date.getFullYear(), mnth, day].join("-");
    }

    if (location.pathname.split('/').slice(-1)[0] == 'manageLectures') 
    {
        $('.timepicker').timepicker({
            showInputs: false,
        });

        var picker = $('.timepicker').data('datetimepicker');

        $("#lecture_date").datepicker({
            startDate: '-0m',
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
        })

        function validate_time(start_time, end_time)
        {
            start_time = start_time.split(" ");
            var time = start_time[0].split(":");
            var stime = time[0];

            if(start_time[1] == "PM" && stime<12) stime = parseInt(stime) + 12;
            start_time = stime + ":" + time[1] + ":00";
        
            end_time = end_time.split(" ");
            var time1 = end_time[0].split(":");
            var etime = time1[0];

            if(end_time[1] == "PM" && etime<12) etime = parseInt(etime) + 12;
            end_time = etime + ":" + time1[1] + ":00";
        
            if (start_time != '' && end_time != '') 
            { 
                if (end_time <= start_time) {
                    return false;
                }
                else
                {
                    return true;
                }
            }
        }

        var calendarEl = document.getElementById('schedule_calendar');
        // initialize the calendar
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,today,next',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            editable: true,
            eventDrop: function(info) {
                start_date = info.event.startStr;
                start_date = start_date.substring(0, start_date.indexOf('T'));
                id = info.event.id;

                $.ajax({
                    url: "Easylearn/Classroom_Controller/drag_schedule",
                    data: {
                        id         : id,
                        start_date : start_date,
                    },
                    type: "POST",
                    success: function (response) {                    
                        calendar.refetchEvents();
                    },
                    error: function (response) {
                        console.log("Error: "+response);
                    }
                });
            },
            // weekNumbers: true,
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            selectable: true,
            nowIndicator: true,
            events: function(start, successCallback) {

                $.ajax({
                    url: "Easylearn/Classroom_Controller/load_schedule",
                    type: "POST",
                    success: function (response) {  
                        response = JSON.parse(response)
                        events = [];

                        if(response.data.length >0){
                            response.data.forEach(function (Index, i) {
                                events.push({
                                    'id'        : response.data[i].id,
                                    'title'     : response.data[i].title,
                                    'start'     : response.data[i].start_date+' '+response.data[i].start_time,
                                    'end'       : response.data[i].start_date+' '+response.data[i].end_time,
                                    'className' : 'bg-'+response.data[i].class_name,
                                    'url'       : response.data[i].meet_url,
                                });
                            });
                            successCallback(events);
                        }
                        else
                        {
                            successCallback(events);
                        }
                    },
                    error: function (response) {
                        console.log("Error: "+response);
                    }
                });
            },
            eventClick: function(event) {
                id = event.event.id;

                $.ajax({
                    url: "Easylearn/Classroom_Controller/load_schedule_id",
                    data: {
                        id : id,
                    },
                    type: "POST",
                    success: function (response) {  
                        $('#edit_schedule')[0].reset();
                        response = JSON.parse(response);
                        $('#start_date').val(response.data['start_date']);
                        $('#schedule_name').val(response.data['title']);
                        $('#schedule_color').val(response.data['class_name']);
                        $('#sc_course_name').val(response.data['course_id']);
                        $('#schedule_start_time').val(response.data['start_time']);
                        $('#schedule_end_time').val(response.data['end_time']);
                        $('#schedule_mentor').val(response.data['lecturer_id']),
                        $('#schedule_url').val(response.data['meet_url']);
                        $('#meet_url').attr('href', response.data['meet_url']);
                        $('.delete_schedule').attr('data-id', response.data['id']);

                        $('#edit-category').modal('show');
                    },
                    error: function (response) {
                        console.log("Error: "+response);
                    }
                });
                event.jsEvent.preventDefault();
            }
        });

        calendar.render();

        $('.delete_schedule').on('click', function(){
            var id = $(this).attr('data-id');

            $.ajax({
                url: "Easylearn/Classroom_Controller/remove_schedule",
                data: {
                    id : id,
                },
                type: "POST",
                success: function (response) {  
                    Swal.fire({
                        icon: "success",
                        title: "Delete successfully",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    calendar.refetchEvents();
                },
                error: function (response) {
                    console.log("Error: "+response);
                }
            });

            $('#edit-category').modal('hide');

            calendar.refetchEvents();

        });

        //Lecture Name
        $('#lecture_name').on('keyup', function(){
            if($(this).val().trim() != '')
            {
                $('.check_lecture_name').addClass('d-none');
            }
            else
            {
                $('.check_lecture_name').removeClass('d-none');
            }
        });

        $('#lecture_date').on('change', function(){
            var date  = $(this).val().trim();

            if(date != '')
            {
                $('.check_lecture_date').addClass('d-none');
            }
            else
            {
                $('.check_lecture_date').removeClass('d-none');
            }
        });

        $('#lecture_start_time').on('change', function(){
            var start_time     = $('#lecture_start_time').val().trim();

            if(start_time != '')
            {
                $('.check_lecture_start_time').addClass('d-none');
            }
            else
            {
                $('.check_lecture_start_time').removeClass('d-none');
            }
        });

        $('#lecture_end_time').on('change', function(){
            var start_time     = $('#lecture_start_time').val().trim();
            var end_time       =  $('#lecture_end_time').val().trim();

            if(validate_time(start_time, end_time))
            {
                $('.check_lecture_end_time').addClass('d-none');
            }
            else
            {
                $('.check_lecture_end_time').removeClass('d-none');
            }
        });

        //Add Schedule
        $('#add_schedule').on('submit',function(e){
            e.preventDefault();

            var lec_name           = $('#lecture_name').val().trim();
            var lecture_date       = $("#lecture_date").datepicker('getDate');
            var lecturer_name      = $('#lecturer_name').val().trim();
            var batch_name         = $('#batch_name').val().trim();
            var lecture_color      = $('#lecture_color').val().trim();
            var start_time         = $('#lecture_start_time').val().trim();
            var end_time           = $('#lecture_end_time').val().trim();
            var add_schedule_token = $('#add_schedule_token').val().trim();

            if(lec_name != '')
            {
                if(lecture_date != '')
                {
                    if(validate_time(start_time, end_time))
                    {
                        var formdata = new FormData();
                        formdata.append('add_schedule_token', add_schedule_token);
                        formdata.append('lec_name'          , lec_name);
                        formdata.append('lecture_date'      , convertstrtodate(lecture_date));
                        formdata.append('lecturer_name'     , lecturer_name);
                        formdata.append('batch_name'        , batch_name);
                        formdata.append('lecture_color'     , lecture_color);
                        formdata.append('start_time'        , start_time);
                        formdata.append('end_time'          , end_time);
                        
                        $('#loader').css('display', 'block');

                        $.ajax({
                            url: "Easylearn/Classroom_Controller/add_schedule",
                            type: "POST",
                            data: formdata,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                response = JSON.parse(response);
                                $('#loader').css('display', 'none');

                                if (response["data"] == "TRUE") 
                                {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Added successfully",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    }).then((result) => {
                                        $('#add_schedule')[0].reset();
                                        $('#add_schedule_modal').modal('hide');
                                        get_lec_list();
                                    });
                                } 
                                else 
                                {
                                    $(".preloader").fadeOut();
                        
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: response.data,
                                    });
                                }
                            },
                            error: function (response) {
                                $('#loader').css('display', 'none');
                    
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something Went Wrong",
                                }).then((result) => {
                                    //location.reload();
                                });
                            },
                        });

                        calendar.refetchEvents();
                    }
                    else
                    {
                        $('.check_lecture_end_time').removeClass('d-none');
                    }
                }
                else
                {
                    $('.check_lecture_date').removeClass('d-none');
                }
            }
            else
            {
                $('.check_lecture_name').removeClass('d-none');
            }
        });

        $('#edit_schedule').on('submit',function(e){
            var start_date          = $('#start_date').val().trim();
            var edit_schedule_token = $('#edit_schedule_token').val().trim();
            var id                  = $('.delete_schedule').attr('data-id');
            var schedule_name       = $('#schedule_name').val().trim();
            var schedule_color      = $('#schedule_color').val().trim();
            var schedule_start_time = $('#schedule_start_time').val().trim();
            var schedule_end_time   = $('#schedule_end_time').val().trim();    
            var schedule_mentor     = $('#schedule_mentor').val().trim();
            var sc_batch_name       = $('#sc_batch_name').val().trim();

            var formdata = new FormData();
            formdata.append('start_date'          , start_date);
            formdata.append('id'                  , id);
            formdata.append('edit_schedule_token' , edit_schedule_token);
            formdata.append('sc_batch_name'       , sc_batch_name);
            formdata.append('schedule_name'       , schedule_name);
            formdata.append('schedule_color'      , schedule_color);
            formdata.append('schedule_mentor'     , schedule_mentor);
            formdata.append('schedule_start_time' , schedule_start_time);
            formdata.append('schedule_end_time'   , schedule_end_time);

            $('#loader').css('display', 'block');
            $.ajax({
                url: "Easylearn/Classroom_Controller/edit_schedule",
                type: "POST",
                data: formdata,
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
                            title: "Updated successfully",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then((result) => {
                            $('#edit_schedule')[0].reset();
                            $('#edit-category').modal('hide');
                            get_lec_list();
                            calendar.refetchEvents();
                        });
                    } 
                    else 
                    {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.data,
                        });
                    }
                },
                error: function (response) 
                {
                    $('#loader').css('display', 'none');

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something Went Wrong",
                    }).then((result) => {
                        location.reload();
                    });
                },
            });

        });
    }

    if (location.pathname.split('/').slice(-1)[0] == 'lectures') 
    {
        var calendarEl = document.getElementById('schedule_calendar');
        // initialize the calendar
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,today,next',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            editable: false,
            // weekNumbers: true,
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            selectable: true,
            nowIndicator: true,
            events: function(start, successCallback) {

                $.ajax({
                    url: "Easylearn/Classroom_Controller/load_schedule_student",
                    type: "POST",
                    success: function (response) {  
                        response = JSON.parse(response)
                        events = [];

                        if(response.data.length >0)
                        {
                            response.data.forEach(function (Index, i) {
                                events.push({
                                    'id'        : response.data[i].id,
                                    'title'     : response.data[i].title,
                                    'start'     : response.data[i].start_date+' '+response.data[i].start_time,
                                    'end'       : response.data[i].start_date+' '+response.data[i].end_time,
                                    'className' : 'bg-'+response.data[i].class_name,
                                    'url'       : response.data[i].meet_url,
                                });
                            });
                            successCallback(events);
                        }
                        else
                        {
                            successCallback(events);
                        }
                    },
                    error: function (response) {
                        console.log("Error: "+response);
                    }
                });
            },
            eventClick: function(event) {
                window.open(event.event.url);

                event.jsEvent.preventDefault();
            }
        });

        calendar.render();
    }
});
