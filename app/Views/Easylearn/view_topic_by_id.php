<?php 
    include 'template/login_header.php'; 

    $unique = $_GET['id'];
    $cid=$_GET['cid'];
    $course = json_decode(get_course_name(), true);

    $topic = json_decode(get_topic_status($_GET['id']), true)['data'];
	if($topic == 'FALSE')
	{
		die;
	}
?>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class='box'>
                <div class='box-body'>

                    <div class="m-10">
                        <div class="text-start p-3">   
                            <a href="view_topic?id=<?=$cid?>" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                        </div>

                        <div class="text-center"><h3>Edit Topic</h3></div>
                        <form id="edit_topic">
                            <div class="row justify-content-center m-20">
                                <?php $session->set('edit_topic_token', md5(uniqid(mt_rand(), true))); ?>
                                <input type="hidden" id='edit_topic_token' name="edit_topic_token" value="<?=$session->get('edit_topic_token'); ?>">
                                <input type="hidden" id='t_unique_id' name="t_unique_id" value="<?=$unique?>">
                                <input type="hidden" id="cid" value="<?=$cid?>">

                                <div class="col-md-10 mb-3">
                                    <div class="form-label-group">
                                        <label for="course_nm">Course Name:</label>
                                        <select name="" id="course_nm" class="form-control" disabled>
                                            <?php foreach ($course['data'] as $i) { ?>
                                                <option value="<?=$i['id']?>"><?=$i['course_name']?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="d-none check-course_nm" style="font-size:12px;"></div>
                                    </div>
                                </div>
                            

                                <div class="col-md-10 mb-3">
                                    <div class="form-label-group">
                                        <label for="topic_nm">Topic Name: </label>
                                        <input type="text" class="form-control topic_nm" id="topic_nm" required>
                                        
                                        <div class="d-none check-topic_nm" style="font-size:12px;background-color:red;color:white;"><i class="fas fa-exclamation-circle"></i> Enter Topic Name</div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="form-label-group">
                                        <label for="topic_img" class="view_topic_img">Topic Image: </label>
                                        <input type="file" class="form-control topic_img" id="topic_img" accept="image/jpeg, image/png, image/gif">
                                        
                                        <div class="d-none check-topic_img" style="font-size:12px;background-color:red;color:white;"><i class="fas fa-exclamation-circle"></i> Topic Image </div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="form-label-group">
                                        <label for="">Topic Required:&emsp;</label>
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
                                        <label for="topic_doc" class="view_topic_doc">Document (In PDF): </label>
                                        <input type="file" class="form-control topic_doc" id="topic_doc" accept = "application/pdf">
                                        
                                        <div class="d-none check-topic_doc" style="font-size:12px;background-color:red;color:white;"><i class="fas fa-exclamation-circle"></i>PDF document must</div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="form-label-group">
                                        <label for="topic_video_link">Video Link:</label>
                                        <input type="text" class="form-control topic_video_link" id="topic_video_link">
                                        
                                        <div class="d-none check-topic_video_link" style="font-size:12px;"></div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="form-label-group">
                                        <label for="topic_video_lab_link">Lab Video Link:</label>
                                        <input type="text" class="form-control topic_video_lab_link" id="topic_video_lab_link" disabled>
                                        
                                        <div class="d-none check-topic_video_lab_link" style="font-size:12px;"></div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="form-label-group">
                                        <label for="topic_descp"> Description :</label>
                                        <textarea type="text" class="form-control form-control-flush" id="topic_descp" rows="3" placeholder="Description" style='resize: none;'></textarea>
                                        
                                        <div class="d-none check-topic_descp" style="font-size:12px;"></div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 text-center">
                                    <div class="form-label-group">
                                    <button type="button" id='delete_topic' class="btn btn-danger btn-rounded waves-effect waves-light">Delete</button>
                                        &nbsp;&nbsp;&nbsp;
                                        <button type='submit' class="btn btn-rounded btn-primary waves-effect waves-light"> Edit Topic </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'template/login_footer.php'; ?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Course.js"></script>