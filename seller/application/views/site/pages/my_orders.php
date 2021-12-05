        <?php include('include/header.php'); ?>
        <?php
            $ci =& get_instance();

            $dataClaimStuff=array('bank_err' => $this->lang->line('cancel_ord_bank_err'), 'please_wait_lbl' => $this->lang->line('please_wait_lbl'), 'done_lbl' => $this->lang->line('done_lbl'));
        ?>
        <style type="text/css">
            .oreder_part_block .order_detail_track {
                background-color: #f9f9f9;
                border-bottom: 1px solid #e6e6e6;
                padding: 12px 15px;
                display: block;
                width: 100%;
                border-radius: 4px 4px 0 0;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
            }
            .order_track_btn {
                display: inline-block;
                text-align: left;
            }
            .order_btn {
                background: #ff5252;
                color: #fff;
                box-shadow: none;
                border: 1px solid #ff5252;
                padding: 8px 20px;
                border-radius: 4px;
                text-transform: uppercase;
                cursor: pointer;
                font-weight: 500;
                text-align: center;
                width: auto;
                -webkit-transition: all 0.4s ease-out;
                -moz-transition: all 0.4s ease-out;
                -ms-transition: all 0.4s ease-out;
                -o-transition: all 0.4s ease-out;
            }
            .order_track_item {
                text-align: right;
            }
            .order_cancle_btn_item {
                cursor: pointer;
                text-align: center;
                display: inline-block;
                border-radius: 6px;
                background: #f9f9f9;
                margin-left: 10px;
                -webkit-transition: all 0.3s ease-out 0s;
                -moz-transition: all 0.3s ease-out 0s;
                -ms-transition: all 0.3s ease-out 0s;
                -o-transition: all 0.3s ease-out 0s;
                transition: all 0.3s ease-out 0s;
            }
            .cancle_order_btn {
                background: #ff5252;
                white-space: nowrap;
                padding: 5px 25px;
                height: 38px;
                line-height: 28px;
                border-radius: 4px;
                font-weight: 500;
                text-align: center;
                text-decoration: none;
                color: #fff;
            }
            .oreder_part_block .track_order_details_part {
                overflow: hidden;
            }
            .oreder_part_block .track_order_details_part {
                overflow: hidden;
            }
            .slingle_item_address_part:first-child {
                border-top: 0;
            }
            .slingle_item_address_part {
                padding: 20px 15px;
                border-top: 1px solid #f0f0f0;
            }
            .product_img_part a img {
                text-align: center;
                margin-right: 0;
                border: 3px solid #eee;
                border-radius: 6px;
            }
            .details_part_product_img a {
                font-weight: 500;
                color: #626262;
            }
            .details_part_product_img a.product_cancel {
                background: #ff5252;
                color: #fff;
                font-size: 20px;
                font-weight: 500;
                height: 30px;
                line-height: 30px;
                padding: 0 15px;
            }
            .oreder_part_block .product_img_part_bottom {
                margin: 0 0 10px 0;
                padding-top: 10px;
                display: flex;
                position: relative;
                float: left;
                width: 100%;
                box-sizing: border-box;
                border-top: 1px solid #f0f0f0;
            }
            .oreder_part_block .product_item_date_item {
                text-align: left;
                color: #212121;
            }
            .oreder_part_block .price_item_right {
                text-align: right;
            }
            .table td {
                vertical-align: middle;
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
                <div class="row mb-10">
                    <div class="col-md-3 col-xl-3">
                        <?php include('include/my_account_sidebar.php'); ?>
                    </div>
                    <div class="col-md-9 col-xl-9">
                        <div class="mr-xl-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">MY ORDERS</h3>
                            </div>
                        
                            <div class="container">
                                <?php 
                                          if(!empty($my_orders)){ 
                                        ?>
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        
                                        
                                    <?php 
                                        foreach ($my_orders as $key => $value) {

                                            $is_order_claim=$ci->is_order_claim($value->id);

                                    ?>
                                        <tbody style="border-bottom: 8px solid grey;">
                                            <tr>
                                                <td>
                                                    <a href="<?php echo site_url('my-orders/'.$value->order_unique_id); ?>" class="pjax">
                                                        <div class="btn btn-danger " style="border-radius: 5px;text-transform: none;"><?=$value->order_unique_id?></div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    $status_arr=$ci->order_status($value->id,0);

                                                    if($value->order_status!='4' && $value->order_status!='5')
                                                    {
                                                    ?>
                                                        <?=$this->lang->line('expected_delivery_lbl')?> <?=date("M d",$value->delivery_date)?>
                                                            <br><?=$ci->get_single_info(array('order_id' => $value->id,'status_title' => $value->order_status),'status_desc','tbl_order_status')?>
                                                    <?php
                                                    }
                                                    else if($value->order_status=='5'){
                                                        ?>
                                                            <?=$this->lang->line('ord_cancelled_lbl')?>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        
                                                            <?=$this->lang->line('delivery_on_lbl')?> <?=date("M d",$value->delivery_date)?>
                                                            <br><?=$ci->get_single_info(array('order_id' => $value->id,'status_title' => $value->order_status),'status_desc','tbl_order_status')?>
                                                        
                                                        <?php
                                                    }        
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($is_order_claim){
                                                    ?>
                                                    <div class="order_cancle_btn_item" style="float: right;">
                                                        <a href="javascript:void(0)">
                                                            <div class="cancle_order_btn btn_claim" data-order="<?=$value->id;?>" data-product="0"><?=$this->lang->line('claim_refund_btn')?></div>
                                                        </a>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="order_cancle_btn_item" style="float: right;">
                                                        <a href="<?php echo site_url('my-orders/'.$value->order_unique_id); ?>">
                                                            <div class="cancle_order_btn"><i class="fa fa-map-marker"></i> <?=$this->lang->line('track_btn')?></div>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                                <?php 
                                                    $where= array('order_id' => $value->id);

                                                    $row_items=$this->common_model->selectByids($where, 'tbl_order_items');

                                                    foreach ($row_items as $key2 => $value2) 
                                                    {

                                                        $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $ci->get_single_info(array('id' => $value2->product_id),'featured_image','tbl_product'));

                                                        $img_file='assets/images/products/'.$ci->get_single_info(array('id' => $value2->product_id),'featured_image','tbl_product');
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="product_img_part">
                                                            <a href="<?php echo site_url('product/'.$ci->get_single_info(array('id' => $value2->product_id),'product_slug','tbl_product')); ?>" target="_blank"><img src="<?=base_url().$img_file?>" alt="" style="width: 100px;height: 100px;"></a>    
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('product/'.$ci->get_single_info(array('id' => $value2->product_id),'product_slug','tbl_product')); ?>" target="_blank" title="<?=$value2->product_title?>">
                                                            <?php 
                                                                if(strlen($value2->product_title) > 40){
                                                                  echo substr(stripslashes($value2->product_title), 0, 40).'...';  
                                                                }else{
                                                                  echo $value2->product_title;
                                                                }
                                                              ?>
                                                        </a>
                                                        <div>
                                                            <?=$this->lang->line('price_lbl')?>: <?=CURRENCY_CODE.' '.number_format($value2->product_price, 2)?>
                                                        </div>
                                                        <div>
                                                            <?=$this->lang->line('qty_lbl')?>: <?=$value2->product_qty?>
                                                        </div>
                                                        <?php 
                                                        if($value2->product_size!='' AND $value2->product_size!='0')
                                                        {
                                                            echo '<div>'.$this->lang->line('size_lbl').': '.$value2->product_size.'</div>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                    if($value2->pro_order_status!='4' && $value2->pro_order_status!='5'){
                                                        ?>
                                                        <div style="text-align: right !important;">                 
                                                            <a href="javascript:void(0)" class="form-button pull-right btn btn-danger product_cancel pull-right" data-order="<?=$value2->order_id?>" data-product="<?=$value2->product_id?>" data-unique="<?=$value->order_unique_id?>" data-gateway="<?=$ci->get_single_info(array('order_id' => $value2->order_id),'gateway','tbl_transaction')?>"><?=$this->lang->line('cancel_btn')?></a>
                                                        </div>
                                                        <?php
                                                    }
                                                    else if($value2->pro_order_status=='5'){

                                                        $cancelled_on=$ci->get_single_info(array('order_id' => $value2->order_id, 'product_id' => $value2->product_id),'created_at','tbl_refund');

                                                        ?>
                                                        
                                                            <span style="color: red;"><?=$this->lang->line('product_cancelled_on_lbl')?> <?=date('d-m-Y h:i A',$cancelled_on)?></span>
                                                            <br>
                                                            <strong><?=$this->lang->line('reason_lbl')?>:</strong>
                                                            <?php echo '<label style="">'.$ci->get_single_info(array('order_id' => $value2->order_id, 'product_id' => $value2->product_id),'refund_reason','tbl_refund').'</label>';?>
                                                            <?php 
                                                                if($ci->get_single_info(array('order_id' => $value2->order_id, 'product_id' => $value2->product_id),'gateway','tbl_refund')!='cod')
                                                                {
                                                                    switch ($ci->get_single_info(array('order_id' => $value2->order_id, 'product_id' => $value2->product_id),'request_status','tbl_refund')) {
                                                                      case '0':
                                                                          $_lbl_title=$this->lang->line('refund_pending_lbl');
                                                                          $_lbl_class='label-warning';
                                                                          break;
                                                                      case '2':
                                                                          $_lbl_title=$this->lang->line('refund_process_lbl');
                                                                          $_lbl_class='label-primary';
                                                                          break;
                                                                      case '1':
                                                                          $_lbl_title=$this->lang->line('refund_complete_lbl');
                                                                          $_lbl_class='label-success';
                                                                          break;
                                                                      case '-1':
                                                                          $_lbl_title=$this->lang->line('refund_wait_lbl');
                                                                          $_lbl_class='btn-danger';
                                                                    }
                                                                    ?>
                                                                    <br/>
                                                                    <?=$this->lang->line('refund_status_lbl')?>: <label class="label <?=$_lbl_class?>"><?=$_lbl_title?></label>
                                                                    <?php

                                                                    if(!$is_order_claim)
                                                                    {

                                                                        if($ci->get_single_info(array('order_id' => $value2->order_id, 'product_id' => $value2->product_id),'request_status','tbl_refund')=='-1')
                                                                        {
                                                                            echo '<a href="javascript:void(0)" class="form-button pull-right btn-danger btn_claim" data-order="'.$value2->order_id.'" data-product="'.$value2->product_id.'">'.$this->lang->line('claim_refund_btn').'</a>';
                                                                        }
                                                                    }   
                                                                }
                                                            ?>
                                                    
                                                        <?php
                                                        }
                                                    ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            
                                            <tr>
                                                <td colspan="2">
                                                    <div class="product_item_date_item">
                                                        <span><?=$this->lang->line('ord_on_lbl')?> </span><?=date("D, M jS 'y",$value->order_date)?>
                                                    </div>
                                                </td>
                                                

                                                <td>
                                                    <div class="price_item_right" style="text-align:right;">
                                                        <span><?=$this->lang->line('ord_total_lbl')?> </span>
                                                        <span class="product_item_price_item"><?=CURRENCY_CODE.' '.number_format($value->payable_amt, 2)?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            

                                    

                                        </tbody>
                                    <?php } ?>
                                    </table>
                                </div>
                            
                                <?php }else{ ?>
                                <center style="margin-bottom: 50px;">
                                    <img src="<?=base_url('assets/img/my_order.png')?>">
                                    <h2 style="font-size: 18px;font-weight: 500;color: #888;"><?=$this->lang->line('my_order_empty')?></h2>
                                    <br/>
                                    <a href="<?=base_url('/')?>"><img src="<?=base_url('assets/images/continue-shopping-button.png')?>"></a>
                                 </center>
                                <?php } ?>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                        
                        <style type="text/css">
                            #orderCancel h4 {
                                font-size: 22px;
                                font-weight: 500;
                                margin-top: 20px;
                                color: rgba(255,0,0,0.9);
                                line-height: 26px;
                            }

                            .modal-confirm h4.modal-title {
                                

                                padding-left: 10px;
                                

                            }
                            .modal-confirm h4 {
                                text-align: center;
                                font-size: 18px;
                                margin: 10px 0;
                            }
                        </style>
                        <div id="orderCancel" class="modal" style="z-index: 9999999;background: rgba(0,0,0,0.5);overflow-y: auto;">
                          <div class="modal-dialog modal-confirm" style="margin-top: 40px;font-family: 'Poppins', sans-serif;">
                            <div class="modal-content" style="position: relative;padding: 30px 20px;font-size: 16px;border-radius: 5px;border: none;">
                              <div class="modal-header" style="display: block; border-bottom: 1px solid rgba(0, 0, 0, 0.06);border: none;position: relative;text-align: center;margin: -20px -20px 0;border-radius: 5px 5px 0 0;padding: 10px;">
                                <img src="<?=base_url('assets/images/shopping-cancel-512.png')?>" style="width: 70px">
                                <h4 class="modal-title cancelTitle"><?=$this->lang->line('product_cancel_confirm_lbl')?></h4>
                                <h5><?=$this->lang->line('ord_id_lbl')?>: <span class="order_unique_id"></span></h5> 
                              </div>
                              <div class="modal-body" style="padding:0px;padding-top:20px;">
                                <div class="msg_holder"></div>
                                <form id="" class="js-validate">
                                    <input type="hidden" name="order_id" value="">
                                    <input type="hidden" name="product_id" value="">
                                    <input type="hidden" name="gateway" value="">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label">
                                                    <textarea class="form-control" name="reason" rows="4" placeholder="<?=$this->lang->line('reason_place_lbl')?> *"></textarea>
                                                    <label><?=$this->lang->line('reason_place_lbl')?> *</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 bank_details" style="display: none">
                                            <div class="table-responsive-sm">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Select</th>
                                                            <th>Bank Details</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            foreach ($bank_details as $key => $row_bank) {

                                                        ?>
                                            
                                                        <tr>
                                                            <td>
                                                                <label class="container">
                                                                    <input type="radio" name="bank_acc_id" class="address_radio" value="<?=$row_bank->id?>" <?php if($row_bank->is_default=='1'){ echo 'checked="checked"';} ?>>
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                               
                                                                <span style="margin-bottom: 0px"><?=$row_bank->bank_name?> (<?=$this->lang->line('bank_acc_no_lbl')?> :<?=$row_bank->account_no?>)</span>
                                                                <p style="margin-bottom: 0px"><?=$this->lang->line('bank_type_lbl')?>: <?=ucfirst($row_bank->account_type)?> <br/> <?=$this->lang->line('bank_ifsc_lbl')?>: <?=$row_bank->bank_ifsc?></p>
                                                                <p style="margin-bottom: 10px"><?=$this->lang->line('holder_name_lbl')?>: <?=$row_bank->bank_holder_name?> <br/> <?=$this->lang->line('holder_mobile_lbl')?>: <?=$row_bank->bank_holder_phone?></p>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="address_details_block">
                                                

                                                <div class="address_details_item">
                                                    <a href="" class="btn_new_account" style="font-size: 16px">
                                                      <div class="address_list" style="padding: 15px 5px">
                                                        <i class="fa fa-plus"></i> <?=$this->lang->line('add_new_bank_lbl')?>
                                                      </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form  method="post" accept-charset="utf-8" action="<?php echo site_url('site/add_new_bank'); ?>" class="bank_form" class="js-validate p-5" novalidate="novalidate" style="display: none;">
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
                                <!-- <form method="post" accept-charset="utf-8" action="<?php echo site_url('site/add_new_bank'); ?>" class="bank_form" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label">
                                                  <input type="text" name="bank_name" value="" required="" placeholder="<?=$this->lang->line('bank_name_place_lbl')?>">
                                                  <label><?=$this->lang->line('bank_name_place_lbl')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label">
                                                  <input type="text" name="account_no" value="" required="" placeholder="<?=$this->lang->line('bank_acc_no_place_lbl')?>" onkeypress="return isNumberKey(event)">
                                                  <label><?=$this->lang->line('bank_acc_no_place_lbl')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="form-control" required="required" name="account_type">
                                                    <option value="saving"><?=$this->lang->line('saving_type_lbl')?></option>
                                                    <option value="current"><?=$this->lang->line('current_type_lbl')?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label">
                                                  <input type="text" name="bank_ifsc" value="" required="" placeholder="<?=$this->lang->line('bank_ifsc_place_lbl')?>">
                                                  <label><?=$this->lang->line('bank_ifsc_place_lbl')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label" style="margin-bottom: 0px">
                                                  <input type="text" name="holder_name" value="" required="" placeholder="<?=$this->lang->line('holder_name_place_lbl')?>">
                                                  <label><?=$this->lang->line('holder_name_place_lbl')?></label>
                                                </div>
                                                <p class="hint_lbl" style="margin-bottom: 20px">(<?=$this->lang->line('holder_name_note_lbl')?>)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label" style="margin-bottom: 0px">
                                                  <input type="text" name="holder_mobile" value="" required="" placeholder="<?=$this->lang->line('holder_mobile_place_lbl')?>" onkeypress="return isNumberKey(event)" maxlength="15">
                                                  <label><?=$this->lang->line('holder_mobile_place_lbl')?></label>
                                                </div>
                                                <p class="hint_lbl" style="margin-bottom: 20px">(<?=$this->lang->line('holder_mobile_note_lbl')?>)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label" style="margin-bottom: 0px">
                                                  <input type="text" name="holder_email" value="" required="" placeholder="<?=$this->lang->line('holder_email_place_lbl')?>">
                                                  <label><?=$this->lang->line('holder_email_place_lbl')?></label>
                                                </div>
                                                <p class="hint_lbl" style="margin-bottom: 20px">(<?=$this->lang->line('holder_email_note_lbl')?>)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="container_checkbox"><?=$this->lang->line('default_refund_acc_lbl')?>
                                              <input type="checkbox" checked="checked" name="is_default">
                                              <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                            <br/>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success"><?=$this->lang->line('save_btn')?></button>
                                                <button type="button" class="btn btn-warning btn_cancel_form"><?=$this->lang->line('cancel_btn')?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> -->
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal" aria-label="Close"><?=$this->lang->line('close_btn')?></button>
                                <?php 

                                    $dataStuff=array('cancel_ord_reason_err' => $this->lang->line('cancel_ord_reason_err'), 'cancel_ord_bank_err' => $this->lang->line('cancel_ord_bank_err'), 'cancel_ord_btn' => $this->lang->line('cancel_ord_btn'), 'please_wait_lbl' => $this->lang->line('please_wait_lbl'), 'cancelled_lbl' => $this->lang->line('cancelled_lbl'));

                                ?>
                                <button class="btn btn-success cancel_order" data-stuff="<?=htmlentities(json_encode($dataStuff))?>"><?=$this->lang->line('cancel_ord_btn')?></button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div id="claimRefund" class="modal" style="z-index: 9999999;background: rgba(0,0,0,0.5);overflow-y: auto;">
                          <div class="modal-dialog modal-confirm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title"><?=$this->lang->line('ord_refund_account_lbl')?></h4>
                              </div>
                              <div class="modal-body" style="padding-top: 0px">
                                <div class="msg_holder">
                                    
                                </div>
                                <form id="">
                                    <input type="hidden" name="order_id" value="">
                                    <input type="hidden" name="product_id" value="">
                                    <div class="row">
                                        <div class="col-md-12 bank_details" style="display: none">
                                            <div class="address_details_block">
                                                <div class="table-responsive-sm">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Select</th>
                                                                <th>Bank Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                foreach ($bank_details as $key => $row_bank) {

                                                            ?>
                                                
                                                            <tr>
                                                                <td>
                                                                    <label class="container">
                                                                        <input type="radio" name="bank_acc_id" class="address_radio" value="<?=$row_bank->id?>" <?php if($row_bank->is_default=='1'){ echo 'checked="checked"';} ?>>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                   
                                                                    <span style="margin-bottom: 0px"><?=$row_bank->bank_name?> (<?=$this->lang->line('bank_acc_no_lbl')?> :<?=$row_bank->account_no?>)</span>
                                                                    <p style="margin-bottom: 0px"><?=$this->lang->line('bank_type_lbl')?>: <?=ucfirst($row_bank->account_type)?> <br/> <?=$this->lang->line('bank_ifsc_lbl')?>: <?=$row_bank->bank_ifsc?></p>
                                                                    <p style="margin-bottom: 10px"><?=$this->lang->line('holder_name_lbl')?>: <?=$row_bank->bank_holder_name?> <br/> <?=$this->lang->line('holder_mobile_lbl')?>: <?=$row_bank->bank_holder_phone?></p>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="address_details_item">
                                                    <a href="" class="btn_new_account" style="font-size: 16px">
                                                      <div class="address_list" style="padding: 15px 5px">
                                                        <i class="fa fa-plus"></i> <?=$this->lang->line('add_new_bank_lbl')?>
                                                      </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- <form method="post" accept-charset="utf-8" action="<?php echo site_url('site/add_new_bank'); ?>" class="bank_form" style="<?=(count($bank_details)!=0) ? 'display: none;' : 'display: block;'?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label">
                                                  <input type="text" name="bank_name" value="" required="" placeholder="<?=$this->lang->line('bank_name_place_lbl')?>">
                                                  <label><?=$this->lang->line('bank_name_place_lbl')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label">
                                                  <input type="text" name="account_no" value="" required="" placeholder="<?=$this->lang->line('bank_acc_no_place_lbl')?>" onkeypress="return isNumberKey(event)">
                                                  <label><?=$this->lang->line('bank_acc_no_place_lbl')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="form-control" required="required" name="account_type">
                                                    <option value="saving"><?=$this->lang->line('saving_type_lbl')?></option>
                                                    <option value="current"><?=$this->lang->line('current_type_lbl')?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label">
                                                  <input type="text" name="bank_ifsc" value="" required="" placeholder="<?=$this->lang->line('bank_ifsc_place_lbl')?>">
                                                  <label><?=$this->lang->line('bank_ifsc_place_lbl')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label" style="margin-bottom: 0px">
                                                  <input type="text" name="holder_name" value="" required="" placeholder="<?=$this->lang->line('holder_name_place_lbl')?>">
                                                  <label><?=$this->lang->line('holder_name_place_lbl')?></label>
                                                </div>
                                                <p class="hint_lbl" style="margin-bottom: 20px">(<?=$this->lang->line('holder_name_note_lbl')?>)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label" style="margin-bottom: 0px">
                                                  <input type="text" name="holder_mobile" value="" required="" placeholder="<?=$this->lang->line('holder_mobile_place_lbl')?>" onkeypress="return isNumberKey(event)" maxlength="15">
                                                  <label><?=$this->lang->line('holder_mobile_place_lbl')?></label>
                                                </div>
                                                <p class="hint_lbl" style="margin-bottom: 20px">(<?=$this->lang->line('holder_mobile_note_lbl')?>)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="wizard-form-field">
                                                <div class="wizard-form-input has-float-label" style="margin-bottom: 0px">
                                                  <input type="text" name="holder_email" value="" required="" placeholder="<?=$this->lang->line('holder_email_place_lbl')?>">
                                                  <label><?=$this->lang->line('holder_email_place_lbl')?></label>
                                                </div>
                                                <p class="hint_lbl" style="margin-bottom: 20px">(<?=$this->lang->line('holder_email_note_lbl')?>)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="container_checkbox"><?=$this->lang->line('default_refund_acc_lbl')?>
                                              <input type="checkbox" checked="checked" name="is_default">
                                              <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                            <br/>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success"><?=$this->lang->line('save_btn')?></button>
                                                <button type="button" class="btn btn-warning btn_cancel_form"><?=$this->lang->line('cancel_btn')?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> -->

                                <form  method="post" accept-charset="utf-8" action="<?php echo site_url('site/add_new_bank'); ?>" class="bank_form" class="js-validate p-5" novalidate="novalidate"  style="<?=(count($bank_details)!=0) ? 'display: none;' : 'display: block;'?>">
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
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal" aria-label="<?=$this->lang->line('close_btn')?>"><?=$this->lang->line('close_btn')?></button>
                                <button class="btn btn-success claim_refund" data-stuff="<?=htmlentities(json_encode($dataClaimStuff))?>"><?=$this->lang->line('claim_refund_btn')?></button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div id="orderConfirm" class="modal" style="z-index: 9999999;background: rgba(0,0,0,0.8);text-align:center;">
                            <div class="modal-dialog modal-confirm" style="width: fit-content">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <img src="<?=base_url('assets/img/successful-icon.png')?>" style="width: 70px">
                                  <h4 class="modal-title" style="margin-top:15px;text-align:center;width: 100%;padding: 0;"><?=$this->lang->line('ord_placed_lbl')?></h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button> 
                                </div>
                                <div class="modal-body" style="padding-top: 0px">
                                  <p class="text-center" style="font-size: 22px;color: green;font-weight: 600;margin-bottom: 10px;padding-top: 20px;text-transform: capitalize;"><?=$this->lang->line('thank_you_ord_lbl')?></p>
                                  <p style="margin-bottom: 5px;text-align: center;"><?=$this->lang->line('ord_confirm_lbl')?></p>
                                  <p style="color: #000;margin-bottom: 5px;font-size: 16px;text-align: center;"><strong><?=$this->lang->line('ord_no_lbl')?>:</strong> <span class="ord_no_lbl"></span></p>
                                </div>
                                <div class="modal-footer" style="text-align: center;">
                                  <button class="btn btn-danger btn_track"><?=$this->lang->line('track_ord_btn')?></button>
                                  <button class="btn btn-success btn_orders" onclick="location.href='<?=base_url('my-orders')?>'"><?=$this->lang->line('my_ord_btn')?></button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
               

            </div>
            

        </main>
        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer.php'); ?>
        <script type="text/javascript">

    // Submit Bank Form
    $(".bank_form").submit(function(e){
        e.preventDefault();

        var _form=$(this);

        href=$(this).attr("action");

        var is_default='';

        if($(_form).find("input[name='is_default']").prop("checked") == true){
            is_default='checked="checked"';
        }

        var parent_element=$(this).prev("form").find(".bank_details");

        bank_name=$(_form).find("input[name='bank_name']").val();
        account_no=$(_form).find("input[name='account_no']").val();
        bank_ifsc=$(_form).find("input[name='bank_ifsc']").val();
        bank_ifsc=$(_form).find("input[name='bank_ifsc']").val();
        account_type=$(_form).find("select[name='account_type']").children("option:selected").text();
        name=$(_form).find("input[name='holder_name']").val();
        mobile_no=$(_form).find("input[name='holder_mobile']").val();

        $.ajax({
          type:'POST',
          url:href,
          data:$(this).serialize(),
          success:function(res){
            var obj = $.parseJSON(res);

            $('.notifyjs-corner').empty();

            if(obj.success=='1'){

                _form.find("input, textarea").val("");
                
                html_content='<div class="address_details_item"><label class="container"><input type="radio" name="bank_acc_id" class="address_radio" value="'+obj.bank_id+'" '+is_default+'><span class="checkmark"></span></label><div class="address_list"><span style="margin-bottom: 0px">'+bank_name+' (<?=$this->lang->line('bank_acc_no_lbl')?> :'+account_no+')</span><p style="margin-bottom: 0px"><?=$this->lang->line('bank_type_lbl')?>: '+account_type+' <br/> <?=$this->lang->line('bank_ifsc_lbl')?>: '+bank_ifsc+'</p><p style="margin-bottom: 10px"><?=$this->lang->line('holder_name_lbl')?>: '+name+' <br/> <?=$this->lang->line('holder_mobile_lbl')?>: '+mobile_no+'</p></div></div>';

                $(".bank_form").hide();

                parent_element.find(".address_details_block").prepend(html_content);

                parent_element.show();

                $.notify(
                    obj.message, {
                        position: "top right",
                        className: 'success'
                    }
                );
            }
            else{

                $.notify(
                    obj.message, {
                        position: "top right",
                        className: 'error'
                    }
                );
            }
            
          }
        });

    });


    $('#orderCancel, #claimRefund').on('hidden.bs.modal', function () {
      $("body").css("overflow-y","auto");
      $(".bank_form").hide();
      $(".bank_details").hide();
      $(".msg_holder").html('');
      $("textarea[name='reason']").css("border-color","#ccc");
      $("textarea").val('');
    });

</script>

<?php
  if($this->session->flashdata('payment_msg')) {
    $data = $this->session->flashdata('payment_msg');
    ?>
    <script type="text/javascript">
      $("#orderConfirm .ord_no_lbl").text('<?=$data['order_unique_id']?>');

      $("#orderConfirm .btn_track").on("click",function(e){
        window.location.href='<?=base_url().'my-orders/'.$data['order_unique_id']?>';
      });

      $("#orderConfirm").fadeIn();
    </script>
    <?php
    if($this->session->flashdata('payment_msg')){
        unset($_SESSION['payment_msg']);
    }
  } 
?>
       