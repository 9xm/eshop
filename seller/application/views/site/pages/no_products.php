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
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $current_page; ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container">
                <div class="mb-5 text-center pb-3 border-bottom border-color-1">
                    <img src="<?=base_url('assets/img/no_data.png')?>">
                <h2 style="font-size: 18px;font-weight: 500;color: #888;"><?=$this->lang->line('no_data')?></h2>
                <br/>
                <a href="<?=base_url('/')?>"><img src="<?=base_url('assets/images/continue-shopping-button.png')?>"></a>
                </div>
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer.php'); ?>
        