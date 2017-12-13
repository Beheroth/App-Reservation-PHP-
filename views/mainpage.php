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
	<table class="table table-sm" style="width 100%">
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
		$sql_reservations = Reservation::SQL_reservations();
            foreach ($sql_reservations as $res) {
                echo '<tr>';
                echo '<td class="text-xs-center">'.$res['PKreservation'].'</td>';
                echo '<td class="text-xs-center">'.$res['Destination'].'</td>';
                if ($res['Assurance']) {
                    echo '<td class="text-xs-center">
                        <i class="fa fa-check"></i>
                    </td>';
                } else {
                    echo '<td class="text-xs-center">
                        <i class="fa fa-times"></i>
                    </td>';
                }
                echo '</tr>';
            }
        ?>
		<tbody>
        </tbody>
    </table>
</div>