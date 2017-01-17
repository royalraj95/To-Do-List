<?php

	// adding note

require_once 'connect.php';

if(isset($_POST['name'])) {
	$name = trim($_POST['name']);
	


	if(!empty($name)) {
		$addedQuery = $db->prepare("
			INSERT INTO items (name, user, created)
			VALUES (:name, :user, NOW())
		");

		$addedQuery->execute([
			'name' => $name,
			'user' => $_SESSION['user_id']
		]);
	}

}

header('Location: index.php');

?>