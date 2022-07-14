<?php include 'template/login_header.php'; ?>

<script src="https://www.geogebra.org/apps/deployggb.js"></script>

<script src="<?=base_url(); ?>/public/Easylearn/js/Student.js"></script>

<section class="content">

	<div class="panel">
		<div class="text-start p-3">
			<a href="manageStudents" class="btn btn-info active"><i
					class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
		</div>
		<div class="text-center">
			<h3>Physics Tools</h3>
		</div>
		<ul class="nav nav-tabs customtab2 d-flex justify-content-center" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" style='border:1px solid black;border-radius: 20px;'
					data-toggle="tab" href="#First-stage" role="tab">
					<i class="fas fa-solid fa-calculator"></i> &nbsp; Basic</span>
				</a>
			</li>
			&emsp;
			<li class="nav-item">
				<a class="nav-link" style='border:1px solid black;border-radius: 20px;'
					data-toggle="tab" href="#Fifth-stage" role="tab">
					<i class="fas fa-solid fa-equals"></i> &nbsp; Evaluator</span>
				</a>
			</li>
			&emsp;			
			<li class="nav-item">
				<a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab"
					href="#Seventh-stage" role="tab">
					<i class="fas fa-solid fa-sticky-note"></i> &nbsp; Notes</span>
				</a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="First-stage" role="tabpanel">
				<br><br>
				<div id="ggb-element1" style="margin:auto;"></div>
			</div>
			<div class="tab-pane" id="Fifth-stage" role="tabpanel">
				<br><br>
				<div id="ggb-element5" style="margin:auto;"></div>
			</div>
			<div class="tab-pane" id="Seventh-stage" role="tabpanel">
				<br><br>
				<div id="ggb-element7" style="margin:auto;"></div>
			</div>
		</div>
	</div>
	
</section>

<script>
var params1 = {"appName": "classic", "width": 1300, "height": 650, "showToolBar": true, "showAlgebraInput": true, "showMenuBar": true};
var applet1 = new GGBApplet(params1, true);

var params5 = {"appName": "evaluator", "width": 1300, "height": 650, "showToolBar": true, "showAlgebraInput": true, "showMenuBar": true};
var applet5 = new GGBApplet(params5, true);

var params7 = {"appName": "notes", "width": 1300, "height": 650, "showToolBar": true, "showAlgebraInput": true, "showMenuBar": true};
var applet7 = new GGBApplet(params7, true);

window.addEventListener("load", function() { 
	applet1.inject('ggb-element1');	
	applet5.inject('ggb-element5');
	applet7.inject('ggb-element7');
});
</script>

<script src="<?=base_url(); ?>/public/Easylearn/js/Student.js"></script>
<?php include 'template/login_footer.php'; ?>