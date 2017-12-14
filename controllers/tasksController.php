<?php


//each page extends controller and the index.php?page=tasks causes the controller to be called
namespace controller;
class tasksController extends \http\controller
{
    //each method in the controller is named an action.
    //to call the show function the url is index.php?page=task&action=show
    public static function show()
    {
        $record = todos::findOne($_REQUEST['id']);
        self::getTemplate('show_task', $record);
    }

    //to call the show function the url is index.php?page=task&action=list_task

    public static function all()
    {
        
        //This is how you would save a new todo item

        
        /*
        $record = new \model\todo();
        $record->message = 'some task';
        $record->isdone = 0;
        $record->ownerid = 1;
        $record->owneremail = 'me@me.com';
        $record->createddate = '2017-11-14 12:59:45';
        $record->duedate = '2017-11-15 12:59:45';
        $record->save();
        print "<pre>" . print_r($record, true) . "</pre>";
        */

        //This is how you would delete a record

        /*
        $record = new todo();
        $record->id = 5;
        $record->deleteById();
        print "<pre>" . print_r($record, true) . "</pre>";
        */

        /*
        $record = new todo();
        $record->id = 6;
        $record->message = 'finish homework';
        $record->isdone = 1;
        $record->save();
        print "<pre>" . print_r($record, true) . "</pre>";
        */


        // this would be the method to put in the index page for todos
        /*
        $records = todos::findAll();
        print "<pre>" . print_r($records, true) . "</pre>";
        */


        //this code is used to get one record and is used for showing one record or updating one record
        /*
        $record = todos::findOne(6);
        print "<pre>" . print_r($record, true) . "</pre>";
        */
        
        
        //$records = \model\todo::findAll();
        /*  
            session_start();
            if(key_exists('userID',$_SESSION)) {
                $userID = $_SESSION['userID'];
            } else {
  
                echo 'you must be logged in to view tasks';
            }
 
         $userID = $_SESSION['userID'];
 
         $records = todos::findTasksbyID($userID);
        
        */
        //self::getTemplate('all_tasks', $records);

    }
    //to call the show function the url is called with a post to: index.php?page=task&action=create
    //this is a function to create new tasks

    //you should check the notes on the project posted in moodle for how to use active record here

    public static function create()
    {
        print_r($_POST);
    }

    //this is the function to view edit record form
    public static function edit()
    {
        $record = todos::findOne($_REQUEST['id']);

        self::getTemplate('edit_task', $record);

    }

    //this would be for the post for sending the task edit form
    public static function store()
    {


        $record = todos::findOne($_REQUEST['id']);
        $record->body = $_REQUEST['body'];
        $record->save();
        print_r($_POST);

    }

    public static function save() {
         session_start();
         $task = new todo();
 
         $task->body = $_POST['body'];
         $task->ownerid = $_SESSION['userID'];
         $task->save();
 
     }
    //this is the delete function.  You actually return the edit form and then there should be 2 forms on that.
    //One form is the todo and the other is just for the delete button
    public static function delete()
    {
        $record = todos::findOne($_REQUEST['id']);
        $record->delete();
        print_r($_POST);

    }

}