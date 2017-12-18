<?php

namespace view;
use \viewHelper\DateConverter;

class ShowAccountView extends View implements iPage
{
    public function output()
    {
        $id = $this->getViewData('id');
        $r = $this->getViewData('data');
        
        $editLink = '<a href="index.php?page=accounts&action=edit&id=' . $id . '">Edit</a>';
        $deleteLink = '<a href="index.php?page=accounts&action=delete&id=' . $id . '">Delete</a>';
        
        $f = $r->{'fname'};
        $l = $r->{'lname'};
        $e = $r->{'email'};
        $p = $r->{'phone'};
        $b = DateConverter::MySqlDateToPHPDateConverter($r->{'birthday'});
        $g = $r->{'gender'};
        
        $body = <<<BODY
        
        <h1>View Account Id # $id</h1>
        
        <div>
            <h2>$editLink</h2>
        </div>
        <div>
            <span><b>First Name:</b> $f</span>
            <br/>
            <span><b>Last Name:</b> $l</span>
            <br/>
            <span><b>E-mail:</b> $e</span>
            <br/>
            <span><b>Phone:</b> $p</span>
            <br/>
            <span><b>Birthday:</b> $b</span>
            <br/>
            <span><b>Gender:</b> $g</span>
        </div>
        <br/>
        <form action="index.php?page=accounts&action=delete&id=$id" method="post" id="form1">
            <button type="submit" form="form1" value="delete">Delete</button>
        </form>
BODY;

        $menu = Menu::output();

        return $body . $menu;
    }
}   
?>