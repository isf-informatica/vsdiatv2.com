<?php 
    include 'template/login_header.php'; 

    $whiteboard = json_decode(get_settings_name('Whiteboard'), true)['data'][0]['value'];
?>

<section class="content">
    <div class="panel">
		<div class="text-start p-3">
			<a href="dashboard" class="btn btn-info active"><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
		</div>
		<div class="text-center">
			<h3>Whiteboard</h3>
		</div>

        <?php if($whiteboard == 'Miro'){ ?>
            <iframe src="" id="miro_board" style="height:700px;width:100%" title="LiveBoard"></iframe>
        <?php } ?>

        <?php if($whiteboard == 'Internal'){ ?>
            <iframe style="width:100%;height:80vh" src="internalwhiteboard" frameBorder="0" scrolling="no" allowFullScreen></iframe>
        <?php } ?>
    </div>
</section>

<?php include 'template/login_footer.php'; ?>