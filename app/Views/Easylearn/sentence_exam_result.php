<?php 
    include 'template/login_header.php';

    if(isset($_GET['student_id']))
    {
        $exam = json_decode(exam_detail_id_student($_GET['id'],$session->get('user')['permissions']), true)['data'];
        $overview = json_decode(sentence_exam_overview_student($_GET['student_id'], $_GET['id']), true)['data'];
        $questions = json_decode(sentence_exam_question_answer($_GET['student_id'], $_GET['id']), true)['data'];
    }
    else
    {
        $exam = json_decode(exam_detail_id_student($_GET['id'],$session->get('user')['permissions']), true)['data'];
        $overview = json_decode(sentence_exam_overview_student($session->get('user')['id'], $_GET['id']), true)['data'];
        $questions = json_decode(sentence_exam_question_answer($session->get('user')['id'], $_GET['id']), true)['data'];
    }

    $percentage = round(($overview['right_questions']/$overview['total_questions'])*100);
?>

<link rel="stylesheet" href="<?=base_url(); ?>/public/easylearn/libs/mcq_exam/css/style.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
.panel-body {
    position: relative;
    padding: 1.25rem;
}

.panel-body h5 {
    margin-bottom: 0;
}

element.style {
    font-size: 30px;
}

.fa-brands,
.fab {
    font-family: "Font Awesome 6 Brands";
    font-weight: 400;
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

                                <a href="sentence_exam" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>

                            <?php } ?>

                            

                        </div>
                    </div>
                </div>

                <div class="col-xl-8 mx-xl-auto">
                    <div class="d-flex flex-wrap align-items-center justify-content-center mb-5 mb-md-3">
                        <div id="graph" style="min-height: 278.7px;">
                        </div>
                    </div>

                    <h1 class="text-center mb-1"> <?=$exam['exam_title']; ?> </h1>
                    <div class="text-center mb-7"> <?=$exam['course_name']; ?> </div>

                    <div class="row mb-7 justify-content-center align-items-center">
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
                        <div class="panel-body">
                            <h5 style="font-size: 15px;">Question's and Answers:</h5>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <?php if($questions == 'No Data'){ } else{ $i = 1; foreach($questions as $question){ ?>

                        <div class='question'>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <div class="content_box position-relative mb-7">

                                        <div class="question_number text-uppercase">
                                            <span>questions <?=$i ?> </span>
                                        </div>

                                        <div class='row d-flex justify-content-center mb-3'>
                                            <img src="<?=$question['question_image'] ?>" style="width: 300px; height: auto;" />
                                        </div>

                                        <div class="question_title py-3 text-uppercase">

                                            <?php
                                                $sentence_question = $question['question_title'];

                                                //Answer 1
                                                if(strtolower(trim($question['option_1'])) == strtolower(trim($question['answer_1'])))
                                                {
                                                    $pos = strpos($sentence_question, '<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;');
                                                    if ($pos !== false) {
                                                        $sentence_question = substr_replace($sentence_question, '<span style="border-bottom: 2px solid black;"> &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: green;">'.$question['answer_1'].'</span> &nbsp;&nbsp;&nbsp;&nbsp; </span>',$pos,strlen('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;'));
                                                    }
                                                }
                                                else
                                                {
                                                    $pos = strpos($sentence_question, '<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;');
                                                    if ($pos !== false) {
                                                        $sentence_question = substr_replace($sentence_question, '<span style="border-bottom: 2px solid black;"> &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: red;"> <s>'.$question['answer_1'].'</s> </span> &nbsp;&nbsp; <span style="color: green;">'.$question['option_1'].'</span> &nbsp;&nbsp;&nbsp;&nbsp; </span>',$pos,strlen('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;'));
                                                    }
                                                }

                                                //Answer 2
                                                if(strtolower(trim($question['option_2'])) == strtolower(trim($question['answer_2'])))
                                                {
                                                    $pos = strpos($sentence_question, '<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;');
                                                    if ($pos !== false) {
                                                        $sentence_question = substr_replace($sentence_question, '<span style="border-bottom: 2px solid black;"> &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: green;">'.$question['answer_2'].'</span> &nbsp;&nbsp;&nbsp;&nbsp; </span>',$pos,strlen('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;'));
                                                    }
                                                }
                                                else
                                                {
                                                    $pos = strpos($sentence_question, '<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;');
                                                    if ($pos !== false) {
                                                        $sentence_question = substr_replace($sentence_question, '<span style="border-bottom: 2px solid black;"> &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: red;"> <s>'.$question['answer_2'].'</s> </span> &nbsp;&nbsp; <span style="color: green;">'.$question['option_2'].'</span> &nbsp;&nbsp;&nbsp;&nbsp; </span>',$pos,strlen('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;'));
                                                    }
                                                }

                                                //Answer 3
                                                if(strtolower(trim($question['option_3'])) == strtolower(trim($question['answer_3'])))
                                                {
                                                    $pos = strpos($sentence_question, '<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;');
                                                    if ($pos !== false) {
                                                        $sentence_question = substr_replace($sentence_question, '<span style="border-bottom: 2px solid black;"> &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: green;">'.$question['answer_3'].'</span> &nbsp;&nbsp;&nbsp;&nbsp; </span>',$pos,strlen('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;'));
                                                    }
                                                }
                                                else
                                                {
                                                    $pos = strpos($sentence_question, '<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;');
                                                    if ($pos !== false) {
                                                        $sentence_question = substr_replace($sentence_question, '<span style="border-bottom: 2px solid black;"> &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: red;"> <s>'.$question['answer_3'].'</s> </span> &nbsp;&nbsp; <span style="color: green;">'.$question['option_3'].'</span> &nbsp;&nbsp;&nbsp;&nbsp; </span>',$pos,strlen('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;'));
                                                    }
                                                }

                                                //Answer 4
                                                if(strtolower(trim($question['option_4'])) == strtolower(trim($question['answer_4'])))
                                                {
                                                    $pos = strpos($sentence_question, '<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;');
                                                    if ($pos !== false) {
                                                        $sentence_question = substr_replace($sentence_question, '<span style="border-bottom: 2px solid black;"> &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: green;">'.$question['answer_4'].'</span> &nbsp;&nbsp;&nbsp;&nbsp; </span>',$pos,strlen('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;'));
                                                    }
                                                }
                                                else
                                                {
                                                    $pos = strpos($sentence_question, '<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;');
                                                    if ($pos !== false) {
                                                        $sentence_question = substr_replace($sentence_question, '<span style="border-bottom: 2px solid black;"> &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: red;"> <s>'.$question['answer_4'].'</s> </span> &nbsp;&nbsp; <span style="color: green;">'.$question['option_4'].'</span> &nbsp;&nbsp;&nbsp;&nbsp; </span>',$pos,strlen('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;'));
                                                    }
                                                }

                                                //Answer 5
                                                if(strtolower(trim($question['option_5'])) == strtolower(trim($question['answer_5'])))
                                                {
                                                    $pos = strpos($sentence_question, '<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;');
                                                    if ($pos !== false) {
                                                        $sentence_question = substr_replace($sentence_question, '<span style="border-bottom: 2px solid black;"> &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: green;">'.$question['answer_5'].'</span> &nbsp;&nbsp;&nbsp;&nbsp; </span>',$pos,strlen('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;'));
                                                    }
                                                }
                                                else
                                                {
                                                    $pos = strpos($sentence_question, '<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;');
                                                    if ($pos !== false) {
                                                        $sentence_question = substr_replace($sentence_question, '<span style="border-bottom: 2px solid black;"> &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: red;"> <s>'.$question['answer_5'].'</s> </span> &nbsp;&nbsp; <span style="color: green;">'.$question['option_5'].'</span> &nbsp;&nbsp;&nbsp;&nbsp; </span>',$pos,strlen('<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;'));
                                                    }
                                                }
                                            ?>

                                            <h5> <b> <?=nl2br($sentence_question); ?> </b> </h5>
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