<div class="row card_item_block" style="padding-left: 30px;padding-right: 30px">
  <div class="col-md-12"> 
    <div class="card">
      <div class="page_title_block">
        <div class="col-md-5 col-xs-12">
          <div class="page_title"><?=$page_title?></div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="card-body mrg_bottom"> 
        <form method="post" class="form form-horizontal" enctype="multipart/form-data">
          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-md-3 control-label">Transaction Id :-
                
                </label>
                <div class="col-md-6">
                  <input type="text" placeholder="Transaction Id" id="transaction" name="transaction" class="form-control" value="<?php if(isset($users)){ echo $users[0]->transaction;} ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Paid Type :-
                
                </label>
                <div class="col-md-6">
                  <input type="text" placeholder="Paid Type " id="paid_type" name="paid_type" class="form-control" value="<?php if(isset($users)){ echo $users[0]->paid_type;} ?>">
                </div>
              </div>
              <hr/>
              <div class="form-group">
                <div class="col-md-12">
                  <button type="submit" name="btn_submit" class="btn btn-primary"><?=$this->lang->line('save_btn')?></button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $("input[name='file_name']").next(".fileupload_img").find("img").attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("input[name='file_name']").change(function() { 
    readURL(this);
  });

  $(function () {
    $('[data-toggle="popover"]').popover()
  })

</script> 