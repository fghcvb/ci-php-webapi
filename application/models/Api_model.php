<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model 
{
	public function insertManufacturer($manufacturerData)
	{
		$this->db->insert('manufacturer', $manufacturerData);
		return $this->db->insert_id();
	}
	
	public function get_manufacturer()
	{
		$this->db->select('*');
		$this->db->from('manufacturer');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_inventory_list()
	{
		$this->db->select('t1.manufacturer_name, t2.model_name, t2.color, t2.manufacturing_year, t2.registration_number, t2.note, 
        t2.image, t2.model_id, COUNT(t2.model_id) as model_count');
		$this->db->from('manufacturer as t1');
		$this->db->join('model as t2', 't1.manufacturer_id=t2.manufacturer_id','INNER');
		$this->db->group_by('model_name');
		$query = $this->db->get();
		return $query->result();
	}
	
   public function insertModel($modelData)
	{
		$this->db->insert('model', $modelData);
		return $this->db->insert_id();
	}

	public function deleteModel($id)
	{
		$this->db->where('model_id', $id);
		$this->db->delete('model');
	}
}
