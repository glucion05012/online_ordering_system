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
        <th scope="col">Branch</th>
        <th scope="col">Name</th>
        <th scope="col">Position</th>
        <th scope="col">Type</th>
        <th scope="col">Status</th>
        <th scope="col-2">Action</th>
    </tr>
    </thead>
    <tbody>           
            <?php foreach($profile as $pf) : ?>
                <tr class="table-active"> 
                    <td><?php echo $pf['code']; ?> - <?php echo $pf['hotel_name']; ?></td>
                    <td><?php echo $pf['user_name']; ?></td>
                    <td><?php echo $pf['position']; ?></td>
                    <td><?php echo $pf['user_type']; ?></td>
                    <td>
                    <?php
                    if($pf['status'] == 1){
                        echo 'Active';
                    }else{
                        echo 'Inactive';
                    }
                    ?>
                    </td>
                    <td>
                        <a class="btn btn-info" href="profile/edit/<?php echo $pf['user_id'] ?>">Edit</a>
                        <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete User?')" href="profile/delete/<?php echo $pf['user_id'] ?>">Delete</a>
                    </td>
            </tr>   
            <?php endforeach; ?>
    </tbody>
</table>
</div>
<!-- /.content-wrapper -->

