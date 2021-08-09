<!DOCTYPE HTML>
<html lang=pl>
<head>
	<meta charset="utf-8" />
	<title>TO-DO LIST</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
	<?php
	$errors = "";
	
	$db = mysqli_connect('localhost', 'root', '', 'todo');
	
	if (isset($_POST['submit'])){
		$task = $_POST['task'];
		if(empty($task)){
			$errors = "Musisz wpisać zadanie";
		}else {
		mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
		header('location: index.php');
		}
	}

	if (isset($_GET['del_task'])) {
		$id= $_GET['del_task'];
		mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
		header('location: index.php');
	}
	
	$tasks= mysqli_query($db, "SELECT * FROM tasks");
	
	?>
	
<body>
	<div class="logo">
		<h1>TO-DO LIST</h1>
	</div>

	<form method="POST" action="index.php">
		<?php if(isset($errors)){ ?>
			<p> <?php echo $errors; ?> </p>
		<?php } ?>
		<input type="text" name="task" class="task_input">
		<button type="submit" class="task_button" name="submit">Dodaj zadanie</button>
	</form>
	
	<table>
		<thead>
			<tr> 
				<th>Nr</th>
				<th>Zadania</th>
				<th>Usuń</th>
			</tr>
		</thead>
		
		<tbody>
		<?php $i = 1; while ($row = mysqli_fetch_array($tasks)){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td class="task"> <?php echo $row['task']; ?></td>
					<td class="delete">
						<a href="index.php?del_task=<?php echo $row['id']; ?>">x</a>
					</td>
			</tr>
		<?php $i++; } ?>	
		</tbody>
		
	</table>

</body>
</html>