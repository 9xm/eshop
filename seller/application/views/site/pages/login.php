<?php 

define('APP_NAME', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->site_name);
define('APP_FAVICON', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->web_favicon);
define('APP_LOGO', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->web_logo_1);
define('APP_LOGO_2', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->web_logo_1);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min-5.css'); ?>" rel="stylesheet" />

    <title><?php echo APP_NAME; ?></title>
    <style>

        #login-box{  width: 420px; margin:0px auto; margin-top: 120px; }
        #login-box img{height: 50px;}

        .frm-lbl{ font-weight: 700;}
        #login-form{ border: 1px #ddd solid;padding: 20px; background-color: rgba(255,82,82);}
        #login-form,#login-form a{color:#ebf8fa;}
        .form-group{  margin-bottom: 14px;}
        .agree-text{ font-size:12px;}
   </style>
    </head>
    <body>

    <?php 
if($messages=$this->session->flashdata('response_msg')) {
    print_r($messages);
}
    ?>

            <div class="container">
                <div class="row">
                        <div id="login-box" class="row">
                            <div class="col-md-12 text-center"><a class="" tabindex="-1" href="/">
                                <img src="http://seller.becarto.in/assets/images/14102021112941_11133.png">
                            </a>
                            </div>
                            <div class="col-md-12">
                                <form id="login-form" class="form" action="" method="post">
                               
                                <h3>Sign-In</h3>
                                <div class="form-group">
                                    <label for="email" class="frm-lbl">Enter Your Email:</label><br>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="frm-lbl">Password:</label><br>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group agree-text">
                                    By continuing, you agree to Becarto's <a href="#">Conditions of Use</a> and
                                    <a href="#">Privacy Notice</a>.
                                </div>
                                <div class="form-group">
                                    <label for="remember-me" class=""><input id="remember-me" name="remember-me" type="checkbox"><span> Remember me</span></label><br>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="submit">
                                </div>
                                <div id="register-link" class="text-right">
                                    <a href="#" class="">Forgot Password</a> | <a href="#" class="">Register here</a>
                                </div>
                            </form>
</div>
                        </div>
                </div>
            </div>
      
    </body>
    </html><?php 