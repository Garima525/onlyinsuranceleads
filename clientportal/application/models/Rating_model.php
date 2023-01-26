<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rating_model extends CI_Model
{

	public function __construct()
	{
	}

	public function getRatingRecord($client_id)
	{
		$this->db->select('*');
		$this->db->from('rating');
		$this->db->where('client_id', $client_id);
		return $this->db->get()->row();
	}

	public function saveRating($data)
	{
		if ($this->db->insert('rating', $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function updateRating($data, $id)
	{
		return $this->db->update('rating', $data, array('id' => $id));
	}

	public function getPremiumsRecords($client_id){
		$this->db->select('*');
		$this->db->from('premiums');
		$this->db->where('client_id', $client_id);
		return $this->db->get()->result();
	}

	public function savePremiumEntry($data)
	{
		$record = $this->db->get_where('premiums', array('client_id' => $data['client_id'], 'year' => $data['year']))->row();
		if($record){
			$data['updated_at'] = time();
			return $this->db->update('premiums', $data, array('client_id' => $data['client_id'], 'year' => $data['year']));
		}else{
			$data['created_at'] = time();
			return $this->db->insert('premiums', $data);
		}
	}

	public function getRating ($client_id) {
		$data['rating'] = $this->db->get_where('rating', array('client_id' => $client_id))->row();
		$data['premiums'] = $this->db->get_where('premiums', array('client_id' => $client_id))->result();
		return $data;
	}

}
