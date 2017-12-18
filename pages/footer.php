<?php

namespace view;

class Footer
{

    public static function output()
	{
		$footer = <<<FOOTER
</body>
</html>
FOOTER;
	return $footer;
	}
}
?>