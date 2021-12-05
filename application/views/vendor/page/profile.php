<div class="row card_item_block" style="padding-left: 30px;padding-right: 30px">
  <div class="col-md-12">
    <div class="card">
      <div class="page_title_block">
        <div class="col-md-5 col-xs-12">
          <div class="page_title"><?=$current_page?></div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row mrg-top">
        <div class="col-md-12">
          
        </div>
      </div>
      <div class="card-body mrg_bottom"> 
        <form action="<?=site_url('vendor/pages/save_profile')?>" name="editprofile" method="post" class="form form-horizontal" enctype="multipart/form-data">
            <div class="section">
              <div class="section-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Company Name</label>
                  <div class="col-sm-10">
                    <input class="form-control" placeholder="Company Name" type="text" name="user_name" oninvalid="this.setCustomValidity('Company Name')" oninput="this.setCustomValidity('')" required="" value="<?php echo $row->user_name; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Email Id</label>
                  <div class="col-sm-10">
                    <input class="form-control" placeholder="Email Id [Used as a username]" type="email" name="user_email" oninvalid="this.setCustomValidity('Email')" oninput="this.setCustomValidity('')"  autocomplete="off" required="" value="<?php echo $row->user_email; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Password" name="pass"  autocomplete="off" />
                    <pre>(If Required then only change otherwise dont write anything)</pre>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Mobile No </label>
                  <div class="col-sm-10">
                    <input class="form-control" placeholder="Mobile Number" name="user_phone" type="text" required=""  onkeyup="this.value=this.value.replace(/[^\d]/,'')" value="<?php echo $row->user_phone; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Gst No. </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="GST Number" name="gstno" required  value="<?php echo $row->gstno; ?>"/>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Gst Document </label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="gstdoc" />
                    <a href="<?php echo base_url(); ?>upload/vendor/<?php echo $row->gstdoc; ?>" target="_blank">View GST Document</a>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Bank Account No. </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Bank Account Number" name="bankacno" required value="<?php echo $row->bankacno; ?>" />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Ifsc No. </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="IFSC Number" name="ifsc" required value="<?php echo $row->ifsc; ?>" />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Branch Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Branch Name" name="branchname" required value="<?php echo $row->branchname; ?>" />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Upload Bank Ac Details or Cancel Cheque</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="bankdoc">
                    <a href="<?php echo base_url(); ?>upload/vendor/<?php echo $row->bankdoc; ?>" target="_blank">View Bank Account Details</a>
                  </div>
                </div>                 
                 
                <div class="form-group">
                  <div class="col-md-9 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
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

</script> 