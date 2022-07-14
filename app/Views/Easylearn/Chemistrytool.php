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
			<h3>Chemistry Tools</h3>
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
					data-toggle="tab" href="#Third-stage" role="tab">
					<i class="fas fa-solid fa-chart-line"></i> &nbsp; Graphing</span>
				</a>
			</li>
			&emsp;
			<li class="nav-item">
				<a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab"
					href="#Sixth-stage" role="tab">
					<i class="fas fa-solid fa-flask"></i> &nbsp; Scientic</span>
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
			<div class="tab-pane" id="Third-stage" role="tabpanel">
				<br><br>
				<div id="ggb-element3" style="margin:auto;"></div>
			</div>
			<div class="tab-pane" id="Sixth-stage" role="tabpanel">
				<br><br>
				<div id="ggb-element6" style="margin:auto;"></div>
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

var params3 = {"appName": "graphing", "width": 1300, "height": 650, "showToolBar": true, "showAlgebraInput": true, "showMenuBar": true};
var applet3 = new GGBApplet(params3, true);

var params6 = {"appName": "scientific", "width": 1300, "height": 650, "showToolBar": true, "showAlgebraInput": true, "showMenuBar": true};
var applet6 = new GGBApplet(params6, true);

var params7 = {"appName": "notes", "width": 1300, "height": 650, "showToolBar": true, "showAlgebraInput": true, "showMenuBar": true};
var applet7 = new GGBApplet(params7, true);

window.addEventListener("load", function() { 
	applet1.inject('ggb-element1');
	applet3.inject('ggb-element3');
	applet6.inject('ggb-element6');
	applet7.inject('ggb-element7');
});
</script>

<script src="<?=base_url(); ?>/public/Easylearn/js/Student.js"></script>
<?php include 'template/login_footer.php'; ?>