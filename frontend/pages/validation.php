<?php 
//session_start();
//require "conf.inc.php";
//require "core/functions.php";
?>
<?php include "template/header.php";?>

<!-- Hero -->
<div id="hero-principal-image" class="px-4 py-5 d-flex justify-content-center align-items-center hero-secondary hero-position">
    <div class="py-5 box-margin-left">
        <h1 class="display-5 fw-bold">Demandes en attente</h1>
    </div>
</div>

<!-- Bloc biens en attente de validation -->
<div id="search-stay" class="box centered-text">
    <h2>Biens en attente de validation</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Location</th>
                    <th>Type de location</th>
                    <th>Capacité</th>
                    <th>Surface (m2)</th>
                    <th>Localisation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $response = file_get_contents('http://localhost:5000/bien');
                    if ($response === false) {
                        header("Location: error.php");
                    } else {
                        $stays = json_decode($response, true);
                        if (!empty($stays)) {
                            foreach ($stays as $stay) {
                                if($stay['statut_bien'] == 0) {
                                    $icon_pmr = ($stay['PMR_ok_bien'] == 1) ? '<img src="../assets/images/pmr.png" alt="Accès PMR" title="Accès PMR" width="15px"> ' : '';
                                    $icon_pet = ($stay['animal_ok_bien'] == 1) ? '<img src="../assets/images/animal.png" alt="Pet friendly" title="Pet friendly" width="18px"> ' : '';
                                    echo '<tr>';
                                    echo '<td class="align-middle">'.$stay['nom_bien'].' '.$icon_pmr.$icon_pet.'</td>';
                                    echo '<td class="align-middle">'.$stay['type_location_bien'].'</td>';
                                    echo '<td class="align-middle">'.$stay['capacite_bien'].'</td>';
                                    echo '<td class="align-middle">'.$stay['surface_bien'].'</td>';
                                    echo '<td class="align-middle">'.$stay['ville_bien'].' ('.$stay['cp_bien'].')</td>';
                                    echo '<td class="align-middle"><button class="btn btn-dark btn-hover-brown" type="button">Consulter</button>';
                                }
                            }
                        } else {
                            echo '<tr><td colspan="5">Aucune location trouvée.</td></tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "template/footer.php";?>