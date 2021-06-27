<!-- Content Wrapper. Contains page content -->
<meta http-equiv="refresh" content="60" > 
<div class="content-wrapper">

<table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th scope="col">Time Ordered</th>
        <th scope="col">Amount</th>
        <th scope="col">Status</th>
        <th scope="col">Room No</th>
        <th scope="col">Advance Order</th>
        <th scope="col">Reference No</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>           
            <?php foreach($orders as $or) : ?>
                <?php if($or['order_status'] == "CANCELLED") : ?>
                    <?php if($_SESSION['user_type'] == "admin") : ?>
                        <tr class="table-active"> 
                            
                            <?php
                                foreach($hotel_code as $hc){
                                    if($or['branch_id'] == $hc['branch_id']){
                                        $bname = $hc['name'];
                                        $doo = $or['datetime_ordered'];
                                        $doo = date("M j, Y g:i a", strtotime($doo)); 
                                        echo " <td>$doo ($bname)</td>";
                                    };
                                }
                                
                            ?>

                            <?php if ($or['promo_code'] == '') : ?>
                                <td><?php echo number_format($or['total_amount'],2); ?></td>
                            <?php else :  ?>
                                <?php
                                    if ($or['promo_percent'] == 1){
                                        $discountVal = $or['total_amount'] * ($or['promo_amt'] * 0.01);
                                        $discountedAmt = $or['total_amount'] - $discountVal;
                                    }else{
                                        $discountedAmt = $or['total_amount'] - $or['promo_amt'];
                                        if($discountedAmt <= 0){
                                            $discountedAmt = "0.00";
                                        }
                                    }
                                ?>

                                <td><?php echo number_format($discountedAmt,2) . " (". $or['promo_code'].")"; ?></td>

                            <?php endif  ?>
                            
                            <td><?php echo $or['order_status']; ?></td>
                            <td><?php echo $or['room_no']; ?></td>
                            <td>
                            <?php
                            if($or['advance_order'] == 1){
                                echo 'Yes';
                            }else{
                                echo 'No';
                            }
                            ?>
                            </td>
                            
                            <td><?php echo $or['reference_number']; ?></td>
                            <td>
                                <a href="order/processView/<?php echo $or['order_id'] ?>" data-toggle="tooltip" title="View Details"><i class="fas fa-list fa-2x"></i></a>
                            </td>
                            
                        </tr>  
                    <?php elseif($_SESSION['user_type'] == "fd" || $_SESSION['user_type'] == "kitchen" || $_SESSION['user_type'] == "ba") : ?>
                        <?php if($_SESSION['branch_id'] == $or['branch_id']) : ?>
                            <tr class="table-active"> 
                            
                                <?php
                                    foreach($hotel_code as $hc){
                                        if($or['branch_id'] == $hc['branch_id']){
                                            $bname = $hc['name'];
                                            $doo = $or['datetime_ordered'];
                                            $doo = date("M j, Y g:i a", strtotime($doo)); 
                                            echo " <td>$doo ($bname)</td>";
                                        };
                                    }
                                    
                                ?>

                                <?php if ($or['promo_code'] == '') : ?>
                                    <td><?php echo number_format($or['total_amount'],2); ?></td>
                                <?php else :  ?>
                                    <?php
                                        if ($or['promo_percent'] == 1){
                                            $discountVal = $or['total_amount'] * ($or['promo_amt'] * 0.01);
                                            $discountedAmt = $or['total_amount'] - $discountVal;
                                        }else{
                                            $discountedAmt = $or['total_amount'] - $or['promo_amt'];
                                            if($discountedAmt <= 0){
                                                $discountedAmt = "0.00";
                                            }
                                        }
                                    ?>

                                    <td><?php echo number_format($discountedAmt,2) . " (". $or['promo_code'].")"; ?></td>

                                <?php endif  ?>
                                
                                <td><?php echo $or['order_status']; ?></td>
                                <td><?php echo $or['room_no']; ?></td>
                                <td>
                                <?php
                                if($or['advance_order'] == 1){
                                    echo 'Yes';
                                }else{
                                    echo 'No';
                                }
                                ?>
                                </td>
                                
                                <td><?php echo $or['reference_number']; ?></td>
                                <td>
                                    <a href="order/processView/<?php echo $or['order_id'] ?>" data-toggle="tooltip" title="View Details"><i class="fas fa-list fa-2x"></i></a>
                                </td>
                                
                            </tr>  
                        <?php endif ?>
                    <?php endif ?>    
                <?php endif ?>
                
            <?php endforeach; ?>
    </tbody>
</table>
</div>
<!-- /.content-wrapper -->

