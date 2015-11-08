<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tasks extends CI_Controller {

 function __construct()
 {
   parent::__construct();
     $this->load->library("TasksFactory");
 }
public function showtasks($taskId = 0){
    $taskId = (int)$taskId;
    $data = array(
        "tasks" => $this->tasksfactory->getTask($taskId)
    );
    $this->load->view("show_tasks", $data);
}
    public function updateTask($taskId=0){
        if ($taskId == 0){
            $tasks = array(new Browsing_task());
            $this->load->helper(array('form'));
            $data = array("tasks" => $tasks );
            $this->load->view("update_tasks",$data);
        }else{
        $taskId = (int)$taskId;
		$data = array("tasks" => $this->tasksfactory->getTask($taskId));
        $this->load->helper(array('form'));
        $this->load->view("update_tasks", $data);
    }}
    
    public function deleteTask($id){
        $this->tasksfactory->deleteTask($id);
        redirect('tasks/showtasks', 'refresh');
    }
    
    public function commitUpdated(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fromuser', 'Username', 'trim|xss_clean');
        $this->form_validation->set_rules('startdate', 'StartDate', 'trim|required|xss_clean|callback_mysqldateRegex');
        $this->form_validation->set_rules('commands', 'Commands', 'trim|xss_clean');
        $this->form_validation->set_rules('duration', 'Commands', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('isonetimetask', 'IsOneTimeTask', 'trim|xss_clean');
        $this->form_validation->set_rules('datecreated', 'LastUpdateDate', 'trim|xss_clean|callback_mysqldateRegex');
        if($this->form_validation->run() == FALSE){
            $this->load->view('login_view');
        }else{
            $task = new Browsing_Task();
            $session_data = $this->session->userdata('logged_in');
            $username = $session_data['username'];
            $task->setId($this->input->post('id'));
            $task->setFromUser($this->input->post('fromuser'));
    	    $task->setCommands($this->input->post('commands'));
            $task->setDuration($this->input->post('duration'));
            $task->setCreatedDate($this->input->post('datecreated'));
            $task->setIsOneTimeTask($this->input->post('isonetimetask'));
            $task->setStartDate($this->input->post('startdate'));
            $task->setUsername($username);
            $task->commit();
            
            redirect('tasks/showtasks', 'refresh');
        }

        
    }

    public function mysqldateRegex($date) {
  if (preg_match('/\d{4}-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3(0|1))\s(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])/', $date ) ) 
  {
    return TRUE;
  } 
  else 
  {
    return FALSE;
  }
}
}

