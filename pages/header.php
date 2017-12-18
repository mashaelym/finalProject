<?php

namespace view;

class Header 
{

    public static function output()
	{
		$header = <<<HEADER
		<!doctype html>

		<html lang="en">
		<head>
			<meta charset="utf-8">

			<title>ToDo List</title>
			<meta name="description" content="To Do List">
		</head>
		<body>
HEADER;
	return $header;
	}
}
?>