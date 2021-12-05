        <?php include('include/header.php'); ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                                <h3 class="section-title mb-0 pb-2 font-size-25">MY PROFILE</h3>
                            </div>
                            <form novalidate="novalidate" method="post" id="profile_form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                               <?=$this->lang->line('name_place_lbl')?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="user_name" value="<?=$user_data->user_name?>" required="" <?=($user_data->user_type!='Normal') ? 'readonly=""' : ''?> placeholder="<?=$this->lang->line('name_place_lbl')?>">
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                <?=$this->lang->line('email_place_lbl')?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="user_email" value="<?=$user_data->user_email?>" <?=($user_data->user_type=='Normal') ? 'required=""' : ''?> <?=($user_data->user_email!='') ? 'readonly=""' : ''?> placeholder="<?=$this->lang->line('email_place_lbl')?>">
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-12">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                <?=$this->lang->line('phone_no_place_lbl')?>
                                            </label>
                                            <input type="text" class="form-control" name="user_phone" value="<?=$user_data->user_phone?>" required="" placeholder="<?=$this->lang->line('phone_no_place_lbl')?>" onkeypress="return isNumberKey(event)" maxlength="15">
                                        </div>
                                        <!-- End Input -->
                                    </div>
                                    

                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary-dark-w px-5"><?=$this->lang->line('save_btn')?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
               

            </div>
            

        </main>
        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer.php'); ?>
        <script type="text/javascript">

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $(".fileupload_img").attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("input[name='file_name']").change(function() { 
                readURL(this);
            });

            $("#profile_form").submit(function(e)
            {
                var inputs = $("#profile_form :input[type='text']");
                var counts=0;
                e.preventDefault();

                inputs.each(function(){
                    if($(this).val()==''){
                        $(this).css("border-color","#F00");
                        counts++;
                    }
                    else{
                        $(this).css("border-color","#E5E5E5");
                    }
                });

                if(counts==0){
                    
                    $(".process_loader").show();

                    var formData = new FormData($(this)[0]);

                    var href = '<?=base_url()?>site/update_profile';

                    $.ajax({
                        url: href,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        data: formData,
                        success: function(data){

                          var obj = $.parseJSON(atob(data));
                          
                          $(".process_loader").hide();

                          if(obj.status==1){
                            swal({ title: "<?=$this->lang->line('updated_lbl')?>", text: obj.msg, type: "success"});
                            $(".profile_img").css("background-image", "url('"+obj.image+"')");
                          }
                          else{
                            swal({
                                title: Settings.err_something_went_wrong,
                                text: obj.msg,
                                type: "error"
                            }, function() {
                                location.reload();
                            });
                          }
                        }
                     });
                }
            });

            $("#profile_form :input[type='text']").blur(function(e){
                if($(this).val()!=''){
                    $(this).css("border-color","#E5E5E5");
                }
                else{
                    $(this).css("border-color","#F00");
                }
            });

            $(".remove_profile").on("click",function(e){
                e.preventDefault();

                swal({
                    title: Settings.confirm_msg,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger btn_edit",
                    cancelButtonClass: "btn-warning btn_edit",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false,
                    showLoaderOnConfirm: true
                },
                function(isConfirm) {
                    if(isConfirm){

                        $(".process_loader").show();

                        var href = '<?=base_url()?>site/remove_profile';
                        $.ajax({
                            url: href,
                            type: 'POST',
                            success: function(data){
                                var obj = $.parseJSON(atob(data));
                                $(".process_loader").hide();

                                if(obj.status==1){
                                    swal({ title: "<?=$this->lang->line('removed_lbl')?>", text: obj.msg, type: "success"});
                                    $(".fileupload_img").attr('src',"<?=base_url('assets/images/photo.jpg')?>");
                                    $(".profile_img").css("background-image", "url('<?=base_url('assets/images/photo.jpg')?>')");
                                }
                                else{
                                    swal({
                                        title: Settings.err_something_went_wrong,
                                        text: obj.msg,
                                        type: "error"
                                    }, function() {
                                        location.reload();
                                    });
                                }
                            }
                        });
                    } 
                    else {
                        swal.close();
                    }
                });
            });

        </script>
       