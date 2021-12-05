        <?php include('include/header.php');?>

        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?php echo base_url('/') ?>">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $page_title; ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->
            <?php 
            if(!empty($compare))
            {
            ?>
            <div class="container">
                <div class="table-responsive table-bordered table-compare-list mb-10 border-0">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="min-width-200">Product</th>
                                <?php 
                                if(!empty($compare[0]))
                                {
                                ?>
                                <td>
                                    <a href="<?php echo site_url('product/'.$compare[0]->product_slug); ?>" class="product d-block">
                                        <div class="product-compare-image">
                                            <div class="d-flex mb-3">
                                                <img class="img-fluid mx-auto" src="<?= base_url() ?>assets/images/products/<?=$compare[0]->featured_image;?>" alt="Image Description" style="width: 200px;height: 200px;">
                                            </div>
                                        </div>
                                        <h3 class="product-item__title text-blue font-weight-bold mb-3"><?= $compare[0]->product_title ?></h3>
                                    </a>
                                    <div class=" mb-2">
                                        <?php 
                                        for ($x = 0; $x < 5; $x++) { 
                                          if($x < $compare[0]->rate_avg){
                                            ?>
                                            <i class="fa fa-star" style="color: #F9BA48;font-size:14px;"></i>
                                            <?php  
                                          }
                                          else{
                                            ?>
                                            <i class="fa fa-star"  style="font-size:14px;"></i>
                                            <?php
                                          }
                                        }
                                        ?>
                                    </div>
                                </td>
                                <?php 
                                }
                                if(!empty($compare[1]))
                                {
                                ?>
                                <td>
                                    <a href="<?php echo site_url('product/'.$compare[1]->product_slug); ?>" class="product">
                                        <div class="product-compare-image">
                                            <div class="d-flex mb-3">
                                                <img class="img-fluid mx-auto" src="<?= base_url() ?>assets/images/products/<?=$compare[1]->featured_image;?>" alt="Image Description" style="width: 200px;height: 200px;">
                                            </div>
                                        </div>
                                        <h3 class="product-item__title text-blue font-weight-bold mb-3"><?= $compare[1]->product_title ?></h3>
                                    </a>
                                    <div class=" mb-2">
                                        <?php 
                                        for ($x = 0; $x < 5; $x++) { 
                                          if($x < $compare[1]->rate_avg){
                                            ?>
                                            <i class="fa fa-star" style="color: #F9BA48;font-size:14px;"></i>
                                            <?php  
                                          }
                                          else{
                                            ?>
                                            <i class="fa fa-star"  style="font-size:14px;"></i>
                                            <?php
                                          }
                                        }
                                        ?>
                                    </div>
                                </td>
                                <?php 
                                }
                                if(!empty($compare[2]))
                                {
                                ?>
                                <td>
                                    <a href="<?php echo site_url('product/'.$compare[2]->product_slug); ?>" class="product">
                                        <div class="product-compare-image">
                                            <div class="d-flex mb-3">
                                                <img class="img-fluid mx-auto" src="<?= base_url() ?>assets/images/products/<?=$compare[2]->featured_image;?>" alt="Image Description" style="width: 200px;height: 200px;">
                                            </div>
                                        </div>
                                        <h3 class="product-item__title text-blue font-weight-bold mb-3"><?= $compare[2]->product_title ?></h3>
                                    </a>
                                    <div class=" mb-2">
                                        <?php 
                                        for ($x = 0; $x < 5; $x++) { 
                                          if($x < $compare[2]->rate_avg){
                                            ?>
                                            <i class="fa fa-star" style="color: #F9BA48;font-size:14px;"></i>
                                            <?php  
                                          }
                                          else{
                                            ?>
                                            <i class="fa fa-star"  style="font-size:14px;"></i>
                                            <?php
                                          }
                                        }
                                        ?>
                                    </div>
                                </td>
                                <?php } ?>
                            </tr>

                            <tr>
                                <th>Price</th>
                                <?php 
                                if(!empty($compare[0]))
                                {
                                ?>
                                <td>
                                    <?php 
                                    if($compare[0]->you_save_amt!='0')
                                    {
                                    ?>
                                    <div class="product-price"><?=CURRENCY_CODE.' '.number_format($compare[0]->selling_price, 2)?></div>
                                    <?php 
                                    }
                                    else
                                    {
                                    ?>
                                    <div class="product-price"><?=CURRENCY_CODE.' '.number_format($compare[0]->product_mrp, 2)?></div>
                                    <?php    
                                    }
                                    ?>
                                </td>
                                <?php 
                                }
                                if(!empty($compare[1]))
                                {
                                ?>
                                <td>
                                    <?php 
                                    if($compare[1]->you_save_amt!='0')
                                    {
                                    ?>
                                    <div class="product-price"><?=CURRENCY_CODE.' '.number_format($compare[1]->selling_price, 2)?></div>
                                    <?php 
                                    }
                                    else
                                    {
                                    ?>
                                    <div class="product-price"><?=CURRENCY_CODE.' '.number_format($compare[1]->product_mrp, 2)?></div>
                                    <?php    
                                    }
                                    ?>
                                </td>
                                <?php 
                                }
                                if(!empty($compare[2]))
                                {
                                ?>
                                <td>
                                    <?php 
                                    if($compare[2]->you_save_amt!='0')
                                    {
                                    ?>
                                    <div class="product-price"><?=CURRENCY_CODE.' '.number_format($compare[2]->selling_price, 2)?></div>
                                    <?php 
                                    }
                                    else
                                    {
                                    ?>
                                    <div class="product-price"><?=CURRENCY_CODE.' '.number_format($compare[2]->product_mrp, 2)?></div>
                                    <?php    
                                    }
                                    ?>
                                </td>
                                <?php } ?>
                            </tr>

                            <!-- <tr>
                                <th>Availability</th>
                                <?php 
                                if(!empty($compare[0]))
                                {
                                ?>
                                <td><span>In stock</span></td>
                                <?php 
                                }
                                if(!empty($compare[1]))
                                {
                                ?>
                                <td><span>In stock</span></td>
                                <?php 
                                }
                                if(!empty($compare[2]))
                                {
                                ?>
                                <td><span>In stock</span></td>
                                <?php } ?>
                            </tr> -->

                            <tr>
                                <th>Description</th>
                                <?php 
                                if(!empty($compare[0]))
                                {
                                ?>
                                <td><?= $compare[0]->product_desc ?></td>
                                <?php 
                                }
                                if(!empty($compare[1]))
                                {
                                ?>
                                <td><?= $compare[1]->product_desc ?></td>
                                <?php 
                                }
                                if(!empty($compare[2]))
                                {
                                ?>
                                <td><?= $compare[2]->product_desc ?></td>
                                <?php } ?>
                            </tr>

                            <tr>
                                <th>Add to cart</th>
                                <?php 
                                if(!empty($compare[0]))
                                {
                                ?>
                                <td>
                                    <?php
                                    $user_id=$this->session->userdata('user_id') ? $this->session->userdata('user_id'):'0'; 
                                    if(!$ci->check_cart($compare[0]->product_id,$user_id)){
                                    ?>
                                    <div class="  prodcut-add-cart">
                                        <a href="javascript:void(0)" data-id="<?=$compare[0]->product_id?>" data-maxunit="<?=$compare[0]->max_unit_buy?>" data-toggle="tooltip" title="<?=$this->lang->line('add_cart_lbl')?>" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-3 px-xl-5">Add to cart</a>
                                    </div>
                                    <?php } else { 
                                    $cart_id=$ci->get_single_info(array('product_id' => $compare[0]->product_id, 'user_id' => $user_id),'id','tbl_cart');
                                    ?>
                                    <div class=" prodcut-add-cart">
                                        <a href="<?php echo site_url('remove-to-cart/'.$cart_id); ?>" title="<?=$this->lang->line('remove_cart_lbl')?>" class=" btn_remove_cart btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-3 px-xl-5">Remove from cart</a>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php 
                                }
                                if(!empty($compare[1]))
                                {
                                ?>
                                <td>
                                    <?php
                                    $user_id=$this->session->userdata('user_id') ? $this->session->userdata('user_id'):'0'; 
                                    if(!$ci->check_cart($compare[1]->product_id,$user_id)){
                                    ?>
                                    <div class="prodcut-add-cart">
                                        <a href="javascript:void(0)" data-id="<?=$compare[1]->product_id?>" data-maxunit="<?=$compare[1]->max_unit_buy?>" data-toggle="tooltip" title="<?=$this->lang->line('add_cart_lbl')?>" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-3 px-xl-5">Add to cart</a>
                                    </div>
                                    <?php } else { 
                                    $cart_id=$ci->get_single_info(array('product_id' => $compare[1]->product_id, 'user_id' => $user_id),'id','tbl_cart');
                                    ?>
                                    <div class="prodcut-add-cart">
                                        <a href="<?php echo site_url('remove-to-cart/'.$cart_id); ?>" title="<?=$this->lang->line('remove_cart_lbl')?>" class=" btn_remove_cart btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-3 px-xl-5">Remove from cart</a>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php 
                                }
                                if(!empty($compare[2]))
                                {
                                ?>
                                <td>
                                    <?php
                                    $user_id=$this->session->userdata('user_id') ? $this->session->userdata('user_id'):'0'; 
                                    if(!$ci->check_cart($compare[2]->product_id,$user_id)){
                                    ?>
                                    <div class="prodcut-add-cart">
                                        <a href="javascript:void(0)" data-id="<?=$compare[2]->product_id?>" data-maxunit="<?=$compare[2]->max_unit_buy?>" data-toggle="tooltip" title="<?=$this->lang->line('add_cart_lbl')?>" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-3 px-xl-5">Add to cart</a>
                                    </div>
                                    <?php } else { 
                                    $cart_id=$ci->get_single_info(array('product_id' => $compare[2]->product_id, 'user_id' => $user_id),'id','tbl_cart');
                                    ?>
                                    <div class="prodcut-add-cart">
                                        <a href="<?php echo site_url('remove-to-cart/'.$cart_id); ?>" title="<?=$this->lang->line('remove_cart_lbl')?>" class=" btn_remove_cart btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-3 px-xl-5">Remove from cart</a>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php } ?>
                            </tr>
                            
                            <tr>
                                <th>brands</th>
                                <?php 
                                if(!empty($compare[0]))
                                {
                                ?>
                                <td><?= $ci->get_single_info(array('id' => $compare[0]->brand_id),'brand_name','tbl_brands'); ?></td>
                                <?php 
                                }
                                if(!empty($compare[1]))
                                {
                                ?>
                                <td><?= $ci->get_single_info(array('id' => $compare[1]->brand_id),'brand_name','tbl_brands'); ?></td>
                                <?php 
                                }
                                if(!empty($compare[2]))
                                {
                                ?>
                                <td><?= $ci->get_single_info(array('id' => $compare[2]->brand_id),'brand_name','tbl_brands'); ?></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <th>Color</th>
                                <?php 
                                if(!empty($compare[0]))
                                {
                                ?>
                                <td><?= strtok($compare[0]->color, '/'); ?></td>
                                <?php 
                                }
                                if(!empty($compare[1]))
                                {
                                ?>
                                <td><?= strtok($compare[1]->color, '/'); ?></td>
                                <?php 
                                }
                                if(!empty($compare[2]))
                                {
                                ?>
                                <td><?= strtok($compare[2]->color, '/'); ?></td>
                                <?php } ?>
                                
                            </tr>

                            <tr>
                                <th>Remove</th>
                                <?php 
                                if(!empty($compare[0]))
                                {
                                ?>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-id="<?=$compare[0]->product_id?>" data-toggle="tooltip"  title="Remove From Compare" class="text-gray-90 btn_remove_comapre"><i class="fa fa-times"></i></a>
                                    <a href="#" class="text-gray-90"></a>
                                </td>
                                <?php 
                                }
                                if(!empty($compare[1]))
                                {
                                ?>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-id="<?=$compare[1]->product_id?>" data-toggle="tooltip"  title="Remove From Compare" class="text-gray-90 btn_remove_comapre"><i class="fa fa-times"></i></a>
                                    <a href="#" class="text-gray-90"></a>
                                </td>
                                <?php 
                                }
                                if(!empty($compare[2]))
                                {
                                ?>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-id="<?=$compare[2]->product_id?>" data-toggle="tooltip"  title="Remove From Compare" class="text-gray-90 btn_remove_comapre"><i class="fa fa-times"></i></a>
                                    <a href="#" class="text-gray-90"></a>
                                </td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php 
            }
            else
            {
            ?>
            <div class="container">
                <div class="mb-5 text-center pb-3 border-bottom border-color-1">
                    <img src="<?=base_url('assets/img/no_data.png')?>">
                <h2 style="font-size: 18px;font-weight: 500;color: #888;"><?=$this->lang->line('no_data')?></h2>
                <br/>
                
                </div>
            </div>
            <?php    
            }
            ?>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer.php'); ?>
