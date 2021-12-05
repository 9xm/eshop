        <?php include('include/header.php'); ?>
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
                <div class="mb-2">
                    <h1 class="text-center"><?php echo $page_title; ?></h1>
                </div>
                <div class="my-4 my-xl-8">
                    <div class="row">
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-6 ml-md-auto ml-xl-0 mr-xl-auto" style="border-style: groove;">
                            <!-- Title -->
                            <!--<div class="border-bottom border-color-1 mb-3">
                                <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">New  Register</h3>
                            </div>-->
                            <!-- End Title -->
                            <!-- Form Group -->
                            <form class="js-validate" novalidate="novalidate" action="<?php echo site_url('site/vendor_register'); ?>" id="registerForm" method="post">
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
                        <div class="col-md-3">
                            
                        </div>
                    </div>
                </div>
            </div>
        </main>
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


  function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
      return false;
    }else{
      return true;
    }
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