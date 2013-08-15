<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once('./getid3/getid3.php');  

define('TBL_DEV', 'apns_devices');

class MDev extends Model{

	function MDev(){
		parent::Model();
	}
		 
	function getAllItem($cat = NULL){
	     $data = array();
	     if ($cat != NULL)
	     {
	     	$this->db->where('appname', $cat);	     
	     }
	     	
	     $this->db->orderby("pid", "desc");
	     $Q = $this->db->get(TBL_DEV);
	     if ($Q->num_rows() > 0){
	       	foreach ($Q->result_array() as $row){
	         	$data[] = $row;
	       	}
	    }
	    $Q->free_result();  
	    return $data; 
	}
	
	function getAllClientByApp($appname = NULL){
	     $data = array();
	     if ($appname != NULL)
	     {
	     	$this->db->where('appname', $appname);	     
	     }
	     
	     $this->db->select("pid, clientid");
	     $this->db->orderby("pid", "desc");
	     $Q = $this->db->get(TBL_DEV);
	     if ($Q->num_rows() > 0){
	       	foreach ($Q->result_array() as $row){
	         	$data[] = $row;
	       	}
	    }
	    $Q->free_result();  
	    return $data; 
	}
	
	function getAllAppName(){
	     $data = array();
	     
	     $this->db->select("appname");	     	
	     $this->db->group_by("appname");
	     $this->db->orderby("appname", "asc");
	     
	     $Q = $this->db->get(TBL_DEV);
	     if ($Q->num_rows() > 0){
	       	foreach ($Q->result_array() as $row){
	         	$data[] = $row;
	       	}
	    }
	    $Q->free_result();  
	    return $data; 
	}
}

?>