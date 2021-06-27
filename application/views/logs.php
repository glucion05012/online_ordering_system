<!-- Content Wrapper. Contains page content -->
<meta http-equiv="refresh" content="60" > 
<div class="content-wrapper">
<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<button id="btnExport" onclick="fnExcelReport();" class='btn btn-success'>Export</button>

    <div class="col-lg-12">
        <table id="myTableCnt" class="row-border table-responsive" style="width:100%">
            <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Reference Number</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>
                <th scope="col">Notes</th>
                <th scope="col">User</th>
            </tr>
            </thead>
            <tbody>           
                    <?php foreach($logs as $lg) : ?>
                        <?php if($_SESSION['user_type'] == "admin") : ?>
                            <tr class="table-active"> 
                                <td><?php echo $lg['date']; ?></td>
                                <td><?php echo $lg['reference_number']; ?></td>
                                <td><?php echo $lg['date']; ?></td>
                                <td><?php echo $lg['time']; ?></td>
                                <td><?php echo $lg['action']; ?></td>
                                <td><?php echo $lg['notes']; ?></td>
                                <td><?php echo $lg['username']; ?></td>
                            </tr>   
                        <?php elseif($_SESSION['user_type'] == "fd" || $_SESSION['user_type'] == "kitchen" || $_SESSION['user_type'] == "ba") : ?>
                            <?php if($_SESSION['branch_id'] == $lg['branch_id'] && $lg['user_type'] != "admin") : ?>
                                <tr class="table-active"> 
                                    <td><?php echo $lg['date']; ?></td>
                                    <td><?php echo $lg['reference_number']; ?></td>
                                    <td><?php echo $lg['date']; ?></td>
                                    <td><?php echo $lg['time']; ?></td>
                                    <td><?php echo $lg['action']; ?></td>
                                    <td><?php echo $lg['notes']; ?></td>
                                    <td><?php echo $lg['username']; ?></td>
                                </tr>   
                            <?php endif  ?>
                        <?php endif  ?>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.content-wrapper -->

