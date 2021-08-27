<!DOCTYPE HTML>
<html>
<?php require_once "views/common/header.php"; ?>

<body class="is-preload">

    <?php require_once "views/common/navbar.php"; ?>

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <section id="main" class="wrapper">
            <div class="inner">
                <h1 class="major">Liste de tous les utilisateurs</h1>
                <!-- Table -->
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Departement</th>
                                <th>Nom</th>
                                <th>Canton</th>
                                <th>Population</th>
                                <!-- <th>Password</th> -->
                                <th>Densite</th>
                                <th>Surface</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        // $users est défini dans le controlleur, on peut l'utiliser dans la vue
                        // print_r($villes);
                        foreach ($ville as $ville)
                        //    echo $ville->surface;
                        { ?>
                            <p>La population de <?=$ville->nom ?> est de <?=$ville->population ?> personnes.</p>
                            <tr>
                                <td><?= $ville->departement?></td>
                                <td><?= $ville->nom ?></td>
                                <td><?= $ville->code_postal ?></td>
                                <td><?= $ville->canton ?></td>
                                <td><?= $ville->population ?></td>
                                <td><?= $ville->densite ?></td>
                                <td><?= $ville->surface ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </section>

    </div>

    <?php require_once "views/common/footer.php"; ?>
</body>

</html>