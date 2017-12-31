<!DOCTYPE html>

<html lang="fr">
<head>

	<meta charset="UTF-8">
	<link rel="stylesheet" href="views/css/main.css">

</head>

<body>

<div id="index-page">
	<h1>Passager(s) entregistré(s)</h1>
	
	<div id="error">
		<ul>
			<?php
			if(isset($_SESSION['finish_error'])){
				$finish_error = unserialize($_SESSION['finish_error']);
				if(count($finish_error) > 0){
					echo 'ERREUR: <br>';
					foreach ($finish_error as $error) 
					{
						echo '<li>'.$error.'</li>';
					}
				}
			}
			?>
		</ul>
	</div>
	<div>
		<form method="post" action="index.php">
			<table style="width 100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Age</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$res = unserialize($_SESSION['res']);
						foreach ($res->get_passengers() as $pas) 
						{
							echo '<tr>';
							echo '<td>'.$pas->get_id().'</td>';
							echo '<td>'.$pas->get_lastname().'</td>';
							echo '<td>'.$pas->get_firstname().'</td>';
							echo '<td>'.$pas->get_age().'</td>';
							echo '<td>
							<button type="submit" name="removepas" value="'.$pas->get_id().'">Supprimer
							</button></td>';
							echo '</tr>';
						}
						echo ('Prix: '.$res->get_price().'€');
				?>
				</tbody>
			</table>
		</form>
	</div>
<div>
	<h2>Nouveau passager</h2>
	
	<div id="error">
		<ul>
			<?php
			if(isset($_SESSION['error_flags'])){
				$error_flags = unserialize($_SESSION['error_flags']);
				if(count($error_flags) > 0){
					echo 'ERREUR: <br>';
					foreach ($error_flags as $error) 
					{
						echo '<li>'.$error.'</li>';
					}
				}
			}	
			?>
		</ul>
	</div>
	
	<form method="post" action="index.php">
		Nom:<br>
		<input type="text" name="lastname" value="John"><br>
		Prénom:<br>
		<input type="text" name="firstname" value="Doe" ><br>
		Age:<br>
		<input type="number" name="age" value="22" >
		
		<button type="submit" name="register">Ajouter</button>

		<div>
			<button type="submit" name="">Annuler</button>
			<button type="submit" name="new">Retour</button>	
			<button type="submit" name="finish">Terminer</button>
		</div>
	
	</form>
</div>
</div>

</body>