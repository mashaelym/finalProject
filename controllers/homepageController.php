<?php

namespace controller;

use \http\controller;
use \view\HomepageView;

class homepageController extends controller
{

	/**
	 * Homepage Show
	 * url: index.php
	 */
    public function show()
    {
		//redirect if the user is already logged in
		if($this->getSessionHandler()->isLoggedIn())
		{
			header("Location: index.php?page=portal&action=show");
		}

		$v = new HomepageView();
		echo $v->render();
    }

}
