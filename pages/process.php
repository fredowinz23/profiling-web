<?php
session_start();
require_once '../config/database.php';
require_once '../config/Models.php';

$action = $_GET['action'];

switch ($action) {

	case 'account-save' :
		account_save();
		break;

	case 'account-delete' :
		account_delete();
		break;

	case 'strand-save' :
		strand_save();
		break;

	case 'strand-delete' :
		strand_delete();
		break;

	case 'record-save' :
		record_save();
		break;


	case 'record-delete' :
		record_delete();
		break;

	case 'subject-save' :
		subject_save();
		break;

	case 'subject-delete' :
		subject_delete();
		break;

	case 'class-save' :
		class_save();
		break;

	case 'class-delete' :
		class_delete();
		break;

	case 'profile-save' :
		profile_save();
		break;

	case 'attendance-change' :
		attendance_change();
		break;




	default :
}

function account_delete(){

	$Id = $_GET["Id"];
	$model = account();
	$model->obj["isDeleted"] = 1;
	$model->obj["status"] = "Archived";
	$model->update("Id=$Id");

	header('Location: ' . $_GET["url"]);
}
function strand_delete(){

	$Id = $_GET["Id"];
	$model = strand();
	$model->obj["isDeleted"] = 1;
	$model->update("Id=$Id");

	header('Location: ' . $_GET["url"]);
}
function subject_delete(){

	$Id = $_GET["Id"];
	$model = subject();
	$model->obj["isDeleted"] = 1;
	$model->update("Id=$Id");

	header('Location: ' . $_GET["url"]);
}

function attendance_change(){
	$facultyId = $_GET["facultyId"];
	$model = attendance();
	$model->obj["classId"] = $_GET["classId"];
	$model->obj["facultyId"] = $_GET["facultyId"];
	$model->obj["status"] = $_GET["status"];
	$model->obj["dateAdded"] = "NOW()";
	$model->create();

	header('Location: teacher-attendance.php');
}

function subject_save(){

	$model = subject();
	$model->obj["name"] = $_POST["name"];
	$model->obj["strandId"] = $_POST["strandId"];
	$model->obj["year"] = $_POST["year"];

	if ($_POST["form-type"] == "add") {
		$model->create();
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
	}

	header('Location: subjects.php');

}

function profile_save(){

	$Id = $_POST["Id"];
	$model = account();
	if ($_FILES['image']['name'] != "") {
		$image_file_name = uploadFile($_FILES["image"]);
		$model->obj["image"] = $image_file_name;
	}
	$model->obj["firstName"] = $_POST["firstName"];
	$model->obj["lastName"] = $_POST["lastName"];
	$model->obj["birthday"] = $_POST["birthday"];
	$model->obj["birthPlace"] = $_POST["birthPlace"];
	$model->obj["civilStatus"] = $_POST["civilStatus"];
	$model->obj["sex"] = $_POST["sex"];
	$model->obj["religion"] = $_POST["religion"];
	$model->obj["email"] = $_POST["email"];
	$model->obj["phone"] = $_POST["phone"];
	$model->obj["address"] = $_POST["address"];
	$model->obj["educationalBackground"] = $_POST["educationalBackground"];
	$model->obj["teachingExperience"] = $_POST["teachingExperience"];
	$model->obj["sss"] = $_POST["sss"];
	$model->obj["philHealth"] = $_POST["philHealth"];
	$model->update("Id=$Id");


	header('Location: my-profile.php');

}

function class_delete(){

	$model = classes();
	$Id = $_GET["Id"];
	$model->delete("Id=$Id");

	header('Location: ' . $_GET['url'] . '?success=You have deleted a class');

}

function class_save(){

	$model = classes();
	$model->obj["name"] = $_POST["name"];
	$model->obj["subjectId"] = $_POST["subjectId"];
	$model->obj["facultyId"] = $_POST["facultyId"];
	$model->obj["time"] = $_POST["time"];
	$model->obj["days"] = $_POST["days"];

	if ($_POST["form-type"] == "add") {
		$model->create();
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
	}

	header('Location: classes.php');

}

function strand_save(){

	$model = strand();
	$model->obj["name"] = $_POST["name"];
	$model->obj["description"] = $_POST["description"];

	if ($_POST["form-type"] == "add") {
		$model->create();
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
	}

	header('Location: strands.php');

}

function record_save(){

	$model = record();
	$model->obj["userId"] = $_POST["userId"];
	$model->obj["name"] = $_POST["name"];
	$model->obj["image"] = uploadFile($_FILES["image"]);
	$model->obj["type"] = $_POST["type"];
	$model->obj["dateAdded"] = "NOW()";
	$model->create();


	header('Location: record-list.php?type=' . $_POST["type"]);

}

function record_delete(){

	$Id = $_GET["Id"];
	$model = record();
	$model->delete("Id=$Id");

	header('Location: record-list.php?type=' . $_GET["type"]);

}



function category_save(){
	#Process to save to the database

	$model = category();
	$model->obj["name"] = $_POST["name"];
	$model->obj["description"] = $_POST["description"];

	if ($_POST["form-type"] == "add") {
		$model->create();
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
	}

	header('Location: categories.php');
}

function program_save(){
	#Process to save to the database

	$model = program();
	$model->obj["title"] = $_POST["title"];
	$model->obj["description"] = $_POST["description"];
	$model->obj["categoryId"] = $_POST["categoryId"];
	$model->obj["date"] = $_POST["date"];
	$model->obj["notes"] = $_POST["notes"];
	$model->obj["maxVolunteer"] = $_POST["maxVolunteer"];
	$model->obj["address"] = $_POST["address"];
	$model->obj["time"] = $_POST["time"];
	$model->obj["amountSpent"] = $_POST["amountSpent"];

	if ($_POST["form-type"] == "add") {
		$model->create();
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
	}

	header('Location: programs.php?catId=' . $_POST["categoryId"]);
}


function beneficiary_submit(){
	#save records to database
	$model = beneficiary();
	$model->obj["firstName"] = $_POST["firstName"];
	$model->obj["lastName"] = $_POST["lastName"];
	$model->obj["email"] = $_POST["email"];
	$model->obj["age"] = $_POST["age"];
	$model->obj["gender"] = $_POST["gender"];
	$model->obj["contactNumber"] = $_POST["contactNumber"];
	$model->obj["address"] = $_POST["address"];
	$model->obj["barangay"] = $_POST["barangay"];
	$model->obj["city"] = $_POST["city"];
	$model->obj["content"] = $_POST["content"];
	$model->obj["status"] = "Pending";
	$model->obj["proof"] = uploadFile($_FILES["image"]);
	$model->obj["dateAdded"] = "NOW()";
	$model->create();

		header('Location: success-message.php?success=You have successfully sent your form');

}

function donation_submit(){
	#save records to database
	$model = donation();
	$model->obj["firstName"] = $_POST["firstName"];
	$model->obj["lastName"] = $_POST["lastName"];
	$model->obj["email"] = $_POST["email"];
	$model->obj["age"] = $_POST["age"];
	$model->obj["gender"] = $_POST["gender"];
	$model->obj["contactNumber"] = $_POST["contactNumber"];
	$model->obj["address"] = $_POST["address"];
	$model->obj["barangay"] = $_POST["barangay"];
	$model->obj["city"] = $_POST["city"];
	$model->obj["content"] = $_POST["content"];
	$model->obj["status"] = "Pending";
	$model->obj["proof"] = uploadFile($_FILES["image"]);
	$model->obj["isAnonymous"] = $_POST["isAnonymous"];
	$model->obj["amount"] = $_POST["amount"];
	$model->obj["dateAdded"] = "NOW()";
	$model->create();

	header('Location: success-message.php');

}


function donation_by_staff_submit(){
	#save records to database
	$model = donation();
	$model->obj["firstName"] = $_POST["firstName"];
	$model->obj["lastName"] = $_POST["lastName"];
	$model->obj["email"] = $_POST["email"];
	$model->obj["age"] = $_POST["age"];
	$model->obj["gender"] = $_POST["gender"];
	$model->obj["contactNumber"] = $_POST["contactNumber"];
	$model->obj["address"] = $_POST["address"];
	$model->obj["barangay"] = $_POST["barangay"];
	$model->obj["city"] = $_POST["city"];
	$model->obj["content"] = $_POST["content"];
	$model->obj["amount"] = $_POST["amount"];
	$model->obj["status"] = "Pending";
	$model->obj["isAnonymous"] = $_POST["isAnonymous"];
	$model->obj["dateAdded"] = "NOW()";
	$model->create();

	header('Location: donations.php');

}


function change_beneficiary_status(){
	#save records to database

	$status = $_GET["status"];
	$Id = $_GET["Id"];

	$model = beneficiary();
	$model->obj["status"] = $status;
	$model->update("Id=$Id");

	if ($status=="Approved") {
		$statusMessage = "You have successfully approved this record";
	}
	else{
		$statusMessage = "You have successfully denied this record";
	}

	header('Location: beneficiaries.php?success=' . $statusMessage);
}

function change_program_status(){
	#save records to database

	$status = $_GET["status"];
	$Id = $_GET["Id"];

	$model = program();
	$model->obj["status"] = $status;
	$model->update("Id=$Id");

	if ($status=="Approved") {
		$statusMessage = "You have successfully approved this program";
	}
	else{
		$statusMessage = "You have successfully denied this program";
	}

	header('Location: program-detail.php?Id='.$Id.'&success=' . $statusMessage);
}


function change_volunteer_status(){
	#save records to database

	$status = $_GET["status"];
	$Id = $_GET["Id"];

	$model = volunteer();
	$model->obj["status"] = $status;
	$model->update("Id=$Id");

	if ($status=="Approved") {
		$statusMessage = "You have successfully approved this record";
	}
	else{
		$statusMessage = "You have successfully denied this record";
	}

	header('Location: volunteers.php?success=' . $statusMessage);
}


function change_donation_status(){
	#save records to database

	$status = $_GET["status"];
	$Id = $_GET["Id"];

	$model = donation();
	$model->obj["status"] = $status;
	$model->update("Id=$Id");

	if ($status=="Approved") {
		$statusMessage = "You have successfully approved this record";
	}
	else{
		$statusMessage = "You have successfully denied this record";
	}

	header('Location: donations.php?success=' . $statusMessage);

}


function user_add(){

	$username = $_POST["username"];
	$checkUser = user()->count("username='$username'");

	if ($checkUser>=1) {
		header('Location: user-add.php?role='.$_POST["role"].'&error=Username Already Exists');
	}
	else{
			$model = user();
			$model->obj["username"] = $_POST["username"];
			$model->obj["firstName"] = $_POST["firstName"];
			$model->obj["role"] = $_POST["role"];
			$model->obj["phone"] = $_POST["phone"];
			$model->obj["email"] = $_POST["email"];
			$model->obj["lastName"] = $_POST["lastName"];
			$model->obj["password"] = $_POST["password"];
			$model->obj["departmentId"] = $_POST["departmentId"];
			$model->obj["dateAdded"] = "NOW()";
			$model->create();
			header('Location: accounts.php?role=' . $_POST["role"]);
	}
}

function account_save(){
	#Process to save to the database

	$model = account();
	$model->obj["username"] = $_POST["username"];
	$model->obj["firstName"] = $_POST["firstName"];
	$model->obj["lastName"] = $_POST["lastName"];
	$model->obj["role"] = $_POST["role"];

	if ($_POST["role"]=="Volunteer") {
		$model->obj["volunteerId"] = $_POST["volunteerId"];
	}

	if ($_POST["form-type"] == "add") {
		$model->obj["password"] = $_POST["password"];
		$model->create();
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
	}

	header('Location: accounts.php?role=' . $_POST["role"]);
}

function joiner_add(){
	#Process to save to the database

	$model = joiner();
	$model->obj["missionId"] = $_POST["missionId"];
	$model->obj["userId"] = $_POST["userId"];

	$model->create();

	header('Location: mission-joiners.php?missionId=' . $_POST["missionId"]);
}

function department_delete(){
	#Process to save to the database

	$Id = $_GET["Id"];
	department()->delete("Id=$Id");

	header('Location: department.php');
}



function beneficiary_save(){
	#Process to save to the database

	$model = beneficiary();
	$model->obj["name"] = $_POST["name"];
	$model->obj["description"] = $_POST["description"];

	if ($_POST["form-type"] == "add") {
		$model->create();
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
	}

	header('Location: beneficiaries.php');
}


function mission_save(){
	#Process to save to the database

	$model = mission();
	$model->obj["name"] = $_POST["name"];
	$model->obj["description"] = $_POST["description"];
	$model->obj["date"] = $_POST["date"];

	if ($_POST["form-type"] == "add") {
		$model->create();
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
	}

	header('Location: missions.php');
}


function joiner_delete(){
	#Process to save to the database

	$Id = $_GET["Id"];
	joiner()->delete("Id=$Id");

	header('Location: mission-joiners.php?missionId=' . $_GET["missionId"]);
}
