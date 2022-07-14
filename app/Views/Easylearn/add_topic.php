<?php include 'template/login_header.php'; 
    $course = json_decode(get_course_name(), true);
    $unique = $_GET['id'];
?>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class='box'>
                <div class='box-body'>
                <div class="m-10">
                    <div class="text-start p-3">
                        <a href="view_topic?id=<?=$unique?>" class="btn btn-info active">
                            <i class="fas fa-backward"></i>&nbsp;&nbsp;Back
                        </a>
                    </div>

                    <input type="hidden" name="" class="t_uid" id="t_uid" value="<?=$unique?>">
                    <div class="text-center">
                        <h3>Add Topic</h3>
                    </div>

                    <ul class="nav nav-tabs customtab2 d-flex justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" style='border:1px solid black;border-radius: 20px;' data-toggle="tab" href="#first-stage" role="tab">
                                <i class="fa fa-solid fa-user"></i> Single Topic</span>
                            </a>
                        </li>
                        &emsp;
                        <li class="nav-item">
                            <a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab" href="#final-stage" role="tab">
                                <i class="fa fa-solid fa-users"></i> Multiple Topics</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="first-stage" role="tabpanel">
                            <br><br>
                            <form id="add_topic">
                                <fieldset>
                                    <div class="row justify-content-center m-20">
                                        <div class="col-md-10 mb-3">
                                            <div class="form-label-group">
                                                <label for="course_nm">Course Name:</label>
                                                <select name="" id="course_nm" class="form-control" disabled>
                                                    <?php foreach ($course['data'] as $i) { 
                                                    if($unique == $i['unique_id']) {?>
                                                    <option value="<?=$i['id']?>" selected><?=$i['course_name']?>
                                                    </option>
                                                    <?php } } ?>
                                                </select>
                                                
                                                <div class="d-none check-course_nm" style="font-size:12px;background-color:red;color:white;">
                                                    <i class="fas fa-exclamation-circle"></i> Select Course Name
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-10 mb-3">
                                            <div class="form-label-group">
                                                <label for="topic_nm">Topic Name:</label>
                                                <input type="text" class="form-control topic_nm" id="topic_nm">

                                                <div class="d-none check-topic_nm" style="font-size:12px;background-color:red;color:white;">
                                                    <i class="fas fa-exclamation-circle"></i> Enter Topic Name
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-10 mb-3">
                                            <div class="form-label-group">
                                                <label for="topic_img">Topic Image:</label>
                                                <input type="file" class="form-control topic_img" id="topic_img" accept="image/png, image/gif, image/jpeg">
                                                
                                                <div class="d-none check-topic_img" style="font-size:12px;background-color:red;color:white;">
                                                    <i class="fas fa-exclamation-circle"></i> Topic Image 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-10 mb-3">
                                            <div class="form-label-group">
                                                <label for="">Topic :&emsp;</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input req_checkbox" type="checkbox" id="topic_req1" value="sub_topic">
                                                    <label class="form-check-label" for="topic_req1">Sub Topic</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input req_checkbox" type="checkbox" id="topic_req2" value="chap">
                                                    <label class="form-check-label" for="topic_req2">Chapter </label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input req_checkbox" type="checkbox" id="topic_req3" value="lab_video">
                                                    <label class="form-check-label" for="topic_req3">Lab Video Link</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5 mb-3">
                                            <div class="form-label-group">
                                                <label for="sub_topic_nm">Sub Topic Name:</label>
                                                <input type="text" class="form-control sub_topic_nm" id="sub_topic_nm" disabled>

                                                <div class="d-none check-sub_topic_nm" style="font-size:12px;"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-5 mb-3">
                                            <div class="form-label-group">
                                                <label for="chap_nm">Chapter Name:</label>
                                                <input type="text" class="form-control chap_nm" id="chap_nm" disabled>

                                                <div class="d-none check-chap_nm" style="font-size:12px;"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-10 mb-3">
                                            <div class="form-label-group">
                                                <label for="topic_doc">Document (In PDF):</label>
                                                <input type="file" class="form-control topic_doc" id="topic_doc" accept="application/pdf">
                                                
                                                <div class="d-none check-topic_doc" style="font-size:12px;background-color:red;color:white;">
                                                    <i class="fas fa-exclamation-circle"></i> Select Document in PDF
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-10 mb-3">
                                            <div class="form-label-group">
                                                <label for="topic_video_link">Video Link:</label>
                                                <input type="text" class="form-control topic_video_link" id="topic_video_link">

                                                <div class="d-none check-topic_video_link" style="font-size:12px;background-color:red;color:white;">
                                                    <i class="fas fa-exclamation-circle"></i>Give Video Link 
                                                </div>

                                                <div class="d-none check-topic_doc_vlink" style="font-size:12px;background-color:red;color:white;">
                                                    <i class="fas fa-exclamation-circle"></i> document or video link must
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-10 mb-3">
                                            <div class="form-label-group">
                                                <label for="topic_video_lab_link">Lab Video Link:</label>
                                                <input type="text" class="form-control topic_video_lab_link" id="topic_video_lab_link" disabled>
                                                
                                                <div class="d-none check-topic_video_lab_link" style="font-size:12px;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-10 mb-3">
                                            <div class="form-label-group">
                                                <label for="topic_descp"> Description :</label>
                                                <textarea type="text" style="resize: none;" class="form-control form-control-flush" id="topic_descp" rows="3" placeholder="Description"></textarea>
                                                
                                                <div class="d-none check-topic_descp" style="font-size:12px;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="col-md-12 text-center">
                                            <div class="form-label-group">
                                                <button type='submit' class="btn btn-rounded btn-primary"> Add Topics </button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <br>
                            </form>
                        </div>

                        <div class="tab-pane" id="final-stage" role="tabpanel">
                            <br><br>
                            <div class="panel panel-secondary" style="background-color: rgba(38, 38, 38, 0.1);">
                                <div class="panel-body">
                                    <h5 style="font-size: 15px;">Add Multiple Topics</h5>
                                </div>
                            </div>
                            <br>

                            <div class="row justify-content-start">
                                <div class="col-md-1"></div>
                                <div class="col-12 mb-3">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10 mb-3">
                                            <div class="form-label-group">
                                                <label>Download Template : - </label>&nbsp; &nbsp;
                                                <a href="download_topic_template" class="btn btn-primary DownloadTemplate">
                                                    <i class="fa fa-solid fa-download"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            
                            <div class="col-12">
                                <form id="multiple_topics_add">
                                    <?php $session->set('add_mtopic_token', md5(uniqid(mt_rand(), true))); ?>
                                    <input type="hidden" id='add_mtopic_token' name="add_mtopic_token" value="<?=$session->get('add_mtopic_token'); ?>">
                                    
                                    <?php foreach ($course['data'] as $i) { 
                                       if($i['unique_id'] == $unique){?>
                                    <input type="hidden" id="course_id" value="<?=$i['id']?>">
                                    <?php } } ?>

                                    <div class="row justify-content-center">
                                        <div class="col-md-10 mb-3">
                                            <div class="form-label-group">
                                                <label>Choose File Below</label>
                                                <input type="file" class="dropify" id="multiple_topics" accept=".csv" data-height="200" />
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <div class="form-label-group">
                                                <button type='submit' class="btn btn-rounded btn-primary"> Add Topics </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'template/login_footer.php'; ?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Course.js"></script>