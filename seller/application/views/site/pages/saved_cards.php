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
                                if(!empty($bank_details))
                                {
                                ?>
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <tbody style="border-bottom: 2px solid grey;">   
                                        
                                            <?php 
                                            foreach ($bank_details as $key => $value) 
                                            {
                                            ?>
                                        
                                            <tr>
                                                <td>
                                                    <div style="background: rgba(0, 0, 0, 0.05);display: inline-block;width: auto;padding: 1px 10px;border-radius: 4px;margin-bottom: 8px;text-transform: uppercase;font-size: 12px;font-weight: 500;border: 1px solid rgba(0, 0, 0, 0.05);" ><?=$value->bank_name?> 
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right">
                                                    <div class="btn-group pull-right">
                                                        <a href="" style="padding: 3px;" class=" btn-success btn_edit_bank" data-stuff='<?php echo htmlentities(json_encode($value)); ?>'><?=$this->lang->line('edit_lbl')?></a>
                                                    </div>
                                                   <div class="btn-group pull-right">
                                                        <a href="" style="padding: 3px;" class=" btn-danger btn_remove_bank" data-id="<?=$value->id?>"><?=$this->lang->line('delete_btn')?></a>
                                                    </div>
                                                    
                                                </td>
                                                

                                            </tr>
                                            <tr>
                                                <td class="col-md-3"><strong><?=$this->lang->line('bank_acc_no_lbl')?></strong></td>
                                                <td><?=$value->account_no?></td>
                                                <td class="col-md-3"><strong><?=$this->lang->line('holder_name_lbl')?></strong></td>
                                                <td><?=$value->bank_holder_name?></td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-2"><strong><?=$this->lang->line('bank_ifsc_lbl')?></strong></td>
                                                <td><?=$value->bank_ifsc?></td>
                                                <td class="col-md-3"><strong><?=$this->lang->line('holder_mobile_lbl')?></strong></td>
                                                <td><?=$value->bank_holder_phone?></td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-3"><strong><?=$this->lang->line('bank_type_lbl')?></strong></td>
                                                <td><?=($value->account_type=='saving') ? $this->lang->line('saving_type_lbl') : $this->lang->line('current_type_lbl')?></td>
                                                <td class="col-md-2"><strong><?=$this->lang->line('holder_email_lbl')?></strong></td>
                                                <td colspan="3"><?=$value->bank_holder_email?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            
                                <?php }else{ ?>
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <tbody style="border-bottom: 2px solid grey;">
                                            <tr>
                                                <td>No Account Details</td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                                

                                <?php } ?>
                                <div id="shopCartAccordion" class="accordion rounded mb-5">
                                    <!-- Card -->
                                    <div class="card border-0">
                                        <div id="shopCartHeadingOne" class="alert alert-primary mb-0" role="alert">
                                            <a href="#" class="alert-link collapsed" data-toggle="collapse" data-target="#shopCartOne" aria-expanded="false" aria-controls="shopCartOne">+ <?=$this->lang->line('add_new_bank_lbl')?></a>
                                        </div>
                                        <div id="shopCartOne" class="border border-top-0 collapse" aria-labelledby="shopCartHeadingOne" data-parent="#shopCartAccordion" style="">
                                            <div class="container">
                                            <!-- Form -->
                                            <form  method="post" accept-charset="utf-8" action="<?php echo site_url('site/add_new_bank'); ?>" class="bank_form" id="bank_form_new" class="js-validate p-5" novalidate="novalidate">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('bank_name_place_lbl')?></label>
                                                            <input type="text" class="form-control" name="bank_name" value="" required="" placeholder="<?=$this->lang->line('bank_name_place_lbl')?>">
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('bank_acc_no_place_lbl')?></label>
                                                            <input type="text" name="account_no" class="form-control" value="" required="" placeholder="<?=$this->lang->line('bank_acc_no_place_lbl')?>" onkeypress="return isNumberKey(event)">
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3">Account Type</label>
                                                            <div class="form-group">
                                                                <select class="form-control" required="required" name="account_type">
                                                                    <option value="saving"><?=$this->lang->line('saving_type_lbl')?></option>
                                                                    <option value="current"><?=$this->lang->line('current_type_lbl')?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('bank_ifsc_place_lbl')?></label>
                                                            <input type="text" name="bank_ifsc" class="form-control" value="" required="" placeholder="<?=$this->lang->line('bank_ifsc_place_lbl')?>">
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('holder_name_place_lbl')?></label>
                                                            <input type="text" name="holder_name" class="form-control" value="" required="" placeholder="<?=$this->lang->line('holder_name_place_lbl')?>">
                                                            <p class="hint_lbl" style="margin-bottom: 20px;color:red;">(<?=$this->lang->line('holder_name_note_lbl')?>)</p>
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('holder_mobile_place_lbl')?></label>
                                                            <input type="text" name="holder_mobile" value="" class="form-control" required="" placeholder="<?=$this->lang->line('holder_mobile_place_lbl')?>" onkeypress="return isNumberKey(event)" maxlength="15">
                                                            <p class="hint_lbl" style="margin-bottom: 20px;color:red;">(<?=$this->lang->line('holder_mobile_note_lbl')?>)</p>
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('holder_email_place_lbl')?></label>
                                                            <input type="text" class="form-control" name="holder_email" value="" required="" placeholder="<?=$this->lang->line('holder_email_place_lbl')?>">
                                                            <p class="hint_lbl" style="margin-bottom: 20px;color:red;">(<?=$this->lang->line('holder_email_note_lbl')?>)</p>
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                             <input type="checkbox" checked="checked" name="is_default">
                                                             <span class="checkmark"> Set default for Refund Payment</span>
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
                                            <!-- End Form -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div id="edit_bank_account" class="modal fade" role="dialog" style="z-index: 99999">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-details">
                            <div style="background: none;border:none;">
                                <form action="" method="post" id="edit_bank_form">
                                  <input type="hidden" name="bank_id">
                                    <div class="row">
                                                    <div class="col-lg-6">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('bank_name_place_lbl')?></label>
                                                            <input type="text" class="form-control" name="bank_name" value="" required="" placeholder="<?=$this->lang->line('bank_name_place_lbl')?>">
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('bank_acc_no_place_lbl')?></label>
                                                            <input type="text" name="account_no" class="form-control" value="" required="" placeholder="<?=$this->lang->line('bank_acc_no_place_lbl')?>" onkeypress="return isNumberKey(event)">
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3">Account Type</label>
                                                            <div class="form-group">
                                                                <select class="form-control" required="required" name="account_type">
                                                                    <option value="saving"><?=$this->lang->line('saving_type_lbl')?></option>
                                                                    <option value="current"><?=$this->lang->line('current_type_lbl')?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('bank_ifsc_place_lbl')?></label>
                                                            <input type="text" name="bank_ifsc" class="form-control" value="" required="" placeholder="<?=$this->lang->line('bank_ifsc_place_lbl')?>">
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('holder_name_place_lbl')?></label>
                                                            <input type="text" name="holder_name" class="form-control" value="" required="" placeholder="<?=$this->lang->line('holder_name_place_lbl')?>">
                                                            <p class="hint_lbl" style="margin-bottom: 20px;color:red;">(<?=$this->lang->line('holder_name_note_lbl')?>)</p>
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('holder_mobile_place_lbl')?></label>
                                                            <input type="text" name="holder_mobile" value="" class="form-control" required="" placeholder="<?=$this->lang->line('holder_mobile_place_lbl')?>" onkeypress="return isNumberKey(event)" maxlength="15">
                                                            <p class="hint_lbl" style="margin-bottom: 20px;color:red;">(<?=$this->lang->line('holder_mobile_note_lbl')?>)</p>
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('holder_email_place_lbl')?></label>
                                                            <input type="text" class="form-control" name="holder_email" value="" required="" placeholder="<?=$this->lang->line('holder_email_place_lbl')?>">
                                                            <p class="hint_lbl" style="margin-bottom: 20px;color:red;">(<?=$this->lang->line('holder_email_note_lbl')?>)</p>
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <!-- Form Group -->
                                                        <div class="js-form-message form-group">
                                                             <input type="checkbox" checked="checked" name="is_default">
                                                             <span class="checkmark"> Set default for Refund Payment</span>
                                                        </div>
                                                        <!-- End Form Group -->
                                                    </div>
                                                    

                                                </div>
                                    <!-- Button -->
                                    <div class="mb-1">
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary px-5">Save</button>
                                            <button class="btn btn-primary px-5" type="button" data-dismiss="modal"><?=$this->lang->line('close_btn')?></button>
                                        </div>
                                    </div>
                                                                       
                                </form>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer.php'); ?>
        <script type="text/javascript">

    $(".btn_edit_bank").click(function(e){

        e.preventDefault();
        var data=$(this).data('stuff');

        $('#edit_bank_account').find("input[name='bank_id']").val(data['id']);
        $('#edit_bank_account').find("input[name='bank_name']").val(data['bank_name']);
        $('#edit_bank_account').find("input[name='account_no']").val(data['account_no']);
        $('#edit_bank_account').find("input[name='bank_ifsc']").val(data['bank_ifsc']);
        $('#edit_bank_account').find("input[name='holder_name']").val(data['bank_holder_name']);

        $('#edit_bank_account').find("input[name='holder_mobile']").val(data['bank_holder_phone']);
        $('#edit_bank_account').find("input[name='holder_email']").val(data['bank_holder_email']);
        $('#edit_bank_account').find('#account_type option[value="'+data['state']+'"]').prop('selected', true);
        if(data['is_default']=='1'){
            $('#edit_bank_account').find("input[name=is_default]").prop("checked",true);
        }
        else{
            $('#edit_bank_account').find("input[name=is_default]").prop("checked",false);
        }
        
        $('#edit_bank_account').modal({
            backdrop: 'static',
            keyboard: false
        })
    });

    // update bank account
    $("#edit_bank_form").submit(function(e){
        e.preventDefault();

        $(".process_loader").show();

        var formData = new FormData($(this)[0]);

        var href = '<?=base_url()?>site/edit_bank_account';
        
        $.ajax({
            url: href,
            processData: false,
            contentType: false,
            type: 'POST',
            data: formData,
            success: function(data){
              var obj = $.parseJSON(atob(data));
              $(".process_loader").hide();
              if(obj.success=='1'){
                $('#edit_bank_account').modal("hide");
                swal({ title: "<?=$this->lang->line('updated_lbl')?>", text: obj.message, type: "success" }, function(){ location.reload(); });
              }
              else{
                swal({
                    title: Settings.err_something_went_wrong,
                    text: obj.message,
                    type: "error"
                }, function() {
                    location.reload();
                });
              }

            }
        });

    });
    
    // Submit Bank Form
    $("#bank_form_new").on("submit",function(e){
        e.preventDefault();
        var _form=$(this);
        href=$(this).attr("action");
        $.ajax({
          type:'POST',
          url:href,
          data:$(this).serialize(),
          success:function(res){
            var obj = $.parseJSON(res);
            if(obj.success=='1'){
                swal({ title: "<?=$this->lang->line('added_lbl')?>", text: obj.message, type: "success" }, function(){ location.reload(); });
            }
            else{
                swal({
                    title: Settings.err_something_went_wrong,
                    text: obj.message,
                    type: "error"
                }, function() {
                    location.reload();
                });
            }
          }
        });
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
