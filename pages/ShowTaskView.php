<?php

namespace view;
use \viewHelper\DateConverter;

class ShowTaskView extends View implements iPage
{
	public function output()
	{
		$id = $this->getViewData('id');
		$r = $this->getViewData('data');
		
		$editLink = '<a href="index.php?page=tasks&action=edit&id=' . $id . '">Edit</a>';
		
		$o = $r->{'owneremail'};
		$c = DateConverter::MySqlTimeStampToPHPDateConverter($r->{'createddate'});
		$d = DateConverter::MySqlDateToPHPDateConverter($r->{'duedate'});
		$m = $r->{'message'};
		$i = $r->{'isdone'};
		
		$body = <<<BODY
		
		<h1>Task Number # $id</h1>
		
		<div>
			<h2>$editLink</h2>
		</div>
		
		<div>
			<span><b>Owner E-mail:</b> $o</span>
			<br/>
			<span><b>Created Date:</b> $c</span>
			<br/>
			<span><b>Due Date:</b> $d</span>
			<br/>
			<span><b>Message:</b> $m</span>
			<br/>
			<span><b>Is Done:</b> $i</span>
		</div>
		<br/>
		<form action="index.php?page=tasks&action=delete&id=$id" method="post" id="form1">
			<button type="submit" form="form1" value="delete">Delete</button>
		 </form>
BODY;

		$menu = Menu::output();

		return $body . $menu;
	}
}	
?>