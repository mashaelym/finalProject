<?php

namespace model;

final class todo extends \database\model
{
    public $id;
    public $owneremail;
    public $ownerid;
    public $createddate;
    public $duedate;
    public $message;
    public $isdone;
    public $useriD;
    protected static $modelName = 'todo';

    public static function getTablename()
    {

        $tableName = 'todos';
        return $tableName;
    }


    public static function findTaskById()
    {

        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE useriD =' . $useriD;
        $recordsSet = self::getResults($sql);
        return $recordsSet[0];

    }

    public static function findAll()
    {
        return 'hello';
    }
}

?>
