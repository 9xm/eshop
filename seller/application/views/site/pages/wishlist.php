        <?php include('include/header.php'); ?>
        <?php
            $ci =& get_instance();

            $dataClaimStuff=array('bank_err' => $this->lang->line('cancel_ord_bank_err'), 'please_wait_lbl' => $this->lang->line('please_wait_lbl'), 'done_lbl' => $this->lang->line('done_lbl'));
        ?>

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
                                if(!empty($wishlist))
                                {
                                ?>
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                              <th class="product-remove"></th>
                                              <th class="product-cart-img"> <span class="nobr">Product Image</span> </th>
                                              <th class="product-name"> <span class="nobr">Product Name</span> </th>
                                              <th class="product-price"> <span class="nobr"> Price </span> </th>
                                              <th class="product-add-to-cart">Add To Cart</th>
                                            </tr>
                                          </thead>
                                        <tbody style="border-bottom: 2px solid grey;">
                                            <?php 
                                            $ci =& get_instance();
                                            foreach ($wishlist as $key => $row)
                                            {
                                                $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->featured_image);
                                                
                                                $img_file='assets/images/products/'.$row->featured_image;

                                                $is_avail=true;

                                                if($ci->get_single_info(array('id' => $row->product_id),'status','tbl_product')==0){
                                                  $is_avail=false;
                                                }

                                            ?>
                                                <tr>
                                                  <td class="product-remove"><a href="javascript:void(0)" class="btn_remove_wishlist" data-id="<?=$row->product_id?>" style="color: black;">×</a></td>
                                                  <td <?=(!$is_avail) ? 'style="opacity: 0.5;"' : ''?> class="product-cart-img"><a href="javascript:void(0)"><img src="<?=base_url().$img_file?>" alt="<?=$row->product_slug?>" style="width: 100px;height: 100px"></a></td>
                                                  <td class="product-name">
                                                    <a href="<?php echo site_url('product/'.$row->product_slug); ?>" style="color: black;<?=(!$is_avail) ? 'pacity: 0.5;' : ''?>">
                                                      <?php
                                                        if(strlen($row->product_title) > 30){
                                                          echo substr(stripslashes($row->product_title), 0, 30).'...';  
                                                        }else{
                                                          echo $row->product_title;
                                                        }
                                                      ?>
                                                    </a>
                                                    <?php 
                                                      if(!$is_avail){
                                                        echo '<p style="color: red;background: #FFF;display: inline-block;box-shadow: 0px 5px 10px #ccc;padding: 5px 10px;line-height: initial">'.$this->lang->line('unavailable_lbl').'</p>';
                                                      }
                                                    ?>
                                                  </td>
                                                  <td <?=(!$is_avail) ? 'style="opacity: 0.5"' : ''?> class="product-price" nowrap="">
                                                    <span>
                                                      <?php 
                                                        if($row->you_save_amt!='0'){
                                                          ?>
                                                          <ins><?=CURRENCY_CODE.' '.number_format($row->selling_price, 2)?></ins> 
                                                          <del><?=CURRENCY_CODE.' '.number_format($row->product_mrp, 2);?></del>
                                                          <?php
                                                        }
                                                        else{
                                                          ?>
                                                          <ins><?=CURRENCY_CODE.' '.number_format($row->product_mrp, 2);?></ins>
                                                          <?php
                                                          
                                                        }
                                                      ?>
                                                    </span>
                                                  </td>
                                                  <td <?=(!$is_avail) ? 'style="opacity: 0.5"' : ''?> class="product-add-to-cart">
                                                    <a href="javascript:void(0)" class="wishlist-btn btn_cart btn btn-primary <?=(!$is_avail) ? 'disabled"' : ''?>" data-id="<?=$row->product_id?>" data-maxunit="<?=$row->max_unit_buy?>"><?=$this->lang->line("add_cart_lbl")?></a>
                                                  </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    

                                    </table>
                                </div>
                            
                                <?php }else{ ?>
                                <center style="margin-bottom: 50px;">
                                    <img src="<?=base_url('assets/img/my_order.png')?>">
                                    <h2 style="font-size: 18px;font-weight: 500;color: #888;"><?=$this->lang->line('empty_wishlist_lbl')?></h2>
                                    <br/>
                                    <a href="<?=base_url('/')?>"><img src="<?=base_url('assets/images/continue-shopping-button.png')?>"></a>
                                </center>
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
          $(".btn_cart").click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var _id=$(this).data("id");
            var _maxunit=$(this).data("maxunit");

            href = '<?=base_url()?>site/cart_action';

            $.ajax({
              url:href,
              data: {"product_id": _id},
              type:'post',
              success:function(res){
                  if(res=='login_now'){
                    window.location.href = "<?php echo site_url('login-register'); ?>";
                  }
                  else{

                    var obj = $.parseJSON(res); 

                    $("#cartModel .modal-body").html(obj.html_code);
                    $("#cartModel").modal("show");

                    $('.radio-group .radio_btn').click(function(){
                        $(this).parent().find('.radio_btn').removeClass('selected');
                        $(this).addClass('selected');
                        var val = $(this).attr('data-value');
                        $(this).parent().find('input').val(val);
                    });

                    $("input[name='product_qty']").blur(function(){
                      if($(this).val() <= 0){
                        $(this).val(1);
                      }
                      else if($(this).val() > _maxunit){
                        alert("You cannot buy more than "+_maxunit+" items in single order !!!");
                        $(this).val(_maxunit);
                      }
                    });
                  }
                },
                error : function(res) {
                    alert("error");
                }

            });
          });

        </script>
       