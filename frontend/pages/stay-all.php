<?php include "template/header.php";?>

<!-- Hero -->
<div id="hero-principal-image" class="px-4 py-5 d-flex justify-content-center align-items-center hero-secondary hero-position">
    <div class="py-5 box-margin-left">
        <h1 class="display-5 fw-bold">Catalogue des biens</h1>
    </div>
</div>

<!-- Bloc recherche d'un bien -->
<div id="search-stay" class="box centered-text">
    <h2>Trouvez la location de vos rêves !</h2>
</div>

<!-- Bloc tous les biens -->
<div id="all-stays" class="box lightgrey-box row">
    <div class="col-md-12">
        <h2>Toutes les locations</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Location</th>
                        <th>Type de location</th>
                        <th>Capacité</th>
                        <th>Surface (m2)</th>
                        <th>Localisation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $response = file_get_contents('http://localhost:5000/bien');
                        if ($response === false) {
                            header("Location: error.php");
                        } else {
                            $biens = json_decode($response, true);
                            if (!empty($biens)) {
                                foreach ($biens as $bien) {
                                    if($bien['statut_bien'] == 1) {
                                        $icone_pmr = ($bien['PMR_ok_bien'] == 1) ? '<img src="../assets/images/pmr.png" alt="Accès PMR" title="Accès PMR" width="15px"> ' : '';
                                        $icone_animal = ($bien['animal_ok_bien'] == 1) ? '<img src="../assets/images/animal.png" alt="Pet friendly" title="Pet friendly" width="17px"> ' : '';
                                        echo '<tr>';
                                        echo '<td class="align-middle">'.$bien['nom_bien'].' '.$icone_pmr.$icone_animal.'</td>';
                                        echo '<td class="align-middle">'.$bien['type_location_bien'].'</td>';
                                        echo '<td class="align-middle">'.$bien['capacite_bien'].'</td>';
                                        echo '<td class="align-middle">'.$bien['surface_bien'].'</td>';
                                        echo '<td class="align-middle">'.$bien['ville_bien'].' ('.$bien['cp_bien'].')</td>';
                                        echo '</tr>';
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
</div>


<?php include "template/footer.php";?>