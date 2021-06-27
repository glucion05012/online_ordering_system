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
        <th scope="col">Code</th>
        <th scope="col">Name</th>
        <th scope="col">Location</th>
        <th scope="col">Notes</th>
        <th scope="col-2">Action</th>
    </tr>
    </thead>
    <tbody>           
            <?php foreach($branch as $br) : ?>
                <tr class="table-active"> 
                    <td><?php echo $br['code']; ?></td>
                    <td><?php echo $br['name']; ?></td>
                    <td><?php echo $br['location']; ?></td>
                    <td><?php echo $br['notes']; ?></td>
                    <td>
                        <a class="btn btn-info" href="branch/edit/<?php echo $br['branch_id'] ?>">Edit</a>
                        <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete Branch?')" href="branch/delete/<?php echo $br['branch_id'] ?>">Delete</a>
                    </td>
            </tr>   
            <?php endforeach; ?>
    </tbody>
</table>
</div>
<!-- /.content-wrapper -->

