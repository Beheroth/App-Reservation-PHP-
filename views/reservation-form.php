<h1 class="row">Réservation</h1>

	<div class="row">

		<div>
			<h3>Prix des places:</h3>
			<ul>
				<li>Moins de 12 ans = 10€</li>
				<li>Plus de 12 ans = 15€</li>
			</ul>
			Assurance annullation = 20 € peu importe le nombre de voyageurs.
		</div>
	</div>

	<form method="post" action="index.php">
	
		<div class="form">
			<label for="places">Nombre de places</label>
			<input type="number" id="places" name="places">
		</div>
		
		<div class="form-check">
			<label><input type="checkbox" id="insurance" name="insurance">Assurance</label>
		</div>
		
		<div>
			<label>
				<button type="submit" class="btn btn-primary" name="">Annuler</button>
				<button type="submit" class="btn btn-primary" name="stage1">Valider</button>			
			</label>
		</div>
	
	</form>
	

