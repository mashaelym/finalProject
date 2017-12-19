<?php

namespace controller;

use \collection\todos;
use \http\controller;
use \model\todo;
use \view\AddTaskView;
use \view\AllTasksView;
use \view\EditTaskView;
use \view\ShowTaskView;
use \view\ValidationView;

class tasksController extends controller
{
    /**
     * Display one task
     * url: index.php?page=task&action=show
     */
    public function show()
    {
        if($this->getSessionHandler()->isLoggedIn())
        {
            $id = $this->getRequestObject()->getParameter('id');
            $record = todos::create()->findOne($id);
            
            $v = new ShowTaskView();
            $v->injectData(array('data' => $record, 'id' => $id));
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
    public function add()
    {
        if($this->getSessionHandler()->isLoggedIn())
        {
            $v = new AddTaskView();
            echo $v->render();
        }
        else
        {
            $this->displayMessage('You must login to view this area!');
        }
    }

    /**
     * Display all tasks
     * url: index.php?page=task&action=all
     */
    public function all()
    {
        if($this->getSessionHandler()->isLoggedIn())
        {
            $id = $this->getSessionHandler()->getSessionVariable('id');
            $records = todos::create()->findAllbyUserId($id);
            
            $v = new AllTasksView();
            $v->injectData(array('data' => $records, 'id' => $id));
            echo $v->render();
        }
        else
        {
            $this->displayMessage('You must login to view this area!');
        }
    }
    
    /**
     * create new task
     * url: index.php?page=tasks&action=create
     */
    public function create()
    {
        if($this->getSessionHandler()->isLoggedIn())
        {
            $todo = new todo();
            $todo->message = $this->getRequestObject()->getParameter('message');
            $todo->isdone = $this->getRequestObject()->getParameter('isdone');
            $todo->ownerid = $this->getSessionHandler()->getSessionVariable('id');
            $todo->owneremail = $this->getSessionHandler()->getSessionVariable('email');
            $todo->createddate = date('Y-m-d h:m:s', strtotime('now'));
            $todo->duedate = $this->getRequestObject()->getParameter('duedate');
            
            //validate
             if($todo->validate() !== true)
             {
                 //returns array of error messages
                 $errors = $todo->validate();
                 $v = new ValidationView();
                 $v->injectData(array('messages' => $errors));
                 echo $v->render();
                 die(); //halt execution if it's invalid
             }
             
            $id = $todo->save();
            header("Location: index.php?page=tasks&action=show&id=$id");
        }
        else
        {
            $this->displayMessage('You must login to view this area!');
        }
    }

    /**
     * Display task
     * url: index.php?page=task&action=edit
     */
    public function edit()
    {
        if($this->getSessionHandler()->isLoggedIn())
        {
            $id = $this->getRequestObject()->getParameter('id');
            $record = todos::create()->findOne($id);
            
            $v = new EditTaskView();
            $v->injectData(array('data' => $record, 'id' => $id));
            echo $v->render();
        }
        else
        {
            $this->displayMessage('You must login to view this area!');
        }

    }

    /**
     * update task
     * url: index.php?page=tasks&action=update
     */
    public function update()
    {
        if($this->getSessionHandler()->isLoggedIn())
        {
            $id = $this->getRequestObject()->getParameter('id');
            $todo = todo::findOne($id);
            $todo->message = $this->getRequestObject()->getParameter('message');
            $todo->isdone = $this->getRequestObject()->getParameter('isdone');
            $todo->ownerid = $this->getRequestObject()->getParameter('ownerid');
            $todo->owneremail = $this->getRequestObject()->getParameter('owneremail');
            $todo->createddate = $this->getRequestObject()->getParameter('createddate');
            $todo->duedate = $this->getRequestObject()->getParameter('duedate');
            
            //validate
             if($todo->validate() !== true)
             {
                 //returns array of error messages
                 $errors = $todo->validate();
                 $v = new ValidationView();
                 $v->injectData(array('messages' => $errors));
                 echo $v->render();
                 die(); //halt execution if it's invalid
             }
             
            $todo->save();
            header("Location: index.php?page=tasks&action=show&id=$id");
        }
        else
        {
            $this->displayMessage('You must login to view this area!');
        }
    }
     
    /**
     * Delete all tasks
     * url: index.php?page=tasks&action=delete
     */
    public function delete()
    {
        if($this->getSessionHandler()->isLoggedIn())
        {
            $id = $this->getRequestObject()->getParameter('id');
            $record = todos::create()->findOne($id);
            $record->delete();
            header("Location: index.php?page=tasks&action=all");
        }
        else
        {
            $this->displayMessage('You must login to view this area!');
        }
    }

}