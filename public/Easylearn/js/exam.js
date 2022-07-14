$(document).ready(function () {

	if(location.pathname.split('/').slice(-1)[0] == 'manageExam')
    {
    	$.ajax({
	        url: "Easylearn/Course_Controller/get_classroom_course",
	        type: "POST",
	        data : {
	            id : $('#classroom_id').val()
	        },
	        success: function (response) 
	        {
	            $('#exam_course').empty();
	            response = JSON.parse(response);
	            if(response.data!='FALSE'){
	                response.data.forEach(function (Index, i) {
	                    $('#exam_course').append("<option value='" + response.data[i].id + "'> " + response.data[i].course_name + " </option>");
	                });
	            }    
	        },
	        error: function (response) 
	        {
	            console.log(response);
	        }
	    });

	   $('#classroom_id').on('change', function() {
	        var id = $(this).val();

	        $.ajax({
	            url: "Easylearn/Course_Controller/get_classroom_course",
	            type: "POST",
	            data : {
	                id : id
	            },
	            success: function (response) 
	            {
	                $('#exam_course').empty();
	                response = JSON.parse(response);

	                if(response.data!='FALSE'){
	                    response.data.forEach(function (Index, i) {
	                        $('#exam_course').append("<option value='" + response.data[i].id + "'> " + response.data[i].course_name + " </option>");
	                    });
	                }
	            },
	            error: function (response) 
	            {
	                console.log(response);
	            }
	        });
	    });

	    $("#exam_date").datepicker({
	        format:'dd-mm-yyyy',
	        orientation:'bottom',
	        startDate: new Date()
	    });

	    function validate_time(start_time, end_time){
	        start_time = start_time.split(" ");
	        var time = start_time[0].split(":");
	        var stime = time[0];

	        if(start_time[1] == "PM" && stime<12) stime = parseInt(stime) + 12;
	        start_time = stime + ":" + time[1] + ":00";
	    
	        end_time = end_time.split(" ");
	        var time1 = end_time[0].split(":");
	        var etime = time1[0];

	        if(end_time[1] == "PM" && etime<12) etime = parseInt(etime) + 12;
	        end_time = etime + ":" + (time1[1]-1) + ":00";
	    
	        if (start_time != '' && end_time != '') 
	        { 
	            if (end_time < start_time) {
	                return false;
	            }
	            else
	            {
	                return true;
	            }
	        }
	    }

	    function user_time(){
	        var currentdate = new Date(); 
	        var datetime = currentdate.getFullYear() + "/"
	                        + (currentdate.getMonth()+1)  + "/" 
	                        + currentdate.getDate() + " "
	                        + currentdate.getHours() + ":"  
	                        + currentdate.getMinutes() + ":" 
	                        + currentdate.getSeconds();
	        return datetime;
	    }

	    //ValidateCSV
	    function ValidateCSV(file)
	    {
	        if(file == null)
	        {
	            return false;
	        }
	        else
	        {
	            var fileType = file['type'];
	            var validCSSTypes = ['application/vnd.ms-excel', 'text/csv'];

	            return validCSSTypes.includes(fileType); 
	        }
	    }

	    //ValidateImage
	    function ValidateImage(file) {
	        var fileType = file["type"];
	        var validImageTypes = ["image/gif", "image/jpeg", "image/png"];

	        return validImageTypes.includes(fileType);
	    }

	    //Exam Title
	    $('#exam_title').on('keyup', function(){
	        if($(this).val() == '')
	        {
	            $('.check_exam_title').removeClass('d-none');
	        }
	        else
	        {
	            $('.check_exam_title').addClass('d-none');
	        }
	    });

	    //Exam Date
	    $('#exam_date').on('change', function(){
	        if($(this).val() == '')
	        {
	            $('.check_exam_date').removeClass('d-none');
	        }
	        else
	        {
	            $('.check_exam_date').addClass('d-none');
	        }
	    });

	    //Exam Start Time
	    $('#exam_start_time').on('change', function(){
	        if($(this).val() == '')
	        {
	            $('.check_exam_start_time').removeClass('d-none');
	        }
	        else
	        {
	            $('.check_exam_start_time').addClass('d-none');
	        }
	    });

	    //Exam End Time
	    $('#exam_end_time').on('change', function(){
	        if($(this).val() == '')
	        {
	            $('.check_exam_end_time').removeClass('d-none');
	        }
	        else
	        {
	            $('.check_exam_end_time').addClass('d-none');
	        }
	    });

	    //Exam Right Mark
	    $('#exam_right_mark').on('keyup', function(){
	        if(Number($(this).val()) <= 0)
	        {
	            $('.check_exam_right_mark').removeClass('d-none');
	        }
	        else
	        {
	            $('.check_exam_right_mark').addClass('d-none');
	        }
	    });

	    //Exam Wrong Mark
	    $('#exam_wrong_mark').on('keyup', function(){
	        if($(this).val() == '')
	        {
	            $('.check_exam_wrong_mark').removeClass('d-none');
	        }
	        else
	        {
	            $('.check_exam_wrong_mark').addClass('d-none');
	        }
	    });

	    //Exam Duration
	    $('#exam_duration').on('keyup', function(){
	        if(Number($(this).val()) <= 0)
	        {
	            $('.check_exam_duration').removeClass('d-none');
	        }
	        else
	        {
	            $('.check_exam_duration').addClass('d-none');
	        }
	    });

	   $('#add_mcq_exam').on('submit', function(event){

	        var add_exam_token    = $('#add_exam_token').val();
	        var exam_title        = $('#exam_title').val();
	        var classroom_id      = $('#classroom_id').val();
	        var exam_course       = $('#exam_course').val();
	        var exam_type         = $('#exam_type').val();
	        var exam_module       = $('#exam_module').val();
	        var exam_date         = $('#exam_date').val();
	        var exam_duration     = $('#exam_duration').val();
	        var exam_category     = $('#exam_category').val();
	        var exam_start_time   = $('#exam_start_time').val();
	        var exam_end_time     = $('#exam_end_time').val();
	        var exam_right_mark   = $('#exam_right_mark').val();
	        var exam_wrong_mark   = $('#exam_wrong_mark').val();

	        if(document.getElementById('show_result').checked)
	        {
	            var show_result = 1;
	        }
	        else
	        {
	            var show_result = 0;
	        }

	        if(document.getElementById('multiple_response').checked)
	        {
	            var multiple_response = 1;
	        }
	        else
	        {
	            var multiple_response = 0;
	        }

	        if(exam_title == '')
	        {
	            $('.check_exam_title').removeClass('d-none');
	        }
	        else
	        {
	        	if(classroom_id=='')
	        	{
	        		$('.check_classroom_id').removeClass('d-none');
	        	}
	        	else
	        	{
		            if(exam_date == '')
		            {
		                $('.check_exam_date').removeClass('d-none');
		            }
		            else
		            {
		                if(exam_start_time == '')
		                {
		                    $('.check_exam_start_time').removeClass('d-none');
		                }
		                else
		                {
		                    if(exam_end_time == '')
		                    {
		                        $('.check_exam_end_time').removeClass('d-none');
		                    }
		                    else
		                    {
		                        if(!validate_time(exam_start_time, exam_end_time))
		                        {
		                            $('.check_exam_end_time').removeClass('d-none');
		                        }
		                        else
		                        {
		                            if(Number(exam_right_mark) <= 0)
		                            {
		                                $('.check_exam_right_mark').removeClass('d-none');
		                            }
		                            else
		                            {
		                                if(Number(exam_wrong_mark) > Number(exam_right_mark))
		                                {
		                                    $('.check_exam_wrong_mark').removeClass('d-none');
		                                }
		                                else
		                                {
		                                    if(Number(exam_duration) <= 0)
		                                    {
		                                        $('.check_exam_duration').removeClass('d-none');
		                                    }
		                                    else
		                                    {
		                                        $("#loader").css("display", "block");

		                                        formdata = new FormData();

		                                        formdata.append('add_exam_token'   , add_exam_token);
		                                        formdata.append('exam_title'       , exam_title);
		                                        formdata.append('classroom_id'     , classroom_id);
		                                        formdata.append('exam_course'      , exam_course);
		                                        formdata.append('exam_type'        , exam_type);
		                                        formdata.append('exam_module'      , exam_module);
		                                        formdata.append('exam_date'        , exam_date);
		                                        formdata.append('exam_duration'    , exam_duration);
		                                        formdata.append('exam_category'    , exam_category);
		                                        formdata.append('exam_start_time'  , exam_start_time);
		                                        formdata.append('exam_end_time'    , exam_end_time);
		                                        formdata.append('exam_right_mark'  , exam_right_mark);
		                                        formdata.append('exam_wrong_mark'  , exam_wrong_mark);
		                                        formdata.append('show_result'      , show_result);
		                                        formdata.append('multiple_response', multiple_response);

		                                        $.ajax({
		                                            url: 'Easylearn/Exam_Controller/add_mcq_exam',
		                                            data: formdata,
		                                            type: 'POST',
		                                            contentType: false,
		                                            processData: false,
		                                            success: function (response) 
		                                            {
		                                                var response = JSON.parse(response);
		                                                $('#loader').fadeOut();
		                            
		                                                setTimeout(function () {
		                            
		                                                    if(response['data'] == 'TRUE')
		                                                    {
		                                                        Swal.fire({
		                                                            icon: 'success',
		                                                            title: 'Successfully Added',
		                                                            showConfirmButton: false,
		                                                            timer: 1500
		                                                        }).then((result) => {
		                                                            location.href = 'manageExam';
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
		                                                }, 1000);
		                                            },
		                                            error: function (response) 
		                                            {
		                                                setTimeout(function () {
		                                                    $('#loader').fadeOut();
		                            
		                                                    Swal.fire({
		                                                        icon: 'error',
		                                                        title: 'Oops...',
		                                                        text: 'Something went wrong!',
		                                                    }).then((result) => {
		                                                        //location.reload();
		                                                    });
		                                                }, 1000);
		                                            }
		                                        });
		                                    }
		                                }
		                            }
		                        }
		                    }
		                }
		            }   
			    }
	        }

	        event.preventDefault();
	    });

		$("#exam_list").DataTable({
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
	            url: "Easylearn/Exam_Controller/get_all_exam",
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
	                data: "exam_title"
	            },
	            {
	                data: "exam_category"
	            },
	            {
	                data: "course_name"
	            },
	            {
	                data: "exam_date"
	            },
	            {
	                data: "exam_start_time"
	            },
	            {
	                data: "exam_end_time"
	            },
	            {
	                data: null,
	                render: function (data, type, row, meta) {
	                    if (row.visibility == 1) {
	                        return `<button type="button" style='border-radius: 20px;' class="btn exam_visibility btn-sm btn-toggle focus active" data-id="${row.unique_id}" data-toggle="button" aria-pressed="true" autocomplete="off">
                                        <div style='border-radius: 50%;' class="handle"></div>
                                    </button>`;
	                    } else {
	                        return `<button type="button" style='border-radius: 20px;' class="btn exam_visibility btn-sm btn-toggle" data-id="${row.unique_id}" data-toggle="button" aria-pressed="false" autocomplete="off">
                                        <div style='border-radius: 50%;' class="handle"></div>
                                    </button>`;
	                    }

	                },
	            },
	            {
	                data: null,
	                render: function (data, type, row, meta) {
	                    return `<i class="fas fa-edit edit_exam" data-id="${row.unique_id}"></i>`;
	                },
	            },
	        ],

	    });

	    $(document).on('click', '.exam_visibility', function(){
	        var id = $(this).attr('data-id');
	        var visibility = 0;

	        if($(this).hasClass('active'))
	        {
	            visibility = 1;
	        }

	        $.ajax({
	            url: 'Easylearn/Exam_Controller/show_hide_exam',
	            type: 'POST',
	            data: {
	                'id'         : id,
	                'visibility' : visibility
	            },
	            success: function (response) 
	            {

	            },
	            error: function (response) 
	            {
	                console.log(response);
	            }
	        });
	    });


	    

	   $('#edit_classroom_id').on('change', function() {
	        var id = $(this).val();

	        $.ajax({
	            url: "Easylearn/Course_Controller/get_classroom_course",
	            type: "POST",
	            data : {
	                id : id
	            },
	            success: function (response) 
	            {
	                $('#edit_exam_course').empty();
	                response = JSON.parse(response);

	                if(response.data!='FALSE'){
	                    response.data.forEach(function (Index, i) {
	                        $('#edit_exam_course').append("<option value='" + response.data[i].id + "'> " + response.data[i].course_name + " </option>");
	                    });
	                }
	            },
	            error: function (response) 
	            {
	                console.log(response);
	            }
	        });
	    });

	    $(document).on('click', '.edit_exam', function(){
	        var id = $(this).attr('data-id');

	        $.ajax({
	            url: "Easylearn/Exam_Controller/exam_detail_id",
	            data: {
	                id : id,
	            },
	            type: "POST",
	            success: function (response) {  
	                response = JSON.parse(response);

	                $('#edit_exam_title').val(response.data['exam_title']);
	                $('#edit_classroom_id').val(response.data['classroom_id']);
	                $('#edit_exam_course').val(response.data['course_id']);
	                $('#edit_exam_type').val(response.data['exam_type']);
	                $('#edit_exam_module').val(response.data['exam_module']);
	                $('#edit_exam_date').val(response.data['exam_date']);
	                $('#edit_exam_start_time').val(response.data['exam_start_time']);
	                $('#edit_exam_end_time').val(response.data['exam_end_time']);
	                $('#edit_exam_right_mark').val(response.data['exam_right_mark']);
	                $('#edit_exam_wrong_mark').val(response.data['exam_wrong_mark']);
	                $('#edit_exam_duration').val(response.data['exam_duration']);
	                $('#edit_exam_category').val(response.data['exam_category']);

	                if(response.data['show_result'] == 1)
	                {
	                    $('#edit_show_result').attr('checked', true);
	                }
	                if(response.data['multiple_response'] == 1)
	                {
	                    $('#edit_multiple_response').attr('checked', true);
	                }

	                $('#delete_mcq_exam').attr('data-id', response.data['unique_id']);
	                $('#edit-exam').modal('show');

	                $.ajax({
				        url: "Easylearn/Course_Controller/get_classroom_course",
				        type: "POST",
				        data : {
				            id : $('#edit_classroom_id').val()
				        },
				        success: function (response) 
				        {
				            $('#edit_exam_course').empty();
				            response = JSON.parse(response);
				            if(response.data!='FALSE'){
				                response.data.forEach(function (Index, i) {
				                    $('#edit_exam_course').append("<option value='" + response.data[i].id + "'> " + response.data[i].course_name + " </option>");
				                });
				            }    
				        },
				        error: function (response) 
				        {
				            console.log(response);
				        }
				    });
	            },
	            error: function (response) {
	                console.log("Error: "+response);
	            }
	        });
	    });

	    $('#edit_mcq_exam').on('submit', function(event){

	        var id                     = $('#delete_mcq_exam').attr('data-id');
	        var edit_exam_token        = $('#edit_exam_token').val();
	        var edit_exam_title        = $('#edit_exam_title').val();
	        var edit_classroom_id      = $('#edit_classroom_id').val();
	        var edit_exam_course       = $('#edit_exam_course').val();
	        var edit_exam_type         = $('#edit_exam_type').val();
	        var edit_exam_module       = $('#edit_exam_module').val();
	        var edit_exam_date         = $('#edit_exam_date').val();
	        var edit_exam_duration     = $('#edit_exam_duration').val();
	        var edit_exam_category     = $('#edit_exam_category').val();
	        var edit_exam_start_time   = $('#edit_exam_start_time').val();
	        var edit_exam_end_time     = $('#edit_exam_end_time').val();
	        var edit_exam_right_mark   = $('#edit_exam_right_mark').val();
	        var edit_exam_wrong_mark   = $('#edit_exam_wrong_mark').val();

	        if(document.getElementById('edit_show_result').checked)
	        {
	            var show_result = 1;
	        }
	        else
	        {
	            var show_result = 0;
	        }

	        if(document.getElementById('edit_multiple_response').checked)
	        {
	            var multiple_response = 1;
	        }
	        else
	        {
	            var multiple_response = 0;
	        }

	        if(edit_exam_title == '')
	        {
	            $('.check_edit_exam_title').removeClass('d-none');
	        }
	        else
	        {
	        	if(edit_classroom_id == '')
	            {
	                $('.check_edit_classroom_id').removeClass('d-none');
	            }	
	            else
	            {
		            if(edit_exam_date == '')
		            {
		                $('.check_edit_exam_date').removeClass('d-none');
		            }
		            else
		            {
		                if(edit_exam_start_time == '')
		                {
		                    $('.check_edit_exam_start_time').removeClass('d-none');
		                }
		                else
		                {
		                    if(edit_exam_end_time == '')
		                    {
		                        $('.check_edit_exam_end_time').removeClass('d-none');
		                    }
		                    else
		                    {
		                        if(!validate_time(edit_exam_start_time, edit_exam_end_time))
		                        {
		                            $('.check_edit_exam_end_time').removeClass('d-none');
		                        }
		                        else
		                        {
		                            if(Number(edit_exam_right_mark) <= 0)
		                            {
		                                $('.check_edit_exam_right_mark').removeClass('d-none');
		                            }
		                            else
		                            {
		                                if(Number(edit_exam_wrong_mark) > Number(edit_exam_right_mark))
		                                {
		                                    $('.check_edit_exam_wrong_mark').removeClass('d-none');
		                                }
		                                else
		                                {
		                                    if(Number(edit_exam_duration) <= 0)
		                                    {
		                                        $('.check_edit_exam_duration').removeClass('d-none');
		                                    }
		                                    else
		                                    {
		                                        $("#loader").css("display", "block");

		                                        formdata = new FormData();

		                                        formdata.append('id'                    , id);
		                                        formdata.append('edit_exam_token'       , edit_exam_token);
		                                        formdata.append('edit_exam_title'       , edit_exam_title);
		                                        formdata.append('edit_classroom_id'     , edit_classroom_id);
		                                        formdata.append('edit_exam_course'      , edit_exam_course);
		                                        formdata.append('edit_exam_type'        , edit_exam_type);
		                                        formdata.append('edit_exam_module'      , edit_exam_module);
		                                        formdata.append('edit_exam_date'        , edit_exam_date);
		                                        formdata.append('edit_exam_duration'    , edit_exam_duration);
		                                        formdata.append('edit_exam_category'    , edit_exam_category);
		                                        formdata.append('edit_exam_start_time'  , edit_exam_start_time);
		                                        formdata.append('edit_exam_end_time'    , edit_exam_end_time);
		                                        formdata.append('edit_exam_right_mark'  , edit_exam_right_mark);
		                                        formdata.append('edit_exam_wrong_mark'  , edit_exam_wrong_mark);
		                                        formdata.append('show_result'           , show_result);
		                                        formdata.append('multiple_response'     , multiple_response);
		                                    

		                                        $.ajax({
		                                            url: 'Easylearn/Exam_Controller/edit_mcq_exam',
		                                            data: formdata,
		                                            type: 'POST',
		                                            contentType: false,
		                                            processData: false,
		                                            success: function (response) 
		                                            {
		                                                var response = JSON.parse(response);
		                                                $('#loader').fadeOut();
		                            
		                                                setTimeout(function () {
		                            
		                                                    if(response['data'] == 'TRUE')
		                                                    {
		                                                        Swal.fire({
		                                                            icon: 'success',
		                                                            title: 'Successfully Edited',
		                                                            showConfirmButton: false,
		                                                            timer: 1500
		                                                        }).then((result) => {
		                                                            location.href = 'manageExam';
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
		                                                }, 1000);
		                                            },
		                                            error: function (response) 
		                                            {
		                                                setTimeout(function () {
		                                                    $('#loader').fadeOut();
		                            
		                                                    Swal.fire({
		                                                        icon: 'error',
		                                                        title: 'Oops...',
		                                                        text: 'Something went wrong!',
		                                                    }).then((result) => {
		                                                        //location.reload();
		                                                    });
		                                                }, 1000);
		                                            }
		                                        });
		                                    }
		                                }
		                            }
		                        }
		                    }
		                }
		            }
		        }
	        }

	        event.preventDefault();
	    });


		$('#delete_mcq_exam').on('click', function(){
	        var id = $(this).attr('data-id');

	        Swal.fire({
	            title: 'Are you sure?',
	            text: "You want to delete this Exam!",
	            icon: 'warning',
	            showCancelButton: true,
	            confirmButtonColor: '#3085d6',
	            cancelButtonColor: '#d33',
	            confirmButtonText: 'Delete'
	        }).then((result) => {
	            if (result.isConfirmed) {
	                $("#loader").css("display", "block");

	                $.ajax({
	                    url: 'Easylearn/Exam_Controller/delete_mcq_exam',
	                    data: {
	                        id : id
	                    },
	                    type: 'POST',
	                    success: function (response) 
	                    {
	                        var response = JSON.parse(response);
	                        $("#loader").css("display", "none");
	    
	                        setTimeout(function () {
	    
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
	                        }, 1000);
	                    },
	                    error: function (response) 
	                    {
	                        setTimeout(function () {
	                            $("#loader").css("display", "none");
	    
	                            Swal.fire({
	                                icon: 'error',
	                                title: 'Oops...',
	                                text: 'Something went wrong!',
	                            }).then((result) => {
	                                //location.reload();
	                            });
	                        }, 1000);
	                    }
	                });
	            }
	        });
	    });
	    
    }
	
});