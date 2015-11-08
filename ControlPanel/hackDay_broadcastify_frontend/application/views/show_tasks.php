<?php

//Check to see if users could be found
	if ($tasks !== FALSE) {

		//Create the HTML table header
		echo <<<HTML

		<table border='1'>
			<tr>
				<th>ID #</th>
				<th>Username</th>
				<th>Command</th>
                <th>Start Date</th>
                <th>Duration</th>
				<th>Is One Time Task</th>
                <th>Delete</th>
			</tr>

HTML;
		if (is_array($tasks) && count($tasks)) {
			foreach ($tasks as $task) {
                $updateurl = anchor('tasks/updatetask/'.$task->getId(), $task->getId());
                $deleteurl = anchor('tasks/deletetask/'.$task->getId(),'x');
				echo <<<HTML
		              <tr>
                        <td>{$updateurl}</td>
						<td>{$task->getFromUser()}</td>
						<td>{$task->getCommands()}</td>
                        <td>{$task->getStartDate()}</td>
                        <td>{$task->getDuration()}</td>
						<td>{$task->getIsOneTimeTask()}</td>
                        <td>{$deleteurl}</td>
                        
					</tr>
HTML;
			}

		} 
		echo <<<HTML
		</table>
HTML;

	} else {
		//Now user could be found so display an error messsage to the user
		echo <<<HTML

			<p>A user could not be found with the specified user ID#, please try again.</p>

HTML;
	}
echo anchor('tasks/updatetask/','New Task');