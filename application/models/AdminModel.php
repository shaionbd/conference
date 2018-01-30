<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
    }

    public function call($caller_id, $receiver_id){
        $data = array(
            'caller_id' => $caller_id,
            'receiver_id' => $receiver_id
        );
        $this->db->insert('call_user', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function getIncommingCall($id){
        $this->db->select('call_user.*, admins.name AS caller_name');
        $this->db->from('call_user');
        $this->db->join('admins', 'call_user.caller_id = admins.id');
        $this->db->where('call_user.receiver_id', $id);
        $this->db->where('call_user.status', 0);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->row();
    }

    public function cancelCall($call_id, $status){
        $this->db->set('status', $status);
        $this->db->where('id', $call_id);
        $this->db->update('call_user');
    }

    public function getUserByEmail($email){
        return $this->db->get_where('admins', array('email'=> $email))->row();
    }

    public function getAdminById($id){
        return $this->db->get_where('admins', array('id'=> $id))->row();
    }

    public function getUsers(){
        return $this->db->get('admins')->result();
    }

    public function createUser($data){
        $this->db->insert('admins', $data);
    }

    public function deleteUser($id){
        $this->db->delete('admins', array('id' => $id));
    }

    public function getUserConferences($user_id){
        $this->db->select('*');
        $this->db->from('conference_attend_users');
        $this->db->join('conferences', 'conferences.id = conference_attend_users.conference_id');
        $this->db->where('conference_attend_users.user_id', $user_id);
        return $this->db->get()->result();
    }

    public function createConference($data){
        $this->db->insert('conferences', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function createConferenceAttendUsers($data){
        $this->db->insert('conference_attend_users', $data);
    }


}