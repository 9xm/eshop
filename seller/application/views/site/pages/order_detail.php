        <?php include('include/header.php'); ?>
        <?php
            $ci =& get_instance();

            $is_order_claim=$ci->is_order_claim($my_order[0]->id);

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
            }
            .product_timeline_block {
                background: transparent;
                box-shadow: 0 0px 0px 0 rgb(0 0 0 / 0%);
                margin-bottom: 0;
            }

            .slingle_product_block, .product_timeline_block {
                margin: 5px 0 25px 0;
                padding: 5px 20px;
                border-radius: 6px;
                box-shadow: 0 1px 10px 0 rgb(0 0 0 / 8%);
                float: left;
                width: 100%;
            }
            div.timeline {
                background-color: #E6D4D4;
                margin: 50px auto 10px;
                height: 6px;
                width: 100%;
                border-radius: 10px;
                position: relative;
            }
            div.timeline .dot:nth-child(1) {
                left: 20%;
            }
            div.timeline .dot:nth-child(2) {
                left: 40%;
            }
            div.timeline .dot:nth-child(3) {
                left: 60%;
            }
            div.timeline .dot:nth-child(4) {
                left: 80%;
            }
            div.timeline .dot {
                z-index: 99;
                transition: 0.5s ease-in-out;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                position: absolute;
                top: -7px;
                text-align: center;
                cursor: pointer;
            }
            .active_dot {
                background-color: #fed700;
            }
            .deactive_dot {
                background-color: grey;
            }
            div.timeline .dot span {
                display: inline-block;
                margin-top: 0px;
                width: 10px;
                height: 10px;
                top: -1px;
                background-color: #fff;
                position: relative;
                border-radius: 50%;
                box-shadow: 0 0 5px rgb(0 0 0 / 20%);
            }

            div.timeline .dot date {
                font-size: 14px;
                display: block;
                position: relative;
                top: -60px;
                right: 10px;
                text-align: center;
                font-weight: 500;
            }
            .product_timeline_block article {
                display: none;
                position: relative;
                top: 0px;
                max-width: 100%;
                padding: 15px 10px 0 5px;
                margin: auto;
            }
            div.timeline .inside {
                position: absolute;
                height: 7px;
                background-color: #fed700;
                width: 0%;
                left: 0;
                border-radius: 10px;
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
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?= base_url(); ?>my-orders"><?php echo $page_title; ?></a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $current_page; ?></li>
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
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">Order Details</h3>
                            </div>
                        
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <h6><?=$this->lang->line('ord_details_section_lbl')?> :-</h6>
                                        <div class="table-responsive-sm">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><?=$this->lang->line('ord_id_lbl')?> :-</td>
                                                        <td><?=$my_order[0]->order_unique_id?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?=$this->lang->line('ord_on_lbl')?> :-</td>
                                                        <td><?=date("M d, Y",$my_order[0]->order_date)?> </td>
                                                    </tr>
                                                    <tr>
                                                        <?php
                                                        $_lbl_class='label-primary';
                                                        $_lbl_title=$ci->get_status_title($my_order[0]->order_status);

                                                        switch ($my_order[0]->order_status) {
                                                            case '1':
                                                                $_lbl_class='btn-default';
                                                            break;
                                                            case '2':
                                                                $_lbl_class='btn-primary';
                                                            break;
                                                            case '3':
                                                                $_lbl_class='btn-warning';
                                                            break;
                                                            case '4':
                                                                $_lbl_class='btn-success';
                                                            break;
                                                              
                                                            default:
                                                                $_lbl_class='btn-danger';
                                                            break;
                                                          }

                                                        ?>
                                                        <td><?=$this->lang->line('ord_status_lbl')?> :-</td>
                                                        <td><button style="padding: 3px 3px 3px 3px;" class="btn <?=$_lbl_class?>"><?=$_lbl_title?></button></td>
                                                        
                                                        <?php 
                                                        echo $my_order[0]->order_status==4 ? '<tr><td>'.$this->lang->line('delivery_on_lbl').':- </td> <td>'.date("M jS, y",$my_order[0]->delivery_date).' </td></tr><tr><td>Download Invoice</td><td><button type="button" style="padding: 3px 3px 3px 3px;" class="btn btn-default btn_download" data-id="'.$my_order[0]->order_unique_id.'">'.$this->lang->line('download_invoice_btn').'</button></td></tr>' : '<tr><td>'.$this->lang->line('expected_delivery_lbl').' :-</td><td> '.date("M jS, y",$my_order[0]->delivery_date).' </td></tr>';
                                                        ?>

                                                        <?php
                                                        if($is_order_claim){
                                                            echo '<tr><td></td><td><a href="javascript:void(0)" class="btn btn-danger cancle_order_btn btn_claim" style="margin-top:10px" data-order="'.$my_order[0]->id.'" data-product="0">
                                                                '.$this->lang->line('claim_refund_btn').'
                                                                </a></td></tr>';
                                                        }
                                                        if($my_order[0]->order_status < 4){
                                                            echo '<tr><td></td><td><a href="javascript:void(0)" class="btn btn-danger cancle_order_btn product_cancel" style="margin-top:10px" data-order="'.$my_order[0]->id.'" data-product="0" data-unique="'.$my_order[0]->order_unique_id.'" data-gateway="'.$ci->get_single_info(array('order_id' => $my_order[0]->id),'gateway','tbl_transaction').'">
                                                                '.$this->lang->line('cancel_ord_btn').'
                                                                </a></td></tr>';
                                                        }
                                                    ?>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <h6><?=$this->lang->line('ord_payment_section_lbl')?> :-</h6>
                                        <div class="table-responsive-sm">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><?=$this->lang->line('total_amt_lbl')?>:</td>
                                                        <td class="text-right"><?=CURRENCY_CODE.' '.number_format($my_order[0]->total_amt, 2)?></td>
                                                    </tr>
                                                    <?php 
                                                        if(!empty($refund_data))
                                                        {
                                                            $cancel_ord_amt=array_sum(array_column($refund_data,'refund_pay_amt'));
                                                            ?>
                                                            <tr>
                                                                <td><?=$this->lang->line('cancel_ord_amt_lbl')?>:</td>
                                                                <td class="text-right">- <?=CURRENCY_CODE.' '.number_format($cancel_ord_amt, 2)?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td><?=$this->lang->line('discount_lbl')?>:</td>
                                                        <td class="text-right">- <?=CURRENCY_CODE.' '.number_format($my_order[0]->discount_amt, 2)?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?=$this->lang->line('delivery_charge_lbl')?>:</td>
                                                        <td class="text-right">+ <?=CURRENCY_CODE.' '.number_format($my_order[0]->delivery_charge, 2)?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?=$this->lang->line('payable_amt_lbl')?>:</td>
                                                        <td class="text-right"><?=CURRENCY_CODE.' '.number_format($my_order[0]->new_payable_amt, 2)?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?=$this->lang->line('payment_mode_lbl')?> :- </td>
                                                        <td class="text-right"><?=strtoupper($this->db->get_where('tbl_transaction', array('order_unique_id' => $my_order[0]->order_unique_id))->row()->gateway)?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?=$this->lang->line('payment_id_lbl')?> :- </td>
                                                        <td class="text-right"><?=$this->db->get_where('tbl_transaction', array('order_unique_id' => $my_order[0]->order_unique_id))->row()->payment_id?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <h6><?=$this->lang->line('ord_address_section_lbl')?> :-</h6>
                                        <div class="table-responsive-sm">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><?=$my_order[0]->name?></td>
                                                    </tr>
                                                     <tr>
                                                        <td><?=$my_order[0]->email?></td>
                                                    </tr>
                                                     <tr>
                                                        <td><?=$my_order[0]->building_name.', '.$my_order[0]->road_area_colony.', '.$my_order[0]->city.', '.$my_order[0]->district.', '.$my_order[0]->state.' - '.$my_order[0]->pincode;?></td>
                                                    </tr>
                                                     <tr>
                                                        <td><?=$this->lang->line('phone_no_lbl')?> : <?=$my_order[0]->mobile_no?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                        <?php 
                                        foreach ($my_order as $key => $value) {

                                            $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $ci->get_single_info(array('id' => $value->product_id),'featured_image','tbl_product'));

                                            $img_file=$ci->_create_thumbnail('assets/images/products/',$thumb_img_nm,$ci->get_single_info(array('id' => $value->product_id),'featured_image','tbl_product'),100,100);

                                          ?>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-2 col-xs-4">
                                                <a href="<?php echo site_url('product/'.$ci->get_single_info(array('id' => $value->product_id),'product_slug','tbl_product')); ?>" target="_blank"><img src="<?=base_url().$img_file?>"  style="width: 100px; height: 100px;" alt=""></a>
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-8">
                                                <a href="<?php echo site_url('product/'.$ci->get_single_info(array('id' => $value->product_id),'product_slug','tbl_product')); ?>" title="<?=$value->product_title?>" target="_blank">
                                                <?php 
                                                    if(strlen($value->product_title) > 45){
                                                        echo substr(stripslashes($value->product_title), 0, 45).'...';  
                                                    }else{
                                                        echo $value->product_title;
                                                    }
                                                    ?>
                                              </a>                
                                              <div><?=$this->lang->line('price_lbl')?>: <?=CURRENCY_CODE.' '.number_format($value->product_price, 2)?></div>
                                              <div><?=$this->lang->line('qty_lbl')?>: <?=$value->product_qty?></div>
                                              <?php 
                                                if($value->product_size!='' AND $value->product_size!='0')
                                                {
                                                    echo '<div>'.$this->lang->line('size_lbl').': '.$value->product_size.'</div>';
                                                }
                                              ?>
                                            </div>
                                            <?php
                                            if($value->pro_order_status!='4' && $value->pro_order_status!='5'){
                                                ?>
                                                <div class="col-md-5 col-sm-5 col-xs-12 col-md-offset-1 text-right">                                            
                                                    <a href="javascript:void(0)" class="btn btn-danger pull-right btn-danger product_cancel" data-order="<?=$value->order_id?>" data-product="<?=$value->product_id?>" data-unique="<?=$value->order_unique_id?>" data-gateway="<?=$ci->get_single_info(array('order_id' => $value->order_id),'gateway','tbl_transaction')?>"><?=$this->lang->line('cancel_btn')?></a>
                                                </div>
                                                <?php
                                            }
                                            else if($value->pro_order_status=='5'){
                                                $cancelled_on=$ci->get_single_info(array('order_id' => $value->order_id, 'product_id' => $value->product_id),'created_at','tbl_refund');
                                            ?>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <span style="color: red;"><?=$this->lang->line('product_cancelled_on_lbl')?> <?=date('d-m-Y h:i A',$cancelled_on)?></span>
                                                        <br>
                                                        <strong><?=$this->lang->line('reason_lbl')?>:</strong>
                                                        <?php echo '<label style="">'.$ci->get_single_info(array('order_id' => $value->order_id, 'product_id' => $value->product_id),'refund_reason','tbl_refund').'</label>';?>
                                                        <?php 
                                                            if($ci->get_single_info(array('order_id' => $value->order_id, 'product_id' => $value->product_id),'gateway','tbl_refund')!='cod')
                                                            {
                                                                switch ($ci->get_single_info(array('order_id' => $value->order_id, 'product_id' => $value->product_id),'request_status','tbl_refund')) {
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
                                                                        if($ci->get_single_info(array('order_id' => $value->order_id, 'product_id' => $value->product_id),'request_status','tbl_refund')=='-1')
                                                                        {
                                                                            echo '<a href="javascript:void(0)" class="form-button pull-right btn-danger btn_claim" data-order="'.$value->order_id.'" data-product="'.$value->product_id.'">'.$this->lang->line('claim_refund_btn').'</a>';
                                                                        }
                                                                    }
                                                            }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                            

                                        </div>
                                        <?php 
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-12">
                                        <hr style="margin: 10px 0px">
                                        <?php 
                                        if($value->pro_order_status!='5')
                                        {
                                        ?>
                                        <div class="product_timeline_block" style="box-shadow: none;">
                                            <section class="cd-horizontal-timeline">
                                                <div class="timeline">
                                                  <?php

                                                    foreach ($status_titles as $key1 => $value1) {
                                                        if($value1->id=='5')
                                                            break;
                                                  ?>
                                                  <div class="dot <?php if($value1->id<=$value->pro_order_status){ echo 'active_dot';}else{ echo 'deactive_dot'; } ?>" id="<?=$value1->id?>" style="<?php if($value->pro_order_status < $value1->id){ echo 'pointer-events: none;cursor: default;';}?>">
                                                    <span></span>
                                                    <date style="width: max-content"><?=$value1->title?></date>
                                                  </div>
                                                  <?php } ?>
                                                  <?php 
                                                    if($value->pro_order_status=='4'){
                                                        ?>
                                                        <div class="inside" style="width: 100% !important"></div>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <div class="inside" style="width: <?=(20*$value->pro_order_status+2)?>% !important"></div>
                                                        <?php
                                                    }
                                                  ?>
                                                  
                                                </div>

                                                <?php 
                                                    $display_first=true;
                                                    foreach ($status_titles as $key1 => $value1) {

                                                        $where=array('order_id' => $my_order[0]->order_id,'status_title' => $value1->id);
                                                ?>
                                                <?php 
                                                    if($ci->get_single_info($where,'status_desc','tbl_order_status')!='')
                                                    {
                                                        ?>
                                                        <article class="modal <?=$value1->id?>" style="<?php if($value1->id==$value->pro_order_status){ echo 'display: block';}?>">
                                                          <date><?=date("M jS,y",$ci->get_single_info($where,'created_at','tbl_order_status'))?></date>
                                                          <h2><?=$value1->title?></h2>
                                                          <p><?=$ci->get_single_info($where,'status_desc','tbl_order_status')?></p>
                                                        </article>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <article class="modal <?=$value1->id?>" style="<?php echo $display_first ? 'display: block' : '';  ?>">
                                                            <h2><?=$this->lang->line('no_ord_status_lbl')?></h2>
                                                        </article>
                                                        <?php
                                                    }
                                                ?>
                                                
                                                <?php $display_first=false; } ?>
                                            </section>
                                        </div>
                                        <?php 
                                        }
                                        else
                                        {
                                        ?>
                                        <div class="product_timeline_block">
                                            <section class="cd-horizontal-timeline">
                                                <div class="timeline">
                                                  <?php

                                                    foreach ($status_titles as $key2 => $value2) {

                                                        if($value2->id!='5' && $value2->id!='1')
                                                            continue;
                                                  ?>
                                                  <div class="dot <?php if($value2->id<=$value->pro_order_status){ echo 'active_dot';}else{ echo 'deactive_dot'; } ?>" id="<?=$value2->id?>">
                                                    <span></span>
                                                    <date style="width: max-content"><?=$value2->title?></date>
                                                  </div>
                                                  <?php } ?>
                                                  <div class="inside" style="width: <?=(20*($value->pro_order_status-3))+2?>% !important"></div>
                                                </div>

                                                <?php 
                                                    $display_first=true;
                                                    foreach ($status_titles as $key2 => $value2) {

                                                        $where=array('order_id' => $my_order[0]->order_id,'status_title' => $value2->id);

                                                ?>
                                                <?php 
                                                    if($ci->get_single_info($where,'status_desc','tbl_order_status')!='')
                                                    {
                                                        ?>
                                                        <article class="modal <?=$value2->id?>" style="<?php if($value2->id==$value->pro_order_status){ echo 'display: block';}?>">
                                                          <date><?=date("M jS,y",$ci->get_single_info($where,'created_at','tbl_order_status'))?></date>
                                                          <h2><?=$value2->title?></h2>
                                                          <p><?=$ci->get_single_info($where,'status_desc','tbl_order_status')?></p>
                                                        </article>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <article class="modal <?=$value2->id?>" style="<?php echo $display_first ? 'display: block' : '';  ?>">
                                                            <h2><?=$this->lang->line('no_ord_status_lbl')?></h2>
                                                        </article>
                                                        <?php
                                                    }
                                                ?>
                                                
                                                <?php $display_first=false; } ?>
                                            </section>
                                        </div>
                                        <?php
                                        }
                                    ?>
                                    </div>
                                </div>
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
                                <div class="address_details_block">
                                    <?php 
                                        foreach ($bank_details as $key => $row_bank) {
                                    ?>
                                    <div class="address_details_item">
                                        <label class="container">
                                          <input type="radio" name="bank_acc_id" class="address_radio" value="<?=$row_bank->id?>" <?php if($row_bank->is_default=='1'){ echo 'checked="checked"';} ?>>
                                          <span class="checkmark"></span>
                                        </label>
                            
                                        <div class="address_list">
                                          <span style="margin-bottom: 0px"><?=$row_bank->bank_name?> (<?=$this->lang->line('bank_acc_no_lbl')?> :<?=$row_bank->account_no?>)</span>
                                          <p style="margin-bottom: 0px"><?=$this->lang->line('bank_type_lbl')?>: <?=ucfirst($row_bank->account_type)?> <br/> <?=$this->lang->line('bank_ifsc_lbl')?>: <?=$row_bank->bank_ifsc?></p>
                                          <p style="margin-bottom: 10px"><?=$this->lang->line('holder_name_lbl')?>: <?=$row_bank->bank_holder_name?> <br/> <?=$this->lang->line('holder_mobile_lbl')?>: <?=$row_bank->bank_holder_phone?></p>
                                        </div>
                                    </div>
                                    <?php } ?>
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

                    <form method="post" accept-charset="utf-8" action="<?php echo site_url('site/add_new_bank'); ?>" class="bank_form" style="display: none;">
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
                    </form>
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
                                    <?php 
                                        foreach ($bank_details as $key => $row_bank) {
                                    ?>
                                    <div class="address_details_item">
                                        <label class="container">
                                          <input type="radio" name="bank_acc_id" class="address_radio" value="<?=$row_bank->id?>" <?php if($row_bank->is_default=='1'){ echo 'checked="checked"';} ?>>
                                          <span class="checkmark"></span>
                                        </label>
                            
                                        <div class="address_list">
                                          <span style="margin-bottom: 0px"><?=$row_bank->bank_name?> (<?=$this->lang->line('bank_acc_no_lbl')?> :<?=$row_bank->account_no?>)</span>
                                          <p style="margin-bottom: 0px"><?=$this->lang->line('bank_type_lbl')?>: <?=ucfirst($row_bank->account_type)?> <br/> <?=$this->lang->line('bank_ifsc_lbl')?>: <?=$row_bank->bank_ifsc?></p>
                                          <p style="margin-bottom: 10px"><?=$this->lang->line('holder_name_lbl')?>: <?=$row_bank->bank_holder_name?> <br/> <?=$this->lang->line('holder_mobile_lbl')?>: <?=$row_bank->bank_holder_phone?></p>
                                        </div>
                                    </div>
                                    <?php } ?>
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

                    <form method="post" accept-charset="utf-8" action="<?php echo site_url('site/add_new_bank'); ?>" class="bank_form" style="<?=(count($bank_details)!=0) ? 'display: none;' : 'display: block;'?>">
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
    unset($_SESSION['payment_msg']);
  } 
?>
       