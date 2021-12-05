<div class="row card_item_block" style="padding-left:30px;padding-right: 30px">
  
  <div class="col-xs-12">
    <div class="card mrg_bottom">
      <div class="page_title_block">
        <div class="col-md-5 col-xs-12">
          <div class="page_title"><?=$page_title?></div>
        </div>
        <div class="col-md-6 col-md-offset-1 col-xs-12">
          <div class="col-sm-12">
            <div class="search_list">
              <div class="search_block">
                <form method="GET" action="">
                <input class="form-control input-sm" placeholder="<?=$this->lang->line('search_lbl')?>" aria-controls="DataTables_Table_0" type="search" name="search_value" required value="<?php if(isset($_GET['search_value'])){ echo $_GET['search_value']; }?>">
                      <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                </form>  
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
        <?php 
          if(!empty($commission))
          { 
        ?>
        <div class="col-md-12 mrg-top">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Vendor</th>
                <th>product title</th>
                <th>Order</th>
                <th>Amount</th>
                <th>Paid Amount</th>
                <th>Commission (%)</th>  
                <th class="cat_action_list">Paid Status</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $i=0;
              foreach ($commission as $key => $row) 
              {
              ?>
              <tr class="item_holder">
                <td>
                  Name :- <?php echo ($row->vendor_name) ? $row->vendor_name : '-'?>
                  <br>
                  Email :- <?php echo ($row->vendor_email) ? $row->vendor_email : '-'?>
                  <br>
                  A/c :- <?php echo ($row->vendor_account) ? $row->vendor_account : '-'?>
                  <br>
                  ifsc :- <?php echo ($row->vendor_ifsc) ? $row->vendor_ifsc : '-'?>
                </td>
                <td><?php echo ($row->product_title) ? $row->product_title : '-'?></td>
                <td><a href="<?php echo site_url("admin/pages/order_summary/".$row->order_id);?>"><?php echo ($row->order_id) ? $row->order_id : '-'?></a></td>
                <td><?php echo ($row->amount) ? $row->amount : '-'?></td>
                <td><?php echo ($row->commission_paid) ? $row->commission_paid : '-'?></td>
                <td><?php echo ($row->commission_percentage) ? $row->commission_percentage : '-'?></td>
                <td nowrap="">
                  <?php 
                  if($row->status == 0)
                  {
                  ?>
                  <a href="<?php echo site_url("admin/pages/commission_paid/".$row->id);?>" class="btn btn-primary" data-toggle="tooltip" data-tooltip="Unpaid">Unpaid</a>
                  <?php 
                  }
                  else
                  {
                  ?>
                  <a href="javascript:void(0);" class="btn btn-danger" data-toggle="tooltip" title="Transaction :- <?php echo ($row->transaction) ? $row->transaction : '-'?> || Payment through :- <?php echo ($row->paid_type) ? $row->paid_type : '-'?> || Payment date :- <?php echo date('d-m-Y',$row->paid_date);?>">Paid</a>
                  <?php 
                  }
                  ?>
                </td>
              <?php } ?>
              </tr>
             <?php    
               $i++;
             ?>
            </tbody>
          </table>
        <?php }else{ ?>
          <div class="col-lg-12 col-sm-12 col-xs-12" style="text-align: center;">
            <h4 class="text-muted" style="font-weight: 400">Sorry! no records found...</h4>
            <br/>
          </div>
        <?php } ?>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12 col-xs-12">
          <div class="pagination_item_block">
            <nav>
              <?php 
                  if(!empty($links)){
                    echo $links;  
                  } 
              ?>
            </nav>
          </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

  // for multiple action

  $(".actions").click(function(e){
    e.preventDefault();

    var _table='tbl_users';

    var href='<?=base_url()?>admin/pages/perform_multipe';

    var _ids = $.map($('.post_ids:checked'), function(c){return c.value; });
    var _action=$(this).data("action");

    if(_ids!='')
    {
      swal({
        title: "<?=$this->lang->line('action_lbl')?>: "+$(this).text(),
        text: "<?=$this->lang->line('action_confirm_msg')?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-warning",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
      },
      function(isConfirm) {
        if (isConfirm) {

          $.ajax({
              type:'post',
              url:href,
              dataType:'json',
              data:{ids:_ids,for_action:_action,table:_table},
              success:function(res){
                  if($.trim(res)=='success'){
                    swal({
                      title: "<?=$this->lang->line('deleted_lbl')?>", 
                      text: "<?=$this->lang->line('deleted_data_lbl')?>", 
                      type: "success"
                    },function() {
                      $(btn).closest('.item_holder').fadeOut("200");
                    });
                  }
                  else
                  {
                    swal.close();
                    $('.notifyjs-corner').empty();
                    $.notify(
                      $.trim(res),
                      { position:"top center",className: 'warn'}
                      );
                  }
                }
            });

        }else{
          swal.close();
        }
      });
    }
    else{
        $('.notifyjs-corner').empty();
        $.notify(
          '<?=$this->lang->line('no_record_select_msg')?>',  
          { position:"top center",className: 'error' }
        );
    }

  });

  $(".enable_disable").on("click",function(e){

    var href;
    var btn = this;
    var _id=$(this).data("id");

    var _for=$(this).prop("checked");
    if(_for==false){
      href='<?=base_url()?>admin/vendor/deactive/'+_id
    }else{
      href='<?=base_url()?>admin/vendor/active/'+_id
    }

    $.ajax({
      type:'GET',
      url:href,
      success:function(res){
          $('.notifyjs-corner').empty();
          var obj = $.parseJSON(res);
          $.notify($.trim(obj.message), { position:"top center",className: obj.class});
        }
    });

  });

  var totalItems=0;

  $("#checkall").click(function () {

    totalItems=0;

    $("input[name='post_ids[]']").not(this).prop('checked', this.checked);

    $.each($("input[name='post_ids[]']:checked"), function(){
      totalItems=totalItems+1;
    });

    if($("input[name='post_ids[]']").prop("checked") == true){
      $('.notifyjs-corner').empty();
      $.notify(
        'Total '+totalItems+' item checked',
        { position:"top center",className: 'success',clickToHide : false,autoHide : false}
      );
    }
    else if($("input[name='post_ids[]']"). prop("checked") == false){
      totalItems=0;
      $('.notifyjs-corner').empty();
    }
  });

  $(".post_ids").click(function(e){

      if($(this).prop("checked") == true){
        totalItems=totalItems+1;
      }
      else if($(this). prop("checked") == false){
        totalItems = totalItems-1;
      }

      if(totalItems==0){
        $('.notifyjs-corner').empty();
        exit();
      }

      $('.notifyjs-corner').empty();

      $.notify(
        'Total '+totalItems+' item checked',
        { position:"top center",className: 'success',clickToHide : false,autoHide : false}
      );
  });

  // for delete users
  $(".btn_delete").click(function(e){
      e.preventDefault();
      var _id=$(this).data("id");

      e.preventDefault(); 
      var href='<?=base_url()?>admin/vendor/delete/'+_id;

      var btn = this;

      swal({
        title: "<?=$this->lang->line('are_you_sure_msg')?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-warning",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
      },
      function(isConfirm) {
        if (isConfirm) {

          $.ajax({
            type:'GET',
            url:href,
            success:function(res){
                if($.trim(res)=='success'){
                  swal({
                      title: "Deleted", 
                      text: "Your user has been deleted", 
                      type: "success"
                  },function() {
                      $(btn).closest('.item_holder').fadeOut("200");
                  });
                }
                else
                {
                  //alert("Error");
                }

              }
          });
          
        }else{
          swal.close();
        }
      });
  });
</script>