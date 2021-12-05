<?php include('include/header.php'); ?>
        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
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
            <div class="bg-img-hero mb-14" style="background-image: url(<?php echo base_url(); ?>assets/site_assets/img/1920x600/img1.html);">
                
                <div class="container">
                    <div class=" flex-column mx-auto min-height-564">
                        <div class="mb-12 text-center">
                            <h1 class="h1 font-weight-bold"><?php echo $page_title; ?></h1>
                            <hr>
                        </div>
                        
                        <p class="text-gray-39 font-size-18 text-lh-default"><?php echo $settings_row; ?></p>
                    </div>
                </div>
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->
<?php include('include/footer.php'); ?>
        