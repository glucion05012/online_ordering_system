<!-- Content Wrapper. Contains page content -->
<meta http-equiv="refresh" content="60" > 
<div class="content-wrapper">
<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<div style="padding: 30px">
    <?php 
    $PLACEDcnt = 1;
    $RECEIVEDcnt = 1;
    $DELIVERcnt = 1;

    $PREPARINGcnt = 1;
    $COOKINGcnt = 1;

    foreach($orders as $or){

        if($_SESSION['user_type'] == "fd"){
            if($_SESSION['branch_id'] == $or['branch_id']){
                // if($or['order_status'] == "PLACED" or $or['order_status'] == "RECEIVED" or $or['order_status'] == "COMPLETED" or $or['order_status'] == "FOR DELIVER"){
                if($or['order_status'] == "PLACED" ){ 
                    $PLACED = $PLACEDcnt++;  
                }
                if($or['order_status'] == "RECEIVED" ){ 
                    $RECEIVED = $RECEIVEDcnt++;  
                }
                if($or['order_status'] == "FOR DELIVER" ){ 
                    $DELIVER = $DELIVERcnt++;  
                }
            }
        }

        if($_SESSION['user_type'] == "kitchen"){
            if($_SESSION['branch_id'] == $or['branch_id']){
                // if($or['order_status'] == "PREPARING TO COOK" or $or['order_status'] == "COOKING"){
                if($or['order_status'] == "PREPARING TO COOK"){
                    $PREPARING = $PREPARINGcnt++;  
                }
                if($or['order_status'] == "COOKING"){
                    $COOKING = $COOKINGcnt++;  
                }
            }
        }

        if($_SESSION['user_type'] == "admin" || $_SESSION['user_type'] == "ba"){
            if($or['order_status'] == "PLACED" ){ 
                $PLACED = $PLACEDcnt++;  
            }
            if($or['order_status'] == "RECEIVED" ){ 
                $RECEIVED = $RECEIVEDcnt++;  
            }
            if($or['order_status'] == "FOR DELIVER" ){ 
                $DELIVER = $DELIVERcnt++;  
            }
            if($or['order_status'] == "PREPARING TO COOK"){
                $PREPARING = $PREPARINGcnt++;  
            }
            if($or['order_status'] == "COOKING"){
                $COOKING = $COOKINGcnt++;  
            }
        }
    } 
    ?>
    
    <?php  if($_SESSION['user_type'] == "fd") :?>
        <h5>NEW ORDERS: <span style="color:orange; "><b><?php if(isset($PLACED)){echo $PLACED;}else{ echo"0";}; ?></b></span> | RECEIVED: <?php if(isset($RECEIVED)){echo $RECEIVED;}else{ echo"0";}; ?> | FOR DELIVER: <?php if(isset($DELIVER)){echo $DELIVER;}else{ echo"0";}; ?></h5>
    <?php endif; ?>

    <?php  if($_SESSION['user_type'] == "kitchen") :?>
        <h5>NEW ORDER: <?php if(isset($PREPARING)){echo $PREPARING;}else{ echo"0";}; ?> | COOKING: <?php if(isset($COOKING)){echo $COOKING;}else{ echo"0";}; ?></h5>
    <?php endif; ?>

    <?php  if($_SESSION['user_type'] == "admin" || $_SESSION['user_type'] == "ba") :?>
        <h5>NEW ORDERS: <span style="color:orange; "><b><?php if(isset($PLACED)){echo $PLACED;}else{ echo"0";}; ?></b></span> | RECEIVED: <?php if(isset($RECEIVED)){echo $RECEIVED;}else{ echo"0";}; ?> | FOR DELIVER: <?php if(isset($DELIVER)){echo $DELIVER;}else{ echo"0";}; ?></h5>
        <h5>PREPARING: <?php if(isset($PREPARING)){echo $PREPARING;}else{ echo"0";}; ?> | COOKING: <?php if(isset($COOKING)){echo $COOKING;}else{ echo"0";}; ?></h5>
    <?php endif; ?>

</div>

<?php if($_SESSION['user_type'] == "kitchen") : ?> 
    <div class="card-columns" style="padding: 20px">
    <!-- -----------PREPARING TO COOK----------------- -->
        <?php foreach($orders as $or) : ?>
            <?php if($or['order_status'] == "PREPARING TO COOK") : ?> 
                <?php if($_SESSION['branch_id'] == $or['branch_id']) : ?> 

                    <a href="order/process/<?php echo $or['order_id'] ?>" data-toggle="tooltip" title="Process Order" style="color:black">
                    <div class='card' style='width: 18rem; padding-top: 20px; background-color:lightgreen'>  
                            <div style="text-align:center">
                                <h1><?php echo $or['reference_number']; ?></h1>
                                <?php echo $or['order_status']; ?>
                                

                            </div>
                            <div class="card-body">
                                <p class="card-text">Time Ordered: <?php $doo = $or['datetime_ordered'];  ?> <?php echo $doo = date("M j, Y g:i a", strtotime($doo));?></p>
                                <p class="card-text">Room Number: <?php echo $or['room_no']; ?></p>
                                <p class="card-text">
                                    <?php
                                    if($or['advance_order'] == 1){
                                        echo 'Advance Order: Yes';
                                    }else{
                                        echo 'Advance Order: No';
                                    }
                                    ?>
                                </p>
                                <p class="card-text">
                                <?php if ($or['promo_code'] == '') : ?>
                                    <?php echo 'Amount: '.number_format($or['total_amount'],2); ?>
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
                                    <?php echo 'Amount: '.number_format($discountedAmt,2) . " (". $or['promo_code'].")"; ?>
                                <?php endif  ?>
                                </p>
                                
                                <div class="row">
                                    <div class="col-6">
                                        <!-- <a href="order/process/<?php echo $or['order_id'] ?>" data-toggle="tooltip" title="Process Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-sign-out-alt fa-5x"></i></a> -->
                                    </div>
                                    <div class="col-6">
                                        <a href="order/cancel/<?php echo $or['order_id'] ?>" onclick="return confirm('Press OK to confirm Cancel Order?')" data-toggle="tooltip" title="Cancel Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-window-close fa-5x" style="color:red"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </a>
                    
                <?php endif; ?>
            
            <?php endif; ?>
        <?php endforeach; ?>
   </div>                                     
    <span>----------------------------------------------------------------------------------------------------------------------------------</span>
    <div class="card-columns" style="padding: 20px">
    <!-- -----------cooking----------------- -->
        <?php foreach($orders as $or) : ?>
            <?php if($or['order_status'] == "COOKING") : ?> 
                <?php if($_SESSION['branch_id'] == $or['branch_id']) : ?> 

                    <a href="order/process/<?php echo $or['order_id'] ?>" data-toggle="tooltip" title="Process Order" style="color:black">
                    <div class='card' style='width: 18rem; padding-top: 20px; background-color:orange'>  
                            <div style="text-align:center">
                                <h1><?php echo $or['reference_number']; ?></h1>
                                <?php echo $or['order_status']; ?>
                                

                            </div>
                            <div class="card-body">
                                <p class="card-text">Time Ordered: <?php $doo = $or['datetime_ordered'];  ?> <?php echo date("M j, Y g:i a", strtotime($doo));?></p>
                                <p class="card-text">Room Number: <?php echo $or['room_no']; ?></p>
                                <p class="card-text">
                                    <?php
                                    if($or['advance_order'] == 1){
                                        echo 'Advance Order: Yes';
                                    }else{
                                        echo 'Advance Order: No';
                                    }
                                    ?>
                                </p>
                                <p class="card-text">
                                <?php if ($or['promo_code'] == '') : ?>
                                    <?php echo 'Amount: '.number_format($or['total_amount'],2); ?>
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
                                    <?php echo 'Amount: '.number_format($discountedAmt,2) . " (". $or['promo_code'].")"; ?>
                                <?php endif  ?>
                                </p>
                                
                                <div class="row">
                                    <div class="col-6">
                                        <!-- <a href="order/process/<?php echo $or['order_id'] ?>" data-toggle="tooltip" title="Process Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-sign-out-alt fa-5x"></i></a> -->
                                    </div>
                                    <div class="col-6">
                                        <a href="order/cancel/<?php echo $or['order_id'] ?>" onclick="return confirm('Press OK to confirm Cancel Order?')" data-toggle="tooltip" title="Cancel Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-window-close fa-5x" style="color:red"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </a>
                    
                <?php endif; ?>
            
            <?php endif; ?>
        <?php endforeach; ?>
        
    </div>
<?php else :  ?>


    <table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th scope="col">Time Ordered</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Room No</th>
            <th scope="col">Advance Order</th>
            <th scope="col">Reference No</th>
            <th scope="col">Location</th>
            <th scope="col-2">Action</th>
        </tr>
        </thead>
        <tbody>           
                <?php foreach($orders as $or) : ?>
                <!-- --------------- FRONT DESK --------------- -->
                    <?php if($_SESSION['user_type'] == "fd") : ?>
                        <?php if($_SESSION['branch_id'] == $or['branch_id']) : ?> 
                            <?php if($or['order_status'] == "PLACED" or $or['order_status'] == "RECEIVED" or $or['order_status'] == "FOR DELIVER") : ?> 
                                <tr class="table-active"> 
                                    <?php $doo = $or['datetime_ordered'];  ?> 
                                    <td><?php echo $doo = date("M j, Y g:i a", strtotime($doo));?></td>
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
                                    <td>
                                        <?php
                                            if($or['order_status'] == "PLACED"){
                                                echo "<span style='background-color:orange'>NEW ORDER</span>";
                                            }else{
                                                echo $or['order_status'];
                                            }
                                        ?>
                                    </td>
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

                                    <!-- longlat -->
                                    <?php
                                        $branch = explode(',', $or['longlat']);
                                        if(isset($branch[0]) && isset($branch[1])){
                                            $lat = $branch[0];
                                            $lon = $branch[1];
                                            echo "<td> <a href='http://maps.google.com/?q=$lat,$lon' target='_blank'><i class='fas fa-location-arrow fa-2x'></i></a></td>";
                                        }else{
                                            echo "<td></td>";
                                        }
                                    ?>
                                    
                                    <td>
                                        <a href="order/process/<?php echo $or['order_id'] ?>" data-toggle="tooltip" title="Process Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-sign-out-alt fa-2x"></i></a>&nbsp;&nbsp;
                                        <a href="order/cancel/<?php echo $or['order_id'] ?>" onclick="return confirm('Press OK to confirm Cancel Order?')" data-toggle="tooltip" title="Cancel Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-window-close fa-2x" style="color:red"></i></a>
                                    </td>
                                    
                                </tr>  
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?> 

                    <!-- --------------- KITCHEN --------------- -->
                    <?php if($_SESSION['user_type'] == "kitchen") : ?> 
                        <?php if($or['order_status'] == "PREPARING TO COOK" or $or['order_status'] == "COOKING") : ?> 
                            <?php if($_SESSION['branch_id'] == $or['branch_id']) : ?> 
                                <tr class="table-active"> 
                                    <?php $doo = $or['datetime_ordered'];  ?> 
                                    <td><?php echo $doo = date("M j, Y g:i a", strtotime($doo));?></td>
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
                                    <td>
                                        <?php
                                            if($or['order_status'] == "PREPARING TO COOK"){
                                                echo "<span style='background-color:orange'>PREPARING TO COOK</span>";
                                            }else{
                                                echo $or['order_status'];
                                            }
                                        ?>
                                    </td>
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

                                    <!-- longlat -->
                                    <?php
                                        $branch = explode(',', $or['longlat']);
                                        if(isset($branch[0]) && isset($branch[1])){
                                            $lat = $branch[0];
                                            $lon = $branch[1];
                                            echo "<td> <a href='http://maps.google.com/?q=$lat,$lon' target='_blank'><i class='fas fa-location-arrow fa-2x'></i></a></td>";
                                        }else{
                                            echo "<td></td>";
                                        }
                                    ?>
                                    
                                    <td>
                                        <a href="order/process/<?php echo $or['order_id'] ?>" data-toggle="tooltip" title="Process Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-sign-out-alt fa-2x"></i></a>&nbsp;&nbsp;
                                        <a href="order/cancel/<?php echo $or['order_id'] ?>" onclick="return confirm('Press OK to confirm Cancel Order?')" data-toggle="tooltip" title="Cancel Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-window-close fa-2x" style="color:red"></i></a>
                                    </td>
                                    
                                </tr>  
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?> 

                    <!-- --------------- ADMIN --------------- -->
                    <?php if($_SESSION['user_type'] == "admin") : ?> 
                        <?php if($or['order_status'] == "PLACED" or $or['order_status'] == "RECEIVED" or $or['order_status'] == "FOR DELIVER" or $or['order_status'] == "PREPARING TO COOK" or $or['order_status'] == "COOKING") : ?> 
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
                                
                                <td>
                                    <?php
                                        if($or['order_status'] == "PLACED"){
                                            echo "<span style='background-color:orange'>NEW ORDER</span>";
                                        }else{
                                            echo $or['order_status'];
                                        }
                                    ?>
                                </td>
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

                                <!-- longlat -->
                                <?php
                                    $branch = explode(',', $or['longlat']);
                                    if(isset($branch[0]) && isset($branch[1])){
                                        $lat = $branch[0];
                                        $lon = $branch[1];
                                        echo "<td> <a href='http://maps.google.com/?q=$lat,$lon' target='_blank'><i class='fas fa-location-arrow fa-2x'></i></a></td>";
                                    }else{
                                        echo "<td></td>";
                                    }
                                ?>
                               
                                
                                <td>
                                    <a href="order/process/<?php echo $or['order_id'] ?>" data-toggle="tooltip" title="Process Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-sign-out-alt fa-2x"></i></a>&nbsp;&nbsp;
                                    <a href="order/cancel/<?php echo $or['order_id'] ?>" onclick="return confirm('Press OK to confirm Cancel Order?')" data-toggle="tooltip" title="Cancel Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-window-close fa-2x" style="color:red"></i></a>
                                </td>
                                
                            </tr>  
                        <?php endif; ?> 
                    <?php endif; ?> 

                    <!-- --------------- BRANCH ADMIN --------------- -->
                    <?php if($_SESSION['user_type'] == "ba") : ?> 
                        <?php if($or['order_status'] == "PLACED" or $or['order_status'] == "RECEIVED" or $or['order_status'] == "FOR DELIVER" or $or['order_status'] == "PREPARING TO COOK" or $or['order_status'] == "COOKING") : ?> 
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
                                    
                                    <td>
                                        <?php
                                            if($or['order_status'] == "PLACED"){
                                                echo "<span style='background-color:orange'>NEW ORDER</span>";
                                            }else{
                                                echo $or['order_status'];
                                            }
                                        ?>
                                    </td>
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

                                    <!-- longlat -->
                                    <?php
                                        $branch = explode(',', $or['longlat']);
                                        if(isset($branch[0]) && isset($branch[1])){
                                            $lat = $branch[0];
                                            $lon = $branch[1];
                                            echo "<td> <a href='http://maps.google.com/?q=$lat,$lon' target='_blank'><i class='fas fa-location-arrow fa-2x'></i></a></td>";
                                        }else{
                                            echo "<td></td>";
                                        }
                                    ?>
                                    
                                    <td>
                                        <a href="order/process/<?php echo $or['order_id'] ?>" data-toggle="tooltip" title="Process Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-sign-out-alt fa-2x"></i></a>&nbsp;&nbsp;
                                        <a href="order/cancel/<?php echo $or['order_id'] ?>" onclick="return confirm('Press OK to confirm Cancel Order?')" data-toggle="tooltip" title="Cancel Order" <?= $or['order_status'] == 'COMPLETED' ? 'class="disabled"' : '' ?>><i class="fas fa-window-close fa-2x" style="color:red"></i></a>
                                    </td>
                                    
                                </tr>
                            <?php endif; ?>
                        <?php endif; ?> 
                    <?php endif; ?> 
                <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?> 
</div>
<!-- /.content-wrapper -->

