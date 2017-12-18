<?php
namespace view;

class Menu
{

    public static function output()
	{
		$menu = <<<MENU
					<ul>
						<li><h2><a href="index.php?page=accounts&action=all">Show All Accounts</a></h2></li>
						<li><h2><a href="index.php?page=tasks&action=all">Show All Tasks</a></h2></li>
						<li><h2><a href="index.php?page=tasks&action=add">Add Task</a></h2></li>
						<li><h2><a href="index.php?page=accounts&action=logout">Logout</a></h2></li>
					</ul>
MENU;

	return $menu;
	}
}
?>