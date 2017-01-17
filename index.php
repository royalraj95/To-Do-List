<?php

	require_once 'connect.php';

	$itemsQuery = $db->prepare("
		SELECT id, name
		FROM items
		WHERE user = :user
	");

	$itemsQuery->execute([
		'user' => $_SESSION['user_id']
	]);

	$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>


<!DOCTYPE html>
<html lang="en">
<link rel = "stylesheet" href = "stylesheet.css">
	<head>
		<title>To do list Program</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
<h1>
	To-Do List
</h1>

<body>
	<div class = "wrapbox">
	<div class="list">
	
			<?php if(!empty($items)): ?>
			<ul class="items">
				<?php foreach($items as $item): ?>
				<li>
					<?php echo ($item['name']); ?>
					<a class="delete-button" href="delete.php?as=delete&item=<?php echo $item['id']; ?>">Delete</a>
					
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
			<?php else: ?>
				<p>You haven't added any items yet.</p>
			<?php endif; ?>

			<form class="item-add" action="additem.php" method="POST">
				<input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" maxlength="30" required>
				<input type="submit" value="Add" class="submit">
			</form>

		</div>

	</body>

</html>