<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Edit Task</title>
 </head>
 <body>
   <h1>Edit task <?php 
        $session_data = $this->session->userdata('logged_in');
        $username = $session_data['username'];
        $lastupdate = date('Y-m-d H:i:s');

if (isset($tasks)){$task = $tasks[0];}
echo $task->getId(); ?></h1>
     <?php echo validation_errors();
    echo form_open('tasks/commitupdated');
	
	echo form_hidden('id',$task->getId() , 'type="hidden" readonly ');
	echo '<label for="fromuser">Username:</label>' .form_input('fromuser',$username, 'readonly id="fromuser" '). '<br/>';
	echo '<label for="startdate">Start Date:</label>' .form_input('startdate',$task->getStartDate(), 'id="startdate" '). '<br/>';
	echo '<label for="commands">Commands:</label>' .form_textarea('commands',$task->getCommands(), 'id="commands" '). '<br/>';
	echo '<label for="duration">Duration:</label>' .form_input('duration',$task->getDuration(), 'id="duration" '). '<br/>';
	echo '<label for="datecreated">Last Update:</label>' .form_input('datecreated',$lastupdate, 'id="datecreated" '). '<br/>';
	echo '<label for="isonetimetask">Is One Time Task:</label>' .form_checkbox('isonetimetask','1',$task->getIsOneTimeTask(), 'id="isonetimetask" '). '<br/>';
	echo form_submit("","Update");

     ?>