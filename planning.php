<section class="container">
    <div class="app-content">
        <div class="plans-section">
            <div class="plans-section-header">
                <p>Planning</p>
                <p class="time"><?php echo $date=Date('Y-m-d');?></p>
            </div>

            <div class="plan-boxes jsGridView">
                <?php  
                $q = "SELECT activite.nomActivite, reservation.dateChoisi, horaires.heureDebut, horaires.heureFin, reservation.nbParticipants, user.entreprise 
                FROM reservation 
                INNER JOIN horaires ON reservation.idHorRes = horaires.idHoraires

                INNER JOIN horaireReserve ON horaireReserve.idReserve = reservation.idReserve
                INNER JOIN activiteReserve ON activiteReserve.idReserve = reservation.idReserve
                INNER JOIN activite ON activite.idActivite = activiteReserve.idActivite
                INNER JOIN user ON user.idUser = reservation.idUser
                ORDER BY reservation.dateChoisi ASC, horaires.heureDebut ASC";
                $res = $db->query($q);

                var_dump($q);

                //INNER JOIN salle ON horaires.idSalle = salle.idSalle
                //salle.numSalle,

                $currentDate = null;
                while ($row = $res->fetch()) {
                    if ($currentDate !== $row['dateChoisi']) {
                        $currentDate = $row['dateChoisi'];
                        echo '<div class="plans-section-date">';
                        echo '<p class="plans-section-date-header">' . $currentDate . '</p>';
                        echo '</div>';
                    }
                    ?>
                    <div class="plan-box-wrapper">
                        <div class="plan-box" style="background-color: #e9e7fd;">
                            <div class="plan-box-header">
                                <div class="more-wrapper">
                                </div>
                            </div>
                            <div class="plan-box-content-header">
                                <h4 class="box-content-header"><?php echo $row['nomActivite']; ?></h4>
                                <p class="box-content-subheader"><?php echo $row['heureDebut'] . " - " . $row['heureFin']; ?></p>
                                <!--<p  class="box-content-subheader"><?php// echo "Salle " . $row['numSalle']; ?></p>-->
                                <p class="box-content-subheader"><?php echo $row['nbParticipants'] . " participants"; ?></p>
                                <p class="box-content-subheader"><?php echo "Réservé par " . $row['entreprise']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>