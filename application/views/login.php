<div class="container">

    <form class="login-form" action="<?= base_url('login'); ?>" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-12">
                <img src="<?php echo base_url()."assets/"; ?>login/sogo.jpg" class="img-fluid" alt="sogo logo">
            </div>

            <div class='col-sm-12 errormsg'>
                <?php echo validation_errors(); ?>
                
                <?php if($this->session->flashdata('errormsg')): ?> 
                    <p><?php echo $this->session->flashdata('errormsg'); ?></p>
                <?php endif; ?>
            </div>

            <div class="col-sm-12">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" >
            </div>

            <div class="col-sm-12">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Login</button>    
            </div>
            <div class="col-sm-12">
                <a id='forgot' href='#'>Forgot password</a>
            </div>
        </div>
    </form>
</div>

</body>
</html>

<script>
$("#forgot").click(function(){
  alert("Please contact your system administrator for retrieving your account.");
});
</script>

