<?php include 'template/login_header.php';

    if($session->get('user')['permissions'] == 'School')
    {
        $batch   = json_decode(get_batches($session->get('user')['permissions'], $session->get('user')['reg_id'], 0), true);
    }
    else
    {
        $batch   = json_decode(get_batches($session->get('user')['permissions'], $session->get('user')['reg_id'], $session->get('classroom_id')), true);
    }
?>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">
                                <a href="dashboard" class="btn btn-info active">
                                    <i class="fas fa-backward"></i>&nbsp;&nbsp;Back
                                </a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#add_lab_instance_modal">Add Lab Instance</button>
                            </div>
                        </div>

                        <div class="col-12">
                            <h2 class="text-center">Lab Instance</h2>
                        </div>

                        <div class="table-responsive p-3">
                            <table id="labinstance_list" class="table text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Lab Name</th>
                                        <th>Batch Name</th>
                                        <th>Student Name</th>
                                        <th>Lab IP</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade none-border add-category" id="add_lab_instance_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Lab Instance</strong></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <ul class="nav nav-tabs customtab2 d-flex justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" style='border:1px solid black;border-radius: 20px;' data-toggle="tab"
                            href="#first-stage" role="tab">
                            <i class="fa fa-solid fa-user"></i> Single Lab Instance</span>
                        </a>
                    </li>
                    &emsp;

                    <li class="nav-item">
                        <a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab"
                            href="#final-stage" role="tab">
                            <i class="fa fa-solid fa-users"></i> Multiple Lab Instance </span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="first-stage" role="tabpanel">

                        <form class="p-t10" id="add_lab_instance_form">
                            <div class="row justify-content-center m-20">

                                <?php $session->set('lab_instance_token', md5(uniqid(mt_rand(),true))); ?>
                                <input type="hidden" id='lab_instance_token' name="lab_instance_token" value="<?=$session->get('lab_instance_token'); ?>">

                                <div class="col-md-6 mb-3">
                                    <div class="form-label-group">
                                        <label for="lab_instance_name">Lab Instance Name :</label>
                                        <input type="text" class="form-control form-control-flush" id="lab_instance_name" placeholder="Lab Instance Name">
                                        
                                        <div class='d-none bg-danger check-lab_instance_name' style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Lab name cannot be blank
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-label-group">
                                        <label for="lab_instance_ip">Lab Instance IP :</label>
                                        <input type="text" class="form-control form-control-flush" id="lab_instance_ip" placeholder="Lab Instance IP">
                                        
                                        <div class='d-none bg-danger check-lab_instance_ip' style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Lab IP cannot be blank
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-label-group">
                                        <label for="lab_username">Username :</label>
                                        <input type="text" class="form-control form-control-flush" id="lab_username" placeholder="Username">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-label-group">
                                        <label for="lab_pwd">Password :</label>
                                        <input type="text" class="form-control form-control-flush" id="lab_pwd" placeholder="Password">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-label-group">
                                        <label for="batch_name">Batch Name :</label>
                                        <select id="batch_name" class="form-control">
                                            <?php if($batch['data'] != 0){ foreach ($batch['data'] as $batch_name) { ?>
                                                <option value="<?=$batch_name['id']?>"><?=$batch_name['batch_name']?></option>
                                            <?php } } ?>
                                        </select>
                                        <div class="d-none check-batch_name" style="font-size:12px;"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-label-group">
                                        <label for="lab_instance_ip">Student Name :</label>
                                        <select name="" id="student_nm" class="form-control form-select">
                                        </select>

                                        <div class='d-none bg-danger check-student_nm' style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Select Student
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-label-group">
                                        <label for="lab_instance_descp">Description</label>
                                        <textarea class="form-control" id="lab_instance_descp" rows="4" maxlength="255" placeholder="Description" style="height: 80px;resize: none;"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Close</button>
                                
                                <button type="submit" class="btn btn btn-primary add_lab_instance" id="add_lab_instance">Add Lab Instance</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="final-stage" role="tabpanel">
                        <br><br>

                        <div class="row justify-content-start">
                            <div class="col-md-1"></div>
                            <div class="col-md-11">
                                <div class="form-label-group">
                                    <label>Download Template : - </label>&nbsp; &nbsp;
                                    <a href="download_lab_template" class="btn btn-primary DownloadTemplate">
                                        <i class="fa fa-solid fa-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row justify-content-center">
                            <div class="col-md-10 mb-3">
                                <div class="form-label-group">
                                    <label for="multiple_batch_name">Batch Name :</label>
                                    <select id="multiple_batch_name" class="form-control">
                                        <?php if($batch['data'] != 0){ foreach ($batch['data'] as $batch_name) { ?>
                                            <option value="<?=$batch_name['id']?>"><?=$batch_name['batch_name']?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-label-group">
                                    <label>Choose File Below</label>
                                    <input type="file" class="dropify" id="multiple_lab_instance" data-height="200" accept=".csv" />
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Close</button>
                            
                            <button type="submit" class="btn btn btn-primary add_mlab_instance" id="add_lab_instance">Add Multiple Lab Instance</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade none-border add-category" id="edit_lab_instance_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Lab Instance</strong></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_lab_instance_form">
                    <div class="row justify-content-center m-20">

                        <?php $session->set('edit_lab_instance_token', md5(uniqid(mt_rand(),true))); ?>
                        <input type="hidden" id='edit_lab_instance_token' name="edit_lab_instance_token" value="<?=$session->get('edit_lab_instance_token'); ?>">

                        <input type="hidden" id='edit_lab_id' name="edit_lab_id" value="">

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_lab_instance_name">Lab Instance Name :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_lab_instance_name" placeholder="Lab Instance Name">
                                
                                <div class='d-none bg-danger check-edit_lab_instance_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Lab name cannot be blank
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_lab_instance_ip">Lab Instance IP :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_lab_instance_ip" placeholder="Lab Instance IP">
                                
                                <div class='d-none bg-danger check-edit_lab_instance_ip' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Lab IP cannot be blank
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_lab_username">Username :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_lab_username" placeholder="Username">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_lab_pwd">Password :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_lab_pwd" placeholder="Password">
                            </div>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_batch_name">Batch Name :</label>
                                <select id="edit_batch_name" class="form-control">
                                    <?php if($batch['data'] != 0){ foreach ($batch['data'] as $batch_name) { ?>
                                        <option value="<?=$batch_name['id']?>"><?=$batch_name['batch_name']?></option>
                                    <?php } } ?>
                                </select>

                                <div class="d-none check-edit_batch_name" style="font-size:12px;"></div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="lab_instance_ip">Student Name :</label>
                                <select name="" id="edit_student_nm" class="form-control form-select">
                                </select>

                                <div class='d-none bg-danger check-edit_student_nm' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Select Student
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="edit_lab_instance_descp">Description</label>
                                <textarea class="form-control" id="edit_lab_instance_descp" rows="4" maxlength="255" placeholder="Description" style="height: 80px;resize: none;"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-info waves-effect waves-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn btn-primary edit_lab_instance" id="edit_lab_instance">Edit</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light del_lab">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include 'template/login_footer.php'; ?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Classroom.js?<?=date("Ymd") ?>"></script>