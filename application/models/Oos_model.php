<?php
class Oos_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }


    public function login(){
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', $this->input->post('password'));
        $query = $this->db->get('user_profile_tb');
        $loginCnt = $query->num_rows();
        
        if($loginCnt == 0){
            return false;
        }else{
            return $query->result_array();
        }
        return false;
    }

    public function login_logs(){
        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'LOGIN',
            'username' =>  $username,
        );
        $this->db->insert('logs_tb', $logs);
    }

    public function logout_logs(){
        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'LOGOUT',
            'username' =>  $username,
        );
        $this->db->insert('logs_tb', $logs);
    }

    public function view_hotel_code(){
        $query = $this->db->get('hotel_branch_tb');
        return $query->result_array();
        
    }

    // ------------------ profile ------------------

    public function view_profile(){
        $query = $this->db->query('SELECT user_profile_tb.name AS user_name, hotel_branch_tb.name AS hotel_name, user_profile_tb.*, hotel_branch_tb.* FROM `user_profile_tb` INNER JOIN hotel_branch_tb ON user_profile_tb.branch_id = hotel_branch_tb.branch_id');
        return $query->result_array();
    }


    public function add_profile(){
        
         // insert logs
         date_default_timezone_set('Asia/Manila');
         $date = date('F j, Y');
         $time = date('g:i:a');
         $username = $_SESSION['username'];
         
         $logs = array(
             'date' => $date,
             'time' => $time,
             'action' => 'ADD PROFILE',
             'username' =>  $username,
             'notes' =>  'Added New Profile: '.$this->input->post('username'),
         );
         $this->db->insert('logs_tb', $logs);

        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'name' => $this->input->post('name'),
            'position' => $this->input->post('position'),
            'status' => $this->input->post('status'),
            'user_type' => $this->input->post('user_type'),
            'branch_id' => $this->input->post('branch_id'),  
        );

        return $this->db->insert('user_profile_tb', $data);
    }

    public function update_profile(){

        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'EDIT PROFILE',
            'username' =>  $username,
            'notes' =>  'Updated Profile: '.$this->input->post('username'),
        );
        $this->db->insert('logs_tb', $logs);

        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'name' => $this->input->post('name'),
            'position' => $this->input->post('position'),
            'status' => $this->input->post('status'),
            'user_type' => $this->input->post('user_type'),
            'branch_id' => $this->input->post('branch_id'),  
        );

        $this->db->where('user_id', $this->input->post('user_id'));
        return $this->db->update('user_profile_tb', $data);
    }

    public function edit_profile($id){
        $query = $this->db->query("SELECT user_profile_tb.name AS user_name, hotel_branch_tb.name AS hotel_name, user_profile_tb.*, hotel_branch_tb.* FROM `user_profile_tb` INNER JOIN hotel_branch_tb ON user_profile_tb.branch_id = hotel_branch_tb.branch_id where user_profile_tb.user_id = '$id'");
        return $query->row_array();
    }

    public function delete_profile($id){
        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'DELETE PROFILE',
            'username' =>  $username
        );
        $this->db->insert('logs_tb', $logs);

        $this->db->where('user_id', $id);
        $this->db->delete('user_profile_tb');
        return true;
    }

    // ------------------ branches ------------------

    public function view_branch(){
        $query = $this->db->get('hotel_branch_tb');
        return $query->result_array();
    }

    public function add_branch(){

        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'ADD BRANCH',
            'username' =>  $username,
            'notes' =>  'Added New Branch: '.$this->input->post('code'),
        );
        $this->db->insert('logs_tb', $logs);

        $data = array(
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'location' => $this->input->post('location'),
            'notes' => $this->input->post('notes'),
        );

        return $this->db->insert('hotel_branch_tb', $data);
    }

    public function edit_branch($id){
        $query = $this->db->get_where('hotel_branch_tb', array('branch_id' => $id));
        return $query->row_array();
    }

    public function update_branch(){
        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'EDIT BRANCH',
            'username' =>  $username,
            'notes' =>  'Updated Branch: '.$this->input->post('code'),
        );
        $this->db->insert('logs_tb', $logs);
        
        $data = array(
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'location' => $this->input->post('location'),
            'notes' => $this->input->post('notes'), 
        );

        $this->db->where('branch_id', $this->input->post('branch_id'));
        return $this->db->update('hotel_branch_tb', $data);
    }

    public function delete_branch($id){
        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'DELETE BRANCH',
            'username' =>  $username,
        );
        $this->db->insert('logs_tb', $logs);

        $this->db->where('branch_id', $id);
        $this->db->delete('hotel_branch_tb');
        return true;
    }

    // ------------------ promo ------------------


    public function view_promo(){
        $query = $this->db->get('promo_codes_tb');
        return $query->result_array();
    }

    public function add_promo(){

        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'ADD PROMO CODE',
            'username' =>  $username,
            'notes' =>  'Added New Promo Code: '.$this->input->post('code'),
        );
        $this->db->insert('logs_tb', $logs);


            foreach($this->input->post('branch') as $br){
                $rsbranch .= $br.",";
            }

            $data = array(
                'promo_code' => $this->input->post('code'),
                'amount' => $this->input->post('amount'),
                'percent' => $this->input->post('percent'),
                'valid_from' => $this->input->post('valid_from'),
                'valid_to' => $this->input->post('valid_to'),
                'status' => $this->input->post('status'),
                'branch_id' => $rsbranch
            );
       
        return $this->db->insert('promo_codes_tb', $data);
    }

    public function edit_promo($id){
        $query = $this->db->get_where('promo_codes_tb', array('promo_id' => $id));
        return $query->row_array();
    }

    public function update_promo(){

        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'UPDATE PROMO CODE',
            'username' =>  $username,
            'notes' =>  'Updated Promo Code: '.$this->input->post('code'),
        );
        $this->db->insert('logs_tb', $logs);

        $rsbranch = 0;
        foreach($this->input->post('branch') as $br){
            $rsbranch .= $br.",";
        }

        $data = array(
            'promo_code' => $this->input->post('code'),
            'amount' => $this->input->post('amount'),
            'percent' => $this->input->post('percent'),
            'valid_from' => $this->input->post('valid_from'),
            'valid_to' => $this->input->post('valid_to'),
            'status' => $this->input->post('status'), 
            'branch_id' => $rsbranch, 
        );

        $this->db->where('promo_id', $this->input->post('promo_id'));
        return $this->db->update('promo_codes_tb', $data);
    }

    public function delete_promo($id){

        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'DELETE PROMO CODE',
            'username' =>  $username,
        );
        $this->db->insert('logs_tb', $logs);

        $this->db->where('promo_id', $id);
        $this->db->delete('promo_codes_tb');
        return true;
    }

    // ------------------ food menu ------------------
    
    public function view_menu(){
        $query = $this->db->get('food_menu_tb');
        return $query->result_array();
    }

    public function add_menu(){

            // ---- image upload ----
            $config['upload_path'] = './assets/food_menu_images/';
            $config['allowed_types']        = 'gif|jpg|png';
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            // $this->upload->do_upload($this->input->post('food_image'));
            
            if (!$this->upload->do_upload('file_name')) {
                $error = array('error' => $this->upload->display_errors());
    
                echo json_encode($error);
            } else {

                // insert logs
                date_default_timezone_set('Asia/Manila');
                $date = date('F j, Y');
                $time = date('g:i:a');
                $username = $_SESSION['username'];
                
                $logs = array(
                    'date' => $date,
                    'time' => $time,
                    'action' => 'ADD MENU',
                    'username' =>  $username,
                    'notes' =>  'Added New Menu: '.$this->input->post('name'),
                );
                $this->db->insert('logs_tb', $logs);

                $data = $this->upload->data();
                $path = json_decode(json_encode($data),true);

                $data = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'category' => $this->input->post('category'),
                    'amount' => $this->input->post('amount'),
                    'quantity' => $this->input->post('quantity'),
                    'branch_id' => $this->input->post('branch'),
                    'image' => $path['file_name']
                );
            }
    
        return $this->db->insert('food_menu_tb', $data);
    }
    
    public function edit_menu($id){
        $query = $this->db->get_where('food_menu_tb', array('menu_id' => $id));
        return $query->row_array();
    }

    public function update_menu(){

            // ---- image upload ----
            $config['upload_path'] = './assets/food_menu_images/';
            $config['allowed_types']        = 'gif|jpg|png';
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            // delete previous img
            $prev_path = $this->input->post('previous_img');
            unlink('./assets/food_menu_images/' . $prev_path);

            $this->load->library('upload', $config);

            
            if (!$this->upload->do_upload('file_name')) {
                $error = array('error' => $this->upload->display_errors());
    
                echo json_encode($error);
            } else {

                // insert logs
                date_default_timezone_set('Asia/Manila');
                $date = date('F j, Y');
                $time = date('g:i:a');
                $username = $_SESSION['username'];
                
                $logs = array(
                    'date' => $date,
                    'time' => $time,
                    'action' => 'UPDATE MENU',
                    'username' =>  $username,
                    'notes' =>  'Updated Menu: '.$this->input->post('name'),
                );
                $this->db->insert('logs_tb', $logs);

                $data = $this->upload->data();
                $path = json_decode(json_encode($data),true);

                $data = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'category' => $this->input->post('category'),
                    'amount' => $this->input->post('amount'),
                    'quantity' => $this->input->post('quantity'),
                    'branch_id' => $this->input->post('branch'),
                    'image' => $path['file_name']
                );
            }
    

        $this->db->where('menu_id', $this->input->post('menu_id'));
        return $this->db->update('food_menu_tb', $data);
    }

    public function delete_menu($id){
    // insert logs
    date_default_timezone_set('Asia/Manila');
    $date = date('F j, Y');
    $time = date('g:i:a');
    $username = $_SESSION['username'];

    $logs = array(
        'date' => $date,
        'time' => $time,
        'action' => 'DELETE MENU',
        'username' =>  $username,
    );
    $this->db->insert('logs_tb', $logs);


            $img = $this->uri->segment('4');

            $config['upload_path'] = './assets/food_menu_images/';
            $config['allowed_types']        = 'gif|jpg|png';

            unlink('./assets/food_menu_images/' . $img);

        $this->db->where('menu_id', $id);
        $this->db->delete('food_menu_tb');
        return true;
    }

    // ------------------ orders ------------------
    
    public function view_orders(){
        $query = $this->db->get('orders_tb');
        return $query->result_array();
    }

    public function edit_orders($id){
        $query = $this->db->get_where('orders_tb', array('order_id' => $id));
        return $query->row_array();
    }

    public function view_items($id){
        // $query = $this->db->get_where('ordered_items_tb', array('order_id' => $id));
        $query = $this->db->query("SELECT c.name AS food_menu_name, b.name AS orders_name, c.quantity AS food_menu_quantity, a.quantity AS ordered_items_quantity, c.amount AS food_menu_amount, a.*, b.*, c.* FROM ordered_items_tb a INNER JOIN orders_tb b ON a.order_id = b.order_id LEFT JOIN food_menu_tb c ON a.menu_id = c.menu_id WHERE b.order_id = '$id'");
        return $query->result_array();
    }
   

    public function cancel_order($id){
        
        // insert logs
        $query = $this->db->get_where('orders_tb', array('order_id' => $id));
        foreach($query->result_array() as $row){
            $reference_number =  $row['reference_number'];
        };
        

        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'ORDER CANCELLED',
            'username' =>  $username,
            'reference_number' =>  $reference_number,
            'notes' =>  'Cancelled Order: '.$id,
        );
        $this->db->insert('logs_tb', $logs);

        
        $data = array(
            'order_status' => 'CANCELLED',
        );

        $this->db->where('order_id', $id);
        return $this->db->update('orders_tb', $data);
    }

    
    public function update_order($id){
        
        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'ORDER RECEIVED',
            'username' =>  $username,
            'reference_number' =>  $this->input->post('reference_number'),
            'notes' =>  'Order Received: '.$id,
        );
        $this->db->insert('logs_tb', $logs);

        date_default_timezone_set('Asia/Manila');
        $date_log = date("Y-m-d H:i:s");

        $data = array(
            'room_no' => $this->input->post('room_no'),
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'notes' => $this->input->post('notes'),
            'datetime_checkin' => $date_log,
            'order_status' => 'RECEIVED',
        );

        $this->db->where('order_id', $id);
        return $this->db->update('orders_tb', $data);
    }

    public function update_order_kitchen($id){

        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'ORDER PREPARING TO COOK',
            'username' =>  $username,
            'reference_number' =>  $this->input->post('reference_number'),
            'notes' =>  'Order Preparing to cook: '.$id,
        );
        $this->db->insert('logs_tb', $logs);

        $data = array(
            'room_no' => $this->input->post('room_no'),
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'notes' => $this->input->post('notes'),
            'order_status' => 'PREPARING TO COOK',
        );

        $this->db->where('order_id', $id);
        return $this->db->update('orders_tb', $data);
    }

    public function update_order_cooking($id){

        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'COOKING',
            'username' =>  $username,
            'reference_number' =>  $this->input->post('reference_number'),
            'notes' =>  'Order Cooking: '.$id,
        );
        $this->db->insert('logs_tb', $logs);

        $data = array(
            'room_no' => $this->input->post('room_no'),
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'notes' => $this->input->post('notes'),
            'order_status' => 'COOKING',
        );

        $this->db->where('order_id', $id);
        return $this->db->update('orders_tb', $data);
    }

    public function update_order_deliver($id){

        // insert logs
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y');
        $time = date('g:i:a');
        $username = $_SESSION['username'];
        
        $logs = array(
            'date' => $date,
            'time' => $time,
            'action' => 'FOR DELIVER',
            'username' =>  $username,
            'reference_number' =>  $this->input->post('reference_number'),
            'notes' =>  'Order For Deliver: '.$id,
        );
        $this->db->insert('logs_tb', $logs);

        $data = array(
            'room_no' => $this->input->post('room_no'),
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'notes' => $this->input->post('notes'),
            'order_status' => 'COOKING',
        );

        $data = array(
            'room_no' => $this->input->post('room_no'),
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'notes' => $this->input->post('notes'),
            'order_status' => 'FOR DELIVER',
        );

        $this->db->where('order_id', $id);
        return $this->db->update('orders_tb', $data);
    }

    public function update_order_complete($id){

         // insert logs
         date_default_timezone_set('Asia/Manila');
         $date = date('F j, Y');
         $time = date('g:i:a');
         $username = $_SESSION['username'];
         
         $logs = array(
             'date' => $date,
             'time' => $time,
             'action' => 'COMPLETED',
             'username' =>  $username,
             'reference_number' =>  $this->input->post('reference_number'),
             'notes' =>  'Order Completed: '.$id,
         );
         $this->db->insert('logs_tb', $logs);

        date_default_timezone_set('Asia/Manila');
        $date_log = date("Y-m-d H:i:s");

        $data = array(
            'room_no' => $this->input->post('room_no'),
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'notes' => $this->input->post('notes'),
            'datetime_delivered' =>$date_log,
            'order_status' => 'COMPLETED',
        );

        $this->db->where('order_id', $id);
        return $this->db->update('orders_tb', $data);
    }

    public function view_logs(){
        $query = $this->db->query('SELECT * FROM logs_tb INNER JOIN user_profile_tb ON logs_tb.username = user_profile_tb.username');
        return $query->result_array();
    }
}
?>