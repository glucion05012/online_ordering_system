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
        <th scope="col">Promo Code</th>
        <th scope="col">Amount</th>
        <th scope="col">Validity</th>
        <th scope="col">Status</th>
        <th scope="col">Branches</th>
        <th scope="col-2">Action</th>
    </tr>
    </thead>
    <tbody>           
            <?php foreach($promo as $pr) : ?>
                <tr class="table-active"> 
                    <td><?php echo $pr['promo_code']; ?></td>
                    <td>
                    <?php
                    if($pr['percent'] == 1){
                        echo $pr['amount'].'%';
                    }else{
                        echo $pr['amount'];
                    }
                    ?>
                    </td>
                    <td><?php echo $pr['valid_from']; ?> - <?php echo $pr['valid_to']; ?></td>
                    <td>
                    <?php
                    if($pr['status'] == 1){
                        echo 'Active';
                    }else{
                        echo 'Inactive';
                    }
                    ?>
                    </td>
                    <td>
                    <?php
                            // $str = "Hello world. It's a beautiful day.";
                            // print_r (explode(" ",$str));
                            $branch = explode(',', $pr['branch_id']);
                            $branchcnt = count($branch) -2;
                            for ($i=0; $i <= $branchcnt; $i++) { 
                                foreach($hotel_code as $hc){
                                    if($branch[$i] == $hc['branch_id']){
                                        echo $hc['name'].", ";
                                    };
                                }
                            }
                            
                            // echo $pr['branch_id'];
                        
                    ?>
                    
                    </td>
                    <td>
                        <a class="btn btn-info" href="promo/edit/<?php echo $pr['promo_id'] ?>">Edit</a>
                        <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete Promo?')" href="promo/delete/<?php echo $pr['promo_id'] ?>">Delete</a>
                    </td>
            </tr>   
            <?php endforeach; ?>
    </tbody>
</table>
</div>
<!-- /.content-wrapper -->

