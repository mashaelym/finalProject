<?php

namespace view;

class RegisterView extends View implements iPage
{
     public function output()
     {
          $register = <<<REGISTER
          
          <h1>Registration</h1>
          
           <form action="index.php?page=accounts&action=create" method="post">
                <div><h3>Required Fields</h3></div>
                First name: <input type="text" name="fname"><br/>
                Last name: <input type="text" name="lname"><br/>
                Email: <input type="text" name="email"> Format: name@email.com<br/>
                Password: <input type="password" name="password"><br/>

                <div><h3>Optional Fields</h3></div>
                Phone: <input type="text" name="phone"> Format: 313-323-2322<br/>
                Birthday: <input type="text" name="birthday"> Format: mm-dd-yyyy<br/>
                Gender: <select name="gender">
                    <option value="">Select</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
                
                <br/>
                <br/>
                <input type="submit" value="Submit form">
      </form>
      <h1><a href="index.php">Home</a></h1>
REGISTER;

          return $register;
     }
}
?>