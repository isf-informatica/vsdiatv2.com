<!DOCTYPE html>
<html lang="en">
    <?php 
        $session = \Config\Services::session();
        helper('common');

        $exam = json_decode(exam_detail_id_student($_GET['id'], $session->get('user')['permissions']), true)['data'];
        $duration = ($exam['exam_duration'])*60;

        if($exam['multiple_response'] == 0)
        {
            if(isset($_COOKIE[$_GET['id']]))
            {
                $past_duration = $_COOKIE[$_GET['id']];
            }
            else
            {
                $past_duration = $duration;
            }
            $duration = $duration - ($duration - $past_duration);

            $check_exam_status = json_decode(check_exam_status($session->get('user')['id'], $_GET['id']), true)['data'];

            if($check_exam_status == 'TRUE')
            {
                echo("<script> location.href='response_recorded' </script>");
            }
        }

        if(isset($_SESSION['classroom_id']))
        {
            $classroom_id = $session->get('classroom_id');
        }
        else
        {
            $classroom_id = $exam['classroom_id'];
        }

        $questions = json_decode(exam_sentence_question_student($session->get('user')['id'], $_GET['id'], $classroom_id), true)['data'];
    ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?=base_url(); ?>/public/easylearn/images/fav.png">
        <title>Easylearn MCQ Exam</title>

        <!-- FontAwesome-cdn include -->
        <link rel="stylesheet" href="<?=base_url(); ?>/public/easylearn/libs/mcq_exam/font-awesome/all.min.css">
        <!-- Google fonts include -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&amp;family=Sen:wght@400;700;800&amp;display=swap" rel="stylesheet">
        <!-- Bootstrap-css include -->
        <link rel="stylesheet" href="<?=base_url(); ?>/public/easylearn/libs/mcq_exam/css/bootstrap.min.css">
        <!-- Animate-css include -->
        <link rel="stylesheet" href="<?=base_url(); ?>/public/easylearn/libs/mcq_exam/css/animate.min.css">
        <!-- Main-StyleSheet include -->
        <link rel="stylesheet" href="<?=base_url(); ?>/public/easylearn/libs/mcq_exam/css/style.css">

        <link rel="stylesheet" href="<?=base_url(); ?>/public/easylearn/libs/Toast/toast.style.css">
    </head>

    <body>
        <div class="wrapper position-relative overflow-hidden">
            <!-- Top content -->
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="logo_area mt-5 ms-5">
                            <a href="index">
                                <img src="<?=base_url(); ?>/public/easylearn/images/easylearn-full.png" alt="image_not_found">
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6 mt-5 ">
                        <div class="row d-flex justify-content-center">
                            <div class="count_box pe-3 rounded-pill d-flex align-items-center justify-content-center">
                                <div class="count_clock ps-2">
                                    <img src="<?=base_url(); ?>/public/easylearn/libs/mcq_exam/clock.png" alt="image-not-found">
                                </div>

                                <div class="count_title">
                                    <h4 class="ps-1">Exam</h4>
                                    <span class="px-1">Time</span>
                                </div>

                                <div class="count_number rounded-pill px-3 d-flex justify-content-around align-items-center position-relative overflow-hidden countdown_timer" data-exam="<?=$_GET['id'] ?>" data-countdown="<?=$duration ?>">
                                    <div class="count_hours">
                                        <h3>00</h3>
                                        <span class="text-uppercase">hrs</span>
                                    </div>
                                    
                                    <div class="count_min">
                                        <h3>00</h3>
                                        <span class="text-uppercase">min</span>
                                    </div>
                                    
                                    <div class="count_sec">
                                        <h3>00</h3>
                                        <span class="text-uppercase">sec</span>
                                    </div>
                                </div>
                            </div> 
                        </div>                   
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                
                <form data-showresult="<?=$exam['show_result']; ?>" data-multipleresponse="<?=$exam['multiple_response']; ?>" class="multisteps_form mt-5" id="wizard">
                    <!------------------------- Step-1 ----------------------------->
                    <?php $num_questions = count($questions); $i = 1; foreach($questions as $question){ ?>

                    <div class="multisteps_form_panel">
                        <div class="row" style='min-height: 50vh;'>
                            <div class="col-md-10 m-auto">
                                <div class="position-relative">
                                    <div class="question_number text-uppercase">
                                        <span>question <?=$i ?> / <?=$num_questions ?> </span>
                                    </div>

                                    <div class='row d-flex justify-content-center mb-15'>
                                        <img src="<?=$question['question_image'] ?>" style='width: 400px; height: auto' />
                                    </div>

                                    <div data-question=<?=$question['id'] ?> class="step_<?=$i; ?> question_title py-3 text-uppercase">

                                        <?php
                                            $sentence_question = $question['question_title'];

                                            //Answer 1
                                            $pos = strpos($sentence_question, 'disabled=""');
                                            if ($pos !== false) {
                                                $sentence_question = substr_replace($sentence_question, 'value="'.$question['answer_1'].'"',$pos,strlen('disabled=""'));
                                            }

                                            //Answer 2
                                            $pos = strpos($sentence_question, 'disabled=""');
                                            if ($pos !== false) {
                                                $sentence_question = substr_replace($sentence_question, 'value="'.$question['answer_2'].'"',$pos,strlen('disabled=""'));
                                            }

                                            //Answer 3
                                            $pos = strpos($sentence_question, 'disabled=""');
                                            if ($pos !== false) {
                                                $sentence_question = substr_replace($sentence_question, 'value="'.$question['answer_3'].'"',$pos,strlen('disabled=""'));
                                            }

                                            //Answer 4
                                            $pos = strpos($sentence_question, 'disabled=""');
                                            if ($pos !== false) {
                                                $sentence_question = substr_replace($sentence_question, 'value="'.$question['answer_4'].'"',$pos,strlen('disabled=""'));
                                            }

                                            //Answer 5
                                            $pos = strpos($sentence_question, 'disabled=""');
                                            if ($pos !== false) {
                                                $sentence_question = substr_replace($sentence_question, 'value="'.$question['answer_5'].'"',$pos,strlen('disabled=""'));
                                            }
                                        ?>
                                        <h3><?=nl2br($sentence_question); ?> </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; } ?>
                </form>

                <!------------------------- Form button ----------------------------->
                <div class="form_btn mb-6">
                    <div class="row">
                        <div class="col-md-10 m-auto">
                            <div class="row">
                                <div class='col-6 text-end'>
                                    <button type="button" class="f_btn prev_btn text-uppercase rounded-pill" id="prevBtn">
                                        <span><i class="fas fa-arrow-left"></i></span> Last Question
                                    </button>
                                </div>

                                <div class='col-6'>
                                    <button type="button" class="f_btn next_btn text-uppercase rounded-pill" id="nextBtn">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <!-- jQuery-js include -->
    <script src="<?=base_url(); ?>/public/easylearn/libs/mcq_exam/js/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap-js include -->
    <script src="<?=base_url(); ?>/public/easylearn/libs/mcq_exam/js/bootstrap.min.js"></script>
    <!-- jQuery-validate-js include -->
    <script src="<?=base_url(); ?>/public/easylearn/libs/mcq_exam/js/jquery.validate.min.js"></script>

    <script src="<?=base_url(); ?>/public/easylearn/libs/Toast/toast.script.js"></script>

    <script src="<?=base_url(); ?>/public/easylearn/js/student_exam.js"></script>
</html>