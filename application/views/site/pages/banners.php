
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
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $current_page ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-wd-12gdot5">
                        <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22"><?php echo $page_title; ?></h3>
                        </div>
                        <ul class="row list-unstyled products-group no-gutters mb-6">
                            <?php 
                            $i=0;
                            $ci =& get_instance();
                            foreach ($banner_list as $key => $row) 
                            {
                              $img_file=base_url().$ci->_create_thumbnail('assets/images/banner/',$row->banner_slug,$row->banner_image,400,125);

                              $url=base_url('banners/'.$row->banner_slug);

                            ?>
                            <li class="col-md-3 col-sm-12 product-item">
                                <div class="product-item__outer h-100 w-100">
                                    <div class="product-item__inner px-xl-4 p-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2">
                                                <a href="<?=$url?>" class="d-block text-center"><img class="img-fluid" src="<?= $img_file; ?>" alt="Image Description"></a>
                                            </div>
                                            <h5 class="text-center mb-1 product-item__title"><a href="<?=$url?>" class="font-size-15 text-gray-90">
                                                <?php 
                                                  if(strlen($row->banner_title) > 30){
                                                    echo strtr(stripslashes($row->banner_title), 0, 30).'...';  
                                                  }else{
                                                    echo $row->banner_title;
                                                  }
                                                ?>
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php 
                            }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer.php'); ?>
        
