<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once('./getid3/getid3.php');  

define('TBL_DATA', 'apns_devices');

class MDevices extends Model{

	function MDevices(){
		parent::Model();
	}
	
	function getItem($id){
	    $data = array();
	    $this->db->where('pid', $id);
	    $this->db->limit(1);
	    $Q = $this->db->get(TBL_DATA);		
		if ($Q->num_rows() > 0){
	      	$data = $Q->row_array();
	    }
	    $Q->free_result();

	    return $data;    
	}
		 
	function getAllItem($per_page = 100, $cat = NULL){
	     $data = array();
	     if ($cat == NULL)
	     {
	     	$cat = 0;
	     }
	     /*
	     if ($cat != NULL)
	     {
	     	$this->db->where('appname', $cat);	     
	     }
	     */
	     	
	     $this->db->orderby("pid", "desc");
	     $this->db->limit($per_page,$cat);
	     $Q = $this->db->get(TBL_DATA);
	     if ($Q->num_rows() > 0){
	       	foreach ($Q->result_array() as $row){
	         	$data[] = $row;
	       	}
	    }
	    $Q->free_result();  
	    return $data; 
	}
	
	function countAllItem(){
		return $this->db->get(TBL_DATA)->num_rows;
	}
	 
	 function addItem(){
		$data = array( 
			'clientid' => $_POST['clientid'],
			'appname' => $_POST['appname'],
			'appversion' => $_POST['appversion'],
			'deviceuid' => $_POST['deviceuid'],
			'devicetoken' => $_POST['devicetoken'],
			'devicename' => $_POST['devicename'],
			'devicemodel' => $_POST['devicemodel'],
			'deviceversion' => $_POST['deviceversion'],
			'pushbadge' => $_POST['pushbadge'],
			'pushalert' => $_POST['pushalert'],
			'pushsound' => $_POST['pushsound'],
			'development' => $_POST['development'],
			'status' => $_POST['status'],			
		);
		
		$data['created'] = now();
	
		$this->db->insert(TBL_DATA, $data);	 
	 }
	 
	 
	 function updateItem(){
		$data = array(
			'clientid' => $_POST['clientid'],
			'appname' => $_POST['appname'],
			'appversion' => $_POST['appversion'],
			'deviceuid' => $_POST['deviceuid'],
			'devicetoken' => $_POST['devicetoken'],
			'devicename' => $_POST['devicename'],
			'devicemodel' => $_POST['devicemodel'],
			'deviceversion' => $_POST['deviceversion'],
			'pushbadge' => $_POST['pushbadge'],
			'pushalert' => $_POST['pushalert'],
			'pushsound' => $_POST['pushsound'],
			'development' => $_POST['development'],
			'status' => $_POST['status'],	
		);
		
	 	$this->db->where('pid', $_POST['id']);
		$this->db->update(TBL_DATA, $data);
	 }
	 
	 function deleteItem($id){
		$this->db->trans_begin();

		$this->db->where('pid', $id);
		$this->db->delete(TBL_DATA);

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		} 
		else{
			$this->db->trans_commit();
		}
		
		return TRUE;
	 }
	 
	 
	 function changeStatus($id){
		// getting status of page
		$pageinfo = array();
		$pageinfo = $this->getItem($id);
		$status = $pageinfo['status'];
		if($status == 'active'){
			$data = array('status' => 'uninstalled');
			$this->db->where('pid', $id);
			$this->db->update(TBL_DATA, $data);	
		}else{
			$data = array('status' => 'active');
			$this->db->where('pid', $id);
			$this->db->update(TBL_DATA, $data);	
		}
		
		return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
	 }
}

?>