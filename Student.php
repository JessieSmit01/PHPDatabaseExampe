<?php
/**************************************
 * File Name: Student.php
 * User: cst231
 * Date: 2019-10-18
 * Project: CWEB280
 *This class will extend Entity/ORFM with certain data for the student table
 *
 **************************************/
//require, require_once effectively copy paste code from another file into this file
require_once 'Entity.php';

//Extends is similar to inheritance in other languages
class Student Extends Entity
{
    public function inputBindTypes()
    {
        $this->setBindType('studentID', SQLITE3_INTEGER); //add bind type for movieID
        $this->setBindType('familyName', SQLITE3_TEXT);  //add bind type for title
        $this->setBindType('givenName', SQLITE3_TEXT);  //add bind type for yearMade
        $this->setBindType('preferredName', SQLITE3_TEXT);  //add bind type for rating
        $this->setBindType('userName', SQLITE3_TEXT);  //add bind type for rating
    }

    /**
     * This function will set up the column definition for the Pet Object.
     * Only to be called when creating a new table in the database
     *  https://www.sqlite.org/datatype3.html used this as a resource to help me ensure that I was choosing the correct datatypes for this entity
     */
    public function inputColDefinitions()
    {
        //col definition for petID
        $this->setCols('studentID', 'INTEGER', null, true, false, true);
        //col definition for petName
        $this->setCols('familyName', 'VARCHAR', 10, false, false, false);
        //col definition for petAge
        $this->setCols('givenName', 'INTEGER', 100,false, false, false);
        //col definition for petNickName -NOTE this field can be nullable
        $this->setCols('preferredName', 'VARCHAR', 10, false, true, false);
        $this->setCols('userName', 'VARCHAR', 10, false, false, false);



    }




    /***
     * Validates the value stored in the studentID against constraints defined in the validate function itself
     * @return - Array of error messages - empty if value in property is valid
     */
    public function validate_studentID()
    {
        $validationResult = [];
        //Added 'constriant' that studentID must be an integer greater than 0
        if(!is_int($this->studentID) || $this->studentID <= 0)
        {
            $validationResult ['studentID'] = 'Student ID must be an integer greater than 0';
        }

        return $validationResult;
    }
    public $studentID;

    public function validate_familyName()
    {
        $validationResult = [];
        if(empty(trim($this->familyName))){$validationResult ['familyName'] = 'Family Name can not be empty or all spaces';}
        else if(strlen($this->familyName) > 50){$validationResult ['familyName'] = 'Family Name maximum length is 50 characters';}
        return $validationResult;
    }
    public $familyName;

    public function validate_givenName()
    {
        $validationResult = [];
        if(empty(trim($this->givenName))){$validationResult ['givenName'] = 'given Name can not be empty or all spaces';}
        else if(strlen($this->givenName) > 50){$validationResult ['givenName'] = 'given Name maximum length is 50 characters';}
        return $validationResult;
    }
    public $givenName;

    //MINICISE 29: make a validator for the optional preferredName but still has a limit of 50 chars
    public function validate_preferredName()
    {
        $validationResult = [];
        if(strlen($this->preferredName) > 50){$validationResult ['preferredName'] = 'preferred Name maximum length is 50 characters';}
        return $validationResult;
    }
    public $preferredName;

    public function validate_userName()
    {
        $validationResult = [];
        if(empty(trim($this->userName))){$validationResult ['userName'] = 'User Name can not be empty or all spaces';}
        if(strlen($this->userName) > 50){$validationResult ['userName'] = 'User Name Name maximum length is 50 characters';}
        return $validationResult;
    }
    public $userName;

    /***
     * Student constructor.
     */
    public function __construct()
    {
        //here the developer can set any protected variables
        $this->pkName = 'studentID'; //override the default primary key.
    }
}