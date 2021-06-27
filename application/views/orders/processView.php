<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<h1 style="text-align:center; padding: 1rem;">View Order Details</h1>

<form class="create-form" action="<?= base_url('order/submit/'.$this->uri->segment('3')); ?>" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-12" style="text-align:center">
                <h2>Reference Number</h2>
                <?php
                    foreach($hotel_code as $hc){
                        if($orders['branch_id'] == $hc['branch_id']){
                            $bname = $hc['name'];
                            echo " <p><i><b>($bname)</b></i></p>";
                        };
                    }
                    
                ?>
            </div>
            <div class="col-sm-12" style="text-align:center">
                <h1><b><?php echo $orders['reference_number']; ?></b></h1>
            </div>
            <div class="col-sm-6">
                    <input type="hidden" name="order_id" value="<?php echo $orders['order_id']; ?>">
                    <input type="hidden" name="reference_number" value="<?php echo $orders['reference_number']; ?>">
                    <label class="form-label">Room Number: </label>
                    <input type="text" style="font-size: 20pt; font-weight: bold"name="room_no" value="<?php echo $orders['room_no']; ?>" class="form-control" >
            </div>

            <div class="col-sm-6">
                    <label class="form-label">Name: </label>
                    <input type="text" value="<?php echo $orders['name']; ?>" name="name" class="form-control">
            </div>

            <div class="col-sm-6">
                    <label class="form-label">Contact Number: </label>
                    <input type="text" value="<?php echo $orders['contact']; ?>" name="contact" class="form-control">
            </div>

            <div class="col-sm-6">
                    <label class="form-label">Time Ordered: </label>
                    <p><?php echo $orders['datetime_ordered']; ?></p>
            </div>

            <div class="col-sm-6">
                    <label class="form-label">Time Checked-In: </label>
                    <p><?php echo $orders['datetime_checkin']; ?></p>
            </div>

            <div class="col-sm-6">
            <?php
                    if($orders['advance_order'] == 1){
                        echo '<label class="form-label" style="color: red">Advanced Order</label>';
                    }
                    ?>
            </div>

            <div class="col-sm-6">
                    <label class="form-label">Promo Code: </label>
            </div>

            <div class="col-sm-6">
                    <b style="background-color: lightblue; border: solid lightblue 10px"><?php echo $orders['promo_code']; ?></b>
            </div>

            <div class="col-sm-12">
                    <label class="form-label">Notes: </label>
                    <textarea name="notes" class="form-control"><?php echo $orders['notes']; ?></textarea>
            </div>

            <div class="col-sm-12" style="margin-top: 2em;">
                <b>ITEMS:</b>
            </div>

            <?php foreach($items as $it) : ?>
            <div class="col-sm-12" style="border: solid gray 2px; margin-bottom: 5px;">
                <div class="row">
                    <div class="col-sm-6">
                        <img style="margin-bottom: 10px;" src="<?php echo base_url()."assets/"; ?>food_menu_images/<?php echo $it['image']; ?>" alt="<?php echo $it['food_menu_name']; ?>" width="50" height="50">
                    </div>
                    <div class="col-sm-6">
                    <?php echo $it['food_menu_name']; ?><br>
                    Quantity: <b><?php echo $it['ordered_items_quantity']; ?></b> pcs.<br>
                    Amount: <b><?php echo floatval($it['menu_amt']); ?></b>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>

            <div class="col-sm-12" style="margin-top: 2em;">
                <b>TOTAL AMOUT: <h1>
                <?php if(isset($it['total_amount'])){
                    echo "₱ ".number_format($it['total_amount'],2) . '<br>';
                    
                    if($it['promo_amt'] != null){

                        if($it['promo_percent'] == 1){

                            $perde = floatval($it['promo_amt'])*.01;
                            $percent = floatval($it['total_amount']) * $perde;
                            echo '<span style="border-bottom: solid black 2px;"> - '.$it['promo_amt']. '%<br></span>';
                            $gtotal = floatval($it['total_amount']) - $percent;

                            echo "₱ ".number_format($gtotal,2);
                        }else  if($it['promo_percent'] == 0){
                            echo '<span style="border-bottom: solid black 2px;"> - ₱'.$it['promo_amt'] . '<br></span>';
                            $gtotal = floatval($it['total_amount']) - floatval($it['promo_amt']);
                            if($gtotal <= 0){
                                $gtotal = "0.00";
                            }
                            echo "₱ ".number_format($gtotal,2);
                        }
                        
                    }
                   
                
                } else {
                    echo '0';
                } ?>
                </h1></b>
            </div>
                
        </div>
    </form>
</div>