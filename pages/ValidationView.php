<?php

namespace view;

class ValidationView extends View implements iPage
{
	public function output()
	{
		$messages = $this->getViewData('messages');
		$list = static::createList($messages);
		$messageBody = <<<MESSAGE
		
		<h1>Validation Errors</h1>
		<ul>
			$list
		</ul>
		
		<div>Please click back and re-submit</div>
MESSAGE;

		return $messageBody;
	}
	
	private static function createList($messages)
	{		
		$string = '';
		
		foreach($messages as $message)
		{
			$string .= '<li>' . $message . '</li>';
		}
		
		return $string;
	}
}
?>