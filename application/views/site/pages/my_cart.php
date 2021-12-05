        <?php include('include/header.php'); 
        $ci =& get_instance();

        $total_cart_amt=$delivery_charge=0;
        ?>

        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main" class="cart-page">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?php echo base_url('/'); ?>">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $current_page; ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="mb-4">
                            <h1 class="text-center"><?= $page_title; ?></h1>
                        </div>
                        <div class="mb-10">
                            
                            <?php 
                            $is_items=false;
                            if(!empty($my_cart))
                            {
                                $is_items=true;
                            ?>
                            <form class="mb-4 cartUpdate" method="post" action="<?=site_url('site/update_cart')?>">
        
                                <input type="hidden" name="cart_id" value="">
                                <input type="hidden" name="product_qty" value="">
                                <div class="table-responsive-sm">
                                <table class="table" cellspacing="0">
                                    <!--<thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-name">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity w-lg-15">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>-->
                                    <tbody>
                                        <?php 
                                        foreach ($my_cart as $key => $value) {
                            
                                            $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value->featured_image);
                                            
                                            $img_file='assets/images/products/'.$value->featured_image;
        
                                            $is_avail=true;
        
                                            if($ci->get_single_info(array('id' => $value->product_id),'status','tbl_product')==0){
                                              $is_avail=false;
                                            }
                                        ?>
                                        <tr class="">
                                            <td class="text-center">
                                                <a href="<?php echo site_url('remove-to-cart/'.$value->id); ?>" class="btn_remove_cart text-gray-32 font-size-26">×</a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)"><img class="img-fluid max-width-100 p-1 border border-color-1" src="<?=base_url().$img_file?>" style="width: 70px;height: 70px;" alt="Image Description"></a>
                                                
                                            </td>
        
                                            <td style="min-width: 150px;">
                                                <a href="<?=(!$is_avail) ? 'javascript:void(0)' : site_url('product/'.$ci->get_single_info(array('id' => $value->product_id),'product_slug','tbl_product'));?>" class="text-gray-90">
                                                    <?php 
                                                         echo $value->product_title;
                                                    ?>
                                                </a>
                                                <?php 
                                                  if(!$is_avail){
                                                    echo '<p style="color: red;background: #FFF;display: inline-block;box-shadow: 0px 5px 10px #ccc;padding: 5px 10px;line-height: initial">'.$this->lang->line('unavailable_lbl').'</p>';
                                                  }
                                                ?>
                                            </td>
        
                                            <!--<td>
                                                <span class="">
                                                    <?php 
        
                                                    $actual_price='';
        
                                                    if($value->you_save_amt!='0'){
                                                      ?>
                                                      <ins><?=CURRENCY_CODE.' '.number_format($actual_price=($value->selling_price * $value->product_qty), 2)?></ins>
                                                      &nbsp;
                                                      <del><?=CURRENCY_CODE.' '.number_format(($value->product_mrp * $value->product_qty), 2);?></del>
                                                      <?php
                                                    }
                                                    else{
                                                      ?>
                                                      <ins><?=CURRENCY_CODE.' '.number_format($actual_price=($value->product_mrp * $value->product_qty), 2);?></ins>
                                                      <?php
                                                      
                                                    }
                                                  ?>
                                                </span>
                                            </td>
        -->
                                            <td>
                                                <span class="sr-only">Quantity</span>
                                                <!-- Quantity -->
                                                
                                                <input type="hidden" name="crt_id" value="<?=$value->id?>">
                                                <select class="product_qty" <?=(!$is_avail) ? 'disabled="disabled"' : ''?>>
                                                  <?php 
                                                    for ($i=1; $i <= $value->max_unit_buy; $i++) { 
                                                  ?>
                                                  <option value="<?=$i?>" <?php if($i==$value->product_qty){ echo 'selected';} ?>><?=$i?></option>
                                                  <?php } ?>
                                                </select>
                                                    
                                                <!-- End Quantity -->
                                            </td>
        
                                            <td>
                                                <span class=""><?=CURRENCY_CODE.' '.number_format($actual_price, 2)?></span>
                                            </td>
                                        </tr>
                                        <?php
                                            $total_cart_amt+=$actual_price;
                                            $delivery_charge+=$value->delivery_charge;
                                          }
                                          $total_cart_amt+=$delivery_charge;
                                        ?>
                                        
                                    </tbody>
                                </table>
                                </div>
                            </form>
                            <?php 
                            }
                            else
                            {
                            ?>
                            <center style="margin-bottom: 50px;">
                                <img src="<?=base_url('assets/img/my_order.png')?>">
                                <h2 style="font-size: 18px;font-weight: 500;color: #888;"><?=$this->lang->line('empty_cart_lbl')?></h2>
                                <br/>
                                <a href="<?=base_url('/')?>"><img src="<?=base_url('assets/images/continue-shopping-button.png')?>"></a>
                            </center>
                            <?php   
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="mb-8 cart-total">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="border-bottom border-color-1 mb-3">
                                <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Cart totals</h3>
                            </div>
                            <table class="table mb-3 mb-md-0">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td data-title="Subtotal"><span class="amount"><?=CURRENCY_CODE.' '.number_format(($total_cart_amt-$delivery_charge), 2)?></span></td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Delivery Charge</th>
                                        <td data-title="Shipping">
                                            <span class="amount"><?=($delivery_charge!=0)?'+ '.CURRENCY_CODE.number_format($delivery_charge, 2):$this->lang->line('free_lbl');?></span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td data-title="Total"><strong><span class="amount"><?=CURRENCY_CODE.' '.number_format($total_cart_amt, 2)?></span></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                              echo form_open('checkout', ['id' => 'frmUsers','method' => 'GET']);
                              ?>
                              <button type="submit" class="checkout-button btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100"><?=$this->lang->line('proceed_checkout_btn')?></button>
                              
                              <?php
                              echo form_close();
                            ?>  
                            
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            <!--<div class="mb-4">
                    <h1 class="text-center"><?= $page_title; ?></h1>
                </div>
                <div class="mb-10">
                    
                    <?php 
                    $is_items=false;
                    if(!empty($my_cart))
                    {
                        $is_items=true;
                    ?>
                    <form class="mb-4 cartUpdate" method="post" action="<?=site_url('site/update_cart')?>">

                        <input type="hidden" name="cart_id" value="">
                        <input type="hidden" name="product_qty" value="">
                        <div class="table-responsive-sm">
                        <table class="table" cellspacing="0">
                            <!--<thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-name">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity w-lg-15">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($my_cart as $key => $value) {
                    
                                    $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value->featured_image);
                                    
                                    $img_file='assets/images/products/'.$value->featured_image;

                                    $is_avail=true;

                                    if($ci->get_single_info(array('id' => $value->product_id),'status','tbl_product')==0){
                                      $is_avail=false;
                                    }
                                ?>
                                <tr class="">
                                    <td class="text-center">
                                        <a href="<?php echo site_url('remove-to-cart/'.$value->id); ?>" class="btn_remove_cart text-gray-32 font-size-26">×</a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"><img class="img-fluid max-width-100 p-1 border border-color-1" src="<?=base_url().$img_file?>" style="width: 90px;height: 90px;" alt="Image Description"></a>
                                        
                                    </td>

                                    <td>
                                        <a href="<?=(!$is_avail) ? 'javascript:void(0)' : site_url('product/'.$ci->get_single_info(array('id' => $value->product_id),'product_slug','tbl_product'));?>" class="text-gray-90">
                                            <?php 
                                                 echo $value->product_title;
                                            ?>
                                        </a>
                                        <?php 
                                          if(!$is_avail){
                                            echo '<p style="color: red;background: #FFF;display: inline-block;box-shadow: 0px 5px 10px #ccc;padding: 5px 10px;line-height: initial">'.$this->lang->line('unavailable_lbl').'</p>';
                                          }
                                        ?>
                                    </td>

                                    <td>
                                        <span class="">
                                            <?php 

                                            $actual_price='';

                                            if($value->you_save_amt!='0'){
                                              ?>
                                              <ins><?=CURRENCY_CODE.' '.number_format($actual_price=($value->selling_price * $value->product_qty), 2)?></ins>
                                              &nbsp;
                                              <del><?=CURRENCY_CODE.' '.number_format(($value->product_mrp * $value->product_qty), 2);?></del>
                                              <?php
                                            }
                                            else{
                                              ?>
                                              <ins><?=CURRENCY_CODE.' '.number_format($actual_price=($value->product_mrp * $value->product_qty), 2);?></ins>
                                              <?php
                                              
                                            }
                                          ?>
                                        </span>
                                    </td>

                                    <td>
                                        
                                        
                                        <input type="hidden" name="crt_id" value="<?=$value->id?>">
                                        <select class="product_qty" <?=(!$is_avail) ? 'disabled="disabled"' : ''?>>
                                          <?php 
                                            for ($i=1; $i <= $value->max_unit_buy; $i++) { 
                                          ?>
                                          <option value="<?=$i?>" <?php if($i==$value->product_qty){ echo 'selected';} ?>><?=$i?></option>
                                          <?php } ?>
                                        </select>
                                            
                                        
                                    </td>

                                    <td>
                                        <span class=""><?=CURRENCY_CODE.' '.number_format($actual_price, 2)?></span>
                                    </td>
                                </tr>
                                <?php
                                    $total_cart_amt+=$actual_price;
                                    $delivery_charge+=$value->delivery_charge;
                                  }
                                  $total_cart_amt+=$delivery_charge;
                                ?>
                                
                            </tbody>
                        </table>
                        </div>
                    </form>
                    <?php 
                    }
                    else
                    {
                    ?>
                    <center style="margin-bottom: 50px;">
                        <img src="<?=base_url('assets/img/my_order.png')?>">
                        <h2 style="font-size: 18px;font-weight: 500;color: #888;"><?=$this->lang->line('empty_cart_lbl')?></h2>
                        <br/>
                        <a href="<?=base_url('/')?>"><img src="<?=base_url('assets/images/continue-shopping-button.png')?>"></a>
                    </center>
                    <?php   
                    }
                    ?>
                </div>
                <?php 
                if($is_items)
                {
                ?>
                <div class="mb-8 cart-total">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                            <div class="border-bottom border-color-1 mb-3">
                                <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Cart totals</h3>
                            </div>
                            <table class="table mb-3 mb-md-0">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td data-title="Subtotal"><span class="amount"><?=CURRENCY_CODE.' '.number_format(($total_cart_amt-$delivery_charge), 2)?></span></td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Delivery Charge</th>
                                        <td data-title="Shipping">
                                            <span class="amount"><?=($delivery_charge!=0)?'+ '.CURRENCY_CODE.number_format($delivery_charge, 2):$this->lang->line('free_lbl');?></span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td data-title="Total"><strong><span class="amount"><?=CURRENCY_CODE.' '.number_format($total_cart_amt, 2)?></span></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                              echo form_open('checkout', ['id' => 'frmUsers','method' => 'GET']);
                              ?>
                              <button type="submit" class="checkout-button btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100"><?=$this->lang->line('proceed_checkout_btn')?></button>
                              
                              <?php
                              echo form_close();
                            ?>  
                            
                        </div>
                    </div>
                </div>
                <?php 
                }
                ?>-->
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->

        <?php include('include/footer2.php');?>
        <script type="text/javascript">
            $(".product_qty").change(function(e){
                $("input[name='cart_id']").val($(this).prev("input").val());
                $("input[name='product_qty']").val($(this).val());
                $(this).parents(".cartUpdate").trigger("submit");
            });
        </script>