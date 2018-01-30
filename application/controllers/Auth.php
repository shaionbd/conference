<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller {

    public $site_name = "Portfolio Site Name";
	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->model('AuthModel', 'authModel');

		if($this->session->userdata('admin_logged_in')) {
			return redirect('/admin');
		}
		date_default_timezone_set('Asia/Dhaka');
	}

	public function admin(){
	    redirect("/auth/admin/login");
    }
	// admin login view
	public function adminLoginView(){
		$data['title'] = $this->site_name.' | Admin Panel | Login';
		$this->load->view('admin/login',$data);
	}
	// login as user
	public function userLogin() {
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		if($this->form_validation->run('login')){	//if the validation passes the creating card rules
			$user = $this->checkDatabase('user');
			if($user){
				if($this->session->userdata('last_page')){
					return redirect($this->session->userdata('last_page'));
				}
				return redirect($user);
			} else{
				$this->user();
			}
		} else {
			$this->user();
		}
	}
	private function _sendMail($emailTo, $emailBody){
   

        $subject="Account Verification";//subject
        $config = Array(        
            'protocol' => 'sendmail',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
    
        $this->email->from('info@chobirbaksho.com', 'Chobir Baksho');
        $this->email->to($emailTo);  // replace it with receiver mail id
        $this->email->subject($subject); // replace it with relevant subject 
    
        $body = $this->load->view('emailBody',$emailBody,TRUE);
        $this->email->message($body);   
        $this->email->send();


	}
	private function _sendMailforgot($emailTo, $emailBody){
   

        $subject="Account Verification";//subject
        $config = Array(        
            'protocol' => 'sendmail',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
    
        $this->email->from('info@choirbaksho.com', 'Chobir Baksho');
        $this->email->to($emailTo);  // replace it with receiver mail id
        $this->email->subject($subject); // replace it with relevant subject 
    
        $body = $this->load->view('forgotPasswordEmailBody',$emailBody,TRUE);
        $this->email->message($body);   
        $this->email->send();


	}
	public function confirmUser(){
		$user_id = $this->uri->segment(3);
		$varification_id = $this->uri->segment(4);
		if(substr(base64_encode(hash_hmac('whirlpool', ($user_id+1), true)),0,80) == $varification_id){
			$this->authModel->confirmUser($user_id);
			$this->session->set_flashdata(['message' => 'Your account has been activated' , 'type' => 'success']);
			return redirect('auth/user');
		}else{
			return redirect('user');
		}
	}
	// create user
	public function createUser(){
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		if($this->form_validation->run('createUserAccount')){
			$code = $this->input->post('code');
			if(!$this->authModel->varifyRefCode($code)) {
				$this->session->set_flashdata(['message' => 'The refferal code doesn\'t match' , 'type' => 'warning']);
				$this->user();
			} else {
				$data = array(
					'name' => $this->input->post('rname'),
					'email' => $this->input->post('remail'),
					'password' => base64_encode(hash_hmac('whirlpool', $this->input->post('rpassword'), true)),
					'contact_no' => $this->input->post('contact_no'),
					'address' => $this->input->post('address')
				);
				array_filter($data);
				$insert_id = $this->authModel->createUser($data);
				$this->authModel->insertUserCode($insert_id);

				// varification message send to your rigister email
				$varificationId = substr(base64_encode(hash_hmac('whirlpool', ($insert_id+1), true)), 0, 80);

				$emailBody['name'] = ucfirst($this->input->post('rname'));
				$emailBody['link'] = base_url('auth/confirmUser/'.$insert_id.'/'.$varificationId);
				//$message = $this->load->view('user/email/emailBody',$emailBody);
                                $this->_sendMail($this->input->post('remail'),$emailBody);
				
				
				$this->session->set_flashdata(['message' => 'A verification link is sent to your account. Please check your email' , 'type' => 'success']);
				return redirect('auth/user');
			}
		}else{
			if($this->authModel->userIsUnique())
				$this->session->set_flashdata(['message' => $this->input->post('remail').' is already registered.' , 'type' => 'warning']);
			$this->user();
		}
	}

	// login as admin
	public function adminLogin(){
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		if($this->form_validation->run('login')){	//if the validation passes the creating card rules
			if($this->checkDatabase())
				return redirect('admin');
			else{
				// set error messsage
				$data['message'] = 'Sorry';
				$data['title'] = 'Medionics | Admin Panel | Login';
				$this->load->view('admin/login',$data);
			}
		}else{
            echo "Validation Check Problem";
            die();
			$data['title'] = 'Medionics | Admin Panel | Login';
			$this->load->view('admin/login',$data);
		}
	}

	public function checkDatabase() {
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
        $result = $this->authModel->checkAdminLogin($email, $password);
		if($result) {
                $data = array(
                    'id' => $result->id,
                    'name' => $result->name,
                    'email' => $result->email
                );
                $this->session->set_userdata('admin_logged_in', $data);
                $user = 'admin';
            return $user;
		} else {
			$this->session->set_flashdata('error', 'Invalid email or password');
			return FALSE;
		}
	}

	public function sendForgotPassword(){
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		if($this->form_validation->run('sendForgotPassword')){
			$user = $this->authModel->getUserByEmail(trim($this->input->post('email')));
			if($user){
				// varification message send for new password
				$varificationId = substr(base64_encode(hash_hmac('whirlpool', ($user->id+1), true)), 0, 80);

				$emailBody['name'] = ucfirst($user->name);
				$emailBody['link'] = base_url('auth/newPassword/'.$user->id.'/'.$varificationId);
				//$message = $this->load->view('user/email/forgotPasswordEmailBody',$emailBody);
				
				$this->_sendMailforgot($this->input->post('remail'),$emailBody);
				$this->session->set_flashdata(['message' => 'A forget password link is sent to your account. Please check your email' , 'type' => 'success']);
				return redirect('auth/user');
			}else{
				$this->session->set_flashdata('forgot_password_error', 'No user account found. Please enter a valid email');
				return redirect($_SERVER['HTTP_REFERER']);		//redirect to previous page
			}
		}else{
			return redirect($_SERVER['HTTP_REFERER']);		//redirect to previous page
		}
	}

	public function newPassword($user_id = null, $varification_id = null){
		if(!$user_id)
			$user_id = $this->uri->segment(3);
		if(!$varification_id)
			$varification_id = $this->uri->segment(4);
		if(substr(base64_encode(hash_hmac('whirlpool', ($user_id+1), true)),0,80) == $varification_id){
			$this->load->model('UserModel', 'userModel');
			$data['cartProducts'] = $this->_getCartInfo();
			$data['favoriteProducts'] = $this->_getFavoriteInfo();
	        $data['categoryList'] = $this->userModel->getAllCategory();
	        $data['newNotifications'] = $this->userModel->getNewNotifications($this->session->userdata('user_logged_in')['id']);
	        $data['settings'] = $this->userModel->getSettings();
			$data['title'] = 'Chobir Box | Sign In';
			$data['active'] = '';
			$data['user'] = 'user';
			$data['userId'] = $user_id;
			$data['varificationId'] = $varification_id;
			$this->load->view('user/partials/head', $data);
			$this->load->view('user/partials/navbar', $data);
			$this->load->view('user/newPassword',$data);
			$this->load->view('user/partials/bottom');
		}else{
			return redirect('user');
		}
	}

	public function saveNewPassword(){
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		if($this->form_validation->run('saveNewPassword')){
			$this->authModel->saveNewPassword();
			$this->session->set_flashdata(['message' => 'New password has created successfully' , 'type' => 'success']);
			return redirect('auth/user');
		}else{
			$this->newPassword($this->input->post('id'), $this->input->post('varificationId'));
		}
	}

}
