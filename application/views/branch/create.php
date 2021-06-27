<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<h1 style="text-align:center; padding: 1rem;">Create New Branch</h1>

<form class="create-form" action="<?= base_url('branch/add'); ?>" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-4">
                <label class="form-label">Code</label>
                <input type="text" name="code" class="form-control" >
            </div>
            <div class="col-sm-8">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" >
            </div>

            <div class="col-sm-12">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control">
            </div>

            <div class="col-sm-12">
                <label class="form-label">Notes</label>
            </div>
            <div class="col-sm-12">
                <textarea name="notes" class="form-control"></textarea>
            </div>
            
            

            <div class="col-sm-12">
                <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Create</button>  
            </div>
        </div>
    </form>
</div>