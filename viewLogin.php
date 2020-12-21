
 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 ?>

<html>

	<head>

		<link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" id="bootstrap-css">
		<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>

		<script src="<?php echo base_url('assets/js/vendor/jquery-2.2.4.min.js')?>"></script>

		<!------ Include the above in your HEAD tag ---------->

		<script>
			$(function() {
				$('.required-icon').tooltip({
					placement: 'left',
					title: 'Required field'
					});
			});

		</script>
		<style>

			body{

			  background-image: url("<?php echo base_url('assets/images/ironbackground.jpg')?>");

			  -webkit-background-size: cover;

			  -moz-background-size: cover;

			  -o-background-size: cover;

			  background-size: cover;

			}

			input, textarea, button { margin-top:10px }



			/* Required field START */



			.required-field-block {

				position: relative;   

			}



			.required-field-block .required-icon {

				display: inline-block;

				vertical-align: middle;

				margin: -0.25em 0.25em 0em;

				background-color: #E8E8E8;

				border-color: #E8E8E8;

				padding: 0.5em 0.8em;

				color: rgba(0, 0, 0, 0.65);

				text-transform: uppercase;

				font-weight: normal;

				border-radius: 0.325em;

				-webkit-box-sizing: border-box;

				-moz-box-sizing: border-box;

				-ms-box-sizing: border-box;

				box-sizing: border-box;

				-webkit-transition: background 0.1s linear;

				-moz-transition: background 0.1s linear;

				transition: background 0.1s linear;

				font-size: 75%;

			}

				

			.required-field-block .required-icon {

				background-color: transparent;

				position: absolute;

				top: 0em;

				right: 0em;

				z-index: 10;

				margin: 0em;

				width: 30px;

				height: 30px;

				padding: 0em;

				text-align: center;

				-webkit-transition: color 0.2s ease;

				-moz-transition: color 0.2s ease;

				transition: color 0.2s ease;

			}



			.required-field-block .required-icon:after {

				position: absolute;

				content: "";

				right: 1px;

				top: 1px;

				z-index: -1;

				width: 0em;

				height: 0em;

				border-top: 0em solid transparent;

				border-right: 30px solid transparent;

				border-bottom: 30px solid transparent;

				border-left: 0em solid transparent;

				border-right-color: inherit;

				-webkit-transition: border-color 0.2s ease;

				-moz-transition: border-color 0.2s ease;

				transition: border-color 0.2s ease;

			}



			.required-field-block .required-icon .text {

				color: #B80000;

				font-size: 26px;

				margin: -3px 0 0 12px;

			}

			.button--tamaya {

				border: 2px solid #40a304 !important;

				border-radius: 5px;

				color: #7986cb;

				min-width: 400px;

				overflow: hidden;

				text-transform: uppercase;

				letter-spacing: 1px;

			}

			.button--border-thick {

				border: 3px solid;

			}

			.button {

				background: rgba(0, 0, 0, 0) none repeat scroll 0 0;

				border: medium none;

				color: inherit;

				display: block;

				float: left;

				max-width: 400px;

				min-width: 199px;

				padding: 1em 7em;

				position: relative;

				vertical-align: middle;

				z-index: 1;

			}

			.button--tamaya::before {

				padding-top: 1em;

				top: 0;

			}

			.button--tamaya::before,

			.button--tamaya::after {

				background: #40a304;

				color: #fff;

				content: attr(data-text);

				height: 50%;

				left: 0;

				overflow: hidden;

				position: absolute;

				transition: transform 0.3s cubic-bezier(0.2, 1, 0.3, 1) 0s;

				width: 100%;

			}

			.button--tamaya::after {

				bottom: 0;

				line-height: 0;

			}

			.button--tamaya:hover::before {

				transform: translate3d(0px, -100%, 0px);

			}

			.button--tamaya:hover::after {

				transform: translate3d(0px, 100%, 0px);

				color: #40a304;

			}

			.button--tamaya:hover {

				color: #40a304;

				font-weight: 600;

			}

			h1 {

				padding-top: 50px;

				font-family: raavi;

				font-size: 30px;

				font-weight: 600;

				line-height: 18px;

				color: #fff;

			}

			/* Required field END */



		</style>

	</head>
	<body>
		<div class="container">
			<div style="width:400px; margin: 0 auto;">
			<?php echo form_open('dashboard/login');?>
				<div style="padding-top: 50" class="text-center">
					<img src="<?php echo base_url('assets/images/ekapaksi.png')?>" alt="Ekapaksi" height="200" width="150"> 
				</div>
				<div class="col-lg-12" style="padding-top:20; text-align: center">
					<div class="col-lg-3 d-inline"> <img src="<?php echo base_url('assets/images/1.png')?>" alt="Ekapaksi" height="50" width="50"> </div>
					<div class="col-lg-3 d-inline"> <img src="<?php echo base_url('assets/images/2.png')?>" alt="Ekapaksi" height="50" width="50"> </div>
					<div class="col-lg-3 d-inline"> <img src="<?php echo base_url('assets/images/3.png')?>" alt="Ekapaksi" height="50" width="50"> </div>
					<div class="col-lg-3 d-inline"> <img src="<?php echo base_url('assets/images/4.png')?>" alt="Ekapaksi" height="50" width="50"> </div>
				</div>
				<h1 style="text-align:center; padding-bottom:10px">Mapping Video</h1>
				<div class="required-field-block">
					<input type="text" name="txtUser" placeholder="User" class="form-control" value="<?php echo set_value('txtUser'); ?>">
					<div class="required-icon">
						<div class="text">*</div>
					</div>
					<p> <?php echo form_error('txtUser'); ?> </p>
				</div>

				<div class="required-field-block">
					<input type="password" name="txtPassword" placeholder="Password" class="form-control" value="<?php echo set_value('txtPassword'); ?>"">
					<div class="required-icon">
						<div class="text">*</div>
					</div>
					<p> <?php echo form_error('txtPassword'); ?> </p>
				</div>
				<button name="btnLogin" style="width: 400px;" data-animation="animated bounceInUp" class="button button--tamaya button--border-thick" data-text="Login"><span>Login</span></button>
			<?php echo form_close();?>
			</div>
		</div>
	</body>
</html>



