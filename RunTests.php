<?php
/**
*	@file : RunTests.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates new TestSuite object
*/
//error_reporting(0);
session_start();
include "src/TestSuite.php";

$TestSuite = new TestSuite();

$TestSuite->RunTests();	

$TestSuite->close();

