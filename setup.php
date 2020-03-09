<?php
/**************************************
 * File Name: setup.php
 * User: cst231
 * Date: 2019-11-04
 * Project: CWEB280
 *
 * This file will be used to create tables (or recreate tables if exist)
 * For a web application. This php file is to be run only once to create the tables
 * for each entity that you need to use
 *
 **************************************/


require_once "Pet.php"; //we will need access to the Pet object
require_once "Movie.php"; //we will need access to the Movie object
require_once "Repository.php"; //we will need access to the Repository object

//create a new repository object and point it to 'test.db' in this current folder.
//if the db does not exist, it will then create the db called 'test.db'
$repo = new Repository('test.db');



//Create empty objects to create tables with
$car = new Car(); //create empty Car object
$movie = new Movie();//create empty Movie object
$pet = new Pet(); //create empty Pet object
//Call the inputColDefinitions method for each object
//this loads the column definitions into each entities colDefinitions array
$car->inputColDefinitions();
$movie->inputColDefinitions();
$pet->inputColDefinitions();

//create an array. Insert each object into the array
//this array will be used to pass into the Repository's
//createTables method. We only need empty objects since we are just using the objects
// attribute datatypes and attribute names and not their attribute values
$array = [$car, $movie, $pet];

//pass this array into the the repo's createTables method.
//Tables will be created along with the database if it does not currently exist
$repo->createTables($array);