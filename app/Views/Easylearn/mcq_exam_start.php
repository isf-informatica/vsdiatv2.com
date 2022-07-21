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

        $questions = json_decode(exam_question_student($session->get('user')['id'], $_GET['id'], $classroom_id), true)['data'];
        //print_r($questions);
        
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

                <form data-showresult="<?=$exam['show_result']; ?>" data-multipleresponse="<?=$exam['multiple_response']; ?>" class="multisteps_form mt-4" id="wizard">
                    <!------------------------- Step-1 ----------------------------->
                    <?php $num_questions = count($questions); $i = 1; $j=1; foreach($questions as $question){ ?>

                    <div class="multisteps_form_panel">
                        <div class="row" style="min-height: 50vh">
                            <div class="col-md-10 m-auto">
                                <div class="position-relative">
                                    <div class="question_number text-uppercase">
                                        <span>question <?=$i ?> / <?=$num_questions ?> </span>
                                    </div>

                                    <div class="question_title py-3 text-uppercase">
                                        <h3><?=nl2br($question['question_title']); ?> </h3>
                                    </div>

                                    <div class='row d-flex justify-content-center mb-15'>
                                        <img src="<?=$question['question_image'] ?>" style='width: 400px; height: auto' />
                                    </div>

                                    <div class="form_items">
                                        <div class='row'>

                                            <!-- Option 1 -->
                                            <?php if($question['option_1'] != '' && $question['option_1'] != null){ ?>
                                            <div class='col-xl-6'>

                                                <?php if($question['answer'] == 1){ ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="1" class="step_<?=$i ?> step active rounded-pill position-relative bg-white">
                                                <?php } else { ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="1" class="step_<?=$i ?> step rounded-pill position-relative bg-white">
                                                <?php } ?>
                                                    
                                                    <?=$question['option_1'] ?>
                                                    <input id="opt_<?=$j; ?>" type="radio" name="stp_<?=$i; ?>_select_option" value="<?=$question['option_1'] ?>">
                                                    <span class="position-absolute">A</span>
                                                </label>
                                            </div>
                                            <?php $j++; } ?>

                                            <!-- Option 2 -->
                                            <?php if($question['option_2'] != '' && $question['option_2'] != null){ ?>
                                            <div class='col-xl-6'>

                                                <?php if($question['answer'] == 2){ ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="2" class="step_<?=$i ?> step active rounded-pill position-relative bg-white">
                                                <?php } else { ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="2" class="step_<?=$i ?> step rounded-pill position-relative bg-white">
                                                <?php } ?>

                                                    <?=$question['option_2'] ?>
                                                    <input id="opt_<?=$j; ?>" type="radio" name="stp_<?=$i; ?>_select_option" value="<?=$question['option_2'] ?>">
                                                    <span class="position-absolute">B</span>
                                                </label>
                                            </div>
                                            <?php $j++; } ?>

                                            <!-- Option 3 -->
                                            <?php if($question['option_3'] != '' && $question['option_3'] != null){ ?>
                                            <div class='col-xl-6'>

                                                <?php if($question['answer'] == 3){ ?>
                                                    <label for="opt_<?=$j; ?>" data-question="<?=$question['id']; ?>" data-option="3" class="step_<?=$i; ?> step active rounded-pill position-relative bg-white">
                                                <?php } else { ?>
                                                    <label for="opt_<?=$j; ?>" data-question="<?=$question['id']; ?>" data-option="3" class="step_<?=$i; ?> step rounded-pill position-relative bg-white">
                                                <?php } ?>
                                                    
                                                    <?=$question['option_3'] ?>
                                                    <input id="opt_<?=$j; ?>" type="radio" name="stp_<?=$i; ?>_select_option" value="<?=$question['option_3'] ?>">
                                                    <span class="position-absolute">C</span>
                                                </label>
                                            </div>
                                            <?php $j++; } ?>

                                            <!-- Option 4 -->
                                            <?php if($question['option_4'] != '' && $question['option_4'] != null){ ?>
                                            <div class='col-xl-6'>

                                                <?php if($question['answer'] == 4){ ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="4" class="step_<?=$i ?> step active rounded-pill position-relative bg-white">
                                                <?php } else { ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="4" class="step_<?=$i ?> step rounded-pill position-relative bg-white">
                                                <?php } ?>
                                                    
                                                    <?=$question['option_4'] ?>
                                                    <input id="opt_<?=$j; ?>" type="radio" name="stp_<?=$i; ?>_select_option" value="<?=$question['option_4'] ?>">
                                                    <span class="position-absolute">D</span>
                                                </label>
                                            </div>
                                            <?php $j++; } ?>

                                            <!-- Option 5 -->
                                            <?php if($question['option_5'] != '' && $question['option_5'] != null){ ?>
                                            <div class='col-xl-6'>

                                                <?php if($question['answer'] == 5){ ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="5" class="step_<?=$i ?> step active rounded-pill position-relative bg-white">
                                                <?php } else { ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="5" class="step_<?=$i ?> step rounded-pill position-relative bg-white">
                                                <?php } ?>

                                                    <?=$question['option_5'] ?>
                                                    <input id="opt_<?=$j; ?>" type="radio" name="stp_<?=$i; ?>_select_option" value="<?=$question['option_5'] ?>">
                                                    <span class="position-absolute">E</span>
                                                </label>
                                            </div>
                                            <?php $j++; } ?>

                                            <!-- Option 6 -->
                                            <?php if($question['option_6'] != '' && $question['option_6'] != null){ ?>
                                            <div class='col-xl-6'>

                                                <?php if($question['answer'] == 6){ ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="6" class="step_<?=$i ?> step active rounded-pill position-relative bg-white">
                                                <?php } else { ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="6" class="step_<?=$i ?> step rounded-pill position-relative bg-white">
                                                <?php } ?>

                                                    <?=$question['option_6'] ?>
                                                    <input id="opt_<?=$j; ?>" type="radio" name="stp_<?=$i; ?>_select_option" value="<?=$question['option_6'] ?>">
                                                    <span class="position-absolute">F</span>
                                                </label>
                                            </div>
                                            <?php $j++; } ?>

                                            <!-- Option 7 -->
                                            <?php if($question['option_7'] != '' && $question['option_7'] != null){ ?>
                                            <div class='col-xl-6'>

                                                <?php if($question['answer'] == 7){ ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="7" class="step_<?=$i ?> step active rounded-pill position-relative bg-white">
                                                <?php } else { ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="7" class="step_<?=$i ?> step rounded-pill position-relative bg-white">
                                                <?php } ?>
                                                    
                                                    <?=$question['option_7'] ?>
                                                    <input id="opt_<?=$j; ?>" type="radio" name="stp_<?=$i; ?>_select_option" value="<?=$question['option_7'] ?>">
                                                    <span class="position-absolute">G</span>
                                                </label>
                                            </div>
                                            <?php $j++; } ?>

                                            <!-- Option 8 -->
                                            <?php if($question['option_8'] != '' && $question['option_8'] != null){ ?>
                                            <div class='col-xl-6'>

                                                <?php if($question['answer'] == 8){ ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="8" class="step_<?=$i ?> step active rounded-pill position-relative bg-white">
                                                <?php } else { ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="8" class="step_<?=$i ?> step rounded-pill position-relative bg-white">
                                                <?php } ?>

                                                    <?=$question['option_8'] ?>
                                                    <input id="opt_<?=$j; ?>" type="radio" name="stp_<?=$i; ?>_select_option" value="<?=$question['option_8'] ?>">
                                                    <span class="position-absolute">H</span>
                                                </label>
                                            </div>
                                            <?php $j++; } ?>

                                            <!-- Option 9 -->
                                            <?php if($question['option_9'] != '' && $question['option_9'] != null){ ?>
                                            <div class='col-xl-6'>

                                                <?php if($question['answer'] == 9){ ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="9" class="step_<?=$i ?> step active rounded-pill position-relative bg-white">
                                                <?php } else { ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="9" class="step_<?=$i ?> step rounded-pill position-relative bg-white">
                                                <?php } ?>

                                                    <?=$question['option_9'] ?>
                                                    <input id="opt_<?=$j; ?>" type="radio" name="stp_<?=$i; ?>_select_option" value="<?=$question['option_9'] ?>">
                                                    <span class="position-absolute">I</span>
                                                </label>
                                            </div>
                                            <?php $j++; } ?>

                                            <!-- Option 10 -->
                                            <?php if($question['option_10'] != '' && $question['option_10'] != null){ ?>
                                            <div class='col-xl-6'>

                                                <?php if($question['answer'] == 10){ ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="10" class="step_<?=$i ?> step active rounded-pill position-relative bg-white">
                                                <?php } else { ?>
                                                    <label for="opt_<?=$j; ?>" data-question=<?=$question['id'] ?> data-option="10" class="step_<?=$i ?> step rounded-pill position-relative bg-white">
                                                <?php } ?>

                                                    <?=$question['option_10'] ?>
                                                    <input id="opt_<?=$j; ?>" type="radio" name="stp_<?=$i; ?>_select_option" value="<?=$question['option_10'] ?>">
                                                    <span class="position-absolute">J</span>
                                                </label>
                                            </div>
                                            <?php $j++; } ?>
                                        </div>
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