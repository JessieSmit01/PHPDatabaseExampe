<?php
/**************************************
 * File Name: Pet.php
 * User: cst231
 * Date: 2019-11-04
 * Project: CWEB280
 *
 *
 **************************************/


/**************************************
 * File Name: Student.php
 * User: cst231
 * Date: 2019-10-18
 * Project: CWEB280
 *This class will extend Entity/ORFM with certain data for the student table
 *
 **************************************/
//require, require_once effectively copy paste code from another file into this file
require_once 'Entity.php';//this class extends entity so need to have it required to be able to declare the Extends

//Extends is similar to inheritance in other languages
class Pet Extends Entity
{
    public $petID; //primary key
    public $petName; //name of the pet max size 10 characters
    public $petAge; //age of the pet max value 100
    public $petNickName; //petNickName -can be nullable max size 10 characters


    /**
     * Pet constructor. sets this entities pkName as petID
     */
    public function __construct()
    {
        $this->pkName = 'petID';

    }

    /**
     * This method will load the bind types for the associated field name by calling this Entities setBindType function
     */
    public function inputBindTypes()
    {
        $this->setBindType('petID', SQLITE3_INTEGER); //add bind type for petID
        $this->setBindType('petName', SQLITE3_TEXT);  //add bind type for petName
        $this->setBindType('petAge', SQLITE3_INTEGER);  //add bind type for petAge
        $this->setBindType('petNickName', SQLITE3_TEXT);  //add bind type for petNickName
    }

    /**
     * This function will set up the column definition for the Pet Object.
     * Only to be called when creating a new table in the database
     *  https://www.sqlite.org/datatype3.html used this as a resource to help me ensure that I was choosing the correct datatypes for this entity
     */
    public function inputColDefinitions()
    {
        //col definition for petID
        $this->setCols('petID', 'INTEGER', null, true, false, true);
        //col definition for petName
        $this->setCols('petName', 'VARCHAR', 10, false, false, false);
        //col definition for petAge
        $this->setCols('petAge', 'INTEGER', 100,false, false, false);
        //col definition for petNickName -NOTE this field can be nullable
        $this->setCols('petNickName', 'VARCHAR', 10, false, true, false);


    }


}