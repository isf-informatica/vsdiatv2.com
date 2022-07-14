<?php 
    include 'template/login_header.php'; 
    $classroom = json_decode(get_classroom($session->get('user')['permissions'], $session->get('user')['reg_id']), true)['data'];
?>

<div class="modal fade none-border add-category" id="add_batch_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Batch</strong></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="add_batch">
                    <div class="row justify-content-center m-20">

                        <?php $session->set('batch_token', md5(uniqid(mt_rand(),true))); ?>
                        <input type="hidden" id='batch_token' name="batch_token" value="<?=$session->get('batch_token'); ?>">

                        <?php if($session->get('user')['permissions'] == 'School'){ ?>
                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="batch_name">Classroom Name :</label>

                                <select class="form-control form-control-flush" id='classroom_id'>
                                    <?php if($classroom != 'No data'){ foreach($classroom as $class){ ?>
                                        <option value='<?=$class['id'] ?>'> <?=$class['classroom_name']; ?> </option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($session->get('user')['permissions'] == 'Classroom'){ ?>
                            <input type="hidden" id='classroom_id' name="classroom_id" value="<?=$session->get('classroom_id'); ?>">
                        <?php } ?>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="batch_name">Batch Name :</label>
                                <input type="text" class="form-control form-control-flush" id="batch_name" placeholder="Batch Name" required>
                                
                                <div class='d-none bg-danger check-batch_name' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Batch name cannot be blank</div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="batch_img">Batch Image :</label>
                                <input type="file" class="form-control form-control-flush" accept="image/*" id="batch_img" required>
                                <div class="d-none bg-danger check-batch_img" style="font-size:12px;padding-left: 20px;">Invalid Image</div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="start_date">Start Date :</label>
                                <input type="text" class="form-control form-control-flush" id="start_date" placeholder="dd-mm-yyyy" required>
                                
                                <div class="d-none bg-danger check-start_date" style="font-size:12px;padding-left: 20px;"><i class="fas fa-times-circle"></i>Start date cannot be blank</div>
                            </div>
                        </div>

                        <div class="col-md-6  mb-3">
                            <div class="form-label-group">
                                <label for="end_date">End Date :</label>
                                <input type="text" class="form-control form-control-flush" id="end_date" placeholder="dd-mm-yyyy" required>
                                
                                <div class="d-none bg-danger check-end_date" style="font-size:12px;padding-left: 20px;"><i class="fas fa-times-circle"></i>End date cannot be blank</div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="batch_descp">Description</label>
                                <textarea class="form-control" id="batch_descp" rows="4" maxlength="255" placeholder="descp" style="height: 80px;resize: none;"></textarea>
                                
                                <div class="d-none check-batch_descp" style="font-size:12px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn btn-primary add_batch" id="add_batch">Add Batch</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade none-border add-category" id="edit_batch_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Batch</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_batch">
                    <div class="unique_id d-none" data-id=""></div>

                    <div class="row justify-content-center m-20">

                        <?php $session->set('edit_batch_token', md5(uniqid(mt_rand(),true))); ?>
                        <input type="hidden" id='edit_batch_token' name="edit_batch_token" value="<?=$session->get('edit_batch_token'); ?>">
                        
                        <?php if($session->get('user')['permissions'] == 'School'){ ?>
                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="batch_name">Classroom Name :</label>

                                <select class="form-control form-control-flush" id='edit_classroom_id' disabled>
                                    <?php if($classroom != 'No data'){ foreach($classroom as $class){ ?>
                                        <option value='<?=$class['id'] ?>'> <?=$class['classroom_name']; ?> </option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                          
                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="edit_batch_name">Batch Name :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_batch_name" placeholder="Batch Name" disabled required>
                                
                                <div class='d-none bg-danger check-edit_batch_name' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Batch name cannot be blank</div>
                            </div>
                        </div>

                        <div class="col-md-8 mb-3 align-self-center">
                            <div class="form-label-group">
                                <label for="edit_batch_img">Batch Image :</label>
                                <input type="file" class="form-control form-control-flush" accept="image/*" id="edit_batch_img" disabled>
                                
                                <div class="d-none bg-danger check-edit_batch_img" style="font-size:12px;"><i class="fas fa-times-circle"></i> Choose Valid Image</div>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex justify-content-center mt-15">
                            <img id='view_batch_image' src="" class="img border border-primary" alt="" style="width : 130px; height: 130px; border-radius:50%;">
                        </div>

                        <div class="col-md-6  mb-3">
                            <div class="form-label-group">
                                <label for="edit_start_date">Start Date :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_start_date" placeholder="dd-mm-yyyy" disabled required>
                                
                                <div class="d-none bg-danger check-edit_start_date" style="font-size:12px;padding-left: 20px;"><i class="fas fa-times-circle"></i>Start date cannot be blank</div>
                            </div>
                        </div>

                        <div class="col-md-6  mb-3">
                            <div class="form-label-group">
                                <label for="edit_end_date">End Date :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_end_date" placeholder="dd-mm-yyyy" disabled required>
                                
                                <div class="d-none bg-danger check-edit_end_date" style="font-size:12px;padding-left: 20px;"><i class="fas fa-times-circle"></i>End date cannot be blank</div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="batch_description">Description</label>
                                <textarea class="form-control" id="batch_description" rows="4" maxlength="255" placeholder="descp" style="height: 80px;resize: none;" disabled></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <a class="btn btn-rounded btn-info edit-batch"> <i class="ti-pencil"> Edit </i> </a>

                        <div class='d-none'>
                            <a class="btn btn-rounded btn-info cancel-batch"> <i class="ti-close"> Cancel </i></a>
                            &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-rounded btn-danger delete-batch"> <i class="ti-trash"> Delete </i></a>
                            &nbsp;&nbsp;&nbsp;
                            <button type="submit" class="btn btn-rounded btn-primary save-batch"> <i class="ti-save-alt"> Save </i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">   
                                <a href="dashboard" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#add_batch_modal">Add Batch</button>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-center text-dark bold">Batch List</h4>
                    <div class="table-responsive p-3">
                        <table id="batch_list" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Classroom Name</th>
                                    <th>Batch Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Visibility</th>
                                    <th>Assign Students</th>
                                    <th>Assign Course</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?=base_url(); ?>/public/Easylearn/js/Batch.js?<?=date("Ymd") ?>"></script>
<?php include 'template/login_footer.php'; ?>