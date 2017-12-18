<?php

namespace view;

class HomepageView extends View implements iPage
{
    public function output()
    {
        $form = <<<FORM
        
        <h1>To-Do Application</h1>
        
        <form action="index.php?page=accounts&action=login" method="POST">

            <div class="container">
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="email" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit">Login</button>
            </div>


        </form>
        <h1><a href="index.php?page=accounts&action=register">Register</a></h1>
FORM;
    
        return $form;
    }
}
?>