<?php

namespace view;

class AddTaskView extends View implements iPage
{
	public function output()
	{				
		$body = <<<BODY
		
		<h1>Add Task</h1>
		
		Note: Create Date defaults to today's date. Owner ID/e-mail defaults to task creator
		<form action="index.php?page=tasks&action=create" method="post">	 
			 Due Date: <input type="text" name="duedate"> Format: mm-dd-yyyy<br>
			 Message: <input type="text" name="message"><br>
			 Is Done: <input type="text" name="isdone"> Format: 1 for yes, 0 for no <br>
			 <input type="submit" value="Submit form">
		 </form>
BODY;

		$menu = Menu::output();

		return $body . $menu;
	}
}	