<?php

namespace view;

class PortalView extends View implements iPage
{
	public function output()
	{
		$id = $this->getViewData('id');
		$homepage = <<<PORTAL
		
		<h1>Welcome user #: $id</h1>
PORTAL;

		$homepage .= Menu::output();

		return $homepage;
	}
}
?>