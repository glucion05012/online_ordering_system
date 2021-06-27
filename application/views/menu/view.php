<!-- Content Wrapper. Contains page content -->
<meta http-equiv="refresh" content="60" > 
<div class="content-wrapper">
<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>
<table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Category</th>
        <th scope="col">Amount</th>
        <th scope="col">Quantity</th>
        <th scope="col">Branches</th>
        <th scope="col-2">Image</th>
        <th scope="col-2">Action</th>
    </tr>
    </thead>
    <tbody>           
       
            <?php foreach($menu as $mn) : ?>
                <?php if($_SESSION['user_type'] == "admin") : ?> 
                    <tr class="table-active"> 
                        <td><?php echo $mn['name']; ?></td>
                        <td><?php echo $mn['description']; ?></td>
                        <td><?php echo $mn['category']; ?></td>
                        <td><?php echo $mn['amount']; ?></td>
                        <td><?php echo $mn['quantity']; ?></td>
                        <td>
                        <?php
                            foreach($hotel_code as $hc){
                                if($mn['branch_id'] == $hc['branch_id']){
                                    echo $hc['name'];
                                };
                            }
                            
                        ?>
                        
                        </td>
                        <td>
                        <img src="<?php echo base_url()."assets/"; ?>food_menu_images/<?php echo $mn['image']; ?>" alt="<?php echo $mn['name']; ?>" width="50" height="50">
                        </td>
                        <td>
                            <a class="btn btn-info" href="menu/edit/<?php echo $mn['menu_id'] ?>">Edit</a>
                            <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete Menu?')" href="menu/delete/<?php echo $mn['menu_id'] ?>/<?php echo $mn['image'] ?>">Delete</a>
                        </td>
                    </tr>   
                <?php endif; ?> 

                <?php if($_SESSION['user_type'] == "fd" || $_SESSION['user_type'] == "kitchen" || $_SESSION['user_type'] == "ba") : ?> 
                    <?php if($_SESSION['branch_id'] == $mn['branch_id']) : ?> 
                        <tr class="table-active"> 
                            <td><?php echo $mn['name']; ?></td>
                            <td><?php echo $mn['description']; ?></td>
                            <td><?php echo $mn['category']; ?></td>
                            <td><?php echo $mn['amount']; ?></td>
                            <td><?php echo $mn['quantity']; ?></td>
                            <td>
                            <?php
                                foreach($hotel_code as $hc){
                                    if($mn['branch_id'] == $hc['branch_id']){
                                        echo $hc['name'];
                                    };
                                }
                                
                            ?>
                            
                            </td>
                            <td>
                            <img src="<?php echo base_url()."assets/"; ?>food_menu_images/<?php echo $mn['image']; ?>" alt="<?php echo $mn['name']; ?>" width="50" height="50">
                            </td>
                            <td>
                                <a class="btn btn-info" href="menu/edit/<?php echo $mn['menu_id'] ?>">Edit</a>
                                <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete Menu?')" href="menu/delete/<?php echo $mn['menu_id'] ?>/<?php echo $mn['image'] ?>">Delete</a>
                            </td>
                        </tr>   
                    <?php endif; ?> 
                <?php endif; ?> 
            <?php endforeach; ?>
    </tbody>
</table>
</div>
<!-- /.content-wrapper -->

