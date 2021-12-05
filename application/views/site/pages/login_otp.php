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
            .app-login{ margin-bottom:40px; padding-left:0px;}
            .app-login .app-body {position: relative;width: 420px;margin: 0px auto;}
            .app-login .app-login-form {border: 1px solid #ddd;padding: 20px;}
            .app-login .input-group-text, .app-login input{border-radius:0px;}
            @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
	            .app-login .app-body {width:320px}
            }


        </style>
        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">&nbsp;
                        <!--nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?php echo base_url('/'); ?>">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $page_title; ?></li>
                            </ol>
                        </nav-->
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container app-login">
              <div class="row">
                <div class="col-md-12 ">
                  <div class="app-body">
                    <img src="assets/images/otp-banner.jpg" />
                <form class="app-login-form" method="post">
                  <!--h3>OTP </h3-->
                  <div class="form-group">
                    <label  class="frm-lbl">Enter OTP sent to <?=$mobile?></label><br>
                    <div id="otplist" class="inputs d-flex flex-row justify-content-center mt-2"> 
                      <input class="m-2 text-center form-control rounded" type="text" id="input1" maxlength="1" />
                      <input class="m-2 text-center form-control rounded" type="text" id="input2" maxlength="1" />
                      <input class="m-2 text-center form-control rounded" type="text" id="input3" maxlength="1" />
                      <input class="m-2 text-center form-control rounded" type="text" id="input4" maxlength="1" /> 
                    </div>
                    
                  </div>
                  <div class="form-group agree-text">
                      <a href="#">RESEND OTP</a>.
                    </div>
                    <div class="form-group  frm-submit-btn">
                      <input type="submit" class="btn btn-primary" value="Verify">
                    </div>
  		            </form>
                </div>
                </div>
              </div>
               
               
            </div>
        </main>
     
  <script>
jQuery(document).ready( function($){
  $("#otplist input").keyup(function(event){
    var codeKey=[48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105];
    var key = event.keyCode;
    if( codeKey.includes(key) ){
      $(this).next("#otplist input").focus();
    }
  });
});

  </script>

        <?php include('include/footer.php'); /*?>
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
  });* /

    if(counts==0){
        
        /*alert('hello');* /
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
  */