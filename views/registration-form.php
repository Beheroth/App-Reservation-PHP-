<!DOCTYPE html>

<html lang="fr">
<head>

	<meta charset="UTF-8">
	<link rel="stylesheet" href="views/css/main.css">

</head>

<body>

<div id="index-page">

	<h1>Enregistrement de passager</h1>

	<form method="post" action="index.php">
		Nom:<br>
		<input type="text" name="lastname" value="John"><br>
		Prénom:<br>
		<input type="text" name="firstname" value="Doe" ><br>
		Age:<br>
		<input type="number" name="age" value="2" >


		<div>
			<button type="submit" class="btn btn-primary" name="">Annuler</button>
			<button type="submit" class="btn btn-primary" name="new">Retour</button>
			<button type="submit" class="btn btn-primary" name="stage2">Valider</button>			
		</div>
	
	</form>

	</div>

</body>