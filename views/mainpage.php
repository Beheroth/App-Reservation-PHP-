<!DOCTYPE html> 

<html lang="fr">
<head>

	<meta charset="UTF-8">
	<link rel="stylesheet" href="views/css/main.css">

</head>

<body>

<div id="index-page">
	
    <h1>Bienvenue</h1>
	<form method="post" action="index.php">
    <div>

		<button id="new-reservation" type="submit" name="new">
			Nouvelle réservation
		</button>

	</div>
	
	<div>
	
		<table style="width 100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Destination</th>
					<th>Prix</th>
					<th>Assurance</th>
					<th>Modification</th>
					<th>Suppression</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql_reservations = Reservation::SQL_reservations();
					foreach ($sql_reservations as $res) {
						echo '<tr>';
						echo '<td>'.$res['PKreservation'].'</td>';
						echo '<td>'.$res['Destination'].'</td>';
						echo '<td>'.$res['Prix'].'</td>';
						echo '<td>'.$res['Assurance'].'</td>';
						echo '<td>
						<button id="modify" type="submit" name="modify" value="'.$res['PKreservation'].'">Modifier
						</button>';
						echo '<td>
						<button id="remove" type="submit" name="remove" value="'.$res['PKreservation'].'">Supprimer
						</button>';
						echo '</tr>';
					}
			?>
			
			</tbody>
		</table>
		
	</div>
	</form>
</div>
</body>
</html>