<?php 
    include 'template/login_header.php'; 

    $exam      = json_decode(exam_detail_id($_GET['id']), true)['data'];
    $questions = json_decode(mcq_exam_question($_GET['id']), true)['data'];
?>

<style>
div#editor {
    width: 98%;
    margin: auto;
    text-align: left;
}
</style>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class='box'>
                <div class='box-body'>
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">
                                <a href="manageExam" class="btn btn-info active"><i
                                        class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='col-md-12'>
                                <a href="#" class="btn btn-primary m-15" data-toggle="modal"
                                    data-target="#add-question">Add Question</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="text-center text-dark bold"> <b> <?=$exam['exam_title'] ?> </b> </h4>

                    <div class="row d-flex justify-content-center">
                        <!-- <button type="button" id='edit_mcq_reading' class="btn btn-danger waves-effect waves-light">Edit</button> -->
                        <button type="button" id='canceledit_mcq_reading'
                            class="btn waves-effect d-none waves-light">Close</button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="button" id='save_mcq_reading'
                            class="btn btn-danger d-none waves-effect waves-light">Save</button>
                    </div>



                    <div class="row d-flex justify-content-center">
                        <!-- <button type="button" id='edit_mcq_listening' class="btn btn-danger waves-effect waves-light">Edit</button> -->

                        <button type="button" id='delete_listening_audio'
                            class="btn btn-danger d-none waves-effect waves-light">Delete Audio</button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="button" id='canceledit_mcq_listening'
                            class="btn waves-effect d-none waves-light">Close</button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="button" id='save_mcq_listening'
                            class="btn btn-primary d-none waves-effect waves-light">Save</button>
                    </div>
                </div>

                <div class='col-md-12 mt-15 mb-15'>
                    <div class="panel panel-secondary" style="background-color: rgba(38, 38, 38, 0.1);">
                        <div class="panel-body">
                            <h5 style="font-size: 15px;">Question's and Answers:</h5>
                        </div>
                    </div>

                    <div class="form-group mt-15">
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

                                        <div class='row d-flex justify-content-center mb-15'>
                                            <img src="<?=$question['question_image'] ?>"
                                                style="width: 300px; height: auto;" />
                                        </div>

                                        <div class="form_items">
                                            <div class='row'>

                                                <?php if($question['option_1'] != '' && $question['option_1'] != null){ ?>
                                                <div class='col-xl-6'>

                                                    <?php if($question['answer_option'] == 1){ ?>
                                                    <label for="opt_1"
                                                        class="step active rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                        <label for="opt_1"
                                                            class="step rounded-pill position-relative bg-white">
                                                            <?php } ?>

                                                            <?=$question['option_1'] ?>
                                                            <input type="radio" name="stp_1_select_option"
                                                                value="<?=$question['option_1'] ?>">
                                                            <span class="position-absolute">A</span>
                                                        </label>
                                                </div>
                                                <?php } ?>

                                                <?php if($question['option_2'] != '' && $question['option_2'] != null){ ?>
                                                <div class='col-xl-6'>

                                                    <?php if($question['answer_option'] == 2){ ?>
                                                    <label for="opt_1"
                                                        class="step active rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                        <label for="opt_1"
                                                            class="step rounded-pill position-relative bg-white">
                                                            <?php } ?>

                                                            <?=$question['option_2'] ?>
                                                            <input type="radio" name="stp_1_select_option"
                                                                value="<?=$question['option_2'] ?>">
                                                            <span class="position-absolute">B</span>
                                                        </label>
                                                </div>
                                                <?php } ?>

                                                <?php if($question['option_3'] != '' && $question['option_3'] != null){ ?>
                                                <div class='col-xl-6'>

                                                    <?php if($question['answer_option'] == 3){ ?>
                                                    <label for="opt_1"
                                                        class="step active rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                        <label for="opt_1"
                                                            class="step rounded-pill position-relative bg-white">
                                                            <?php } ?>

                                                            <?=$question['option_3'] ?>
                                                            <input type="radio" name="stp_1_select_option"
                                                                value="<?=$question['option_3'] ?>">
                                                            <span class="position-absolute">C</span>
                                                        </label>
                                                </div>
                                                <?php } ?>

                                                <?php if($question['option_4'] != '' && $question['option_4'] != null){ ?>
                                                <div class='col-xl-6'>

                                                    <?php if($question['answer_option'] == 4){ ?>
                                                    <label for="opt_1"
                                                        class="step active rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                        <label for="opt_1"
                                                            class="step rounded-pill position-relative bg-white">
                                                            <?php } ?>

                                                            <?=$question['option_4'] ?>
                                                            <input type="radio" name="stp_1_select_option"
                                                                value="<?=$question['option_4'] ?>">
                                                            <span class="position-absolute">D</span>
                                                        </label>
                                                </div>
                                                <?php } ?>

                                                <?php if($question['option_5'] != '' && $question['option_5'] != null){ ?>
                                                <div class='col-xl-6'>

                                                    <?php if($question['answer_option'] == 5){ ?>
                                                    <label for="opt_1"
                                                        class="step active rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                        <label for="opt_1"
                                                            class="step rounded-pill position-relative bg-white">
                                                            <?php } ?>

                                                            <?=$question['option_5'] ?>
                                                            <input type="radio" name="stp_1_select_option"
                                                                value="<?=$question['option_5'] ?>">
                                                            <span class="position-absolute">E</span>
                                                        </label>
                                                </div>
                                                <?php } ?>

                                                <?php if($question['option_6'] != '' && $question['option_6'] != null){ ?>
                                                <div class='col-xl-6'>

                                                    <?php if($question['answer_option'] == 6){ ?>
                                                    <label for="opt_1"
                                                        class="step active rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                        <label for="opt_1"
                                                            class="step rounded-pill position-relative bg-white">
                                                            <?php } ?>

                                                            <?=$question['option_6'] ?>
                                                            <input type="radio" name="stp_1_select_option"
                                                                value="<?=$question['option_6'] ?>">
                                                            <span class="position-absolute">F</span>
                                                        </label>
                                                </div>
                                                <?php } ?>

                                                <?php if($question['option_7'] != '' && $question['option_7'] != null){ ?>
                                                <div class='col-xl-6'>

                                                    <?php if($question['answer_option'] == 7){ ?>
                                                    <label for="opt_1"
                                                        class="step active rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                        <label for="opt_1"
                                                            class="step rounded-pill position-relative bg-white">
                                                            <?php } ?>

                                                            <?=$question['option_7'] ?>
                                                            <input type="radio" name="stp_1_select_option"
                                                                value="<?=$question['option_7'] ?>">
                                                            <span class="position-absolute">G</span>
                                                        </label>
                                                </div>
                                                <?php } ?>

                                                <?php if($question['option_8'] != '' && $question['option_8'] != null){ ?>
                                                <div class='col-xl-6'>

                                                    <?php if($question['answer_option'] == 8){ ?>
                                                    <label for="opt_1"
                                                        class="step active rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                        <label for="opt_1"
                                                            class="step rounded-pill position-relative bg-white">
                                                            <?php } ?>

                                                            <?=$question['option_8'] ?>
                                                            <input type="radio" name="stp_1_select_option"
                                                                value="<?=$question['option_8'] ?>">
                                                            <span class="position-absolute">H</span>
                                                        </label>
                                                </div>
                                                <?php } ?>

                                                <?php if($question['option_9'] != '' && $question['option_9'] != null){ ?>
                                                <div class='col-xl-6'>

                                                    <?php if($question['answer_option'] == 9){ ?>
                                                    <label for="opt_1"
                                                        class="step active rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                        <label for="opt_1"
                                                            class="step rounded-pill position-relative bg-white">
                                                            <?php } ?>

                                                            <?=$question['option_9'] ?>
                                                            <input type="radio" name="stp_1_select_option"
                                                                value="<?=$question['option_9'] ?>">
                                                            <span class="position-absolute">I</span>
                                                        </label>
                                                </div>
                                                <?php } ?>

                                                <?php if($question['option_10'] != '' && $question['option_10'] != null){ ?>
                                                <div class='col-xl-6'>

                                                    <?php if($question['answer_option'] == 10){ ?>
                                                    <label for="opt_1"
                                                        class="step active rounded-pill position-relative bg-white">
                                                        <?php } else { ?>
                                                        <label for="opt_1"
                                                            class="step rounded-pill position-relative bg-white">
                                                            <?php } ?>

                                                            <?=$question['option_10'] ?>
                                                            <input type="radio" name="stp_1_select_option"
                                                                value="<?=$question['option_10'] ?>">
                                                            <span class="position-absolute">J</span>
                                                        </label>
                                                </div>
                                                <?php } ?>

                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-center">
                                            <button type="button" data-id='<?=$question['id'] ?>'
                                                class="btn btn-primary waves-effect edit_question">Edit</button>
                                            &nbsp;&nbsp;&nbsp;
                                            <button type="submit" data-id='<?=$question['id'] ?>'
                                                class="btn delete_mcq_question btn-danger waves-effect waves-light">Delete</button>
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
    </div>

</section>

<!-- Modal Add Question -->
<div class="modal fade none-border add-category" id="add-question" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Question</strong></h4>
            </div>

            <ul class="nav nav-tabs customtab2 d-flex justify-content-center m-15" role="tablist">
                <li class="nav-item mt-20">
                    <a class="nav-link active" style='border:1px solid black;border-radius: 20px;' data-toggle="tab"
                        href="#first-stage" role="tab">
                        <i class="fa fa-solid fa-user"></i> Single Question</span>
                    </a>
                </li>
                &emsp;
                <li class="nav-item mt-20">
                    <a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab"
                        href="#final-stage" role="tab">
                        <i class="fa fa-solid fa-users"></i> Multiple Question</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="first-stage" role="tabpanel">
                    <form id='add_mcq_question'>
                        <?php $session->set('add_question_token', md5(uniqid(mt_rand(), true))); ?>
                        <input type="hidden" id='add_question_token' name="add_question_token"
                            value="<?=$session->get('add_question_token'); ?>">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label style='color: #969ba0;' class="control-label form-label">Question
                                        Title</label>
                                    <input class="form-control form-white" placeholder="Enter Question"
                                        id='question_title' type="text" name="question_title">
                                    <div class='d-none btn-danger check_question_title'
                                        style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>
                                        Enter valid Question Title</div>
                                </div>

                                <div class="col-md-12 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Question
                                        Image</label>
                                    <input class="form-control form-white" id='question_image' type="file"
                                        name="question_image" accept='image/*'>
                                    <div class='d-none btn-danger check_question_image'
                                        style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>
                                        Choose valid Question Image</div>
                                </div>

                                <div class="col-md-6 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Option 1</label>
                                    <input class="form-control form-white" placeholder="Option 1" id='add_option_1'
                                        type="text" name="add_option_1">
                                    <div class='d-none btn-danger check_add_option_1'
                                        style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>
                                        Enter valid Option</div>
                                </div>

                                <div class="col-md-6 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Option 2</label>
                                    <input class="form-control form-white" placeholder="Option 2" id='add_option_2'
                                        type="text" name="add_option_2">
                                    <div class='d-none btn-danger check_add_option_2'
                                        style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>
                                        Enter valid Option</div>
                                </div>

                                <div class="col-md-6 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Option 3</label>
                                    <input class="form-control form-white" placeholder="Option 3" id='add_option_3'
                                        type="text" name="add_option_3">
                                </div>

                                <div class="col-md-6 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Option 4</label>
                                    <input class="form-control form-white" placeholder="Option 4" id='add_option_4'
                                        type="text" name="add_option_4">
                                </div>

                                <div class="col-md-6 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Option 5</label>
                                    <input class="form-control form-white" placeholder="Option 5" id='add_option_5'
                                        type="text" name="add_option_5">
                                </div>

                                <div class="col-md-6 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Option 6</label>
                                    <input class="form-control form-white" placeholder="Option 6" id='add_option_6'
                                        type="text" name="add_option_6">
                                </div>

                                <div class="col-md-6 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Option 7</label>
                                    <input class="form-control form-white" placeholder="Option 7" id='add_option_7'
                                        type="text" name="add_option_7">
                                </div>

                                <div class="col-md-6 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Option 8</label>
                                    <input class="form-control form-white" placeholder="Option 8" id='add_option_8'
                                        type="text" name="add_option_8">
                                </div>

                                <div class="col-md-6 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Option 9</label>
                                    <input class="form-control form-white" placeholder="Option 9" id='add_option_9'
                                        type="text" name="add_option_9">
                                </div>

                                <div class="col-md-6 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Option 10</label>
                                    <input class="form-control form-white" placeholder="Option 10" id='add_option_10'
                                        type="text" name="add_option_10">
                                </div>

                                <div class="col-md-12 mt-15">
                                    <label style='color: #969ba0;' class="control-label form-label">Answer
                                        Option</label>
                                    <select class="form-control form-white" placeholder="Answer Option"
                                        id='add_answer_option' type="text" name="add_answer_option" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    <div class='d-none btn-danger check_add_answer_option'
                                        style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>
                                        Choose valid Answer Option</div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="final-stage" role="tabpanel">
                    <div class="modal-body">
                        <div class="row justify-content-start">
                            <div class="col-md-1"></div>
                            <div class="">
                                <div class="form-label-group">
                                    <label style='color: #969ba0;' class="control-label form-label">Download Template :
                                        - </label> &nbsp;&nbsp;&nbsp;
                                    <a href="Download_Question_Template"
                                        class="ps-15 pe-15 pt-10 pb-10 btn btn-primary DownloadTemplate"> <i
                                            class="fa fa-solid fa-download"></i> Download</a>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-label-group">
                                    <label style='color: #969ba0;' class="control-label form-label">Choose File
                                        Below</label>
                                    <input type="file" class="dropify" id="Multiple_Question" data-height="200" />
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="Multiple_QuestionAdd">Add Questions</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Model Edit Question-->
<div class="modal fade none-border add-category" id="edit-question" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Question</strong></h4>
            </div>

            <form id='edit_mcq_question'>
                <?php $session->set('edit_question_token', md5(uniqid(mt_rand(), true))); ?>
                <input type="hidden" id='edit_question_token' name="edit_question_token"
                    value="<?=$session->get('edit_question_token'); ?>">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label style='color: #969ba0;' class="control-label form-label">Question Title</label>
                            <input class="form-control form-white" placeholder="Enter Question" id='edit_question_title'
                                type="text" name="edit_question_title">
                            <div class='d-none btn-danger check_edit_question_title'
                                style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter
                                valid Question Title</div>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center mt-15">
                            <img id='view_question_image' src="" style='height: 150px;'>
                        </div>

                        <div class="col-md-6 align-self-center mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Question Image</label>
                            <input class="form-control form-white" id='edit_question_image' type="file"
                                name="edit_question_image" accept='image/*'>
                            <div class='d-none btn-danger check_edit_question_image'
                                style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Choose
                                valid Question Image</div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Option 1</label>
                            <input class="form-control form-white" placeholder="Option 1" id='edit_option_1' type="text"
                                name="edit_option_1">
                            <div class='d-none btn-danger check_edit_option_1'
                                style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter
                                valid Option</div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Option 2</label>
                            <input class="form-control form-white" placeholder="Option 2" id='edit_option_2' type="text"
                                name="edit_option_2">
                            <div class='d-none btn-danger check_edit_option_2'
                                style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter
                                valid Option</div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Option 3</label>
                            <input class="form-control form-white" placeholder="Option 3" id='edit_option_3' type="text"
                                name="edit_option_3">
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Option 4</label>
                            <input class="form-control form-white" placeholder="Option 4" id='edit_option_4' type="text"
                                name="edit_option_4">
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Option 5</label>
                            <input class="form-control form-white" placeholder="Option 5" id='edit_option_5' type="text"
                                name="edit_option_5">
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Option 6</label>
                            <input class="form-control form-white" placeholder="Option 6" id='edit_option_6' type="text"
                                name="edit_option_6">
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Option 7</label>
                            <input class="form-control form-white" placeholder="Option 7" id='edit_option_7' type="text"
                                name="edit_option_7">
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Option 8</label>
                            <input class="form-control form-white" placeholder="Option 8" id='edit_option_8' type="text"
                                name="edit_option_8">
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Option 9</label>
                            <input class="form-control form-white" placeholder="Option 9" id='edit_option_9' type="text"
                                name="edit_option_9">
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Option 10</label>
                            <input class="form-control form-white" placeholder="Option 10" id='edit_option_10'
                                type="text" name="edit_option_10">
                        </div>

                        <div class="col-md-12 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Answer Option</label>
                            <select class="form-control form-white" placeholder="Answer Option" id='edit_answer_option'
                                type="text" name="edit_answer_option" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <div class='d-none btn-danger check_edit_answer_option'
                                style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Choose
                                valid Answer Option</div>
                        </div>
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

<script src="<?=base_url(); ?>/public/easylearn/js/exam.js"></script>
<?php 
    include 'template/login_footer.php'; 
?>