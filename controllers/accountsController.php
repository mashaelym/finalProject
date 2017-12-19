<?php

namespace controller;

use \collection\accounts;
use \http\controller;
use \view\ShowAccountView;
use \view\AllAccountsView;
use \view\EditAccountView;
use \view\RegisterView;
use \view\ValidationView;
use \model\account;

class accountsController extends controller
{

    /**
     * Display one account
     * url: index.php?page=accounts&action=show
     */
    public function show()
    {
        if($this->getSessionHandler()->isLoggedIn())
        {
            $id = $this->getRequestObject()->getParameter('id');
            $record = accounts::create()->findOne($id);
            
            $v = new ShowAccountView();
            $v->injectData(array('data' => $record, 'id' => $id));
            echo $v->render();
        }
        else
        {
            $this->displayMessage('You must login to view this area!');
        }
    }

    /**
     * Display all accounts
     * url: index.php?page=accounts&action=all
     */
    public function all()
    {
        if($this->getSessionHandler()->isLoggedIn())
        {
            //check if logged in
            $records = accounts::create()->findAll();
            
            $v = new AllAccountsView();
            $v->injectData(array('data' => $records));
            echo $v->render();
        }
        else
        {
            $this->displayMessage('You must login to view this area!');
        }
    }
    
    /**
     * Displays page to register new account
     * url: index.php?page=accounts&action=register
     */
    public function register()
    {
         $v = new RegisterView();
         echo $v->render();
    }
    
    /**
     * Edit User
     * url: index.php?page=accounts&action=edit
     */
    public function edit()
    {
        if($this->getSessionHandler()->isLoggedIn())
        {
            $id = $this->getRequestObject()->getParameter('id');
            $record = accounts::create()->findOne($id);
            
            $v = new EditAccountView();
            $v->injectData(array('data' => $record, 'id' => $id));
            echo $v->render();
        }
        else
        {
            $this->displayMessage('You must login to view this area!');
        }

    }
    
    /**
     * Add new user
     * url: index.php?page=accounts&action=create
     */
    public function create()
    {
        
         $user = \model\account::findUserbyEmail($this->getRequestObject()->getParameter('email'));
         
         if ($user == FALSE)
         {
             $user = new account();
             $user->email = $this->getRequestObject()->getParameter('email');        
             $user->fname = $this->getRequestObject()->getParameter('fname');
             $user->lname = $this->getRequestObject()->getParameter('lname');
             $user->phone = $this->getRequestObject()->getParameter('phone');
             $user->birthday = $this->getRequestObject()->getParameter('birthday');
             $user->gender = $this->getRequestObject()->getParameter('gender');
             $user->password = $this->getRequestObject()->getParameter('password'); //gets hashed in account model
             
             //validate
             if($user->validate() !== true)
             {
                 //returns array of error messages
                 $errors = $user->validate();
                 $v = new ValidationView();
                 $v->injectData(array('messages' => $errors));
                 echo $v->render();
                 die(); //halt execution if it's invalid
             }
             
             $user->save();
             
             $this->displayMessage('You have successfully registered!');
         }
         else
         {
            $this->displayMessage('User is already registered. Try logging in.');
         }
     }
    
    /**
     * Post action for creating updating user record
     * url: index.php?page=accounts&action=update
     */
    public function update()
    {
 
        if($this->getSessionHandler()->isLoggedIn())
        {
             $id = $this->getRequestObject()->getParameter('id');
             $user = new account();
             $user->id = $this->getRequestObject()->getParameter('id');
             $user->email = $this->getRequestObject()->getParameter('email');        
             $user->fname = $this->getRequestObject()->getParameter('fname');
             $user->lname = $this->getRequestObject()->getParameter('lname');
             $user->phone = $this->getRequestObject()->getParameter('phone');
             $user->birthday = $this->getRequestObject()->getParameter('birthday');
             $user->gender = $this->getRequestObject()->getParameter('gender');
             $user->password = $this->getRequestObject()->getParameter('password'); //gets hashed in account model
             
             //validate
             if($user->validate() !== true)
             {
                 //returns array of error messages
                 $errors = $user->validate();
                 $v = new ValidationView();
                 $v->injectData(array('messages' => $errors));
                 echo $v->render();
                 die(); //halt execution if it's invalid
             }
             
             $user->save();

             header("Location: index.php?page=accounts&action=show&id=$id");
         }
         else {
            $this->displayMessage('You must login to view this area!');
         }

    }
 
     /**
      * Delete User
      */
     public function delete() {
 
        if($this->getSessionHandler()->isLoggedIn())
        {
            $id = $this->getRequestObject()->getParameter('id');
            $record = accounts::create()->findOne($id);
            $record->delete();
            header("Location: index.php?page=accounts&action=all");
        }
        else
        {
            $this->displayMessage('You must login to view this area!');
        }
     }

    /**
     * Login
     */
    public function login()
    {
        $email = $this->getRequestObject()->getParameter('email');
        $password = $this->getRequestObject()->getParameter('password');
        $user = accounts::create()->findUserbyEmail($email);

        if ($user == FALSE)
        {
            $this->displayMessage('User does not exist. Please register.');
        }
        else
        {
             if($user->checkPassword($password) == TRUE)
             {
                 //session is already started on the controller on the constructor
                 //this tells us the user is logged in
                 $this->getSessionHandler()->setSessionVariable('id', $user->id);
                 $this->getSessionHandler()->setSessionVariable('email', $user->email);
                 header("Location: index.php?page=portal&action=show");
             }
             else
             {
                $this->displayMessage('Invalid password. Try Again.');
             }
         }
    }
    
    /**
     * Logout
     */
    public function logout()
    {
        if($this->getSessionHandler()->isLoggedIn())
        {
            //remove all session variables
            session_unset(); 

            //destroy the session 
            session_destroy();
        }
            
        //redirect user to homepage
        header("Location: index.php");
    }

}