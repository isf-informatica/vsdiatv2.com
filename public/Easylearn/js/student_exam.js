$(document).ready(function () {

    //setCookie
    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }

    //getCookie
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    //Reading Exams
    if(location.pathname.split('/').slice(-1)[0] == 'mcq_exam')
    {        
        $.ajax({
            url: 'Easylearn/Exam_Controller/mcq_exam',
            type: 'POST',
            success: function (response) 
            {
                response = JSON.parse(response);
                response.data.forEach(function (Index, i)
                {

                    if(response.data[i].unique_id  != null){
                        var examlist = $('.exam_list').clone();
                        $('.exam_list_holder').append(examlist);
                        examlist.removeClass('d-none').addClass('exam_list_cloned').removeClass('exam_list');

                        examlist.children().children().children().eq(1).html(response.data[i].exam_title);
                        examlist.children().children().eq(1).children().eq(0).html(response.data[i].questions+' question');

                        if(response.data[i].exam_duration > 59)
                        {
                            var hours = Math.floor(response.data[i].exam_duration/60);
                            var min = response.data[i].exam_duration%60;

                            examlist.children().children().eq(1).children().eq(1).html(hours+' hr : '+min+' min');
                        }
                        else
                        {
                            examlist.children().children().eq(1).children().eq(1).html(response.data[i].exam_duration+' min');
                        }
                        examlist.children().children().eq(1).children().eq(2).attr('href', "mcq_exam_start?id="+response.data[i].unique_id);
                    }
                    else
                    {

                    }
                });

                $('.exam_list').remove();

            },
            error: function (response) 
            {
                console.log(response);
            }
        });
    }

    if(location.pathname.split('/').slice(-1)[0] == 'mcq_exam_start')
    {
        var time = $('.countdown_timer').attr('data-countdown');
        var exam = $('.countdown_timer').attr('data-exam');

        setInterval(function() {
            var hr  = "00";
            var min = "00";
            var sec = "00";

            if(time > 3600)
            {
                hr  = Math.floor(time/3600);
                min = Math.floor((time%3600)/60);
                sec = time%60;

                if(hr < 10)
                {
                    hr = "0"+hr;
                }
                if(min < 10)
                {
                    min = "0"+min;
                }
                if(sec < 10)
                {
                    sec = "0"+sec;
                }
            }
            else if(time > 60 )
            {
                min = Math.floor(time/60);
                sec = time%60;

                if(min < 10)
                {
                    min = "0"+min;
                }
                if(sec < 10)
                {
                    sec = "0"+sec;
                }
            }
            else
            {
                if(time < 30)
                {
                    $('.count_box').removeClass('count_box').addClass('count_red_box');
                }
                sec = time;

                if(sec < 10)
                {
                    sec = "0"+sec;
                }
            }

            $('.count_hours').children().eq(0).html(hr);
            $('.count_min').children().eq(0).html(min);
            $('.count_sec').children().eq(0).html(sec);

            time = time-1;

            setCookie(exam, time);

            if(time == 0)
            {
                var show_result = $('#wizard').attr('data-showresult');
                var unique_id = (location.search.split(name + '=')[1] || '').split('&')[0];

                if(show_result  == 1)
                {
                    location.href="mcq_exam_result?id="+unique_id;
                }
                else
                {
                    location.href="response_recorded";
                }
            }

        }, 1000);

        var currentTab = 0;
        showTab(currentTab);

        $('#nextBtn').on('click', function(){
            var x = document.getElementsByClassName("multisteps_form_panel");

            n = currentTab+1;
            var unique_id = (location.search.split(name + '=')[1] || '').split('&')[0];
            var option = $('.step_'+n+'.active').attr('data-option');
            var question = $('.step_'+n+'.active').attr('data-question');

            if(option != undefined)
            {
                if ((currentTab+1) >= x.length) {
                    var show_result = $('#wizard').attr('data-showresult');
                    var multiple_response = $('#wizard').attr('data-multipleresponse');

                    $.ajax({
                        url: 'Easylearn/Exam_Controller/add_mcq_question_answer_final',
                        data: {
                            'id'                : unique_id,
                            'option'            : option,
                            'question'          : question,
                            'multiple_response' : multiple_response
                        },
                        type: 'POST',
                        success: function (response) 
                        {
                            if(show_result  == 1)
                            {
                                location.href="mcq_exam_result?id="+unique_id;
                            }
                            else
                            {
                                location.href="response_recorded";
                            }
                        },
                        error: function (response) 
                        {
                            console.log("Error");
                        }
                    });
                }
                else
                {
                    $.ajax({
                        url: 'Easylearn/Exam_Controller/add_mcq_question_answer',
                        data: {
                            'id'       : unique_id,
                            'option'   : option,
                            'question' : question
                        },
                        type: 'POST',
                        success: function (response) 
                        {
                            x[currentTab].style.display = "none";

                            currentTab = currentTab+1;
                            showTab(currentTab);
                        },
                        error: function (response) 
                        {
                            console.log("Error");
                        }
                    });
                }
            }
            else
            {
                $.Toast("Error", "Select an Option", "error", {
                    has_icon:true,
                    has_close_btn:true,
                    stack: true,
                    position_class: "toast-top-center",
                    timeout:1500,
                    sticky:false,
                    has_progress:true,
                    rtl:false,
                });
            }
        });

        $('#prevBtn').on('click', function(){
            var x = document.getElementsByClassName("multisteps_form_panel");
            x[currentTab].style.display = "none";

            if (currentTab >= x.length) {
                //Submit
            }
            currentTab = currentTab-1;
            showTab(currentTab);
        });

        function showTab(n) 
        {
            var x = document.getElementsByClassName("multisteps_form_panel");
            x[n].style.display = "block";

            if (n == 0) 
            {
                document.getElementById("prevBtn").style.display = "none";
            } 
            else 
            {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) 
            {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } 
            else {
                document.getElementById("nextBtn").innerHTML = "Next Question" + ' <span><i class="fas fa-arrow-right"></i></span>';
            }
        }

        $('.step').on('click', function(){
            n = currentTab+1;
            $('.step_'+n).removeClass('active');
            $(this).addClass('active');
        });
    }

    if(location.pathname.split('/').slice(-1)[0] == 'sentence_exam')
    {        
        $.ajax({
            url: 'Easylearn/Exam_Controller/sentence_exam',
            type: 'POST',
            success: function (response) 
            {
                response = JSON.parse(response);

                response.data.forEach(function (Index, i)
                {

                    if(response.data[i].unique_id  != null){
                        var examlist = $('.exam_list').clone();
                        $('.exam_list_holder').append(examlist);
                        examlist.removeClass('d-none').addClass('exam_list_cloned').removeClass('exam_list');

                        examlist.children().children().children().eq(1).html(response.data[i].exam_title);
                        examlist.children().children().eq(1).children().eq(0).html(response.data[i].questions+' question');

                        if(response.data[i].exam_duration > 59)
                        {
                            var hours = Math.floor(response.data[i].exam_duration/60);
                            var min = response.data[i].exam_duration%60;

                            examlist.children().children().eq(1).children().eq(1).html(hours+' hr : '+min+' min');
                        }
                        else
                        {
                            examlist.children().children().eq(1).children().eq(1).html(response.data[i].exam_duration+' min');
                        }
                        examlist.children().children().eq(1).children().eq(2).attr('href', "sentence_exam_start?id="+response.data[i].unique_id);
                    }
                    else
                    {

                    }
                });

                $('.exam_list').remove();

            },
            error: function (response) 
            {
                console.log(response);
            }
        });
    }


    if(location.pathname.split('/').slice(-1)[0] == 'sentence_exam_start')
    {
        var time = $('.countdown_timer').attr('data-countdown');
        var exam = $('.countdown_timer').attr('data-exam');

        setInterval(function() {
            var hr  = "00";
            var min = "00";
            var sec = "00";

            if(time > 3600)
            {
                hr  = Math.floor(time/3600);
                min = Math.floor((time%3600)/60);
                sec = time%60;

                if(hr < 10)
                {
                    hr = "0"+hr;
                }
                if(min < 10)
                {
                    min = "0"+min;
                }
                if(sec < 10)
                {
                    sec = "0"+sec;
                }
            }
            else if(time > 60 )
            {
                min = Math.floor(time/60);
                sec = time%60;

                if(min < 10)
                {
                    min = "0"+min;
                }
                if(sec < 10)
                {
                    sec = "0"+sec;
                }
            }
            else
            {
                if(time < 30)
                {
                    $('.count_box').removeClass('count_box').addClass('count_red_box');
                }
                sec = time;

                if(sec < 10)
                {
                    sec = "0"+sec;
                }
            }

            $('.count_hours').children().eq(0).html(hr);
            $('.count_min').children().eq(0).html(min);
            $('.count_sec').children().eq(0).html(sec);

            time = time-1;

            setCookie(exam, time);

            if(time == 0)
            {
                var show_result = $('#wizard').attr('data-showresult');
                var unique_id = (location.search.split(name + '=')[1] || '').split('&')[0];

                if(show_result  == 1)
                {
                    location.href="mcq_exam_result?id="+unique_id;
                }
                else
                {
                    location.href="response_recorded";
                }
            }

        }, 1000);

        var currentTab = 0;
        showTab(currentTab);

        $('#nextBtn').on('click', function(){
            var x = document.getElementsByClassName("multisteps_form_panel");

            n = currentTab+1;
            var unique_id = (location.search.split(name + '=')[1] || '').split('&')[0];
            var question = $('.step_'+n).attr('data-question');

            formdata = new FormData();

            formdata.append('id', unique_id);
            formdata.append('question', question);

            var i = 1;
            $('.step_'+n).find('input[type=text]').each(function(){
                formdata.append('answer_'+i, $(this).val());
                i++;
            });

            while(i <= 5)
            {
                formdata.append('answer_'+i, '');
                i++;
            }

            if ((currentTab+1) >= x.length) {
                var show_result = $('#wizard').attr('data-showresult');
                var multiple_response = $('#wizard').attr('data-multipleresponse');

                formdata.append('multiple_response', multiple_response);

                $.ajax({
                    url: 'Easylearn/Exam_Controller/add_sentence_question_answer_final',
                    data: formdata,
                    type: 'POST',
                    contentType : false,
                    processData : false,
                    success: function (response) 
                    {
                        if(show_result  == 1)
                        {
                            location.href="sentence_exam_result?id="+unique_id;
                        }
                        else
                        {
                            location.href="response_recorded";
                        }
                    },
                    error: function (response) 
                    {
                        console.log("Error");
                    }
                });
            }
            else
            {
                $.ajax({
                    url: 'Easylearn/Exam_Controller/add_sentence_question_answer',
                    data: formdata,
                    type: 'POST',
                    contentType : false,
                    processData : false,
                    success: function (response) 
                    {
                        x[currentTab].style.display = "none";

                        currentTab = currentTab+1;
                        showTab(currentTab);
                    },
                    error: function (response) 
                    {
                        console.log("Error");
                    }
                });
            }
        });

        $('#prevBtn').on('click', function(){
            var x = document.getElementsByClassName("multisteps_form_panel");
            x[currentTab].style.display = "none";

            if (currentTab >= x.length) {
                //Submit
            }
            currentTab = currentTab-1;
            showTab(currentTab);
        });

        function showTab(n) 
        {
            var x = document.getElementsByClassName("multisteps_form_panel");
            x[n].style.display = "block";

            if (n == 0) 
            {
                document.getElementById("prevBtn").style.display = "none";
            } 
            else 
            {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) 
            {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } 
            else {
                document.getElementById("nextBtn").innerHTML = "Next Question" + ' <span><i class="fas fa-arrow-right"></i></span>';
            }
        }
    }


});