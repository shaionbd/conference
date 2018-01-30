<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller{

    public $site_name = "Conference";
    public $admin;

    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        if(!$this->session->userdata('admin_logged_in'))
            return redirect('/auth/admin');
        $this->load->model('AdminModel', 'adminModel');
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        date_default_timezone_set('Asia/Dhaka');
    }

    public function dashboard(){
        $data['title'] = $this->site_name.' | Dashboard';
        $data['active'] = 'dashboard';
        $data['admin'] = $this->admin;
        $data['users'] = $this->adminModel->getUsers();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function createUser(){
        $data = array(
            'name' => trim($this->input->post('name')),
            'email' => trim($this->input->post('email')),
            'password' => trim(md5($this->input->post('password')))
        );
        $this->adminModel->createUser($data);
        $this->session->set_flashdata(['message' => 'The user has been created successfully!', 'type' => 'create']);
        return redirect('admin');
    }

    public function deleteUser($id){
        $this->adminModel->deleteUser($id);
        $this->session->set_flashdata(['message' => 'The user has been removed successfully!', 'type' => 'remove']);
        return redirect('admin');
    }

    public function privateCall($caller_id = null, $receiver_id = null){
        $id = $this->adminModel->call($caller_id, $receiver_id);
        $data['title'] = $this->site_name.' | Conference';
        $data['active'] = 'Call';
        $data['admin'] = $this->admin;
        
        $data['resource_id'] = $id;
        $data['name'] = $this->admin->name;
        // $this->load->view('admin/partials/head', $data);
        // $this->load->view('admin/partials/navbar', $data);
       // $this->load->view('admin/conference', $data);
        $this->load->view('admin/call_vidyo', $data);
    }

    public function privateCallReceive($id = null,$caller_id = null, $receiver_id = null){
        $data['title'] = $this->site_name.' | Conference';
        $data['active'] = 'Call';
        $data['admin'] = $this->admin;
        
        $data['resource_id'] = $id;
        $data['name'] = $this->admin->name;
        // $this->load->view('admin/partials/head', $data);
        // $this->load->view('admin/partials/navbar', $data);
       // $this->load->view('admin/conference', $data);
        $this->load->view('admin/call_vidyo', $data);
    }

    public function getIncommingCall(){
        $data = $this->adminModel->getIncommingCall($this->session->userdata('admin_logged_in')['id']);
        if($data){
            echo json_encode($data);
        }else{
            echo false;
        }
        
    }

    public function postCancelCall(){
        $call_id = $this->input->post('call_id');
        $status = $this->input->post('status');
        $this->adminModel->cancelCall($call_id, $status);
    }

    public function conference($id = null, $user = null){
        $data['title'] = $this->site_name.' | Conference';
        $data['active'] = 'conference';
        $data['admin'] = $this->admin;
        $data['resource_id'] = $id;
        $data['name'] = $user;
        // $this->load->view('admin/partials/head', $data);
        // $this->load->view('admin/partials/navbar', $data);
       // $this->load->view('admin/conference', $data);
        $this->load->view('admin/conference_vidyo', $data);
        // $this->load->view('admin/partials/bottom', $data);
    }

    public function callConference(){
        $data['title'] = $this->site_name.' | Call Conference';
        $data['active'] = 'call-conference';
        $data['admin'] = $this->admin;
        $data['users'] = $this->adminModel->getUsers();
        $data['conferences'] = $this->adminModel->getUserConferences($this->session->userdata('admin_logged_in')['id']);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/call_conference', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function createConference(){
        $data = array(
            'conference_created_by' => $this->session->userdata('admin_logged_in')['id'],
            'name' => trim($this->input->post('name')),
            'conference_id' => trim($this->input->post('conference_id')),
            'start_time' => trim($this->input->post('start_date')).' '.trim($this->input->post('start_time'))
        );
        $conference_id = $this->adminModel->createConference($data);

        $users = $this->input->post('users');
        $data = array(
            'user_id' => $this->session->userdata('admin_logged_in')['id'],
            'conference_id' => $conference_id
        );
        $this->adminModel->createConferenceAttendUsers($data);
        
        for($i = 0; $i < sizeof($users); $i++){
            $data = array(
                'user_id' => $users[$i],
                'conference_id' => $conference_id
            );
            $this->adminModel->createConferenceAttendUsers($data);
        }


        $this->session->set_flashdata(['message' => 'The conference has been created successfully!', 'type' => 'create']);
        return redirect('admin/call/conference');
    }

    public function logout(){
        $this->session->unset_userdata('admin_logged_in');
        return redirect('admin');
    }
}