<?php

namespace view;

use \viewHelper\DateConverter;

class AllTasksView extends View implements iPage
{
	public function output()
	{
		$t = $this->createTable();
		$id = $this->getViewData('id');

		$title = <<<TITLE
		
		<h1>All Tasks for User Id # $id</h1>
				 
TITLE;

		$table = <<<TABLE
			$t
TABLE;

		$menu = Menu::output();

		return $title . $table . $menu;
	}
	
	
	//generate all tasks view
	 
	private function createTable()
	{
		//get data
		$r = $this->getViewData('data');
		
		if(!is_object($r[0])) //for some reason $r returns size 0 with nothing in the array..
		{
			return 'No tasks to view';
		}
		
		//setup headers
		$a = array(
				array('Owner E-mail', 'Created Date', 'Due Date', 'Message', 'Is Done', 'Show', 'Edit')
				);
		
		//populate array
		foreach($r as $o)
		{
			$showLink = '<a href="index.php?page=tasks&action=show&id=' . $o->{'id'} . '">Show</a>';
			$editLink = '<a href="index.php?page=tasks&action=edit&id=' . $o->{'id'} . '">Edit</a>';
			$a[] = array($o->{'owneremail'}, DateConverter::MySqlTimeStampToPHPDateConverter($o->{'createddate'}), DateConverter::MySqlDateToPHPDateConverter($o->{'duedate'}), $o->{'message'}, $o->{'isdone'},  $showLink, $editLink);
		}
				
		//convert array to html
		$output = \viewHelper\arrayToHtml::generate($a);
		
		return $output;
	}
}	
?>