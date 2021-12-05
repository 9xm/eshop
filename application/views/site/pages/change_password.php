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
                    <div class="col-md-3 col-xl-3">
                        <?php include('include/my_account_sidebar.php'); ?>
                    </div>
                    <div class="col-md-9 col-xl-9">
                        <div class="mr-xl-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25"><?php echo $page_title; ?></h3>
                            </div>
                        
                            <div class="container">
                                <?php
                                if(strcmp($this->session->userdata('user_type'), 'Normal')==0)
                                {
                                ?>
                                <form  action="" id="change_password_form" method="post" class="js-validate p-5" novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('old_password_place_lbl')?></label>
                                                <input type="password" class="form-control" name="old_password" value="" placeholder="<?=$this->lang->line('old_password_place_lbl')?>"  autocomplete="off">
                                                <p class="err err_old_password" style="color:red;"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('old_password_require_lbl')?></span></p>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>

                                        <div class="col-lg-12">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('new_password_place_lbl')?></label>
                                                <input type="password" class="form-control" name="new_password" value="" placeholder="<?=$this->lang->line('new_password_place_lbl')?>"  autocomplete="off">
                                                <p class="err err_new_password" style="color:red;"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('new_password_require_lbl')?></span></p>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('c_new_password_place_lbl')?></label>
                                                <input type="password" class="form-control" name="confirm_password" value="" placeholder="<?=$this->lang->line('c_new_password_place_lbl')?>"  autocomplete="off">
                                                <p class="err err_confirm_password" style="color:red"><i class="fa fa-exclamation-circle"></i> <span><?=$this->lang->line('c_new_password_require_lbl')?></span></p>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="mb-1">
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary px-5">Save</button>
                                        </div>
                                    </div>
                                    <!-- End Button -->
                                </form>
                            
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        


        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer.php'); ?>
        <script type="text/javascript">

        $("#change_password_form").submit(function(e){

            var inputs = $("#change_password_form :input[type='password']");
            var counts=0;
            e.preventDefault();

            inputs.each(function(){
                if($(this).val()=='')
                {
                    $(this).css("border-color","#F00");
                    $(this).parents(".wizard-form-input").find("p").fadeIn();
                    counts++;
                }
                else{
                    $(this).parents(".wizard-form-input").find("p").hide();
                }
            });

            if($("input[name='confirm_password']").val()!=$("input[name='new_password']").val())
            {
                counts++;

                $("input[name='confirm_password']").parents(".wizard-form-input").find("p").find("span").text("<?=$this->lang->line('password_cpass_match_lbl')?>");

                $("input[name='confirm_password']").parents(".wizard-form-input").find("p").fadeIn();
            }
            else
            {
                $(this).parents(".wizard-form-input").find("p").hide();
            }

            if(counts==0)
            {
                var formData = new FormData($(this)[0]);
                var href = '<?=base_url()?>site/change_password';

                $.ajax({
                    url: href,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    data: formData,
                    success: function(data){

                      var obj = $.parseJSON(atob(data));
                      
                      if(obj.status==1){
                        swal({ title: "<?=$this->lang->line('updated_lbl')?>", text: obj.msg, type: "success" }, function(){ location.reload(); });
                      }
                      else{
                        $("#change_password_form").find("."+obj.class).find("span").text(obj.msg);
                        $("#change_password_form").find("."+obj.class).fadeIn();
                      }
                    }
                 });

            }

        });

        $("#change_password_form input").blur(function(e)
        {
            if($(this).val()!='')
            {
                if($("input[name='confirm_password']").val()!=''){

                    if($("input[name='confirm_password']").val()!=$("input[name='new_password']").val())
                    {
                        $("input[name='confirm_password']").parents(".wizard-form-input").find("p").find("span").text("<?=$this->lang->line('password_cpass_match_lbl')?>");

                        $("input[name='confirm_password']").parents(".wizard-form-input").find("p").fadeIn();
                    }
                    else{

                        $(this).css("border-color","#E5E5E5");
                        $(this).parents(".wizard-form-input").find("p").hide();
                    }
                }
                else
                {
                    $(this).parents(".wizard-form-input").find("p").find("span").text("<?=$this->lang->line('c_new_password_require_lbl')?>");
                    $(this).parents(".wizard-form-input").find("p").fadeIn();
                }

                $(this).parents(".wizard-form-input").find("p").hide();

                $(this).css("border-color","#E5E5E5");

            }
            else{
                $(this).parents(".wizard-form-input").find("p").fadeIn();
            }
        });

        $("input[name='confirm_password']").on('keyup blur',function(e){
            if($(this).val()!=''){
                if($(this).val()!=$("input[name='new_password']").val()){
                    $(this).css("border-color","#F00");
                    $(this).parents(".wizard-form-input").find("p").find("span").text("<?=$this->lang->line('password_cpass_match_lbl')?>");

                    $(this).parents(".wizard-form-input").find("p").fadeIn();
                }
                else{
                    $(this).parents(".wizard-form-input").find("p").hide();
                    $(this).css("border-color","#E5E5E5");
                }
            }
            else
            {
                $(this).css("border-color","#F00");
                $(this).parents(".wizard-form-input").find("p").find("span").text("<?=$this->lang->line('c_new_password_require_lbl')?>");
                $(this).parents(".wizard-form-input").find("p").fadeIn();
            }
        });

</script>




