<?php include 'template/login_header.php'; ?>

<script src="https://www.geogebra.org/apps/deployggb.js"></script>

<script src="<?=base_url(); ?>/public/Easylearn/js/Student.js"></script>

<section class="content">
	<div class="panel">
		<div class="text-start p-3">
			<a href="dashboard" class="btn btn-info active"><i
					class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
		</div>
		<div class="text-center">
			<h3>Notebook</h3>
		</div>
		
		<iframe style="background:url('<?=base_url(); ?>/public/Easylearn/images/lines.png');width:100%;height:80vh" src="internalwhiteboard" frameBorder="0" scrolling="no" allowFullScreen></iframe>		
	</div>
</section>



<script src="<?=base_url(); ?>/public/Easylearn/js/Student.js"></script>
<?php include 'template/login_footer.php'; ?>