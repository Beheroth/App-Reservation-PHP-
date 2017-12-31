<!DOCTYPE html>

<html lang="fr">
<head>

	<meta charset="UTF-8">
	<link rel="stylesheet" href="views/css/main.css">

</head>

<body>

<div id="index-page">

	<h1>Réservation</h1>

	<div>
		<h3>Prix des places:</h3>
		
		<ul>
			<li>Moins de 12 ans = 10€</li>
			<li>Plus de 12 ans = 15€</li>
		</ul>
	</div>

	<div id="error">
		<ul>
		<?php
		if(count($error_flags) != 0)
		{	
			echo 'ERREUR: <br>';
			foreach ($error_flags as $error) 
			{
				echo '<li>'.$error.'</li>';
			}
		}
		?>
		</ul>
	</div>
	
	<div>
	<form method="post" action="index.php">
	
		<div>
			<label for="destination">
				Destination <input type="text" id= "destination" name="destination" 
				<?php
				if ($res != null) 
				{
					echo 'value="'.$res->get_destination().'"';
				}
				else 
				{
					echo 'value="default value"';
				}
				?>
				><br>
			</label>
			
			<label for="places">
				Nombre de places <input type="number" id="places" name="places" 
				<?php
				if ($res != null)
				{
					echo 'value="'.$res->get_n().'"';
				}
				else 
				{
					echo 'value="1"';
				}
				?>
				><br>
			</label>

			<label for="assurance">
				Assurance d'annulation -> 20€<input type="checkbox" id="insurance" name="insurance" 
				<?php if ($res != null && $res->get_insurance()) {echo 'checked';}?>>
			</label>
		</div>
		
		<div>
				<button type="submit" name="">Annuler</button>
				<button type="submit" name="reserve">Valider</button>			
		</div>
	
	</form>
	</div>
</body>
</html>