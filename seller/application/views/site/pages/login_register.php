        <?php include('include/header.php'); ?>
        <?php 
        if($this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->g_captcha=='true'){
        ?>
          <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>
        <?php } ?>
        <style type="text/css">
            .social_login{
                text-align: center;
                display: inline-block;
                margin-bottom: 40px;
                width: 100%;
            }
            .social_login img{
                width: 220px;
                height: auto;
                margin:10px 0;
            }
            .social_login .btn_social{
                filter: grayscale(0%);   
                transition: all linear 0.3s;
            }
            .social_login .btn_social:hover{
                filter: grayscale(50%);
                transition: all linear 0.3s;
            }
        </style>
        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?php echo base_url('/'); ?>">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $page_title; ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container">
                <div class="mb-4">
                    <h1 class="text-center"><?php echo $page_title; ?></h1>
                </div>
                <div class="my-4 my-xl-8">
                    <div class="row">
                        <div class="col-md-5 ml-xl-auto mr-md-auto mr-xl-0 mb-8 mb-md-0">
                            <!-- Title -->
                            <div class="border-bottom border-color-1 mb-6">
                                <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Login</h3>
                            </div>
                            <p class="text-gray-90 mb-4">Welcome back! Sign in to your account.</p>
                            <!-- End Title -->
                            <form class="js-validate" novalidate="novalidate" action="<?php echo site_url('site/login'); ?>" id="login_form" method="post">
                                <input type="hidden" name="preview_url" value="<?php if(isset($_SERVER['HTTP_REFERER']) && $this->session->userdata('single_pre_url')==''){ echo str_replace(base_url().'site/register','',$_SERVER['HTTP_REFERER']);}else { echo $this->session->userdata('single_pre_url'); $this->session->unset_userdata('single_pre_url'); }?>">
                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('email_place_lbl')?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    
                                    <input type="email" class="form-control" id="login_form_email" name="email" value="" autocomplete="off" placeholder="<?=$this->lang->line('email_place_lbl')?>">
                                    <p class="err"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('email_require_lbl')?></span></p>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="form-label" for="signinSrPasswordExample2"><?=$this->lang->line('password_lbl')?> <span class="text-danger">*</span></label>
                                
                                    <input type="password" name="password" class="form-control" id="login_form_password" value="" autocomplete="off" placeholder="<?=$this->lang->line('password_lbl')?>">
                                    <p class="err"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('password_require_lbl')?></span></p>
                                </div>
                                <!-- End Form Group -->
                                <?php 
                                if($this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->g_captcha=='true'){
                                ?>
                                <div class="js-form-message form-group">
                                    <div class="g-recaptcha" id="google_recaptcha" data-sitekey="<?=$this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->g_captcha_site_key?>"></div>
                                </div>
                                  <?php } ?>
                                <!-- Button -->
                                <div class="mb-1">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary-dark-w px-5"><?=$this->lang->line('login_btn')?></button>
                                    </div>
                                    <div class="mb-2">
                                        <a class="text-blue"  href=""   data-toggle="modal" data-target="#lostPassword" data-backdrop="static" data-keyboard="false"><?=$this->lang->line('lost_password_lbl')?></a>
                                    </div>
                                </div>
                                <!-- End Button -->
                            </form>
                            <?php 

                            if($google_login_btn=='true' OR $facebook_login_btn=='true'){
                              ?>

                              <div class="social_login">
                                <h2 style="font-weight: 600">OR</h2>
                                <?php 
                                if($google_login_btn=='true'){
                                  ?>
                                  <div class="col-md-6 col-sm-6 col-xs-12">     
                                    <a href="<?=site_url('redirectGoogle')?>" class="btn_social"><img src="<?=base_url('assets/img/google_login_btn.png')?>"/></a>
                                  </div>
                                <?php }
                                if($facebook_login_btn=='true'){
                                  ?>
                                  <div class="col-md-6 col-sm-6 col-xs-12">     
                                    <a href="<?=site_url('redirectFacebook')?>" class="btn_social"><img src="<?=base_url('assets/img/fb_login_btn.png')?>"/></a>
                                  </div>
                                <?php } ?>
                              </div>

                            <?php } ?>
                        </div>
                        <div class="col-md-1 d-none d-md-block">
                            <div class="flex-content-center h-100">
                                <div class="width-1 bg-1 h-100"></div>
                                <div class="width-50 height-50 border border-color-1 rounded-circle flex-content-center font-italic bg-white position-absolute">or</div>
                            </div>
                        </div>
                        <div class="col-md-5 ml-md-auto ml-xl-0 mr-xl-auto">
                            <!-- Title -->
                            <div class="border-bottom border-color-1 mb-6">
                                <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26"><?=$this->lang->line('register_lbl')?></h3>
                            </div>
                            <!-- End Title -->
                            <!-- Form Group -->
                            <form class="js-validate" novalidate="novalidate" action="<?php echo site_url('site/register'); ?>" id="registerForm" method="post">
                                <input type="hidden" name="preview_url" value="<?php if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER']; }?>">
                                <div class="js-form-message form-group mb-5">
                                    <label class="form-label" for="RegisterSrEmailExample3"><?=$this->lang->line('name_place_lbl')?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="user_name" value="" autocomplete="off" placeholder="<?=$this->lang->line('name_place_lbl')?>">

                                    <p class="err"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('name_require_lbl')?></span></p>
                                </div>
                                <div class="js-form-message form-group mb-5">
                                    <label class="form-label" for="RegisterSrEmailExample3"><?=$this->lang->line('email_place_lbl')?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="user_email" value="" autocomplete="off" placeholder="<?=$this->lang->line('email_place_lbl')?>">

                                    <p class="err"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('email_require_lbl')?></span></p>
                                </div>
                                <div class="js-form-message form-group mb-5">
                                    <label class="form-label" for="RegisterSrEmailExample3"><?=$this->lang->line('password_lbl')?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control"  name="user_password" value="" autocomplete="off" placeholder="<?=$this->lang->line('password_lbl')?>">

                                    <p class="err"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('password_require_lbl')?></span></p>
                                </div>
                                <div class="js-form-message form-group mb-5">
                                    <label class="form-label" for="RegisterSrEmailExample3"><?=$this->lang->line('cpassword_lbl')?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control"  name="c_password" value="" autocomplete="off" placeholder="<?=$this->lang->line('cpassword_lbl')?>">

                                    <p class="err"><i class="fa fa-exclamation-circle"></i> <?=$this->lang->line('cpassword_require_lbl')?></p>
                                </div>
                                <div class="js-form-message form-group mb-5">
                                    <label class="form-label" for="RegisterSrEmailExample3"><?=$this->lang->line('phone_no_lbl')?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"  name="user_phone" value="" autocomplete="off" placeholder="<?=$this->lang->line('phone_no_lbl')?>" onkeypress="return isNumberKey(event)" maxlength="15">

                                    <p class="err"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('phone_no_require_lbl')?></span></p>
                                </div>
                                <div class="mb-6">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary-dark-w px-5" name="btn_register"><?=$this->lang->line('register_btn')?></button>
                                    </div>
                                </div>
                                <!-- End Button -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div id="lostPassword" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm"> 
                <div class="modal-content">
                <div class="modal-header">
                    <h3><?=$this->lang->line('forgot_password_lbl')?></h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="modal-details">
                    <form action="<?=site_url('site/reset_password')?>" method="post" id="lost_password_form">
                        <!-- <p class="err_password" style="color: red;display: none"></p> -->
                        <!-- <div class="wizard-form-field">
                            <div class="wizard-form-input has-float-label">
                                <input type="email" name="registered_email" value="" placeholder="<?=$this->lang->line('registered_email_lbl')?>">
                                <label><?=$this->lang->line('registered_email_lbl')?></label>
                                <p class="err err_password"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('email_require_lbl')?></span></p>
                            </div>
                        </div> -->
                        <!-- Form Group -->
                        
                        <div class="js-form-message form-group wizard-form-inputttt">
                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('registered_email_lbl')?>
                                <span class="text-danger">*</span>
                            </label>
                            
                            <input type="email" class="form-control" name="registered_email" value="" placeholder="<?=$this->lang->line('registered_email_lbl')?>">
                            <p class="err err_password" style="display:none;"><span><?=$this->lang->line('email_require_lbl')?></span></p>
                        </div>
                        <!-- End Form Group -->

                        <!-- Button -->
                        

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary-dark-w px-5 form-button"><?=$this->lang->line('reset_password_send_btn')?></button>
                        </div>
                        

                        <!-- End Button -->
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ========== END MAIN CONTENT ========== -->

        <?php include('include/footer.php'); ?>
        <script type="text/javascript">

  <?php 
    if($this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->g_captcha=='true'){
  ?>
      
     var onloadCallback = function() {
        grecaptcha.render('google_recaptcha', {
          'sitekey' : "<?=$this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->g_captcha_site_key?>"
        });
      };
  
  <?php } ?>

  $('#lostPassword').on('hidden.bs.modal', function () {
    $("input[name='registered_email']").val('');
    $("input").next("p").fadeOut();
    $(".err_password").hide();
  })

  $("#login_form").submit(function (e) {

    e.preventDefault();

    var $inputs = $("#login_form :input[name='email'], #login_form :input[name='password']");
    var counts=0;

    /*$inputs.each(function(){

     if($(this).val() != '') {
      $(this).parents(".wizard-form-input").find("p").fadeOut();  
    } else {
      counts++;
      $(this).parents(".wizard-form-input").find("p").fadeIn();
    }
  });*/

    if(counts==0){
        
        /*alert('hello');*/
        $(".process_loader").show();

      $.ajax({
        url:$(this).attr("action"),
        data: $(this).serialize(),
        type:'post',
        success:function(data){
            console.log(data);
          <?php 
            if($this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->g_captcha=='true'){
            ?>
            var rcres = grecaptcha.getResponse();
            if(rcres.length){
              grecaptcha.reset();
            }
          <?php } ?>

          $(".process_loader").hide();

          var obj = $.parseJSON(atob(data));
          if(obj.status=='1'){
            window.location.href=obj.preview_url;
          }
          else{
            swal({title:"<?=$this->lang->line('error_lbl')?>",text:obj.message,type:'error'});
          }
          
        },
        error : function(data) {
          swal({title:"<?=$this->lang->line('error_lbl')?>",text:data,type:'error'});
        }
      });
    }
  });

  function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
      return false;
    }else{
      return true;
    }
  }

  function resendOTP() {
    var count = document.getElementById('countdown');
    timeoutfn = function(){

      if(parseInt(count.innerHTML) <= 0){
        clearInterval(this);

        $('.btn_resend').removeAttr("style");
        $('.btn_resend').attr("disabled", false);
        $("#countdown").parent("span").hide();

      }
      else{
        count.innerHTML = parseInt(count.innerHTML) - 1;
        setTimeout(timeoutfn, 1000);
      }
    };

    setTimeout(timeoutfn, 1000);
  }

  $(".btn_resend").on("click",function(e){
    e.preventDefault();

    $(this).attr("disabled", true);
    $(this).css("background-color", "#bbb");

    var name=$("input[name='user_name']").val();
    var email=$("input[name='user_email']").val();

    href = '<?=base_url()?>site/sent_code';

    $(".process_loader").show();

    $.ajax({
      url:href,
      data: {"email": email, "name": name, "is_resend": true},
      type:'post',
      success:function(res){

        var obj = $.parseJSON(res);

        $(".process_loader").hide();
        swal({title: "<?=$this->lang->line('resent_lbl')?>",text: obj.msg,type: "success"});
        $("#countdown").html("60");
        $("#countdown").parent("span").show();
        resendOTP();
      }

    });

  });


  $(".step_1_btn").on("click",function(e){

    var btn=$(this);

    var $inputs = $(".step_1").find("input");

    var counts=0;

    $inputs.each(function(){
      if($(this).val() != '') {
        $(this).parents(".wizard-form-input").find("p").fadeOut();
      } else {
        counts++;
        $(this).parents(".wizard-form-input").find("p").fadeIn();
      }
    });

    if(counts > 0){
      return false;
    }

    var name=$(".step_1 :input[name='user_name']").val();
    var email=$(".step_1 :input[name='user_email']").val();
    var password=$(".step_1 :input[name='user_password']").val();
    var cpassword=$(".step_1 :input[name='c_password']").val();

    if(IsEmail(email)==false && email!=''){
      $(".step_1 :input[name='user_email']").parents(".wizard-form-input").find("p").find("span").text("<?=$this->lang->line('invalid_email_format')?>");
      $(".step_1 :input[name='user_email']").parents(".wizard-form-input").find("p").fadeIn();
      counts++;
    }
    else{
      $(".step_1 :input[name='user_email']").parents(".wizard-form-input").find("p").fadeOut();
    }
    
    if(password!=cpassword){
      $(".step_1 :input[name='c_password']").parents(".wizard-form-input").find("p").find("span").text("Password and confirm password must be same !!!");
      $(".step_1 :input[name='c_password']").parents(".wizard-form-input").find("p").fadeIn();
      counts++;
    }
    else{
      $(".step_1 :input[name='c_password']").parents(".wizard-form-input").find("p").fadeOut();
    }

    if(counts > 0){
      return false;
    }

    if(counts==0)
    {

      $(".process_loader").show();

      href = '<?=base_url()?>site/check_email';
      $.ajax({
        url:href,
        data: {"email": email},
        type:'post',
        success:function(res){

          var obj = $.parseJSON(res);

          if(obj.success=='1'){
            btn.attr("disabled", true);

            href = '<?=base_url()?>site/sent_code';

            $.ajax({
              url:href,
              data: {"email": email, "name": name, "is_resend": false},
              type:'post',
              success:function(res2){
                var obj2 = $.parseJSON(res2);
                if(obj2.success=='1'){
                  $(".process_loader").hide();
                  swal({title: "<?=$this->lang->line('sent_lbl')?>",text: obj2.msg,type: "success"}, function() {
                    $(".step_1").slideUp();
                    $(".step_2").slideDown();
                    resendOTP();
                  });
                  
                }
                else if(obj2.success=='0'){

                  $(".step_1_btn").attr("disabled", false);

                  $(".process_loader").hide();
                  swal(obj2.msg);
                }

              }

            });
          }
          else if(obj.success=='0'){

            $(".step_1_btn").attr("disabled", false);

            $(".process_loader").hide();
            $(".step_1 :input[name='user_email']").parents(".wizard-form-input").find("p").find("span").text(obj.msg);
            $(".step_1 :input[name='user_email']").parents(".wizard-form-input").find("p").fadeIn();
          }
        },
        error : function(res) {
          swal("Error !");
        }
      });
    }

  });

  $(".btn_back").on("click",function(e){

    swal({
      title: "Are you sure?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      cancelButtonClass: "btn-warning",
      confirmButtonText: "Yes",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false,
      showLoaderOnConfirm: true
    },
    function(isConfirm) {
      if (isConfirm) {

        swal.close();

        $(".step_2").slideUp();
        $(".step_1").slideDown();

        $(".step_1_btn").attr("disabled", false);

      }else{
        swal.close();
      }
    });
    
  });

  $(".step_2_btn").on("click",function(e){
    e.preventDefault();

    var email=$(".step_1 :input[name='user_email']").val();
    var code=$(".step_2 :input[name='email_sent_code']").val();

    href = '<?=base_url()?>site/verify_code';

    $.ajax({
      url:href,
      data: {email: email,code: code},
      type:'post',
      success:function(res){
        if($.trim(res)=='true'){
          $("#registerForm").submit();
        }
        else{
          $(".step_2 :input[name='email_sent_code']").next("p").show();
        }
      },
      error : function(res) {
        alert("error");
      }
    });
  });

  $(".btn_register").on("click",function(e){
    e.preventDefault();

    $("#registerForm").submit();
  });



  $("#lost_password_form").submit(function(e)
  {
    e.preventDefault();
    $(".err_password").hide();
    var _btn=$(this).find("button");

    if($("input[name='registered_email']").val()!='')
    {
      _btn.text("<?=$this->lang->line('please_wait_lbl')?>");

      _btn.attr("disabled", true);

      var formData = new FormData($(this)[0]);

      $.ajax({
        url:$(this).attr("action"),
        processData: false,
        contentType: false,
        type: 'POST',
        data: formData,
        success: function(data){
          var obj = $.parseJSON(data);
          if(obj.success=='1'){
            location.reload();
          }
          else if(obj.success=='0'){
            _btn.attr("disabled", false);
            _btn.text("<?=$this->lang->line('reset_btn')?>");
            $(".err_password").parents(".wizard-form-input").find("p").find("span").text(obj.message);
            $(".err_password").parents(".wizard-form-input").find("p").fadeIn();
          }
          else{
            _btn.attr("disabled", false);
            _btn.text("<?=$this->lang->line('reset_btn')?>");
            $(".err_password").parents(".wizard-form-input").find("p").find("span").text(Settings.err_something_went_wrong);
            $(".err_password").parents(".wizard-form-input").find("p").fadeIn();
          }
        },
        error : function(res) {
          alert("error");
        }
      });
    }
    else
    {
      $(".err_password").parents(".wizard-form-input").find("p").fadeIn();
    }
  });

</script>

<?php
if($this->session->flashdata('response_msg')) {
  $message = $this->session->flashdata('response_msg');
  ?>
  <script type="text/javascript">
    var _msg='<?=$message['message']?>';
    var _class='<?=$message['class']?>';

    $('.notifyjs-corner').empty();
    $.notify(
      _msg, 
      { position:"top right",className: _class }
      ); 
    </script>
    <?php
    unset($_SESSION['response_msg']);
  }
  ?>