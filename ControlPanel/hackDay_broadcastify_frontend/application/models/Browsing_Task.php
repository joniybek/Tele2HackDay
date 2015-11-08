<?php
class Browsing_Task extends CI_Model
{
	private $_id;
	private $_fromuser;
	private $_datecreated;
    private $_commands;
    private $_startdate;
    private $_duration;
    private $username;
    private $_isonetimetask;
        
    

	function __construct()	{
        
        if(!$this->session->userdata('logged_in')){
            redirect('login', 'refresh');
        }
   		parent::__construct();
        $session_data = $this->session->userdata('logged_in');
        $username = $session_data['username'];
	}
    
    public function setUsername($value){$this->username=$value;}
    
    public function getFromUser(){return $this->_fromuser;}

    public function setFromUser($value){$this->_fromuser = $value;}
    
    public function getCreatedDate(){ return $this->_datecreated;}

    public function setCreatedDate($value){ $this->_datecreated = $value;}
    
    public function getStartDate(){ return $this->_startdate;}

    public function setStartDate($value){ $this->_startdate = $value;}
        
    public function getDuration(){ return $this->_duration;}

    public function setDuration($value){ $this->_duration = $value;}
    
    public function getCommands(){ return $this->_commands;}
    
    public function setCommands($value){ $this->_commands = $value;}
    
    public function getId(){ return $this->_id;}
    
    public function setId($value){$this->_id = $value;}
    
    public function getIsOneTimeTask(){ 	
	if ((int)$this->_isonetimetask==1){
		return true;
	}else{
		return false;
	}
	
	
	}
    
    public function setIsOneTimeTask($value){
		if ((int)$value==1){$this->_isonetimetask="1";
		}else{
			$this->_isonetimetask="0";
			}
		}
    
    public function delete(){
        $this->db->where('id',$this->getId());
        $this->db->delete('tasks');   
        
    }
    
    
    public function commit(){
    $data = array(
        'fromuser' => $this->username,
        'start' => $this->_startdate,
        'duration'=> $this->_duration,
        'createddate' => $this->_datecreated,
        'commands'=> $this->_commands,
		'isonetimetask'=> $this->_isonetimetask
    );

    if ($this->_id > 0) {
        //We have an ID so we need to update this object because it is not new
        if ($this->db->update("tasks", $data, array("id" => $this->_id))) {
            return true;
        }
    } else {
        //We dont have an ID meaning it is new and not yet in the database so we need to do an insert
        if ($this->db->insert("tasks", $data)) {
            //Now we can get the ID and update the newly created object
            $this->_id = $this->db->insert_id();
            return true;
        }
    }
    return false;
}
}
    
    
    
