<?php


function ti_jobs_feed(){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, 'https://gocambio.com/go-cambio-jobs.php');
	$result = curl_exec($ch);
	curl_close($ch);

	$gocambio_jobs = json_decode($result);

	return $gocambio_jobs;

}

function ti_online_tefl_job_feed(){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, 'https://gocambio.com/go-cambio-online-tefl-job.php');
	$result = curl_exec($ch);
	curl_close($ch);

	$gocambio_jobs = json_decode($result);

	return $gocambio_jobs;

}