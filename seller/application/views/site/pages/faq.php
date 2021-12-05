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
            <div class="mb-12 text-center">
                <h1><?php echo $page_title; ?></h1>
            </div>
            
            <!-- Basics Accordion -->
            <div id="basicsAccordion" class="mb-12">
                <?php 
                $i = 0;

                foreach ($faq_row as $key => $value) {
                ?>
            
                <div class="card mb-3 border-top-0 border-left-0 border-right-0 border-color-1 rounded-0">
                        <div class="card-header card-collapse bg-transparent-on-hover border-0" id="basicsHeadingTwo<?php echo $i; ?>">
                            <h5 class="mb-0">
                                <button type="button" class="px-0 btn btn-link btn-block d-flex justify-content-between card-btn collapsed py-3 font-size-25 border-0" data-toggle="collapse" data-target="#basicsCollapseTwo<?php echo $i; ?>" aria-expanded="false" aria-controls="basicsCollapseTwo<?php echo $i; ?>">
                                    <?=$value->faq_question?>

                                    <span class="card-btn-arrow">
                                        <i class="fas fa-chevron-down text-gray-90 font-size-18"></i>
                                    </span>
                                </button>
                            </h5>
                        </div>
                        <div id="basicsCollapseTwo<?php echo $i; ?>" class="collapse" aria-labelledby="basicsHeadingTwo<?php echo $i; ?>" data-parent="#basicsAccordion">
                            <div class="card-body pl-0 pb-8">
                                <p class="mb-0"><?=nl2br(stripslashes($value->faq_answer))?></p>
                            </div>
                        </div>
                    </div>
                <!-- End Card -->
                <?php $i++; } ?>
            </div>
            <!-- End Basics Accordion -->
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
<?php include('include/footer.php'); ?>
        
