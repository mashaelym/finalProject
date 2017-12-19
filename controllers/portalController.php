<?php
namespace controller;

use \http\controller;
use \view\PortalView;

class portalController extends controller
{
	
	/**
	 * Portal Show
	 * url: index.php?page=portal&action=show
	 */
    public function show()
    {
		if($this->getSessionHandler()->isLoggedIn())
		{
			$v = new PortalView();
			$v->injectData(array('id' => $this->getSessionHandler()->getSessionVariable('id')));
			echo $v->render();
		}
		else
		{
			$this->displayMessage('You must login to view this area!');
		}
	}
}
