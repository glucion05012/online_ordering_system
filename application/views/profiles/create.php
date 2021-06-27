<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<h1 style="text-align:center; padding: 1rem;">Create new User Profile</h1>

<form class="create-form" action="<?= base_url('profile/add'); ?>" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-12 input-group">
                <div class="input-group-prepend">
                    <label id="branch_id_label" class="input-group-text" for="inputGroupSelect01">Branch</label>
                </div>
                <select id="branch_id" name="branch_id" class="custom-select" id="inputGroupSelect01">
                    <?php foreach ($hotel_code as $hc): ?>
                        <option value="<?= $hc['branch_id']; ?>" ><?= $hc['code']; ?> - <?= $hc['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-sm-7">
                <label class="form-label">Fullname</label>
                <input type="text" name="name" class="form-control" >
            </div>
            <div class="col-sm-5">
                <label class="form-label">Position</label>
                <input type="text" name="position" class="form-control" >
            </div>

            <div class="col-sm-12">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="col-sm-12">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="myInput">
                <i class="far fa-eye-slash fa-lg eye" onclick="myFunction()" style="color:blue"></i>
            </div>

            <div class="col-sm-6">
                <label class="form-label">Type</label>
                <select id="user_type" name="user_type" class="custom-select">
                    <option value="ba" >Branch Admin</option>
                    <option value="fd" >Front Desk</option>
                    <option value="kitchen" >Kitchen</option>
                    <option value="admin" >Superadmin</option>
                </select>
            </div>

            <div class="col-sm-6">
                <label class="form-label">Status</label>
                <select name="status" class="custom-select">
                    <option value="1" >Active</option>
                    <option value="0" >Inactive</option>
                </select>
            </div>
            

            <div class="col-sm-12">
                <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Create</button>  
            </div>
        </div>
    </form>
</div>