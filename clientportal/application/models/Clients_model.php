<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Clients_model extends CI_Model {

    public function __construct() {

    }

    function create_agreement($data) {
        if ($this->db->insert('agreements', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function add_client_permissions($data) {
        if ($this->db->insert('client_permission', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function getAgreements($group, $user_id, $limit, $offset) {
        $this->db->select('agreements.*');
        $this->db->from('agreements');
        $this->db->select('client.email as client_email, client.first_name as client_fname, client.last_name as client_lname');
            $this->db->join('users as client', 'client.id = agreements.client_id', 'left');
        if ($group == 'admin') {
            $this->db->select('creator.email as c_email, creator.first_name as c_fname, creator.last_name as c_lname');
            $this->db->join('users as creator', 'creator.id = agreements.created_by', 'left');
        }
        if ($group == 'sales') {
            $this->db->where('agreements.created_by', $user_id);
        }
        if ($group == 'client') {
            $this->db->where('agreements.client_id', $user_id);
        }
        if ($group != 'client') {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        if ($group == 'client') {
            return $query->row();
        }
        return $query->result();
    }

    public function getAgreementsCount($group, $user_id) {
        $this->db->select('*');
        $this->db->from('agreements');
        if ($group == 'sales') {
            $this->db->where('created_by', $user_id);
        }
        return $this->db->count_all_results();
    }

    function getAgreement($id) {
        $this->db->select('agreements.*');
        $this->db->select('users.id as client_id, users.email, users.first_name, users.last_name, users.created_on');
        $this->db->from('agreements');
        $this->db->join('users', 'users.id = agreements.client_id');
        $this->db->where('agreements.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function updateAgreementStatus($id, $data) {
        return $this->db->update('agreements', $data, array('id' => $id));
    }

    function getAgreementByClientId($client_id) {
        $this->db->select('*');
        $this->db->from('agreements');
        $this->db->where('client_id', $client_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function addClientInfo($client_info) {
        if ($this->db->insert('client_info', $client_info)) {
            return true;
        } else {
            return false;
        }
    }

    public function getClientinfo ($client_id) {
        $this->db->select('*');
        $this->db->from('client_info');
        $this->db->where('client_id', $client_id);
        return $this->db->get()->row();
    }

    function getPaymentRecord($client_id) {
        $this->db->select('*');
        $this->db->from('client_payment_info');
        $this->db->where('client_id', $client_id);
        return $this->db->get()->result();
    }

    function getAccountRecord($client_id, $type = null) {
        $this->db->select('*');
        $this->db->from('client_payment_info');
        $this->db->where('client_id', $client_id);
        if ($type != null) {
            $this->db->where('payment_type', $type);
        }
        return $this->db->get()->row();
    }

    public function saveClientDetail($data) {
        if ($this->db->insert('client_payment_info', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateClientDetail($data, $id) {
        return $this->db->update('client_payment_info', $data, array('id' => $id));
    }

    public function delete_client($client) {
        $res = false;
        $this->db->trans_start();
        $agreement = $this->db->get_where('agreements', array('client_id' => $client->id))->row();
        if ($agreement) {
            $file = $_SERVER['DOCUMENT_ROOT'] . "/clientportal/assets/artwork/" . $agreement->art_work;
            if ($agreement->art_work && file_exists($file)) {
                unlink($file);
            }
            $res = $this->db->delete('agreements', array('client_id' => $client->id));
        }
        $client_info = $this->db->get_where('client_info', array('client_id' => $client->id))->row();
        if ($client_info) {
            $res &= $this->db->delete('client_info', array('client_id' => $client->id));
        }
        $premiums = $this->db->get_where('premiums', array('client_id' => $client->id))->row();
        if ($premiums) {
            $res &= $this->db->delete('premiums', array('client_id' => $client->id));
        }
        $rating = $this->db->get_where('rating', array('client_id' => $client->id))->row();
        if ($rating) {
            $res &= $this->db->delete('rating', array('client_id' => $client->id));
        }
        $users_groups = $this->db->get_where('users_groups', array('user_id' => $client->id))->row();
        if ($users_groups) {
            $res &= $this->db->delete('users_groups', array('user_id' => $client->id));
        }
        $users = $this->db->get_where('users', array('id' => $client->id))->row();
        $this->db->delete('client_permission', array('user_id' => $client->id));

        if ($users) {
            $res &= $this->db->delete('users', array('id' => $client->id));
        }
        $this->db->trans_complete();
        return $res ? true : false;
    }

}
