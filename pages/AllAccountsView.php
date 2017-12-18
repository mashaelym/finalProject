<?php

namespace view;

use \viewHelper\DateConverter;

class AllAccountsView extends View implements iPage
{
	public function output()
	{
		$t = $this->createTable();

		$title = <<<TITLE
		
		<h1>All Accounts</h1>
				 
TITLE;

		$table = <<<TABLE
			$t
TABLE;

		$menu = Menu::output();

		return $title . $table . $menu;
	}
	
	 // generate accounts table
	 
	private function createTable()
	{
		
		//get data
		$r = $this->getViewData('data');
		
		if(!is_object($r[0])) //for some reason $r returns size 0 with nothing in the array..
		{	
			//we would never see 0 accounts since this page requires you to be logged in to see it
			return 'No accounts to view';
		}
		
		//set up table headers
		$a = array(
				array('First Name', 'Last Name', 'E-mail', 'Phone Number', 'Date of Birth', 'Gender', 'Show', 'Edit')
				);
		
		//populate array
		foreach($r as $o)
		{
			$showLink = '<a href="index.php?page=accounts&action=show&id=' . $o->{'id'} . '">Show</a>';
			$editLink = '<a href="index.php?page=accounts&action=edit&id=' . $o->{'id'} . '">Edit</a>';
			$a[] = array($o->{'fname'}, $o->{'lname'}, $o->{'email'}, $o->{'phone'}, DateConverter::MySqlDateToPHPDateConverter($o->{'birthday'}), $o->{'gender'},  $showLink, $editLink);
		}
				
		//convert array to html table
		$output = \viewHelper\arrayToHtml::generate($a);
		
		return $output;
	}
}	
?>