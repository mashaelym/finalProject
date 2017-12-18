<?php

namespace view;
use \viewHelper\DateConverter;

class EditTaskView extends View implements iPage
{
	public function output()
	{
		$id = $this->getViewData('id');
		$r = $this->getViewData('data');
				
		$o = $r->{'owneremail'};
		$c = \viewHelper\DateConverter::MySqlTimeStampToPHPDateConverter($r->{'createddate'});
		$d = DateConverter::MySqlDateToPHPDateConverter($r->{'duedate'});
		$m = $r->{'message'};
		$i = $r->{'isdone'};
		$oi = $r->{'ownerid'};
		
		$body = <<<BODY
		
		<h1>Edit Task # $id</h1>
		
		<form action="index.php?page=tasks&action=update&id=$id" method="post">	 
			 Owner E-mail: <input type="text" name="owneremail" value="$o" disabled><br>
			 Created Date: <input type="text" name="createddate" value="$c" disabled><br>
			 Due Date: <input type="text" name="duedate" value="$d"> Format: mm-dd-yyyy<br>
			 Message: <input type="text" name="message" value="$m"><br>
			 Is Done: <input type="text" name="isdone" value="$i"> Format: 1 for yes, 0 for no <br>
			 Owner Id: <input type="text" name="ownerid" value="$oi" disabled><br>
			 <input type="submit" value="Submit form">
		 </form>
		 
		 <form action="index.php?page=tasks&action=delete&id=$id" method="post" id="form1">
			<button type="submit" form="form1" value="delete">Delete</button>
		 </form>
BODY;

		$menu = Menu::output();

		return $body . $menu;
	}
}	