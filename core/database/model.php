<?php

namespace database;

abstract class model
{

    /**
     * Save method - does insert or update
     */
    public function save()
    {
        //get database connection
        $db = dbConn::getConnection();
         
        //run pre-hook activities
        $this->preHook();

        //create new row if id is blank
        if ($this->id == '')
        {
            
            //prepare and bind values
            $sql = $this->insert();
                    
            //get sql statement with placeholders
            $statement = $db->prepare($sql);
            $columnValues = $this->getColumnValues();
            
            $i = 1;
            foreach($columnValues as $value)
            {
                $statement->bindValue($i, $value);
                $i++;
            }
            
            $statement->execute();
            
            //good practice for an orm to return id
            return $db->lastInsertId();
        } 
        else
        {
            //run sql update
            $sql = $this->update();
                        
            //check to see if the record you want to update exists
            $statement = $db->prepare($sql);
            $statement->execute();
            
            //good practice for an orm to return id
            return $this->id;
        }
    }

    /**
     * Insert method
     */
    private function insert()
    {

       //prepare sql statement
        //get table name
        $tableName = $this::TABLE_NAME;
        
        //get column names for table id,message,xxx,...
        $columnString = implode(',', $this->getColumnNames());
        
        //create parameter placeholders array(?,?,?,?,?)
        $valuePlaceholderArray = array_fill(0, sizeof($this->getColumnValues()), '?');
        
        //create ?,?,?,?,?
        $valueString = implode(',', $valuePlaceholderArray);
        
        //output is INSERT INTO tablename (a,b,c,d) VALUES (?,?,?,?)        
        $sql = "INSERT INTO $tableName ($columnString) VALUES ($valueString)";
        
        return $sql;
    }

    /**
     * Validate stub method - always returns true (the stub)
     * Method over-ridden by inheriting classes
     */
    public function validate()
    {
         return TRUE;
    }
     
     /**
      * Prehook stub method - allows post-processing of information in model before sql action. 
      * Method over-ridden by inheriting classes
      */
    public function preHook()
    {
        return TRUE;
    }

    /**
     * Update method
     */
    private function update()
    {

        //prepare sql statement
        //get table name
        $tableName = $this::TABLE_NAME;
        $primaryKey = $this::PRIMARY_KEY;
        $id = $this->getColumnValues()['id'];
                        
        $valueString = NULL;
        
        foreach($this->getColumnValues() as $columnName => $value)
        {
            //we never want to update a primary key
            //we only want to update the fields provided            
            if($columnName !== $primaryKey and !empty($value))
            {
                $valueString .= $columnName . ' = \'' . $value .'\', '; //pdo execute will prevent injection attacks
            }
        }
        
        $valueString = rtrim($valueString, ', ');
        
        $sql = "UPDATE $tableName SET $valueString WHERE $primaryKey = $id";
        return $sql;
    }

    /**
     * delete method
     */
    public function delete()
    {
        //prepare sql statement
        //get table name
        $tableName = $this::TABLE_NAME;
        $primaryKey = $this::PRIMARY_KEY;
        
        $sql = "DELETE FROM $tableName WHERE $primaryKey = ?";
        
        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->id);
        
        $statement->execute();
        
        //good practice is to check the database if the record exists and return true or false
        if($statement->rowCount() == 1)
        {
            return true;
        }
        
        return false;
    }
    
    /**
     * Get public properties from model using reflection class. Used to generate SQL statement
     */
    private function getColumnNames()
    {
        $obj = new \ReflectionObject($this);
        $objs = $obj->getProperties(\ReflectionProperty::IS_PUBLIC);
        
        $columns = array();
        
        foreach($objs as $column)
        {
            $columns[] = $column->{'name'};
        }
        
        return $columns;
    }
    
    /**
     * Get public property value from model using reflection class. Used to generate SQL statement
     */
    private function getColumnValues()
    {
        $obj = new \ReflectionObject($this);
        
        $columns = array();
        
        foreach($obj->getProperties(\ReflectionProperty::IS_PUBLIC) as $property)
        {
            if($property->getValue($this) == '')
            {
                //force insert null into db if there is no value
                $columns[$property->getName()] = NULL;
                continue;
            }
            
            $columns[$property->getName()] = $property->getValue($this); //array('property name' => 'property value')
        }
        
        return $columns;
    }
}

?>
