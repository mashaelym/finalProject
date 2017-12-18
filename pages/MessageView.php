<?php

namespace view;

class MessageView extends View implements iPage
{
	public function output()
	{
		$message = $this->getViewData('message');
		$messageBody = <<<MESSAGE
		
		<h1>$message</h1>
		<h1><a href="index.php">Home</a></h1>
MESSAGE;

		return $messageBody;
	}
}
?>