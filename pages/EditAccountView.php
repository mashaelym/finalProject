<?php

namespace view;
use \viewHelper\DateConverter;

class EditAccountView extends View implements iPage
{
	public function output()
	{
		$id = $this->getViewData('id');
		$r = $this->getViewData('data');
				
		$f = $r->{'fname'};
		$l = $r->{'lname'};
		$e = $r->{'email'};
		$p = $r->{'phone'};
		$b = DateConverter::MySqlDateToPHPDateConverter($r->{'birthday'});
		$g = $r->{'gender'};
		$pw = $r->{'password'};
		
		$body = <<<BODY
		
		<h1>Edit Account Id # $id</h1>
		
		<form action="index.php?page=accounts&action=update&id=$id" method="post">	 
			 First name: <input type="text" name="fname" value="$f"><br>
			 Last name: <input type="text" name="lname" value="$l"><br>
			 Email: <input type="text" name="email" value="$e"> Format: name@email.com<br/>
			 Phone: <input type="text" name="phone" value="$p"> Format: 313-323-2322<br/>
			 Birthday: <input type="text" name="birthday" value="$b"> Format: mm-dd-yyyy<br/>
			 Gender: <input type="text" name="gender" value="$g"> Format: M or F<br/>
			 Password: <input type="password" name="password" value="$pw"><br>
			 <input type="submit" value="Submit form">
		 </form>
		 
		 <form action="index.php?page=accounts&action=delete&id=$id" method="post" id="form1">
			<button type="submit" form="form1" value="delete">Delete</button>
		 </form>
BODY;

		$menu = Menu::output();

		return $body . $menu;
	}
}	
