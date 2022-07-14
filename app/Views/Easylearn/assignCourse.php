<?php 
	include 'template/login_header.php';

	$batch = json_decode(get_batch_status($_GET['id']), true)['data'];

	if($batch == 'FALSE')
	{
		die;
	}
?>

<section class="content">
	<div class="row">			  
		<div class="col-lg-10 col-12 offset-lg-1">
			<div class="box">
				<div class="box-header with-border text-center">
				    <h4 class="box-title">Assign Courses To <?=$_GET['batch'];?> Batch</h4>
				</div>

                <div class='row'>
                    <div class='col-6'>
                        <div class="text-start p-3">   
                            <a href="manageBatch" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                        </div>
                    </div>

                    <div class='col-6'>
                        <div style='text-align: right' class='p-3'>
                            <button class="btn btn-primary text-end" data-toggle="modal" data-target="#view_assigncourselist">View Assign Courses</button>
                        </div>
                    </div>
                </div>

				<div class="row d-flex justify-content-center">
                    <div class='col-md-10 m-15 align-self-center'>
                        <div class="table-responsive p-5">
                            <table id="assigncourse_list" class="table" style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Course Name</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
				</div>

				<div class="row mb-10">
                    <div class="col-md-12">
                        <div class='d-flex justify-content-center'>
                            <button class="btn btn-rounded btn-success save-assign-course"> <i class="ti-save-alt"> Save </i> </button>
                        </div>
                    </div>
                </div>
			</div>
		</div>
    </div>
</section>

<div class="modal fade none-border add-category" id="view_assigncourselist" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Assign Batch Courses</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
            	<div class="table-responsive p-3">
                    <table id="assignedcourse_list" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Course Name</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url(); ?>/public/Easylearn/js/Batch.js?<?=date("Ymd") ?>"></script>
<?php include 'template/login_footer.php'; ?>