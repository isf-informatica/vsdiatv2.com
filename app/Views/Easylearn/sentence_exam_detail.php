<?php 
    include 'template/login_header.php'; 
    $exam      = json_decode(exam_detail_id($_GET['id']), true)['data'];
    $questions = json_decode(sent_exam_question($_GET['id']), true)['data'];
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?=base_url(); ?>/public/easylearn/libs/wysiwg-editor/css/froala_editor.css">

<style>
    div#editor {
        margin: auto;
        text-align: left;
    }
</style>

<section class="content">
    <div class="row d-flex justify-content-center" >
        <input type="hidden" id="exam_id" value="<?=$exam['id'] ?>" >

        <div class="col-12">
            <div class='box'>
                <div class='box-body'>
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">   
                                <a href="manageExam" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='col-md-12'>
                                <a href="#" class="btn btn-primary m-15" data-toggle="modal" data-target="#add-question">Add Question</a>
                            </div>
                        </div>
                    </div>
            
                    <h4 class="text-center text-dark bold"> <b> <?=$exam['exam_title'] ?> </b> </h4>

                    <div class="row d-flex justify-content-center">
                        <button type="button" id='canceledit_mcq_reading' class="btn waves-effect d-none waves-light">Close</button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="button" id='save_mcq_reading' class="btn btn-danger d-none waves-effect waves-light">Save</button>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <button type="button" id='delete_listening_audio' class="btn btn-danger d-none waves-effect waves-light">Delete Audio</button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="button" id='canceledit_mcq_listening' class="btn waves-effect d-none waves-light">Close</button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="button" id='save_mcq_listening' class="btn btn-primary d-none waves-effect waves-light">Save</button>
                    </div>   
                </div>

                <div class='col-md-12 mt-15 mb-15'>
                    <div class="panel panel-secondary" style="background-color: rgba(38, 38, 38, 0.1);">
                        <div class="panel-body"><h5 style="font-size: 15px;">Question's and Answers:</h5></div>
                    </div>

                    <div class="form-group mt-15">
                        <?php if($questions == 'No Data'){ } else{ $i = 1; foreach($questions as $question){ ?>
                            <div class="content-box border p-15 ,mt-10">
                                <div class="question_number text-uppercase mt-15">
                                    <span>questions <?=$i ?> </span>
                                </div>

                                <div class="question_title py-3 text-uppercase">
                                    <h5> <b> <?=nl2br($question['question_title']) ?> </b> </h5>
                                </div>

                                <div class='row d-flex justify-content-center mb-15'>
                                    <img src="<?=$question['question_image'] ?>" style="width: 300px; height: auto;" />
                                </div>

                                <div class="form_items">
                                    <div class='row'>

                                        <?php if($question['option_1'] != '' && $question['option_1'] != null){ ?>
                                        <div class='col-md-6'>
                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">

                                                <?=$question['option_1'] ?>
                                                <input type="radio" name="stp_1_select_option" value="<?=$question['option_1'] ?>">
                                                <span class="position-absolute">A</span>
                                            </label>
                                        </div>
                                        <?php } ?>

                                        <?php if($question['option_2'] != '' && $question['option_2'] != null){ ?>
                                        <div class='col-md-6'>
                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">

                                                <?=$question['option_2'] ?>
                                                <input type="radio" name="stp_1_select_option" value="<?=$question['option_2'] ?>">
                                                <span class="position-absolute">B</span>
                                            </label>
                                        </div>
                                        <?php } ?>

                                        <?php if($question['option_3'] != '' && $question['option_3'] != null){ ?>
                                        <div class='col-md-6'>
                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">

                                                <?=$question['option_3'] ?>
                                                <input type="radio" name="stp_1_select_option" value="<?=$question['option_3'] ?>">
                                                <span class="position-absolute">C</span>
                                            </label>
                                        </div>
                                        <?php } ?>

                                        <?php if($question['option_4'] != '' && $question['option_4'] != null){ ?>
                                        <div class='col-md-6'>
                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">

                                                <?=$question['option_4'] ?>
                                                <input type="radio" name="stp_1_select_option" value="<?=$question['option_4'] ?>">
                                                <span class="position-absolute">D</span>
                                            </label>
                                        </div>
                                        <?php } ?>

                                        <?php if($question['option_5'] != '' && $question['option_5'] != null){ ?>
                                        <div class='col-md-6'>
                                            <label for="opt_1" class="step rounded-pill position-relative bg-white">

                                                <?=$question['option_5'] ?>
                                                <input type="radio" name="stp_1_select_option" value="<?=$question['option_5'] ?>">
                                                <span class="position-absolute">E</span>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-center">
                                    <button type="button" data-id='<?=$question['id'] ?>' class="btn btn-primary waves-effect edit_sent_question">Edit</button>
                                    &nbsp;&nbsp;&nbsp;
                                    <button type="submit" data-id='<?=$question['id'] ?>' class="btn delete_sent_question btn-danger waves-effect waves-light">Delete</button>
                                </div>
                            </div>
                        <?php $i++; }}?>
                    </div>
                </div>
            </div>
        </div>
    </div>    
<section>

<!-- Modal Add Question -->
<div class="modal fade none-border add-category" id="add-question" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-5" >
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Question</strong></h4>
            </div>

            <ul class="nav nav-tabs customtab2 d-flex justify-content-center m-15" role="tablist">
                <li class="nav-item mt-20"> 
                    <a class="nav-link active" style='border:1px solid black;border-radius: 20px;' data-toggle="tab" href="#first-stage" role="tab">
                    <i class="fa fa-solid fa-user"></i> Single Question</span>
                    </a> 
                </li>
                &emsp;
                <li class="nav-item mt-20"> 
                    <a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab" href="#final-stage" role="tab">
                        <i class="fa fa-solid fa-users"></i> Multiple Question</span>
                    </a> 
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="first-stage" role="tabpanel">
                    <div id="editor">
                        <form id='add_sentence_question' >
                            <?php $session->set('add_sentence_token', md5(uniqid(mt_rand(), true))); ?>
                            <input type="hidden" id='add_sentence_token' name="add_sentence_token" value="<?=$session->get('add_sentence_token'); ?>">
                            <div class="row p-3">
                                <div class="col-12">
                                    <label for="sent_question">Question: <span class="text-danger">*</span></label>
                                    <textarea id='sent_question' class="form-control" style="margin-top: 30px;" placeholder="Type some text"></textarea>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-12 mb-2">
                                    <label style='color: #969ba0;' class="control-label form-label">Question Image</label>
                                    <input class="form-control form-white" id='question_image' type="file" name="question_image"  accept='image/*'>
                                    <div class='d-none btn-danger check_question_image' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Choose valid Question Image</div>
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col-6 mb-2">
                                    <label for="opt-1">Option 1 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control input-sm" id="opt-1" required>
                                    <div class='d-none btn-danger check_opt-1' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter valid Option</div>
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="opt-2">Option 2</label>
                                    <input type="text" class="form-control input-sm" id="opt-2">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="opt-3">Option 3</label>
                                    <input type="text" class="form-control input-sm" id="opt-3">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="opt-4">Option 4</label>
                                    <input type="text" class="form-control input-sm" id="opt-4">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="otp-5">Option 5</label>
                                    <input type="text" class="form-control input-sm" id="opt-5">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane" id="final-stage" role="tabpanel">
                    <div class="modal-body">
                        <div class="row justify-content-start">
                            <div class="col-md-1"></div>
                            <div class="">
                                <div class="form-label-group">
                                    <label style='color: #969ba0;' class="control-label form-label">Download Template : - </label> &nbsp;&nbsp;&nbsp;
                                    <a href="Download_Sentence_Question_Template" class="ps-15 pe-15 pt-10 pb-10 btn btn-primary DownloadTemplate"> <i class="fa fa-solid fa-download"></i> Download</a>
                                </div>
                            </div>
                        </div>
                        </br>

                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-label-group">
                                    <label style='color: #969ba0;' class="control-label form-label"> <b> Note : add this symbol for input element "--input--" </b> </label> 
                                </div>
                            </div>
                        </div>
                        </br>

                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-label-group">
                                    <label style='color: #969ba0;' class="control-label form-label">Choose File Below</label> 
                                    <input type="file" class="dropify" id="Multiple_Sentence_Question" data-height="200"/>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="Multiple_Sentence_QuestionAdd">Add Questions</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Question -->
<div class="modal fade none-border add-category" id="edit-question" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-5" >
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Question</strong></h4>
            </div>

            <div id="editor">
                <form id='edit_sentence' >
                    <?php $session->set('edit_sentence_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_sentence_token' name="edit_sentence_token" value="<?=$session->get('edit_sentence_token'); ?>">
                    <input type="hidden" id='question_id' name="question_id" value="">
                    <div class="row p-3">
                        <div class="col-12">
                            <label for="edit_sentence_question">Question: <span class="text-danger">*</span></label>
                            <textarea id='edit_sentence_question' class="form-control" style="margin-top: 30px;" placeholder="Type some text"></textarea>
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col-md-6 d-flex justify-content-center mt-15">
                            <img id='view_question_image' src="" style='height: 150px;'>
                        </div>

                        <div class="col-md-6 align-self-center mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Question Image</label>
                            <input class="form-control form-white" id='edit_question_image' type="file" name="edit_question_image"  accept='image/*'>
                            <div class='d-none btn-danger check_edit_question_image' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Choose valid Question Image</div>
                        </div>
                    
                        <div class="col-6 mb-2">
                            <label for="edit_opt_1">Option 1 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-sm" id="edit_opt_1" required>
                            <div class='d-none btn-danger check_edit_opt_1' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter valid Option</div>
                        </div>

                        <div class="col-6 mb-2">
                            <label for="edit_opt_2">Option 2</label>
                            <input type="text" class="form-control input-sm" id="edit_opt_2">
                        </div>

                        <div class="col-6 mb-2">
                            <label for="edit_opt_3">Option 3</label>
                            <input type="text" class="form-control input-sm" id="edit_opt_3">
                        </div>

                        <div class="col-6 mb-2">
                            <label for="edit_opt_4">Option 4</label>
                            <input type="text" class="form-control input-sm" id="edit_opt_4">
                        </div>

                        <div class="col-6 mb-2">
                            <label for="edit_opt_5">Option 5</label>
                            <input type="text" class="form-control input-sm" id="edit_opt_5">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript" src="<?=base_url(); ?>/public/easylearn/libs/wysiwg-editor/js/froala_editor.min.js" ></script>

<script src="<?=base_url(); ?>/public/easylearn/js/exam.js"></script>
<?php include 'template/login_footer.php'; ?>

