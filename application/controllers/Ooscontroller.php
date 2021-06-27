<?php
    class Ooscontroller extends CI_Controller{
        
        public function login(){
           
            $this->load->view('templates/header');
            $this->load->view('login');
        }

        public function logout(){
            $this->oos_model->logout_logs();

            session_unset();
            session_destroy();

            $this->load->view('templates/header');
            $this->load->view('login');
        }

        public function home(){
            $this->form_validation->set_rules('username', 'Username',
            'required');
            $this->form_validation->set_rules('password', 'Password',
            'required');

            if($this->form_validation->run() == FALSE){
                $this->load->view('templates/header');
                $this->load->view('login');
                
            }else{
                 if($this->oos_model->login()) {
                    $data['profile'] =  $this->oos_model->login();
                   
                    $name = json_encode($data['profile'][0]['name']);
                    $user_id = json_encode($data['profile'][0]['user_id']);
                    $username = json_encode($data['profile'][0]['username']);
                    $branch_id = json_encode($data['profile'][0]['branch_id']);
                    $user_type = json_encode($data['profile'][0]['user_type']);
                    $status = json_encode($data['profile'][0]['status']);
                       
                    $status =  trim($status, '"');

                    if($status == 1){
                        $_SESSION['name'] =  trim($name, '"');
                        $_SESSION['username'] =  trim($username, '"');
                        $_SESSION['user_id'] =  trim($user_id, '"');
                        $_SESSION['branch_id'] =  trim($branch_id, '"');
                        $_SESSION['user_type'] =  trim($user_type, '"');
    


                        // ------------ ACCESS LEVELS ------------

                        if($_SESSION['user_type'] == "admin"){
                            $_SESSION['food_menu_access'] = 1;
                            $_SESSION['promo_codes_access'] = 1;
                            $_SESSION['profile_access'] = 1;
                            $_SESSION['branches_access'] = 1;
                            $_SESSION['logs_access'] = 1;

                            $_SESSION['roomBtn_access'] = 1;
                            $_SESSION['kitchenBtn_access'] = 0; //temp
                            $_SESSION['cookingBtn_access'] = 0; //temp
                            $_SESSION['deliverBtn_access'] = 1;
                            $_SESSION['completeBtn_access'] = 1;
                        }else if($_SESSION['user_type'] == "fd"){
                            $_SESSION['food_menu_access'] = 0;
                            $_SESSION['promo_codes_access'] = 0;
                            $_SESSION['profile_access'] = 0;
                            $_SESSION['branches_access'] = 0;
                            $_SESSION['logs_access'] = 1;
    
                            $_SESSION['roomBtn_access'] = 1;
                            $_SESSION['kitchenBtn_access'] = 0; //temp
                            $_SESSION['cookingBtn_access'] = 0;
                            $_SESSION['deliverBtn_access'] = 1; //temp
                            $_SESSION['completeBtn_access'] = 1;
                        }else if($_SESSION['user_type'] == "kitchen"){
                            $_SESSION['food_menu_access'] = 0;
                            $_SESSION['promo_codes_access'] = 0;
                            $_SESSION['profile_access'] = 0;
                            $_SESSION['branches_access'] = 0;
                            $_SESSION['logs_access'] = 1;
    
                            $_SESSION['roomBtn_access'] = 0;
                            $_SESSION['kitchenBtn_access'] = 0;
                            $_SESSION['cookingBtn_access'] = 1;
                            $_SESSION['deliverBtn_access'] = 1;
                            $_SESSION['completeBtn_access'] = 0;
                        }else if($_SESSION['user_type'] == "ba"){
                            $_SESSION['food_menu_access'] = 0;
                            $_SESSION['promo_codes_access'] = 0;
                            $_SESSION['profile_access'] = 0;
                            $_SESSION['branches_access'] = 0;
                            $_SESSION['logs_access'] = 1;

                            $_SESSION['roomBtn_access'] = 1;
                            $_SESSION['kitchenBtn_access'] = 0; //temp
                            $_SESSION['cookingBtn_access'] = 0; //temp
                            $_SESSION['deliverBtn_access'] = 1;
                            $_SESSION['completeBtn_access'] = 1;
                        }

                        // ------------ END ACCESS LEVELS ------------
                            
                        $this->oos_model->login_logs();
                        $this->myhome();
                    }elseif($status == 0){
                        $this->session->set_flashdata('errormsg', 'User Disabled!');

                        $this->load->view('templates/header');
                        $this->load->view('login');
                    }
                   
                        
                }     
                else{
                    $this->session->set_flashdata('errormsg', 'No User found!');

                    $this->load->view('templates/header');
                    $this->load->view('login');
                } 
               
            }
        }

        public function myhome(){
            if(isset($_SESSION['user_id'])){
                // $this->load->view('templates/header');
                // $this->load->view('templates/navbar');
                // $this->load->view('home');
                // $this->load->view('templates/footer');
                $data['orders'] = $this->oos_model->view_orders();
                $data['hotel_code'] = $this->oos_model->view_hotel_code();
                $nav['vieworders'] = $this->oos_model->view_orders();

                $this->load->view('templates/header');
                $this->load->view('templates/navbar', $nav);
                $this->load->view('orders/view', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        // ------------------ profile ------------------

        public function viewProfile(){
            if(isset($_SESSION['user_id'])){
                $data['profile'] = $this->oos_model->view_profile();
                $nav['vieworders'] = $this->oos_model->view_orders();

                $this->load->view('templates/header');
                $this->load->view('templates/navbar', $nav);
                $this->load->view('profiles/view', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
            $this->load->view('login');
            }
        }

        public function addProfile(){
            if(isset($_SESSION['user_id'])){
                $this->form_validation->set_rules('name', 'Name',
                'required');
                $this->form_validation->set_rules('position', 'Position',
                'required');
                $this->form_validation->set_rules('username', 'Username',
                'required|min_length[8]');
                $this->form_validation->set_rules('password', 'Password',
                'required|min_length[8]');

                if($this->form_validation->run() === FALSE){
                    $data['hotel_code'] = $this->oos_model->view_hotel_code();
                    $nav['vieworders'] = $this->oos_model->view_orders();

                    // echo json_encode($data['allotments']);
                    $this->load->view('templates/header');
                    $this->load->view('templates/navbar', $nav);
                    $this->load->view('profiles/create', $data);
                    $this->load->view('templates/footer');
                }else{
                    $this->oos_model->add_profile();
                    $this->session->set_flashdata('successmsg', 'User successfully created!');
                    // $url = $_SERVER['HTTP_REFERER'];
                    // redirect($url);
                    redirect('profile');
                }
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        public function editProfile($id){
            if(isset($_SESSION['user_id'])){
                $this->form_validation->set_rules('name', 'Name',
                'required');
                $this->form_validation->set_rules('position', 'Position',
                'required');
                $this->form_validation->set_rules('username', 'Username',
                'required|min_length[8]');
                $this->form_validation->set_rules('password', 'Password',
                'required|min_length[8]');

                if($this->form_validation->run() === FALSE){
                    $data['profile'] = $this->oos_model->edit_profile($id);
                    $data['hotel_code'] = $this->oos_model->view_hotel_code();
                    $nav['vieworders'] = $this->oos_model->view_orders();

                    // echo json_encode($data['hotel_code']);
                    $this->load->view('templates/header');
                    $this->load->view('templates/navbar', $nav);
                    $this->load->view('profiles/edit', $data);
                    $this->load->view('templates/footer');
                }else{
                    $this->oos_model->update_profile();
                    $this->session->set_flashdata('successmsg', 'User successfully updated!');
                    redirect('profile');
                }
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
            
        }

        public function deleteProfile($id){
            if(isset($_SESSION['user_id'])){
                $this->oos_model->delete_profile($id);
                $this->session->set_flashdata('successmsg', 'User successfully deleted!');
                $url = $_SERVER['HTTP_REFERER'];
                redirect($url);
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        // ------------------ branches ------------------

        public function viewBranch(){
            if(isset($_SESSION['user_id'])){
                $data['branch'] = $this->oos_model->view_branch();
                $nav['vieworders'] = $this->oos_model->view_orders();

                $this->load->view('templates/header');
                $this->load->view('templates/navbar', $nav);
                $this->load->view('branch/view', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        public function addBranch(){
            if(isset($_SESSION['user_id'])){
                $this->form_validation->set_rules('code', 'code',
                'required');
                $this->form_validation->set_rules('name', 'Name',
                'required');

                if($this->form_validation->run() === FALSE){
                    $nav['vieworders'] = $this->oos_model->view_orders();

                    // echo json_encode($data['allotments']);
                    $this->load->view('templates/header');
                    $this->load->view('templates/navbar', $nav);
                    $this->load->view('branch/create');
                    $this->load->view('templates/footer');
                }else{
                    $this->oos_model->add_branch();
                    $this->session->set_flashdata('successmsg', 'Branch successfully created!');
                    // $url = $_SERVER['HTTP_REFERER'];
                    // redirect($url);
                    redirect('branch');
                }
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        public function editBranch($id){
            if(isset($_SESSION['user_id'])){
                $this->form_validation->set_rules('code', 'Code',
                'required');
                $this->form_validation->set_rules('name', 'Name',
                'required');

                if($this->form_validation->run() === FALSE){
                    $data['branch'] = $this->oos_model->edit_branch($id);
                    $nav['vieworders'] = $this->oos_model->view_orders();

                    // echo json_encode($data['branch']);
                    $this->load->view('templates/header');
                    $this->load->view('templates/navbar', $nav);
                    $this->load->view('branch/edit', $data);
                    $this->load->view('templates/footer');
                }else{
                    $this->oos_model->update_branch();
                    $this->session->set_flashdata('successmsg', 'Branch successfully updated!');
                    redirect('branch');
                }
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
            
        }

        public function deleteBranch($id){
            if(isset($_SESSION['user_id'])){
                $this->oos_model->delete_branch($id);
                $this->session->set_flashdata('successmsg', 'Branch successfully deleted!');
                $url = $_SERVER['HTTP_REFERER'];
                redirect($url);
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        // ------------------ promo ------------------

        public function addPromo(){
            if(isset($_SESSION['user_id'])){
                $this->form_validation->set_rules('code', 'code',
                'required');
                $this->form_validation->set_rules('amount', 'Amount',
                'required');
                $this->form_validation->set_rules('valid_from', 'Valid From',
                'required');
                $this->form_validation->set_rules('valid_to', 'Valid To',
                'required');


                if($this->form_validation->run() === FALSE){
                    $data['branch'] = $this->oos_model->view_branch();
                    $nav['vieworders'] = $this->oos_model->view_orders();

                    // echo json_encode($data['allotments']);
                    $this->load->view('templates/header');
                    $this->load->view('templates/navbar', $nav);
                    $this->load->view('promo/create', $data);
                    $this->load->view('templates/footer');
                }else{
                    $this->oos_model->add_promo();
                    $this->session->set_flashdata('successmsg', 'Promo successfully created!');
                    // $url = $_SERVER['HTTP_REFERER'];
                    // redirect($url);
                    redirect('promo');
                }
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }      
        
        public function viewPromo(){
            if(isset($_SESSION['user_id'])){
                $data['promo'] = $this->oos_model->view_promo();
                $data['hotel_code'] = $this->oos_model->view_hotel_code();
                $nav['vieworders'] = $this->oos_model->view_orders();

                $this->load->view('templates/header');
                $this->load->view('templates/navbar', $nav);
                $this->load->view('promo/view', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        public function editPromo($id){
            if(isset($_SESSION['user_id'])){
                $this->form_validation->set_rules('code', 'code',
                'required');
                $this->form_validation->set_rules('amount', 'Amount',
                'required');
                $this->form_validation->set_rules('valid_from', 'Valid From',
                'required');
                $this->form_validation->set_rules('valid_to', 'Valid To',
                'required');

                if($this->form_validation->run() === FALSE){
                    $data['hotel_code'] = $this->oos_model->view_hotel_code();
                    $data['promo'] = $this->oos_model->edit_promo($id);
                    $nav['vieworders'] = $this->oos_model->view_orders();

                    // echo json_encode($data['promo']);
                    $this->load->view('templates/header');
                    $this->load->view('templates/navbar', $nav);
                    $this->load->view('promo/edit', $data);
                    $this->load->view('templates/footer');
                }else{
                    $this->oos_model->update_promo();
                    $this->session->set_flashdata('successmsg', 'Promo successfully updated!');
                    redirect('promo');
                }
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
            
        }

        public function deletePromo($id){
            if(isset($_SESSION['user_id'])){
                $this->oos_model->delete_promo($id);
                $this->session->set_flashdata('successmsg', 'Promo successfully deleted!');
                $url = $_SERVER['HTTP_REFERER'];
                redirect($url);
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

         // ------------------ orders ------------------

         public function viewOrders(){
            if(isset($_SESSION['user_id'])){
                $data['orders'] = $this->oos_model->view_orders();
                $data['hotel_code'] = $this->oos_model->view_hotel_code();
                $nav['vieworders'] = $this->oos_model->view_orders();

                $this->load->view('templates/header');
                $this->load->view('templates/navbar', $nav);
                $this->load->view('orders/view', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        public function viewCompleted(){
            if(isset($_SESSION['user_id'])){
                $data['orders'] = $this->oos_model->view_orders();
                $data['hotel_code'] = $this->oos_model->view_hotel_code();
                $nav['vieworders'] = $this->oos_model->view_orders();

                $this->load->view('templates/header');
                $this->load->view('templates/navbar', $nav);
                $this->load->view('orders/completed', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        public function viewCancelled(){
            if(isset($_SESSION['user_id'])){
                $data['orders'] = $this->oos_model->view_orders();
                $data['hotel_code'] = $this->oos_model->view_hotel_code();
                $nav['vieworders'] = $this->oos_model->view_orders();

                $this->load->view('templates/header');
                $this->load->view('templates/navbar', $nav);
                $this->load->view('orders/cancelled', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        public function processOrder($id){
            if(isset($_SESSION['user_id'])){
                $data['orders'] = $this->oos_model->edit_orders($id);
                $data['items'] = $this->oos_model->view_items($id);
                $data['hotel_code'] = $this->oos_model->view_hotel_code();
                $nav['vieworders'] = $this->oos_model->view_orders();

                // echo json_encode($data['items']);
                $this->load->view('templates/header');
                $this->load->view('templates/navbar', $nav);
                $this->load->view('orders/process', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        public function processOrderView($id){
            if(isset($_SESSION['user_id'])){
                $data['orders'] = $this->oos_model->edit_orders($id);
                $data['items'] = $this->oos_model->view_items($id);
                $data['hotel_code'] = $this->oos_model->view_hotel_code();
                $nav['vieworders'] = $this->oos_model->view_orders();

                // echo json_encode($data['items']);
                $this->load->view('templates/header');
                $this->load->view('templates/navbar', $nav);
                $this->load->view('orders/processView', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        public function submitOrder($id){
            if(isset($_SESSION['user_id'])){
                $btn = $this->input->post('submit');
                // echo $btn;

                if($btn == 'roomBtn'){
                    $this->oos_model->update_order($id);
                    $this->session->set_flashdata('successmsg', 'Order successfully Received!');
                    redirect('orders');
                }
                else if($btn == 'kitchenBtn'){
                    $this->oos_model->update_order_kitchen($id);
                    $this->session->set_flashdata('successmsg', 'Order successfully forwarded to Kitchen!');
                    redirect('orders');
                }else if($btn == 'cookingBtn'){
                    $this->oos_model->update_order_cooking($id);
                    $this->session->set_flashdata('successmsg', 'Order is Cooking!');
                    redirect('orders');
                }else if($btn == 'deliverBtn'){
                    $this->oos_model->update_order_deliver($id);
                    $this->session->set_flashdata('successmsg', 'Order is For Delivery!');
                    redirect('orders');
                }else if($btn == 'completeBtn'){
                    $this->oos_model->update_order_complete($id);
                    $this->session->set_flashdata('successmsg', 'Order Complete!');
                    redirect('orders');
                }
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }


        public function cancelOrder($id){
            if(isset($_SESSION['user_id'])){
                $this->oos_model->cancel_order($id);
                $this->session->set_flashdata('successmsg', 'Order successfully Cancelled!');
                $url = $_SERVER['HTTP_REFERER'];
                redirect($url);
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        // ------------------ menu ------------------

        public function viewMenu(){
            if(isset($_SESSION['user_id'])){
                $data['hotel_code'] = $this->oos_model->view_hotel_code();
                $data['menu'] = $this->oos_model->view_menu();
                $nav['vieworders'] = $this->oos_model->view_orders();

                $this->load->view('templates/header');
                $this->load->view('templates/navbar', $nav);
                $this->load->view('menu/view', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

        public function addMenu(){
            if(isset($_SESSION['user_id'])){
                $this->form_validation->set_rules('name', 'Name',
                'required');
                $this->form_validation->set_rules('amount', 'Amount',
                'required');
                $this->form_validation->set_rules('quantity', 'Quantity',
                'required');


                if($this->form_validation->run() === FALSE){
                    $data['branch'] = $this->oos_model->view_branch();
                    $nav['vieworders'] = $this->oos_model->view_orders();

                    // echo json_encode($data['allotments']);
                    $this->load->view('templates/header');
                    $this->load->view('templates/navbar', $nav);
                    $this->load->view('menu/create', $data);
                    $this->load->view('templates/footer');
                }else{            
                
                    $this->oos_model->add_menu();
                    $this->session->set_flashdata('successmsg', 'Menu successfully created!');
                    redirect('menu');
                }
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }  

        public function editMenu($id){
            if(isset($_SESSION['user_id'])){
                $this->form_validation->set_rules('name', 'Name',
                'required');
                $this->form_validation->set_rules('amount', 'Amount',
                'required');
                $this->form_validation->set_rules('quantity', 'Quantity',
                'required');

                if($this->form_validation->run() === FALSE){
                    $data['branch'] = $this->oos_model->view_branch();
                    $data['hotel_code'] = $this->oos_model->view_hotel_code();
                    $data['menu'] = $this->oos_model->edit_menu($id);
                    $nav['vieworders'] = $this->oos_model->view_orders();

                    // echo json_encode($data['menu']);
                    $this->load->view('templates/header');
                    $this->load->view('templates/navbar', $nav);
                    $this->load->view('menu/edit', $data);
                    $this->load->view('templates/footer');
                }else{

                    $this->oos_model->update_menu();
                    $this->session->set_flashdata('successmsg', 'Menu successfully updated!');
                    redirect('menu');
                }
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
            
        }

        public function deleteMenu($id, $img){
            if(isset($_SESSION['user_id'])){
                $this->oos_model->delete_menu($id);
                $this->session->set_flashdata('successmsg', 'Menu successfully deleted!');
                $url = $_SERVER['HTTP_REFERER'];
                redirect($url);
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }

         // ------------------ logs ------------------
         public function viewLogs(){
            if(isset($_SESSION['user_id'])){
                $data['logs'] = $this->oos_model->view_logs();
                $nav['vieworders'] = $this->oos_model->view_orders();

                $this->load->view('templates/header');
                $this->load->view('templates/navbar', $nav);
                $this->load->view('logs', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('login');
            }
        }
    }
?>