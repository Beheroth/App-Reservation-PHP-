<!DOCTYPE html> 
<html lang="fr"> 
<head> 
	<meta charset="UTF-8">
</head>

<body>
<h1 class="row">Réservation</h1>

	<div class="row">

		<div>
			<h3>Prix des places:</h3>
			<ul>
				<li>Moins de 12 ans = 10€</li>
				<li>Plus de 12 ans = 15€</li>
			</ul>
		</div>
	</div>

	<form method="post" action="index.php">
	
		<div class="form">
			<label for="destination">
				Destination <input type="text" id= "destination" name="destination" value="Final"><br>
			</label>
			<label for="places">
				Nombre de places <input type="number" id="places" name="places" value="1"><br>
			</label>
		</div>
		
		<div class="form-check">
			<label>
				Assurance d'annulation -> 20€<input type="checkbox" id="insurance" name="insurance" 
				<?php if ($res != null && $res->get_insurance()) {echo 'checked';}?>>
			</label>
		</div>
		
		<div>
			<label>
				<button type="submit" class="btn btn-primary" name="">Annuler</button>
				<button type="submit" class="btn btn-primary" name="stage1">Valider</button>			
			</label>
		</div>
	
	</form>
</body>
</html>