<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<h1 style="text-align:center; padding: 1rem;">Update Menu</h1>
    <?php echo form_open_multipart('menu/edit/'.$this->uri->segment('3'));?>
    <div class="create-form">
        <div class="row">
            <div class="col-sm-12">
            <input type="hidden" name="menu_id" value="<?php echo $menu['menu_id']; ?>">
                <label class="form-label">Name</label>
                <input type="text" value="<?php echo $menu['name']; ?>" name="name" class="form-control" >
            </div>
            
            <div class="col-sm-12">
                <label class="form-label">Category</label>
                <select class="custom-select" name="category">
                    <option <?= $menu['category'] == 'Filipino Breakfast' ? 'selected=""' : '' ?> value="Filipino Breakfast" >Filipino Breakfast</option>
                    <option <?= $menu['category'] == 'Bento Box' ? 'selected=""' : '' ?> value="Bento Box" >Bento Box</option>
                    <option <?= $menu['category'] == 'Ala Carte' ? 'selected=""' : '' ?> value="Ala Carte" >Ala Carte</option>
                    <option <?= $menu['category'] == 'Appetizer' ? 'selected=""' : '' ?> value="Appetizer" >Appetizer</option>
                    <option <?= $menu['category'] == 'Soups' ? 'selected=""' : '' ?> value="Soups" >Soups</option>
                    <option <?= $menu['category'] == 'Pasta and Noodles' ? 'selected=""' : '' ?> value="Pasta and Noodles" >Pasta and Noodles</option>
                    <option <?= $menu['category'] == 'Desserts' ? 'selected=""' : '' ?> value="Desserts" >Desserts</option>
                    <option <?= $menu['category'] == 'Sandwiches' ? 'selected=""' : '' ?> value="Sandwiches" >Sandwiches</option>
                    <option <?= $menu['category'] == 'Beverages' ? 'selected=""' : '' ?> value="Beverages" >Beverages</option>
                </select>
            </div>

            <div class="col-sm-12">
                <label class="form-label">Description</label>
            </div>
            <div class="col-sm-12">
                <textarea name="description" class="form-control"><?php echo $menu['description']; ?></textarea>
            </div>

            <div class="col-sm-6">
                <label class="form-label">Amount</label>
                <input type="number" value="<?php echo $menu['amount']; ?>" name="amount" class="form-control" step="0.01">
            </div>

            <div class="col-sm-6">
                <label class="form-label">Quantity</label>
                <input type="number" value="<?php echo $menu['quantity']; ?>" name="quantity" class="form-control">
            </div>

            <div class="col-sm-8">
                <input type="file" name="file_name" accept="image/*" onchange="loadFile(event)" required><i style="color:red;">(please select again image)</i>
            </div>

            <div class="col-sm-4">
                <input type="hidden" name="previous_img" value="<?php echo $menu['image']; ?>">
                <img id="img_prev"  src="#" alt="<?php echo $menu['name']; ?>" alt="preview" width="100" height="100"/>
            </div>

            <div class="col-sm-12">
            <label class="form-label">Choose Branches: </label>
            
            <select class="custom-select" name="branch" >
                <?php if($_SESSION['user_type'] == "admin") : ?> 
                    <?php foreach ($hotel_code as $hc): ?>
                        <option <?= $hc['branch_id'] == $menu['branch_id'] ? 'selected=""' : '' ?> value="<?= $hc['branch_id']; ?>" ><?= $hc['code']; ?> - <?= $hc['name']; ?></option>
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
                <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Update</button>  
            </div>
        </div>
    </div>
    </form>
</div>