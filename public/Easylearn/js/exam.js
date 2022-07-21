$(document).ready(function () {

	$('.timepicker').timepicker({
        showInputs: false
    });

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
	        createdRow:function(row,data,dataIndex){
	        	$(row).attr('data-id',data.exam_category);
	        },
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

	    $('#exam_list tbody').on('dblclick', 'tr', function () {
        	var unique = $(this).attr('id');
        	var category = $(this).attr('data-id');
        	if(category == "MCQ Exam")
            {
                location.href = 'Examdetail?id='+unique;
            }
            if(category == "Sentence Completion")
            {
                location.href = 'sentence_exam_detail?id='+unique;
            }
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

    if(location.pathname.split('/').slice(-1)[0] == 'Examdetail')
    {
    	$('.dropify').dropify();
        //Question Title
        $('#question_title').on('keyup', function(){
            if($(this).val() == '')
            {
                $('.check_question_title').removeClass('d-none');
            }
            else
            {
                $('.check_question_title').addClass('d-none');
            }
        });

        //Question Image
        $('#question_image').on('change', function(){
            var file = this.files[0];

            if(file == null)
            {
                $('.check_question_image').addClass('d-none');
            }
            else
            {
                if(ValidateImage(file))
                {
                    $('.check_question_image').addClass('d-none');
                }
                else
                {
                    $('.check_question_image').removeClass('d-none');
                } 
            }
        });

        //Option1
        $('#add_option_1').on('keyup', function(){
            if($(this).val() == '')
            {
                $('.check_add_option_1').removeClass('d-none');
            }
            else
            {
                $('.check_add_option_1').addClass('d-none');
            }
        });

        //Option2
        $('#add_option_2').on('keyup', function(){
            if($(this).val() == '')
            {
                $('.check_add_option_2').removeClass('d-none');
            }
            else
            {
                $('.check_add_option_2').addClass('d-none');
            }
        });

        //Add MCQ Form
        $('#add_mcq_question').on('submit', function(event){

            var unique_id          = (location.search.split(name + '=')[1] || '').split('&')[0];
            var add_question_token = $('#add_question_token').val();
            var question_title     = $('#question_title').val();
            var question_image     = document.getElementById('question_image').files[0];
            var add_option_1       = $('#add_option_1').val();
            var add_option_2       = $('#add_option_2').val();
            var add_option_3       = $('#add_option_3').val();
            var add_option_4       = $('#add_option_4').val();
            var add_option_5       = $('#add_option_5').val();
            var add_option_6       = $('#add_option_6').val();
            var add_option_7       = $('#add_option_7').val();
            var add_option_8       = $('#add_option_8').val();
            var add_option_9       = $('#add_option_9').val();
            var add_option_10      = $('#add_option_10').val();
            var add_answer_option  = $('#add_answer_option').val();

            if(question_title == '')
            {
                $('.check_question_title').removeClass('d-none');
            }
            else
            {
                if(question_image == null || ValidateImage(question_image))
                {
                    if(add_option_1 == '')
                    {
                        $('.check_add_option_1').removeClass('d-none');
                    }
                    else
                    {
                        if(add_option_2 == '')
                        {
                            $('.check_add_option_2').removeClass('d-none');
                        }
                        else
                        {
                            $("#loader").css("display", "block");                           

                            formdata = new FormData();

                            formdata.append('unique_id'         , unique_id);
                            formdata.append('add_question_token', add_question_token);
                            formdata.append('question_title'    , question_title);
                            formdata.append('question_image'    , question_image);
                            formdata.append('add_option_1'      , add_option_1);
                            formdata.append('add_option_2'      , add_option_2);
                            formdata.append('add_option_3'      , add_option_3);
                            formdata.append('add_option_4'      , add_option_4);
                            formdata.append('add_option_5'      , add_option_5);
                            formdata.append('add_option_6'      , add_option_6);
                            formdata.append('add_option_7'      , add_option_7);
                            formdata.append('add_option_8'      , add_option_8);
                            formdata.append('add_option_9'      , add_option_9);
                            formdata.append('add_option_10'     , add_option_10);
                            formdata.append('add_answer_option' , add_answer_option);                          

                            $.ajax({
                                url: 'Easylearn/Exam_Controller/add_mcq_question',
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
                else
                {
                    $('.check_question_image').removeClass('d-none');
                }
            }
            event.preventDefault();
        });

		//Delete MCQ Form
        $('.delete_mcq_question').on('click', function(){
            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this question!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#loader").css("display", "block");

                    $.ajax({
                        url: 'Easylearn/Exam_Controller/delete_mcq_question',
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


        //Multiple Question ADD
        $('#Multiple_QuestionAdd').on('click', function(event){

            var add_question_token  = $('#add_question_token').val();   
            var unique_id          = (location.search.split(name + '=')[1] || '').split('&')[0];
            var Multiple_Question   = document.getElementById('Multiple_Question').files[0];
    
            if(ValidateCSV(Multiple_Question))
            {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to proceed further!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $('#loader').css('display', 'block');
    
                        formdata = new FormData();
                        formdata.append('add_question_token' , add_question_token);
                        formdata.append('unique_id'          , unique_id);
                        formdata.append('question_csv'       , Multiple_Question);
    
                        $.ajax({
                            url: 'HTMLtoCSV/add_multiple_question',
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
                                            title: 'Successfully Added '+response.count,
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
                                            location.reload();
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
                                        location.reload();
                                    });
                                }, 1000);
                            }
                        });
                    }
                });
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Choose CSV file',
                });
            }
    
            event.preventDefault();
        });

		//Edit question Pop up
        $(document).on('click', '.edit_question', function(){
            var id = $(this).attr('data-id');

            $.ajax({
                url: "Easylearn/Exam_Controller/get_question_by_id",
                data: {
                    id : id,
                },
                type: "POST",
                success: function (response) {  
                    response = JSON.parse(response);

                    $('#edit_question_title').val(response.data['question_title']);
                    $('#edit_question_title').attr('data-id', id);
                    $('#view_question_image').attr('src', response.data['question_image'])
                    $('#edit_option_1').val(response.data['option_1']);
                    $('#edit_option_2').val(response.data['option_2']);
                    $('#edit_option_3').val(response.data['option_3']);
                    $('#edit_option_4').val(response.data['option_4']);
                    $('#edit_option_5').val(response.data['option_5']);
                    $('#edit_option_6').val(response.data['option_6']);
                    $('#edit_option_7').val(response.data['option_7']);
                    $('#edit_option_8').val(response.data['option_8']);
                    $('#edit_option_9').val(response.data['option_9']);
                    $('#edit_option_10').val(response.data['option_10']);
                    $('#edit_answer_option').val(response.data['answer_option']);

                    $('#edit-question').modal('show');
                },
                error: function (response) {
                    console.log("Error: "+response);
                }
            });
        });

        //Edit Question Title
        $('#edit_question_title').on('keyup', function(){
            if($(this).val() == '')
            {
                $('.check_edit_question_title').removeClass('d-none');
            }
            else
            {
                $('.check_edit_question_title').addClass('d-none');
            }
        });

        //Question Image
        $('#edit_question_image').on('change', function(){
            var file = this.files[0];

            if(file == null)
            {
                $('.check_edit_question_image').addClass('d-none');
                $('#view_question_image').attr('src', '');
            }
            else
            {
                if(ValidateImage(file))
                {
                    $('.check_edit_question_image').addClass('d-none');
                    $('#view_question_image').attr('src', URL.createObjectURL(file));
                }
                else
                {
                    $('.check_edit_question_image').removeClass('d-none');
                    $('#view_question_image').attr('src', '');
                } 
            }
        });

        //Option1
        $('#edit_option_1').on('keyup', function(){
            if($(this).val() == '')
            {
                $('.check_edit_option_1').removeClass('d-none');
            }
            else
            {
                $('.check_edit_option_1').addClass('d-none');
            }
        });

        //Option2
        $('#edit_option_2').on('keyup', function(){
            if($(this).val() == '')
            {
                $('.check_edit_option_2').removeClass('d-none');
            }
            else
            {
                $('.check_edit_option_2').addClass('d-none');
            }
        });

        //Edit MCQ Question
        $('#edit_mcq_question').on('submit', function(event){

            var id                  = $('#edit_question_title').attr('data-id');
            var edit_question_token = $('#edit_question_token').val();
            var edit_question_title = $('#edit_question_title').val();
            var edit_question_image = document.getElementById('edit_question_image').files[0];
            var edit_option_1       = $('#edit_option_1').val();
            var edit_option_2       = $('#edit_option_2').val();
            var edit_option_3       = $('#edit_option_3').val();
            var edit_option_4       = $('#edit_option_4').val();
            var edit_option_5       = $('#edit_option_5').val();
            var edit_option_6       = $('#edit_option_6').val();
            var edit_option_7       = $('#edit_option_7').val();
            var edit_option_8       = $('#edit_option_8').val();
            var edit_option_9       = $('#edit_option_9').val();
            var edit_option_10      = $('#edit_option_10').val();
            var edit_answer_option  = $('#edit_answer_option').val();

            if(edit_question_title == '')
            {
                $('.check_edit_question_title').removeClass('d-none');
            }
            else
            {
                if(edit_question_image == null || ValidateImage(edit_question_image))
                {
                    if(edit_option_1 == '')
                    {
                        $('.check_edit_option_1').removeClass('d-none');
                    }
                    else
                    {
                        if(edit_option_2 == '')
                        {
                            $('.check_edit_option_2').removeClass('d-none');
                        }
                        else
                        {
                            $("#loader").css("display", "block");

                            formdata = new FormData();

                            formdata.append('id'                 , id);
                            formdata.append('edit_question_token', edit_question_token);
                            formdata.append('edit_question_title', edit_question_title);
                            formdata.append('edit_question_image', edit_question_image);
                            formdata.append('edit_option_1'      , edit_option_1);
                            formdata.append('edit_option_2'      , edit_option_2);
                            formdata.append('edit_option_3'      , edit_option_3);
                            formdata.append('edit_option_4'      , edit_option_4);
                            formdata.append('edit_option_5'      , edit_option_5);
                            formdata.append('edit_option_6'      , edit_option_6);
                            formdata.append('edit_option_7'      , edit_option_7);
                            formdata.append('edit_option_8'      , edit_option_8);
                            formdata.append('edit_option_9'      , edit_option_9);
                            formdata.append('edit_option_10'     , edit_option_10);
                            formdata.append('edit_answer_option' , edit_answer_option);

                            $.ajax({
                                url: 'Easylearn/Exam_Controller/edit_mcq_question',
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
                else
                {
                    $('.check_edit_question_image').removeClass('d-none');
                }
            }
            event.preventDefault();
        });
	}

	if (location.pathname.split('/').slice(-1)[0] == 'sentence_exam_detail')
    {
    	//Question Image
        $('#question_image').on('change', function(){
            var file = this.files[0];

            if(file == null)
            {
                $('.check_question_image').addClass('d-none');
            }
            else
            {
                if(ValidateImage(file))
                {
                    $('.check_question_image').addClass('d-none');
                }
                else
                {
                    $('.check_question_image').removeClass('d-none');
                } 
            }
        });

        //Option1
        $('#opt-1').on('keyup', function(){
            if($(this).val() == '')
            {
                $('.check_opt-1').removeClass('d-none');
            }
            else
            {
                $('.check_opt-1').addClass('d-none');
            }
        });

        $('#add_sentence_question').on('submit',function(e){
            e.preventDefault();
            var sent_question  = $('#sent_question').val();
            var question_image = document.getElementById('question_image').files[0];
            
            var doc  = new DOMParser().parseFromString(sent_question, "text/html");
            var ans  = doc.getElementsByTagName('input');
            var opt1 = $('#opt-1').val();

            if(ans.length > 0){

                if(opt1 != '')
                {
                    $("#loader").css("display", "block");

                    var add_sentence_token = $('#add_sentence_token').val();
                    var exam_id = $('#exam_id').val();
                    var sent_question = $('#sent_question').val();
                    var opt2 = $('#opt-2').val();
                    var opt3 = $('#opt-3').val();
                    var opt4 = $('#opt-4').val();
                    var opt5 = $('#opt-5').val();
                    
                    var formdata = new FormData();
                    formdata.append('exam_id',exam_id);
                    formdata.append('add_sentence_token',add_sentence_token);
                    formdata.append('sent_question',sent_question);
                    formdata.append('question_image', question_image);
                    formdata.append('opt1',opt1);
                    formdata.append('opt2',opt2);
                    formdata.append('opt3',opt3);
                    formdata.append('opt4',opt4);
                    formdata.append('opt5',opt5);

                    $.ajax({
                        url: 'Easylearn/Exam_Controller/add_sentence_question',
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
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Fill Correct Answer',
                    });
                }
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Enter Sentance Completion Question',
                });
            }
        });

        FroalaEditor.DefineIcon('insert', { NAME: 'plus', SVG_KEY: 'add' })
        FroalaEditor.RegisterCommand('insert', {
            title: 'Add Answer InputBox',
            focus: true,
            undo: true,
            refreshAfterCallback: true,
            callback: function () {

                var sent_question = $('#sent_question').val();
                var doc = new DOMParser().parseFromString(sent_question, "text/html");
                var ans = doc.getElementsByTagName('input');
                if((ans.length >= 0) && (ans.length < 5))
                {
                    this.html.insert('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;')
                }
                if(ans.length >= 4)
                {
                    $('#insert-1').addClass('d-none');
                }
            }
        });

        setInterval(function() {
            var sent_question = $('#sent_question').val();
            var doc = new DOMParser().parseFromString(sent_question, "text/html");
            var ans = doc.getElementsByTagName('input');

            if(ans.length < 5)
            {
                $('#insert-1').removeClass('d-none');
            }

            var edit_sentence_question = $('#edit_sentence_question').val();
            var doc1 = new DOMParser().parseFromString(edit_sentence_question, "text/html");
            var ans1 = doc1.getElementsByTagName('input');

            if(ans1.length < 5)
            {
                $('#insert2-2').removeClass('d-none');
            }
        }, 1000);

        var editorInstance = new FroalaEditor('#sent_question', {
            enter: FroalaEditor.ENTER_P,
            placeholderText: null,
            toolbarButtons: [['insert']],
            
            pluginsEnabled: ['image', 'table', 'lists'],
            
        });

        FroalaEditor.DefineIcon('insert2', { NAME: 'plus', SVG_KEY: 'add' })
        FroalaEditor.RegisterCommand('insert2', {
            title: 'Add Answer InputBox',
            focus: true,
            undo: true,
            refreshAfterCallback: true,
            callback: function () {

                var edit_sentence_question = $('#edit_sentence_question').val();
                var doc = new DOMParser().parseFromString(edit_sentence_question, "text/html");
                var ans = doc.getElementsByTagName('input');
                if((ans.length >= 0) && (ans.length < 5))
                {
                    this.html.insert('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;')
                }
                if(ans.length >= 4)
                {
                    $('#insert2-2').addClass('d-none');
                }
            }
        });

        var editorInstance1 = new FroalaEditor('#edit_sentence_question', {
            enter: FroalaEditor.ENTER_P,
            placeholderText: null,
            toolbarButtons: [['insert2']], 
            pluginsEnabled: ['image', 'table', 'lists'],
            
        });

        $('.delete_sent_question').on('click',function(){
            var exam_id = $(this).attr('data-id');
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
                    $.ajax({
                        url: 'Easylearn/Exam_Controller/delete_sent_question',
                        data: {
                            id : exam_id
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
                }});
        });

        $('.edit_sent_question').on('click',function(){
            
            var id = $(this).attr('data-id');
            $('#edit-question').modal('show');
            $.ajax({
                url: "Easylearn/Exam_Controller/exam_sent_quest_id",
                data: {
                    id : id,
                },
                type: "POST",
                success: function (response) {  
                    
                    response = JSON.parse(response);
                    $('#question_id').val(response.data.id);
                    $('#view_question_image').attr('src', response.data['question_image'])
                    $('#edit_opt_1').val(response.data.option_1);
                    $('#edit_opt_2').val(response.data.option_2);
                    $('#edit_opt_3').val(response.data.option_3);
                    $('#edit_opt_4').val(response.data.option_4);
                    $('#edit_opt_5').val(response.data.option_5);

                    editorInstance1.html.set('');
                    editorInstance1.html.insert(response.data.question_title);
                },
                error: function (response) {
                    console.log("Error: "+response);
                }
            });

        });

        //Option1
        $('#edit_opt_1').on('keyup', function(){
            if($(this).val() == '')
            {
                $('.check_edit_opt_1').removeClass('d-none');
            }
            else
            {
                $('.check_edit_opt_1').addClass('d-none');
            }
        });

        //Question Image
        $('#edit_question_image').on('change', function(){
            var file = this.files[0];

            if(file == null)
            {
                $('.check_edit_question_image').addClass('d-none');
                $('#view_question_image').attr('src', '');
            }
            else
            {
                if(ValidateImage(file))
                {
                    $('.check_edit_question_image').addClass('d-none');
                    $('#view_question_image').attr('src', URL.createObjectURL(file));
                }
                else
                {
                    $('.check_edit_question_image').removeClass('d-none');
                    $('#view_question_image').attr('src', '');
                } 
            }
        });

        $('#edit_sentence').on('submit',function(e){
            e.preventDefault();
            var sent_question       = $('#edit_sentence_question').val();
            var edit_question_image = document.getElementById('edit_question_image').files[0];

            var doc  = new DOMParser().parseFromString(sent_question, "text/html");
            var ans  = doc.getElementsByTagName('input');
            var opt1 = $('#edit_opt_1').val();

            if(ans.length > 0){
                if(opt1 != '')
                {
                    $("#loader").css("display", "block");
                    
                    var edit_sentence_token = $('#edit_sentence_token').val();
                    var exam_id = $('#exam_id').val();
                    var question_id = $('#question_id').val();
                    var sent_question = $('#edit_sentence_question').val();
                    var opt2 = $('#edit_opt_2').val();
                    var opt3 = $('#edit_opt_3').val();
                    var opt4 = $('#edit_opt_4').val();
                    var opt5 = $('#edit_opt_5').val();
                    
                    var formdata = new FormData();
                    formdata.append('exam_id',exam_id);
                    formdata.append('question_id',question_id);
                    formdata.append('edit_sentence_token',edit_sentence_token);
                    formdata.append('sent_question',sent_question);
                    formdata.append('edit_question_image', edit_question_image);
                    formdata.append('opt1',opt1);
                    formdata.append('opt2',opt2);
                    formdata.append('opt3',opt3);
                    formdata.append('opt4',opt4);
                    formdata.append('opt5',opt5);

                    $.ajax({
                        url: 'Easylearn/Exam_Controller/edit_sentence_question',
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
                                        title: 'Successfully Updated',
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
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Fill Correct Answer',
                    });
                }
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Enter Sentance Completion Question',
                });
            }
        });

        $('#Multiple_Sentence_QuestionAdd').on('click', function(event){

            var add_sentence_token  = $('#add_sentence_token').val();   
            var unique_id           = (location.search.split(name + '=')[1] || '').split('&')[0];
            var Multiple_Question   = document.getElementById('Multiple_Sentence_Question').files[0];
    
            if(ValidateCSV(Multiple_Question))
            {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to proceed further!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $('#loader').css('display', 'block');
    
                        formdata = new FormData();
                        formdata.append('add_sentence_token' , add_sentence_token);
                        formdata.append('unique_id'          , unique_id);
                        formdata.append('question_csv'       , Multiple_Question);
    
                        $.ajax({
                            url: 'HTMLtoCSV/add_multiple_sentence_question',
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
                                            title: 'Successfully Added '+response.count,
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
                                            location.reload();
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
                                        location.reload();
                                    });
                                }, 1000);
                            }
                        });
                    }
                });
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Choose CSV file',
                });
            }
    
            event.preventDefault();
        });
    }

    //Exam Result
    if (location.pathname.split('/').slice(-1)[0] == 'Exam_result') 
    {
    	$("#exam_result_list").DataTable({
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
	                data: "exam_date"
	            },
	            {
	                data: "exam_start_time"
	            },
	            {
	                data: "exam_end_time"
	            }
	        ],
	    });

	    $('#exam_result_list tbody').on('dblclick', 'tr', function () {
        	var unique = $(this).attr('id');
        	location.href = 'exam_result_id?id='+unique;
    	});
    }

    //Exam Result ID
    if (location.pathname.split('/').slice(-1)[0] == 'exam_result_id') 
    {
    	var unique_id           = (location.search.split(name + '=')[1] || '').split('&')[0];
    	$("#exam_result_list").DataTable({
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
	            url: "Easylearn/Exam_Controller/get_all_exam_result",
	            type: "POST",
	            data: {
	                'unique_id' : unique_id
	            },
	            dataSrc: function (json) {
	            	 if(json.data == 'False')
                    {
                        return {};
                    }
                    else
                    {
                        var total_response = json.data.length;
		                var average_right_marks = 0;
		                var average_wrong_marks = 0;
		                var total_mark = 0;
		                if(json.data != 0)
	                	{
	                		json.data.forEach(function (Index, i) {
	                			average_right_marks = average_right_marks + Number(json.data[i].mark_obtained);
		                        average_wrong_marks = average_wrong_marks + (json.data[i].total_mark - json.data[i].mark_obtained);
		                        total_mark = json.data[i].total_mark;

	                		});

	                		average_right_marks = Math.round(average_right_marks/total_response);
		                    average_wrong_marks = Math.round(average_wrong_marks/total_response);

		                    $('.total_response').html(total_response+"&nbsp; Total Response");
		                    $('.average_right_marks').html(average_right_marks+"&nbsp; Average Right Marks");
		                    $('.average_wrong_marks').html(average_wrong_marks+"&nbsp; Average Wrong Marks");
		                    return json.data;
	                	}
	                	else
	                	{

	                	}
		                
	                }
	            },
	        },
	        rowId: "unique_id",
	        createdRow:function(row,data,dataIndex){
	        	$(row).attr('data-id',data.account_id);
	        	$(row).attr('data-category',data.exam_category);
	        },
	        columns: [{
	                data: "unique_id",
	                render: function (data, type, row, meta) {
	                    return meta.row + meta.settings._iDisplayStart + 1;
	                },
	            },
	            {
	                data: "username"
	            },
	            {
	                data: "total_mark"
	            },
	            {
	                data: "mark_obtained"
	            },
	            {
	                data: "added_on"
	            }, 
	        ],

	    });

    	$('#exam_result_list tbody').on('dblclick', 'tr', function () {
            var unique_id     = (location.search.split(name + '=')[1] || '').split('&')[0];
            var student_id    = $(this).attr('data-id');
            var exam_category = $(this).attr('data-category');
            if(exam_category == 'MCQ Exam')
            {
                location.href = 'mcq_exam_result?id='+unique_id+'&student_id='+student_id;
            }
            else if(exam_category == 'Sentence Completion')
            {
                location.href = 'sentence_exam_result?id='+unique_id+'&student_id='+student_id;
            }
        });

    }
	
});