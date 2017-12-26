<!DOCTYPE html> 

<html lang="fr">
<head>

	<meta charset="UTF-8">
	<link rel="stylesheet" href="views/css/main.css">

</head>

<body>

<div id="index-page">
	
    <h1>Bienvenue</h1>

    <div>
		<form method="post" action="index.php">
			<button id="new-reservation" type="submit" class="btn btn-primary big" name="new">
				Nouvelle réservation
			</button>
		</form>
	</div>
	
	<div>
	
		<table class="table table-sm" style="width 100%">
			<thead>
				<tr>
					<th class="text-xs-center">ID</th>
					<th class="text-xs-center">Destination</th>
					<th class="text-xs-center">Prix</th>
					<th class="text-xs-center">Assurance</th>
					<th class="text-xs-center">Modification</th>
					<th class="text-xs-center">Suppression</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql_reservations = Reservation::SQL_reservations();
					foreach ($sql_reservations as $res) {
						echo '<tr>';
						echo '<td class="text-xs-center">'.$res['PKreservation'].'</td>';
						echo '<td class="text-xs-center">'.$res['Destination'].'</td>';
						echo '<td class="text-xs-center">'.$res['Prix'].'</td>';
						echo '<td class="text-xs-center">'.$res['Assurance'].'</td>';
						echo '<td class="text-xs-center">
						<button id="modify" type="submit" class="btn btn-primary big" name="modify">Modifier
						</button>';
						echo '<td class="text-xs-center">
						<button id="delete" type="submit" class="btn btn-primary big" name="delete">Supprimer
						</button>';
						echo '</tr>';
					}
			?>
			
			</tbody>
		</table>
		
	</div>
</div>
</body>
</html>