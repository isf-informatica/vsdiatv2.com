<?php 
    include 'template/login_header.php';

    if(isset($_GET['student_id']))
    {
        $exam = json_decode(exam_detail_id_student($_GET['id'],$session->get('user')['permissions']), true)['data'];
        $overview = json_decode(exam_overview_student($_GET['student_id'], $_GET['id']), true)['data'];
        $questions = json_decode(mcq_exam_question_answer($_GET['student_id'], $_GET['id']), true)['data'];
    }
    else
    {
        $exam = json_decode(exam_detail_id_student($_GET['id'],$session->get('user')['permissions']), true)['data'];
        $overview = json_decode(exam_overview_student($session->get('user')['id'], $_GET['id']), true)['data'];
        $questions = json_decode(mcq_exam_question_answer($session->get('user')['id'], $_GET['id']), true)['data'];
    }

    $percentage = round(($overview['right_questions']/$overview['total_questions'])*100);
?>

<link rel="stylesheet" href="<?=base_url(); ?>/public/easylearn/libs/mcq_exam/css/style.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/easylearn/fonts/fontawesome/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<style>
    .panel-body {
        position: relative;
        padding: 1.25rem;
    }

    .panel-body h5{
        margin-bottom : 0;
    }
    .mb-7 {
    margin-bottom: 2.5rem !important;
}
.me-3 {
    margin-right: 0.75rem !important;
}
</style>

<div class="container pt-8 pt-md-11">
    <div class="row">
        <div class='box'>
            <div class='box-body'>
                <div class='row'>
                    <div class='col-6'>
                        <div class="text-start p-3">   
                        <?php if($session->get('user')['permissions'] == 'School' || $session->get('user')['permissions'] == 'Jr College' || $session->get('user')['permissions'] == 'Classroom') { ?>
                            <a href="exam_result_id?id=<?=$_GET['id']; ?>" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                        <?php } ?>
                        <?php if($session->get('user')['permissions'] == 'Student' || $session->get('user')['permissions'] == 'Mentor') { ?>

                            <a href="mcq_exam" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>

                        <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="col-xl-8 mx-xl-auto">
                    <div class="d-flex flex-wrap align-items-center justify-content-center mb-5 mb-md-3">
                        <div id="graph">
                        </div>
                    </div>

                    <h1 class="text-center"> <?=$exam['exam_title']; ?> </h1>
                    <div class="text-center mb-7"  style='color: #b4b4b4; font-weight: 400;'> <?=$exam['course_name']; ?> </div>

                    <div class="row mb-7 justify-content-center align-items-center"  style='color: #b4b4b4;'>
                        <div class="col-12 col-md-auto mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <div class="me-3 d-flex">
                                    <i class="fab fa-wpforms" style='font-size: 30px;'></i>
                                </div>&nbsp;&nbsp;
                                <?=$overview['total_questions'] ?> Questions
                            </div>
                        </div>

                        <div class="col-12 col-md-auto mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <div class="me-3 d-flex">
                                    <i class="fas fa-check"></i>
                                </div>&nbsp;&nbsp;
                                <?=$overview['right_questions'] ?> Right Answers
                            </div>
                        </div>

                        <div class="col-12 col-md-auto mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <div class="me-3 d-flex">
                                    <i class="fas fa-times"></i>
                                </div>&nbsp;&nbsp;
                                <?=$overview['wrong_questions'] ?> Wrong Answers
                            </div>
                        </div>

                        <div class="col-12 col-md-auto mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <div class="me-3 d-flex">
                                    <i class="far fa-clock"></i>
                                </div>&nbsp;&nbsp;

                                <?php
                                    if(isset($_COOKIE[$_GET['id']]))
                                    {
                                        $past_duration = (int)$_COOKIE[$_GET['id']];
                                    }
                                    else
                                    {
                                        $past_duration = $exam['exam_duration']*60;
                                    }
                                    $past_duration = ($exam['exam_duration']*60) - $past_duration;

                                    $hr  = floor($past_duration/3600);
                                    $min = floor(($past_duration%3600)/60);
                                    $sec = $past_duration%60;
                    
                                    if($hr < 10)
                                    {
                                        $hr = $hr;
                                    }
                                    if($min < 10)
                                    {
                                        $min = $min;
                                    }
                                    if($sec < 10)
                                    {
                                        $sec = $sec;
                                    }

                                    $time = $hr." hr ".$min." min ".$sec." sec";
                                ?>

                                <?=$time ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='col-md-12 mt-3 mb-3'>
                    <div class="panel panel-secondary" style="background-color: rgba(38, 38, 38, 0.1);">
                        <div class="panel-body"><h5 style="font-size: 15px;">Question's and Answers:</h5></div>
                    </div>

                    <div class="form-group mt-3">
                        <?php if($questions == 'No Data'){ } else{ $i = 1; foreach($questions as $question){ ?>

                            <div class='question'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class="content_box position-relative">

                                            <div class="question_number text-uppercase">
                                                <span>questions <?=$i ?> </span>
                                            </div>

                                            <div class="question_title py-3 text-uppercase">
                                                <h5> <b> <?=nl2br($question['question_title']) ?> </b> </h5>
                                            </div>

                                            <div class='row d-flex justify-content-center mb-3'>
                                                <img src="<?=$question['question_image'] ?>" style="width: 300px; height: auto;" />
                                            </div>

                                            <div class="form_items">
                                                <?php if($question['answer_option'] == $question['answer']){ ?>

                                                <div class='row'>

                                                    <?php if($question['option_1'] != '' && $question['option_1'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 1){ ?>
                                                            <label for="opt_1" class="step success rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_1'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_1'] ?>">
                                                            <span class="position-absolute">A</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_2'] != '' && $question['option_2'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 2){ ?>
                                                            <label for="opt_1" class="step success rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_2'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_2'] ?>">
                                                            <span class="position-absolute">B</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_3'] != '' && $question['option_3'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 3){ ?>
                                                            <label for="opt_1" class="step success rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_3'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_3'] ?>">
                                                            <span class="position-absolute">C</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_4'] != '' && $question['option_4'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 4){ ?>
                                                            <label for="opt_1" class="step success rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_4'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_4'] ?>">
                                                            <span class="position-absolute">D</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_5'] != '' && $question['option_5'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 5){ ?>
                                                            <label for="opt_1" class="step success rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_5'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_5'] ?>">
                                                            <span class="position-absolute">E</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_6'] != '' && $question['option_6'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 6){ ?>
                                                            <label for="opt_1" class="step success rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_6'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_6'] ?>">
                                                            <span class="position-absolute">F</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_7'] != '' && $question['option_7'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 7){ ?>
                                                            <label for="opt_1" class="step success rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_7'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_7'] ?>">
                                                            <span class="position-absolute">G</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_8'] != '' && $question['option_8'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 8){ ?>
                                                            <label for="opt_1" class="step success rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_8'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_8'] ?>">
                                                            <span class="position-absolute">H</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_9'] != '' && $question['option_9'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 9){ ?>
                                                            <label for="opt_1" class="step success rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_9'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_9'] ?>">
                                                            <span class="position-absolute">I</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_10'] != '' && $question['option_10'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 10){ ?>
                                                            <label for="opt_1" class="step success rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_10'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_10'] ?>">
                                                            <span class="position-absolute">J</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                </div>

                                                <?php } else{?>

                                                <div class='row'>

                                                    <?php if($question['option_1'] != '' && $question['option_1'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 1){ ?>
                                                            <label for="opt_1" class="step success_line rounded-pill position-relative bg-white">
                                                        <?php } elseif($question['answer'] == 1) { ?>
                                                            <label for="opt_1" class="step error rounded-pill position-relative bg-white">
                                                        <?php } else{ ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_1'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_1'] ?>">
                                                            <span class="position-absolute">A</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_2'] != '' && $question['option_2'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 2){ ?>
                                                            <label for="opt_1" class="step success_line rounded-pill position-relative bg-white">
                                                        <?php } elseif($question['answer'] == 2) { ?>
                                                            <label for="opt_1" class="step error rounded-pill position-relative bg-white">
                                                        <?php } else{ ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_2'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_2'] ?>">
                                                            <span class="position-absolute">B</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_3'] != '' && $question['option_3'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 3){ ?>
                                                            <label for="opt_1" class="step success_line rounded-pill position-relative bg-white">
                                                        <?php } elseif($question['answer'] == 3) { ?>
                                                            <label for="opt_1" class="step error rounded-pill position-relative bg-white">
                                                        <?php } else{ ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_3'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_3'] ?>">
                                                            <span class="position-absolute">C</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_4'] != '' && $question['option_4'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 4){ ?>
                                                            <label for="opt_1" class="step success_line rounded-pill position-relative bg-white">
                                                        <?php } elseif($question['answer'] == 4) { ?>
                                                            <label for="opt_1" class="step error rounded-pill position-relative bg-white">
                                                        <?php } else{ ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_4'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_4'] ?>">
                                                            <span class="position-absolute">D</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_5'] != '' && $question['option_5'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 5){ ?>
                                                            <label for="opt_1" class="step success_line rounded-pill position-relative bg-white">
                                                        <?php } elseif($question['answer'] == 5) { ?>
                                                            <label for="opt_1" class="step error rounded-pill position-relative bg-white">
                                                        <?php } else{ ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_5'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_5'] ?>">
                                                            <span class="position-absolute">E</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_6'] != '' && $question['option_6'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 6){ ?>
                                                            <label for="opt_1" class="step success_line rounded-pill position-relative bg-white">
                                                        <?php } elseif($question['answer'] == 6) { ?>
                                                            <label for="opt_1" class="step error rounded-pill position-relative bg-white">
                                                        <?php } else{ ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_6'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_6'] ?>">
                                                            <span class="position-absolute">F</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_7'] != '' && $question['option_7'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 7){ ?>
                                                            <label for="opt_1" class="step success_line rounded-pill position-relative bg-white">
                                                        <?php } elseif($question['answer'] == 7) { ?>
                                                            <label for="opt_1" class="step error rounded-pill position-relative bg-white">
                                                        <?php } else{ ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_7'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_7'] ?>">
                                                            <span class="position-absolute">G</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_8'] != '' && $question['option_8'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 8){ ?>
                                                            <label for="opt_1" class="step success_line rounded-pill position-relative bg-white">
                                                        <?php } elseif($question['answer'] == 8) { ?>
                                                            <label for="opt_1" class="step error rounded-pill position-relative bg-white">
                                                        <?php } else{ ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_8'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_8'] ?>">
                                                            <span class="position-absolute">H</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_9'] != '' && $question['option_9'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 9){ ?>
                                                            <label for="opt_1" class="step success_line rounded-pill position-relative bg-white">
                                                        <?php } elseif($question['answer'] == 9) { ?>
                                                            <label for="opt_1" class="step error rounded-pill position-relative bg-white">
                                                        <?php } else{ ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_9'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_9'] ?>">
                                                            <span class="position-absolute">I</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($question['option_10'] != '' && $question['option_10'] != null){ ?>
                                                    <div class='col-xl-6'>

                                                        <?php if($question['answer_option'] == 10){ ?>
                                                            <label for="opt_1" class="step success_line rounded-pill position-relative bg-white">
                                                        <?php } elseif($question['answer'] == 10) { ?>
                                                            <label for="opt_1" class="step error rounded-pill position-relative bg-white">
                                                        <?php } else{ ?>
                                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">
                                                        <?php } ?>

                                                            <?=$question['option_10'] ?>
                                                            <input type="radio" name="stp_1_select_option" value="<?=$question['option_10'] ?>">
                                                            <span class="position-absolute">J</span>
                                                        </label>
                                                    </div>
                                                    <?php } ?>

                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php $i++; } } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url(); ?>/public/easylearn/libs/apexcharts/apexcharts.min.js"></script>

<script>
    //Credit Score Distribution
    if ($('#graph').length) {
        var options = {
            chart: {
                height: 300,
                type: "radialBar",				
				animations: {
					enabled: true,
					easing: 'easeinout',
					speed: 800,
					animateGradually: {
						enabled: true,
						delay: 10000
					},
					dynamicAnimation: {
						enabled: true,
						speed: 350
					}
				}
            },
            series: [<?=$percentage; ?>],
            colors: ["#6571ff"],
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 15,
                        size: "70%"
                    },
                    track: {
                        show: true,
                        background: "#e9ecef",
                        strokeWidth: '100%',
                        opacity: 1,
                        margin: 5, 
                    },
                    dataLabels: {
                        showOn: "always",
                        name: {
                            show: true,
                            color: "#7987a1",
                            fontSize: "30px"
                        },
                        value: {
                            color: "#6571ff",
                            fontSize: "15px",
                            show: true
                        }
                    }
                }
            },			
            fill: {
                opacity: 1
            },
            stroke: {
                lineCap: "round",
            },
			labels: ["<?=$overview['right_questions'] ?> / <?=$overview['total_questions'] ?>"]
        };
        
        var graph = new ApexCharts(document.querySelector("#graph"), options);
        graph.render();    
    }
</script>

<?php 
    include 'template/login_footer.php';
?>