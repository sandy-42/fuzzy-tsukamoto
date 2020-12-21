  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
 
  class M_account extends CI_Model{

	   function collectRules()
	   {
		   $this->db->select("*"); 
			 $this->db->from('tblgejala');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function collectBobot()
	   {
		   $this->db->select("*"); 
			 $this->db->from('tblbobot');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function collectDataBobot($data)
	   {
			$this->db->select("*"); 
			$this->db->from('tblbobot');
			$this->db->where('id', $data);
			$query = $this->db->get();
			return $query->result();
	   }
	   function editBobot($data)
	   {
		   $this->db->set('bobot', $data["bobot"]);
		   $this->db->where('class', $data["class"]);
		   $this->db->update('tblbobot');
	   }
	   function registerGejala($data)
	   {
		   $this->db->insert('tblgejala',$data);
	   }
	   function collection_gejala()
	   {
			 $this->db->select("id,gejala"); 
			 $this->db->from('tblgejala');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function deleteGejala($data)
	   {
		   $this->db->where('id', $data);
			$this->db->delete('tblgejala');
	   }
	   function getBobot($data)
	   {
		   $this->db->select("bobot"); 
			 $this->db->from('tblbobot');
			 $this->db->where('class', $data);
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function addSolusi($data)
	   {
		   $this->db->insert('tblsolusi',$data);
	   }
	   function collectSolusi()
	   {
			 $this->db->select("*"); 
			 $this->db->from('tblsolusi');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function deleteSolusi($data)
	   {
		   $this->db->where('id', $data);
			$this->db->delete('tblsolusi');
	   }
	   function collectSolusiBy($data)
	   {
		    $this->db->select("solusi"); 
			 $this->db->from('tblsolusi');
			 $this->db->where('penyakit', $data);
			 $query = $this->db->get();
			 return $query->result();
	   }
  }