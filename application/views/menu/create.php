<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<h1 style="text-align:center; padding: 1rem;">Create New Menu</h1>

    <?php echo form_open_multipart('menu/add');?>
    <!-- <form class="create-form" action="<?= base_url('menu/add'); ?>" method="post" accept-charset="utf-8"> -->
    <div class="create-form">
        <div class="row">
            <div class="col-sm-12">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" >
            </div>
            
            <div class="col-sm-12">
                <label class="form-label">Category</label>
                <select class="custom-select" name="category">
                    <option value="Filipino Breakfast" >Filipino Breakfast</option>
                    <option value="Bento Box" >Bento Box</option>
                    <option value="Ala Carte" >Ala Carte</option>
                    <option value="Appetizer" >Appetizer</option>
                    <option value="Soups" >Soups</option>
                    <option value="Pasta and Noodles" >Pasta and Noodles</option>
                    <option value="Desserts" >Desserts</option>
                    <option value="Sandwiches" >Sandwiches</option>
                    <option value="Beverages" >Beverages</option>
                </select>
            </div>

            <div class="col-sm-12">
                <label class="form-label">Description</label>
            </div>
            <div class="col-sm-12">
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="col-sm-6">
                <label class="form-label">Amount</label>
                <input type="number" name="amount" class="form-control" step="0.01">
            </div>

            <div class="col-sm-6">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control">
            </div>

            <div class="col-sm-8">
                <input type="file" name="file_name" accept="image/*" onchange="loadFile(event)" required>
            </div>

            <div class="col-sm-4">
                <img id="img_prev" src="#" alt="preview" width="100" height="100"/>
            </div>

            <div class="col-sm-12">
            <label class="form-label">Choose Branches:</label>
            
            <select class="custom-select" name="branch" >
                <?php if($_SESSION['user_type'] == "admin") : ?> 
                    <?php foreach ($branch as $hc): ?>
                        <option value="<?= $hc['branch_id']; ?>" ><?= $hc['code']; ?> - <?= $hc['name']; ?></option>
                    <?php endforeach; ?> 
                <?php endif; ?> 

                <?php if($_SESSION['user_type'] == "fd" || $_SESSION['user_type'] == "kitchen" || $_SESSION['user_type'] == "ba") : ?> 
                    <?php foreach ($branch as $hc): ?>
                        <?php if($_SESSION['branch_id'] == $hc['branch_id']) : ?> 
                            <option value="<?= $hc['branch_id']; ?>" ><?= $hc['code']; ?> - <?= $hc['name']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?> 
                <?php endif; ?>
            </select>
            </div>

            <div class="col-sm-12">
                <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Create</button>  
            </div>
        </div>
    </div>
    </form>
</div>