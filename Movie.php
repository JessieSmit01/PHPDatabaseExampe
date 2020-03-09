<?php
/**************************************
 * File Name: Movie.php
 * User: cst231
 * Date: 2019-11-04
 * Project: CWEB280
 *
 *
 **************************************/
//require, require_once effectively copy paste code from another file into this file
require_once 'Entity.php'; //this class extends entity so need to have it required to be able to declare the Extends

//Extends is similar to inheritance in other languages
class Movie Extends Entity
{
    public $movieID; //primary key
    public $title; //movie title max size 50 characters
    public $yearMade; //year that the movie was made max value size 2050
    public $rating; //movie rating -max size 100


    /**
     * Movie constructor. sets this entities pkName as movieID
     */
    public function __construct()
    {
        $this->pkName = 'movieID';
        $this->inputColDefinitions();
    }
    /**
     * This method will load the bind types for the associated field name by calling this Entities setBindType function
     */
    public function inputBindTypes()
    {
        $this->setBindType('movieID', SQLITE3_INTEGER); //add bind type for movieID
        $this->setBindType('title', SQLITE3_TEXT);  //add bind type for title
        $this->setBindType('yearMade', SQLITE3_INTEGER);  //add bind type for yearMade
        $this->setBindType('rating', SQLITE3_INTEGER);  //add bind type for rating
    }

    /**
     * This function will set up the column definition for the Movie Object.
     * Only to be called when creating a new table in the database
     * https://www.sqlite.org/datatype3.html used this as a resource to help me ensure that I was choosing the correct datatypes for this entity
     */
    public function inputColDefinitions()
    {
        //col definition for movieID
        $this->setCols('movieID', 'INTEGER', null, true, false, true);
        //col definition for title
        $this->setCols('title', 'VARCHAR', 50, false, false, false);
        //col definition for yearMade
        $this->setCols('yearMade', 'INTEGER', 2050,false, false, false);
        //col definition for rating
        $this->setCols('rating', 'INTEGER', 100, false, true, false);


    }


}