<div id="index-page">
    <h1 class="row">Bienvenue</h1>

    <div class="row">
        <div class="col-md-6">
            <form method="post" action="index.php" class="container">
                <button id="new-reservation" type="submit" class="btn btn-primary big" name="new">
                    Nouvelle réservation
                </button>
            </form>
        </div>
	</div>
	<table class="table table-sm">
        <thead>
            <tr>
                <th class="text-xs-center">ID</th>
                <th class="text-xs-center">Destination</th>
                <th class="text-xs-center">Assurance</th>
                <th class="text-xs-center">Modification</th>
                <th class="text-xs-center">Suppression</th>
            </tr>
        </thead>
		<tbody>
        <?php
            $reservations = Reservation::list_reservations();
            foreach ($reservations as $res) {
                echo '<tr>';
                echo '<td class="text-xs-center">'.$res['id'].'</td>';
                echo '<td class="text-xs-center">'.$res['destination'].'</td>';
                if ($res['insurance']) {
                    echo '<td class="text-xs-center">
                        <i class="fa fa-check"></i>
                    </td>';
                } else {
                    echo '<td class="text-xs-center">
                        <i class="fa fa-times"></i>
                    </td>';
                }
                echo '<td class="text-xs-center edit">
                        <form method="post" action="index.php">
                            <button type="submit" class="btn btn-warning btn-sm" name="edit" value="'.$res['id'].'">Modifier</button>
                        </form>
                      </td>';
                echo '<td class="text-xs-center delete">
                        <form method="post" action="index.php">
                            <button type="submit" class="btn btn-danger btn-sm" name="remove" value="'.$res['id'].'">Supprimer</button>
                        </form>
                      </td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>