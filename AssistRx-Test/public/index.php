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


	if ($action == 'home'){

		$_SESSION['set_var'] = 0;

		$data = $paginator->get_patients();

		$view_model->get_view('../views/header.php');
		$view_model->get_view('../views/patients.php', $data);
		$view_model->get_view('../views/footer.php');
	}
	elseif ($action == 'report'){

		// $$patient_model->list_all();
		// $data['song_data'] = $patient_model->patient_song($data->patient_id);

		$view_model->get_view('../views/header.php');
		$view_model->get_view('../views/report.php', $patient_model);
		$view_model->get_view('../views/footer.php');
	}
	elseif ($action == 'assign_song'){

		// what should you do if there is no patient_id set??
		// something... hopefully.
		$patient_id = $_GET['patient_id'];


		$patient = $patient_model->get_by_id($patient_id);

		$view_model->get_view('../views/header.php');
		$view_model->get_view('../views/songs.php', $patient);
		$view_model->get_view('../views/footer.php');
	}
	elseif ($action == 'next'){

		$data = NULL;
		$data = $paginator->next();

		// var_dump($data);
		$view_model->get_view('../views/query_template.php', $data);

	}
	elseif ($action == 'back'){

		$data = NULL;

		$data = $paginator->back();

		$view_model->get_view('../views/query_template.php', $data);

	}

	elseif($action == 'ajax_controller'){
		require '../controller/ajax_controller.php';
	}

	else {
		echo 'the page you were looking for does not exist';
	}