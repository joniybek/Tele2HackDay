<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TasksFactory {

	private $_ci;

 	function __construct()
    {
   
    	$this->_ci =& get_instance();
    	$this->_ci->load->model("Browsing_Task");
    }
    
    public function deleteTask($id){
        $tasks = $this->getTask($id);
        $task = $tasks[0];
        $task->delete();
    }
    
    public function getTask($id = 0) {
        $tasks = array();
    	if ($id > 0) {
    		$query = $this->_ci->db->get_where("tasks", array("id" => $id));
    		if ($query->num_rows() > 0) {
    			$tasks[] = $this->createObjectFromData($query->row());
                return $tasks;
                
    		}
    		return false;
    	} else {
               
    		$query = $this->_ci->db->select("*")->from("tasks")->get();

    		if ($query->num_rows() > 0) {
    			
    			foreach ($query->result() as $row) {
    
    				$tasks[] = $this->createObjectFromData($row);
    			}

    			return $tasks;
    		}
    		return false;
    	}
    }

    public function createObjectFromData($row) {
    	$task = new Browsing_Task();
    	$task->setId($row->id);
    	$task->setFromUser($row->fromuser);
    	$task->setCommands($row->commands);
        $task->setDuration($row->duration);
        $task->setCreatedDate($row->createddate);
        $task->setIsOneTimeTask($row->isonetimetask);
        $task->setStartDate($row->start);
    	return $task;
    }

}