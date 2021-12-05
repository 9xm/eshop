<?php 
    define('APP_NAME', $this->db->get_where('tbl_settings', array('id' => '1'))->row()->app_name);
    define('APP_LOGO', $this->db->get_where('tbl_settings', array('id' => '1'))->row()->app_logo);
    define('APP_FAVICON', $this->db->get_where('tbl_settings', array('id' => '1'))->row()->web_favicon);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type"content="text/html;charset=UTF-8"/>
<meta name="viewport"content="width=device-width, initial-scale=1.0">
<title><?=$page_title?> | <?php echo APP_NAME;?></title>
<link rel="shortcut icon" type="image/png" href="<?=base_url('assets/images/').APP_FAVICON?>"/>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/vendor.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/flat-admin.css?ver='.time())?>">
<style>
@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
	.app-login .app-body {width:320px}
	.app-login .app-body input.form-control, .app-login .app-body textarea.form-control{padding: 10px;}
	.app-login .app-login-form #register-link a{padding: 0px; font-size:12px; font-weight:bold;}
}
</style>
</head>
<body class="body-login-form">
<div class="app app-default">
  <div class="app-container app-login">
    <div class="flex-center-ok">
      <div class="app-body">
        <div class="app-block">
          <div class="app-form login-form">
            <div class="form-header">
              <div class="app-brand"><?php echo APP_NAME;?> Seller</div>
            </div>
			<?php	/*<!--div class="login_title_lineitem">
				<div class="line_1"></div>
				  <div class="flipInX-1 blind icon">
					 <span class="icon">
						 <i class="fa fa-gg"></i>&nbsp;
						 <i class="fa fa-gg"></i>&nbsp;
						 <i class="fa fa-gg"></i>
				   </span>
				   </div>
				<div class="line_2"></div>
			</div--> */
			
					    if($this->session->flashdata('response_msg')) {
					      $message = $this->session->flashdata('response_msg');
					      if(strcmp($message['class'], 'error')==0){

					      	?>
					      	<div class="alert alert-danger <?=$message['class']?> alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?=$message['message']?></div>
					      	<?php
					      }
					      /*else{
					      	?>
					      	<div class="alert <?=$message['class']?> alert-dismissible" role="alert"><i class="fa fa-check" aria-hidden="true"></i> <?=$message['message']?></div>
					      	<?php
					      }*/
					    }
					  ?>
			<div class="clearfix"></div>
             <form class="app-login-form" action="<?php echo site_url('saller-register'); ?>" method="post">
				<?php /*<div class="input-group" style="border:0px;">
					<!-- Error Goes Here -->
					
					  <?php //print_r(validation_errors()) ?>
				</div> */ ?>
				<h3>Create Saller Account</h3>
				<div class="form-group">
					<label for="user_name" class="frm-lbl">Your Name:</label><br>
					<input type="text" name="user_name" id="user_name" value="<?php echo set_value('user_namename'); ?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="user_phone" class="frm-lbl">Mobile Number:</label><br>
					<input type="text" name="user_phone" id="user_phone" value="<?php echo set_value('user_phone'); ?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="email" class="frm-lbl">Enter Your Email:</label><br>
					<input type="email" name="email" id="email" value="<?php echo set_value('username'); ?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="password" class="frm-lbl">Password:</label> <?php /*<a class="frm-forgot" href="<?=base_url('admin/forgot-password')?>" class="">Forgot Password</a> */ ?><br>
					<input type="password" name="password" id="password" class="form-control" value="<?php echo set_value('password'); ?>">
				</div>
				<div class="form-group agree-text">
					By continuing, you agree to Becarto's <a href="#">Conditions of Use</a> and
					<a href="#">Privacy Notice</a>.
				</div>
				<div class="form-group  frm-submit-btn">
					<input type="submit" class="btn btn-primary" value="Register">
				</div>
				<?php /*<div class="form-group  frm-remember">
					<label for="remember-me" class=""><input id="remember-me" name="remember-me" type="checkbox"><span> Keep me signed in</span></label><br>
				</div> */ ?>
				<div class="form-group  frm-newdivder">
					<span class="line">
    						<h3><span>Already have an seller account</span></h3>
					</span>
				</div>

				<div id="register-link" class="text-right">
				 <a href="<?php echo site_url('admin'); ?>" class="btn btn-default">Sign-In</a>
				</div>

				<?php /*<div class="input-group"> <span class="input-group-addon" id="basic-addon1"> <i class="fa fa-user" aria-hidden="true"></i></span>
					<input type="text" name="username" id="username" class="form-control" placeholder="Enter Your Email" aria-describedby="basic-addon1" value="<?php echo set_value('username'); ?>">
				</div>
				<div class="input-group"> <span class="input-group-addon" id="basic-addon2"> <i class="fa fa-key" aria-hidden="true"></i></span>
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" value="<?php echo set_value('password'); ?>">
				</div>
				<div class="form-forgot-password" style="margin-top: 6px;margin-bottom: 10px;font-size: 14px;font-weight: 500"><a href="<?=base_url('admin/forgot-password')?>" style="color: #939393"><?=$this->lang->line('forgot_password_lbl')?></a></div>
				<div class="text-center">
					<input type="submit" class="btn btn-success btn-submit" value="<?=$this->lang->line('login_btn')?>">
				</div> */ ?>
            </form>
			

          </div>
        </div>

		
      </div>
	  <div class="a-divider-inner"></div>
	  <div class="frm-footer-copy">© 2020-2021, Becarto.in</div>
    </div>
	
  </div>
</div>
</body>
</html>