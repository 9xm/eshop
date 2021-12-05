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
                <div class="row mb-10">
                    <div class="col-md-12 col-xl-12">
                        <div class="mr-xl-6">
                            <?php 
                            if($link_err!=''){
                            ?>
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25"><?=$this->lang->line('something_went_wrong_err')?></h3>
                            </div>
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?=$link_err?>
                            </div>
                            <?php 
                            }
                            else if($link_err=='')
                            {
                            ?>
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25"><?=$this->lang->line('reset_password_lbl')?></h3>
                            </div>
                            <div class="container">
                                <?php 
                                    echo form_open('site/reset_password_form', ['id' => 'resetPassword']);
                                ?>
                                <input type="hidden" name="requestToken" value="<?=$this->input->get('requestToken')?>">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('new_password_lbl')?></label>
                                                <input type="password" class="form-control" name="new_password" value="" placeholder="<?=$this->lang->line('new_password_lbl')?>"  autocomplete="off">
                                                <p class="err err_new_password" style="color:red;"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('new_password_require_lbl')?></span></p>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('c_new_password_lbl')?></label>
                                                <input type="password" class="form-control" name="c_password" value="" placeholder="<?=$this->lang->line('c_new_password_lbl')?>"  autocomplete="off">
                                                <p class="err err_confirm_password" style="color:red"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('c_new_password_require_lbl')?></span></p>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="mb-1">
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary px-5" name="btn_reset_password">Save</button>
                                        </div>
                                    </div>
                                    <!-- End Button -->
                                </form>
                            </div>
                            <?php    
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </main>
        


        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer.php'); ?>
        <script type="text/javascript">

  $("#resetPassword").on("submit",function (event) {

    var counts=0;

    var $inputs = $(this).find("input");

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
      event.preventDefault();
      return false;
    }

    var password=$(this).find("input[name='new_password']").val();
    var c_password=$(this).find("input[name='c_password']").val();

    if(password!=c_password){
      $("#resetPassword :input[name='c_password']").parents(".wizard-form-input").find("p").find("span").text("<?=$this->lang->line('password_c_new_pass_match_lbl')?>");
      $("#resetPassword :input[name='c_password']").parents(".wizard-form-input").find("p").fadeIn();
      counts++;
    }
    else{
      $("#resetPassword :input[name='c_password']").parents(".wizard-form-input").find("p").fadeOut();
    }

    if(counts > 0){
      return false;
    }
    else{
      return true;
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




