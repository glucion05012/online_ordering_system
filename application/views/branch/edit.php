<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<h1 style="text-align:center; padding: 1rem;">Update Branch</h1>

<form class="create-form" action="<?= base_url('branch/edit/'.$this->uri->segment('3')); ?>" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-4">
                <input type="hidden" name="branch_id" value="<?php echo $branch['branch_id']; ?>">
                <label class="form-label">Code</label>
                <input type="text" value="<?php echo $branch['code']; ?>" name="code" class="form-control" >
            </div>
            <div class="col-sm-8">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="<?php echo $branch['name']; ?>" class="form-control" >
            </div>

            <div class="col-sm-12">
                <label class="form-label">Location</label>
                <input type="text" value="<?php echo $branch['location']; ?>" name="location" class="form-control">
            </div>

            <div class="col-sm-12">
                <label class="form-label">Notes</label>
            </div>
            <div class="col-sm-12">
                <textarea name="notes" ><?php echo $branch['notes']; ?></textarea>
            </div>
            
            

            <div class="col-sm-12">
                <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Update</button>  
            </div>
        </div>
    </form>
</div>