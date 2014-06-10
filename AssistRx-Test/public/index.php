<?php

	// includes
	include '../models/view_model.php';
	include '../models/patient_model.php';
	include '../models/paginator_model.php';

	// start session
	session_start();

	/*
	*
	*Conditional to chek for action in the url then sets action variable
	*/
	if (empty($_GET['action'])){
		$action = 'home';
	}
	else {
		$action = $_GET['action'];
	}

	// declaring models
	$paginator = new Paginator_Model();
	$view_model = new View_Model();
	$patient_model = new patient_model();

	/*
		this is the home action
		home takes us to the patients landing page
	*/
	if ($action == 'home'){
		// setting session variable here for pagination control functionality
		// because ph forgets everything once a page loads i needed a session var to hold the pagination counter
		$_SESSION['set_var'] = 0;

		//RUnning the pagination model here
		$data = $paginator->get_patients();

		//Running viewmodel and spitting out a the views
		$view_model->get_view('../views/header.php');
		$view_model->get_view('../views/patients.php', $data);
		$view_model->get_view('../views/footer.php');
	}

	/*
		this is the Report action
		Report takes us to the reports page
	*/
	elseif ($action == 'report'){

		//Running viewmodel and spitting out a the views
		$view_model->get_view('../views/header.php');
		$view_model->get_view('../views/report.php', $patient_model);
		$view_model->get_view('../views/footer.php');
	}

	/*
		Assign song takes us to the song page
		and grabs all of the song data if its there and spits it back to the browser
	*/
	elseif ($action == 'assign_song'){

		// what should you do if there is no patient_id set??
		// something... hopefully.

		// So i saw this and was not really sure what you meant here. The patient_id will always be set
		// because of the way that I have build this. There will never be a time that the id is not set.
		// not really sure if this is the most accurate thing but its how i got it to work so lol...

		// grabing the patient id from get variable
		$patient_id = $_GET['patient_id'];

		// passing patient id to get the patient id fro the database
		$patient = $patient_model->get_by_id($patient_id);

		//Running viewmodel and spitting out a the views
		$view_model->get_view('../views/header.php');
		$view_model->get_view('../views/songs.php', $patient);
		$view_model->get_view('../views/footer.php');
	}
	/*
		the next action is used for pagination. This paginates right
	*/
	elseif ($action == 'next'){

		// resseting the data variable to prevent bleedthrough data
		$data = NULL;
		// running hte paginator next function to push the page right and reset pagination values
		$data = $paginator->next();

		//Running viewmodel and spitting out a the views
		$view_model->get_view('../views/query_template.php', $data);

	}
	/*
		The back action is the same as next but in reverse order. It paginates us left
	*/
	elseif ($action == 'back'){
		// resseting the data variable to prevent bleedthrough data
		$data = NULL;
		// running hte paginator back function to push the page left and reset pagination values
		$data = $paginator->back();
		//Running viewmodel and spitting out a the views
		$view_model->get_view('../views/query_template.php', $data);

	}
	/*
		ajax controller action All ajax comes through here and is sent to the ajax controller
	*/
	elseif($action == 'ajax_controller'){
		require '../controller/ajax_controller.php';
	}
	/*
		this is where you would put your 404 page ifyou had one
	*/
	else {
		$view_model->get_view('../views/404.php');
	}