<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<h1 style="text-align:center; padding: 1rem;">Update User Profile</h1>

<form class="create-form" action="<?= base_url('profile/edit/'.$this->uri->segment('3')); ?>" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-12 input-group">
                <div class="input-group-prepend">
                    <label id="branch_id_label"  class="input-group-text" for="inputGroupSelect01">Branch</label>
                    <input type="hidden" name="user_id" value="<?php echo $profile['user_id']; ?>">
                </div>
                <select id="branch_id" name="branch_id" class="custom-select" id="inputGroupSelect01">
                    <?php foreach ($hotel_code as $hc): ?>
                        <option <?= $hc['branch_id'] == $profile['branch_id'] ? 'selected=""' : '' ?> value="<?= $hc['branch_id']; ?>" ><?= $hc['code']; ?> - <?= $hc['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-sm-7">
                <label class="form-label">Fullname</label>
                <input type="text" name="name" value="<?php echo $profile['user_name']; ?>" class="form-control" >
            </div>
            <div class="col-sm-5">
                <label class="form-label">Position</label>
                <input type="text" value="<?php echo $profile['position']; ?>" name="position" class="form-control" >
            </div>

            <div class="col-sm-12">
                <label class="form-label">Username</label>
                <input type="text" value="<?php echo $profile['username']; ?>"name="username" class="form-control">
            </div>

            <div class="col-sm-12">
                <label class="form-label">Password</label>
                <input type="password" value="<?php echo $profile['password']; ?>" name="password" class="form-control" id="myInput">
                <i class="far fa-eye-slash fa-lg eye" onclick="myFunction()" style="color:blue"></i>
            </div>

            <div class="col-sm-6">
                <label class="form-label">Type</label>
                <select id="user_type" name="user_type" class="custom-select">
                    <option <?= $profile['user_type'] == 'ba' ? 'selected=""' : '' ?> value="branchAdmin" >Branch Admin</option>
                    <option <?= $profile['user_type'] == 'fd' ? 'selected=""' : '' ?> value="fd" >Front Desk</option>
                    <option <?= $profile['user_type'] == 'kitchen' ? 'selected=""' : '' ?> value="kitchen" >Kitchen</option>
                    <option <?= $profile['user_type'] == 'admin' ? 'selected=""' : '' ?> value="admin" >Superadmin</option>
                </select>
            </div>

            <div class="col-sm-6">
                <label class="form-label">Status</label>
                <select name="status" class="custom-select">
                    <option <?= $profile['status'] == '1' ? 'selected=""' : '' ?> value="1" >Active</option>
                    <option <?= $profile['status'] == '0' ? 'selected=""' : '' ?> value="0" >Inactive</option>
                </select>
            </div>
            

            <div class="col-sm-12">
                <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm changes?')">Update</button>  
            </div>
        </div>
    </form>
</div>