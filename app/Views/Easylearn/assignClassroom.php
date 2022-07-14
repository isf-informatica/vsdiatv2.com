<?php 
	include 'template/login_header.php';
	$classroom = json_decode(get_classroom_status($_GET['id']), true)['data'];

	if($classroom == 'FALSE')
	{
		die;
	}
?>

<section class="content">
	<div class="row">			  
		<div class="col-lg-10 col-12 offset-lg-1">
			<div class="box">
				<div class="box-header with-border text-center">
				  	<h4 class="box-title">Assign Students To Classroom</h4>
				</div>
				<!-- /.box-header -->

				<div class='row'>
                    <div class='col-6'>
                        <div class="text-start p-3">   
                            <a href="manageClassroom" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                        </div>
                    </div>

                    <div class='col-6'>
                        <div style='text-align: right' class='p-3'>
	                        <button class="btn btn-primary text-end" data-toggle="modal" data-target="#view_assignmemberlist">View Assign Students</button>
						</div>
                    </div>
                </div>

				<ul class="nav nav-tabs customtab2 d-flex justify-content-center" role="tablist">
					<li class="nav-item mt-20">
						<a class="nav-link active" style='border:1px solid black;border-radius: 20px;'
							data-toggle="tab" href="#first-stage" role="tab">
							<i class="fa fa-solid fa-check"></i> Select Upload</span>
						</a>
					</li>
					&emsp;
					<li class="nav-item mt-20">
						<a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab"
							href="#final-stage" role="tab">
							<i class="fa fa-solid fa-file-csv"></i> CSV Upload</span>
						</a>
					</li>
				</ul>

				<div class="tab-content mt-30">
                    <div class="tab-pane active" id="first-stage" role="tabpanel">
						<div class="row d-flex justify-content-center">
							<div class='col-lg-1'> </div>

							<div class='col-md-10 m-15 align-self-center'>
								<div class="table-responsive p-5">
									<table id="assignclassroom_list" class="table" style="width:100%">
										<thead class="text-center">
											<tr>
												<th>Sr. No.</th>
												<th>Student Name</th>
												<th>Student Email</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>

						<div class="row d-flex justify-content-center mb-10">
							<div class="col-lg-10 col-md-12">
								<div class='d-flex justify-content-center'>
									<button class="btn btn-rounded btn-success save-assign-classroom"> <i class="ti-save-alt"> Save </i> </button>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="final-stage" role="tabpanel">

						<div class="row justify-content-start">
							<div class="col-md-1"></div>
							<div class="col-md-11">
								<div class="form-label-group">
									<label>Download Template : - </label>&nbsp; &nbsp;
									<a href="Download_Assign_Student_Template" class="btn btn-primary DownloadTemplate"><i
											class="fa fa-solid fa-download"></i> Download</a>
								</div>
							</div>
						</div>
						<br>

						<div class="row justify-content-center">
							<div class="col-md-10">
								<div class="form-label-group">
									<label>Choose File Below</label>
									<input type="file" class="dropify" id="csv_assign_student_classroom" data-height="200" accept=".csv" />
								</div>
							</div>
						</div>
						<br>

						<div class="row justify-content-center pb-15">
							<div class="form-label">
                                <button class="btn btn-rounded btn-primary" id="csv_assign_student_classroom_submit"> Assign Students </button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>  
</section>

<div class="modal fade none-border add-category" id="view_assignmemberlist" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Assigned Classroom Students</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
            	<div class="table-responsive p-3">
                    <table id="assignclassroom_memberlist" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Student Name</th>
                                <th>Student Email</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody class='selectedlistTbody'>
                           
                        </tbody>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="<?=base_url(); ?>/public/Easylearn/js/Classroom.js?<?=date("Ymd") ?>"></script>
<?php include 'template/login_footer.php'; ?>