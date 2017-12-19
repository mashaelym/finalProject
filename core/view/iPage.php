<?php

namespace view;

/**
 * Interface implemented by View classes (not partial: header, footer, menu, etc..)
 */
interface iPage
{
	public function output();
}
?>