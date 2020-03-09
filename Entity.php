<?php
/**************************************
 * File Name: Entity.php
 * User: cst231
 * Date: 2019-10-16
 * Project: CWEB280
 *
 * This is an abstract class which contains definitions for various methods and metadata
 * Will be sent as parameters to the repository class so repo class perform SQL command
 *
 **************************************/




abstract class Entity
{
    protected $pkName = 'id'; //set default primary key to 'id'
    //default column definitions. Column definition values can be changed by developer is child classes
    //$colDefinitions will be empty unless you are creating a table for the Entity object.
    protected $colDefinitions = []; //this will be a 2D array containing a row for each column in the entity and a column for each column definition.
    //IMPORTANT - each row must be an associative array containing 'datatype', 'size', 'null', and 'autoincrement for the keys.
    //Additional info: use SQLITE3_(append datatype to here) for 'datatype', integer size for 'size', true or false for 'null' - true being nullable, true
    // and true or false for 'autoincrement'

    protected $bindTypes = []; //this array will store the bind type values for each entity attribute key

    protected $incrementingFields = []; //this array will keep track of auto incrementing fields


    /**
     * @return array - this method will return the column definitions for this entity
     */
    public function getColDefinitions()
    {
        return $this->colDefinitions;

    }

    /**
     * @return array - this method will return an array of incrementing fields for this entity.
     */
    public function getIncrementingFields()
    {
        return $this->incrementingFields;
    }

    /***
     * @return array - returns an array composed of each field name as the key and bind type as the value
     */
    public function getBindTypes()
    {
        return $this->bindTypes;
    }

    /**
     * This method will take in a field name and bind type and append it to this entity's bindTypes array.
     * @param $fieldName - this will become the key
     * @param $bindValue - this will become the bind type value
     */
    protected function setBindType($fieldName, $bindValue)
    {
       // https://www.sitepoint.com/community/t/adding-elements-to-a-php-associative-array/1948
        //I used this site to help me learn how to add new associative values to an associative array
        $this->bindTypes[$fieldName] = $bindValue; //add this bind type for the given field key to this entity's bindTypes array.
    }

    /**
     * Takes in information for a column definition for an entity attribute.
     * @param $colName - name of the column - must be string
     * @param $datatype - column datatype - must be SQLITE3_[datatype]
     * @param $size - size of the datatype -Must be integer. -put null for auto incrementing
     * @param $pk - true for primary key
     * @param $null - true - allow null, false- do not allow null
     * @param $autoincrement - true for autoincrement.
     */
    protected function setCols($colName, $datatype, $size, $pk, $null, $autoincrement)
    {
        //set the column data information into an associative array with the data given.
        $col = ['colName' => $colName, 'datatype' => $datatype, 'size' => $size, 'pk' => $pk, 'null' => $null, 'autoincrement' => $autoincrement];
        array_push($this->colDefinitions, $col); //add the column definition to the $colDefinitions 2D array.
        if($autoincrement == true)
        {
            //if this column is auto incrementing just dynamically add it to the array of auto incrementing values
            $this->incrementingFields [] = $colName;
        }
        //https://www.php.net/manual/en/function.array-push.php used this website to understand how array_push works
        //first it takes in the array to push to
        //second it takes in the array to push to the end of this array - in this case we are pushing an
        //associative array to the end of this entity's $colDefinitions array
        //creating a 2D array
    }




    /**
     * @return string - returns the primary key field name Example: 'id' or 'studentID'
     */
    public function getPkName(): string
    {
        return $this->pkName;
    }


    /***
     * @return string - the name of the child entity class - also used for database table name.
     */
    public function getClassName()
    {
        return get_class($this);
    }


    /**
     * @param $array - An Associative array that has the same keys as the entity has properties
     */
    public function parseArray($array){
        //DONE
        $entityField = get_object_vars($this);
        //https://www.php.net/manual/en/function.array-diff-key.php i used this website for help on the array_dif_keys function
        //array_diff_key will check two arrays and return an array composed of
        //keys from the first array who are not included in the second array
        //I am expecting an empty array if all fields match all entity properties
        //if an array of keys is returned fields do not match the entity fields, then return -1
        if(array_diff_key($array, $entityField) !== [])
        {
            return -1;
        }
        foreach ($array as $field=>$valInPost)
        {
            //set the entity property to corresponding value from the database
            $this->$field = $valInPost;
        }

        return $this;
    }



}