<?php 
    include 'template/login_header.php'; 
    $unique=$_GET['id'];
    $course = json_decode(get_course_name(), true);

    $course = json_decode(get_course_status($_GET['id']), true)['data'];
	if($course == 'FALSE')
	{
		die;
	}
?>

<style>
    .course_certificate:before,
    .topic_visibility:before {
        content: 'No';
        left: -3rem;
    }

    .course_certificate:after,
    .topic_visibility:after {
        content: 'Yes';
        right: -3rem;
        opacity: .5;
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
                                <a href="manageCourses" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                            <input type="hidden" id="cid" value="<?=$unique?>">
                            
                            <a href="add_topic?id=<?=$unique?>" class="btn btn-primary">Add Topic</a>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" class="unique_id" name="" value="<?=$unique?>">

                    <h4 class="text-center text-dark bold">Topic List</h4>
                    <div class="table-responsive p-3">
                        <table id="topic_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Course Name</th>
                                    <th>Topic</th>
                                    <th>Sub Topic</th>
                                    <th>Chapter</th>
                                    <th>Visibility</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'template/login_footer.php'; ?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Course.js"></script>