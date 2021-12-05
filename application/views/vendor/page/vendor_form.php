
<div class="row card_item_block" style="padding-left: 30px;padding-right: 30px">
  <div class="col-md-12">
    <div class="card">
      <div class="page_title_block">
        <div class="col-md-5 col-xs-12">
          <div class="page_title"><?=$current_page?></div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="card-body mrg_bottom"> 
        <form action="<?php if(!isset($users)){ echo site_url('admin/vendor/add'); }else{  echo site_url('admin/vendor/edit/'.$users[0]->id);} ?>" method="post" id="categoryForm" class="form form-horizontal" enctype="multipart/form-data">
          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-md-3 control-label"><?=$this->lang->line('name_lbl')?>:-
                </label>
                <div class="col-md-6">
                  <input type="text" required="" placeholder="<?=$this->lang->line('name_place_lbl')?>" id="user_name" name="user_name" class="form-control" value="<?php if(isset($users)){ echo $users[0]->user_name;} ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 control-label"><?=$this->lang->line('email_lbl')?> :-
                
                </label>
                <div class="col-md-6">
                  <input type="text" required="" placeholder="<?=$this->lang->line('email_place_lbl')?>" id="user_email" name="user_email" class="form-control" value="<?php if(isset($users)){ echo $users[0]->user_email;} ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 control-label"><?=$this->lang->line('phone_no_lbl')?> :-
                
                </label>
                <div class="col-md-6">
                  <input type="text" onkeypress="return isNumberKey(event)" maxlength="15" placeholder="<?=$this->lang->line('phone_no_place_lbl')?>" id="user_phone" name="user_phone" class="form-control" value="<?php if(isset($users)){ echo $users[0]->user_phone;} ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 control-label"><?=$this->lang->line('password_lbl')?> :-</label>
                <div class="col-md-6">
                  <input type="password" placeholder="*******" id="user_password" name="user_password" class="form-control" value=""<?php echo (!isset($users)) ? 'required="required"' : '' ;?>>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
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
