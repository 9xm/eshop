        <?php include('include/header.php'); ?>
        <?php
            $ci =& get_instance();
        ?>
        <style type="text/css">
        .rating-stars ul {
            list-style-type: none;
            padding: 0;
            -moz-user-select: none;
            -webkit-user-select: none;
        }
        .rating-stars ul > li.star {
            display: inline-block;
        }
        .rating-stars ul > li.star > i.fa {
            font-size: 1.5em;
            color: #ccc;
        }
        .rating-stars ul > li.star.hover > i.fa {
            color: #FF912C;
            cursor: pointer;
        }
        .rating-stars ul > li.star.selected > i.fa {
            color: #FF912C;
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
                                <h3 class="section-title mb-0 pb-2 font-size-25"><?=$this->lang->line('myreviewrating_lbl')?></h3>
                            </div>
                        
                            <div class="container">
                                <?php 
                                if(!empty($my_review))
                                {
                                ?>
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <!-- <thead>
                                            <tr>
                                              <th class="product-remove"></th>
                                              <th class="product-cart-img"> <span class="nobr">Product Image</span> </th>
                                              <th class="product-name"> <span class="nobr">Product Name</span> </th>
                                              <th class="product-price"> <span class="nobr"> Price </span> </th>
                                              <th class="product-add-to-cart">Add To Cart</th>
                                            </tr>
                                          </thead> -->
                                        <tbody style="border-bottom: 2px solid grey;">
                                            <?php 
                                            foreach ($my_review as $key => $value) 
                                            {

                                                $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $ci->get_single_info(array('id' => $value->product_id),'featured_image','tbl_product'));

                                                $img_file=$ci->_create_thumbnail('assets/images/products/',$thumb_img_nm,$ci->get_single_info(array('id' => $value->product_id),'featured_image','tbl_product'),200,200);
                                            ?>
                                                <tr>
                                                    <td class="product-cart-img">
                                                        <a href="<?php echo site_url('product/'.$ci->get_single_info(array('id' => $value->product_id),'product_slug','tbl_product')); ?>" target="_blank"><img src="<?=base_url().$img_file?>" alt="" style="width: 100px;height: 100px"></a>
                                                    </td>
                                                    <td class="product-name">
                                                        <a href="<?php echo site_url('product/'.$ci->get_single_info(array('id' => $value->product_id),'product_slug','tbl_product')); ?>" target="_blank" style="font-weight:500">
                                                            <?php echo $ci->get_single_info(array('id' => $value->product_id),'product_title','tbl_product'); ?>
                                                                
                                                        </a>
                                                        <br>
                                                        <?=nl2br(stripslashes($value->rating_desc))?>
                                                        <br>
                                                        <?php 
                                                          for ($x = 0; $x < 5; $x++) { 
                                                            if($x < $value->rating){
                                                              ?>
                                                              <i class="fa fa-star" style="color: #F9BA48;"></i>
                                                              <?php  
                                                            }
                                                            else{
                                                              ?>
                                                              <i class="fa fa-star on-color"></i>
                                                              <?php
                                                            }
                                                          }
                                                        ?>
                                                        <input type="hidden" class="review_content" value="<?php echo $value->rating_desc; ?>">
                                                        <a class="review-link edit_review" href="" data-rating='<?php echo $value->rating; ?>' data-id='<?php echo $value->id; ?>'>(<?=$this->lang->line('edit_review_lbl')?>)</a>
                                                    </td>
                                                    <td class="product-add-to-cart">
                                                        <a href="javascript:void(0)" class="form-button pull-right btn-danger btn_remove_review" data-id="<?=$value->id?>"><?=$this->lang->line('delete_btn')?></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php }else{ ?>
                                <center style="margin-bottom: 50px;">
                                    <img src="<?=base_url('assets/img/my_order.png')?>">
                                    <h2 style="font-size: 18px;font-weight: 500;color: #888;"><?=$this->lang->line('no_review_lbl')?></h2>
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
        <div id="edit_review" class="modal fade" role="dialog" style="z-index: 99999">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-details">
                            <h3 style="font-weight: 500"><?=$this->lang->line('edit_review_lbl')?></h3>
                            <br/>
                            <div class="ceckout-form" style="background: none;border:none;">
                                <form action="" method="post" id="edit_review_form">
                                    <input type="hidden" name="review_id" value="">
                                    <input type="hidden" class="inp_rating" name="rating" value="">
                                    <label><?=$this->lang->line('your_rating_lbl')?></label>
                                    <div class="rating"> 
                                        <div class='rating-stars'>
                                            <ul id='stars'>
                                              <li class='star selected' title='<?=$this->lang->line('rate_poor_lbl')?>' data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                              </li>
                                              <li class='star' title='<?=$this->lang->line('rate_fair_lbl')?>' data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                              </li>
                                              <li class='star' title='<?=$this->lang->line('rate_good_lbl')?>' data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                              </li>
                                              <li class='star' title='<?=$this->lang->line('rate_excellent_lbl')?>' data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                              </li>
                                              <li class='star' title='<?=$this->lang->line('rate_wow_lbl')?>' data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                              </li>
                                            </ul>
                                          </div> 
                                    </div>
                                    <br/>
                                    <div class="form-fild">
                                        <div class="wizard-form-field">
                                            <div class="wizard-form-input has-float-label" style="margin-bottom: 0px">
                                              <textarea placeholder="<?=$this->lang->line('reviews_place_lbl')?>" name="message" cols="40" rows="8"></textarea>
                                              <label><?=$this->lang->line('reviews_place_lbl')?></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="add-to-link" style="margin-top: 15px">
                                        <button class="form-button" type="submit" data-text="save"><?=$this->lang->line('save_btn')?></button>
                                        <button class="form-button" type="button" data-dismiss="modal"><?=$this->lang->line('close_btn')?></button>
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

    $(".edit_review").on("click",function(e){
        e.preventDefault();

        var onStar = parseInt($(this).data('rating'), 10); // The star currently selected
        var stars = $('#stars li').parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        $('#edit_review').find(".inp_rating").val(parseInt($(this).data('rating'), 10));
        $('#edit_review').find("input[name='review_id']").val($(this).data('id'));
        $('#edit_review').find("textarea[name='message']").val($(this).parents(".product-rating").find("input.review_content").val());


        var arrIds = $(this).parents(".product-rating").find('input[name="review_images[]"]').map(function () {
            return $(this).data("id");
        }).get();

        var arrImage = $(this).parents(".product-rating").find('input[name="review_images[]"]').map(function () {
            return $(this).val();
        }).get();

        var joinArr = arrIds.map((el, i) => {
          return [arrIds[i], arrImage[i]];
        });

        var mainArr = Object.fromEntries(joinArr);

        var html='<div class="row upload_img_part">';

        var elem='';

        $("#edit_review").find(".img_container").html('');

        $.each(mainArr,function(index, value) 
        {
            html+='<div class="review_img_holder"><img src="'+value+'" /><br/><a href="javascript:void(0)" class="btn_remove_img" data-id="'+index+'" style="color: #F00">&times;</a></div>';
        });

        html+='</div>';

        $("#edit_review").find(".img_container").html(html);

        $(".btn_remove_img").click(function(event){
            event.preventDefault();

            var _ele=$(this).parent(".review_img_holder");

            var href = '<?=base_url()?>site/remove_review_image';

            var id=$(this).data("id");

            swal({
                title: "<?=$this->lang->line('are_you_sure_msg')?>",
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
                if (isConfirm) {

                    $.ajax({
                        url:href,
                        data: {"id": id},
                        type:'post',
                        success:function(res){
                            var obj = $.parseJSON(res); 
                            swal.close();
                            if(obj.success==1){
                                _ele.remove();
                                $('.notifyjs-corner').empty();
                                $.notify(
                                    obj.message, 
                                    { position:"top right",className: obj.class }
                                );
                            }
                            else{
                                swal("<?=$this->lang->line('something_went_wrong_err')?>");
                            }
                        }
                    });

                }else{
                    swal.close();
                }
            });
        });

        $('#edit_review').modal({
            backdrop: 'static',
            keyboard: false
        })
    });


    $("#edit_review_form").on("submit",function(e){
        e.preventDefault();
        $(".process_loader").show();

        var formData = new FormData($(this)[0]);

        var href = '<?=base_url()?>site/edit_review';

        $.ajax({
            url: href,
            processData: false,
            contentType: false,
            type: 'POST',
            data: formData,
            success: function(data){

              var obj = $.parseJSON(atob(data));
              $(".process_loader").hide();
              $('#edit_review').modal("hide");

              if(obj.success=='1'){
                swal({ title: "<?=$this->lang->line('updated_lbl')?>", text: obj.message, type: "success" }, function(){ location.reload(); });
              }
              else{
                swal("<?=$this->lang->line('something_went_wrong_err')?>", obj.message);
              }

            }
        });
    });
</script>
       