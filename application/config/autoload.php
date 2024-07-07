<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| For example, to autoload the database library, you would do this:
|
|   $autoload['libraries'] = array('database');
|
| You can also autoload helpers, config files, language files, and models.
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
| Please see the user guide for information on libraries.
|
| Prototype:
|
|   $autoload['libraries'] = array('database', 'email', 'session');
|
*/
$autoload['libraries'] = array('pdf'); // Add 'pdf' to the array

// Other autoload configurations remain the same
$autoload['libraries'] = array('database', 'session', 'pdf');
$autoload['helper'] = array('url', 'form');
$autoload['model'] = array();
$autoload['driver'] = array();

// You can add other necessary autoload configurations below as needed

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|   $autoload['helper'] = array('url', 'file');
|
*/
$autoload['helper'] = array('url', 'file', 'form');

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|   $autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files. Otherwise, leave it blank.
|
*/
$autoload['config'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|   $autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/
$autoload['language'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|   $autoload['model'] = array('first_model', 'second_model');
|
*/
$autoload['model'] = array();
