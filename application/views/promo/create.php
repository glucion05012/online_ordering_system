<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<h1 style="text-align:center; padding: 1rem;">Create New Promo</h1>

<form class="create-form" action="<?= base_url('promo/add'); ?>" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-6">
                <label class="form-label">Promo Code</label>
                <input type="text" name="code" class="form-control" >
            </div>
            <div class="col-sm-4">
                <label class="form-label">Amount</label>    
                <input type="number" name="amount" class="form-control" step="0.01">
            </div>
            <div class="col-sm-2">
                <label class="form-label"></label>
                <select name="percent" class="custom-select">
                    <option value="1" >%</option>
                    <option value="0" >P</option>
                </select>
            </div>

            <div class="col-sm-6">
                <label class="form-label">Valid From</label>
                <input type="date" name="valid_from" class="form-control">
            </div>

            <div class="col-sm-6">
            <label class="form-label">Valid To</label>
                <input type="date" name="valid_to" class="form-control">
            </div>

            <div class="col-sm-12">
                <label class="form-label">Status</label>
                <select name="status" class="custom-select">
                    <option value="1" >Active</option>
                    <option value="0" >Inactive</option>
                </select>
            </div>
            
            <div class="col-sm-12">
            <label class="form-label">Choose Branches:</label>
            
            <select class="custom-select" name="branch[]" multiple>
                    <?php foreach ($branch as $hc): ?>
                        <option value="<?= $hc['branch_id']; ?>" ><?= $hc['code']; ?> - <?= $hc['name']; ?></option>
                    <?php endforeach; ?>
            </select>
            </div>

            <div class="col-sm-12">
                <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Create</button>  
            </div>
        </div>
    </form>
</div>