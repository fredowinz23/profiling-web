<?php
include "CRUD.php";
include "functions.php";

function account() {
	$crud = new CRUD;
	$crud->table = "account";
	return $crud;
}


function classes() {
	$crud = new CRUD;
	$crud->table = "classes";
	return $crud;
}



function strand() {
	$crud = new CRUD;
	$crud->table = "strand";
	return $crud;
}


function subject() {
	$crud = new CRUD;
	$crud->table = "subject";
	return $crud;
}


function record() {
	$crud = new CRUD;
	$crud->table = "record";
	return $crud;
}



function attendance() {
	$crud = new CRUD;
	$crud->table = "attendance";
	return $crud;
}


?>
