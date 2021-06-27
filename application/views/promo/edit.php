<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<h1 style="text-align:center; padding: 1rem;">Update Promo</h1>

<form class="create-form" action="<?= base_url('promo/edit/'.$this->uri->segment('3')); ?>" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-6">
                <input type="hidden" name="promo_id" value="<?php echo $promo['promo_id']; ?>">
                <label class="form-label">Promo Code</label>
                <input type="text" value="<?php echo $promo['promo_code']; ?>" name="code" class="form-control" >
            </div>
            <div class="col-sm-4">
                <label class="form-label">Amount</label>
                <input type="number" value="<?php echo $promo['amount']; ?>" name="amount" class="form-control" step="0.01">
            </div>
            <div class="col-sm-2">
                <label class="form-label"></label>
                <select name="percent" class="custom-select">
                    <option <?= $promo['percent'] == '1' ? 'selected=""' : '' ?> value="1" >%</option>
                    <option <?= $promo['percent'] == '0' ? 'selected=""' : '' ?> value="0" >P</option>
                </select>
            </div>

            <div class="col-sm-6">
                <label class="form-label">Valid From</label>
                <input type="date"value="<?php echo $promo['valid_from']; ?>"  name="valid_from" class="form-control">
            </div>

            <div class="col-sm-6">
            <label class="form-label">Valid To</label>
                <input type="date" value="<?php echo $promo['valid_to']; ?>" name="valid_to" class="form-control">
            </div>

            <div class="col-sm-12">
                <label class="form-label">Status</label>
                <select name="status" class="custom-select">
                    <option <?= $promo['status'] == '1' ? 'selected=""' : '' ?> value="1" >Active</option>
                    <option <?= $promo['status'] == '0' ? 'selected=""' : '' ?> value="0" >Inactive</option>
                </select>
            </div>
            

            <div class="col-sm-12">
            <label class="form-label">Current Branches:</label>
            <p>
                <?php
                  $branch = explode(',', $promo['branch_id']);
                  $branchcnt = count($branch) -2;
                  for ($i=0; $i <= $branchcnt; $i++) { 
                      foreach($hotel_code as $hc){
                          if($branch[$i] == $hc['branch_id']){
                              echo $hc['name'].", ";
                          };
                      }
                  }
                ?>
            </p>
            </div>

            <div class="col-sm-12">
            <label class="form-label">Choose Branches: <i style="color:red;">*(please select again branches)</i></label>
            
            <select class="custom-select" name="branch[]" multiple>
                    <?php foreach ($hotel_code as $hc): ?>
                        <option value="<?= $hc['branch_id']; ?>"><?= $hc['code']; ?> - <?= $hc['name']; ?></option>
                    <?php endforeach; ?>
            </select>
            </div>

            <div class="col-sm-12">
                <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Update</button>  
            </div>
        </div>
    </form>
</div>