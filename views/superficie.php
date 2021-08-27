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
                                <th>Densite</th>
                                <th>Surface</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        foreach ($town as $town)
                        { ?>
                            <tr>
                                <td><?= $town->departement?></td>
                                <td><?= $town->nom ?></td>
                                <td><?= $town->code_postal ?></td>
                                <td><?= $town->canton ?></td>
                                <td><?= $town->population ?></td>
                                <td><?= $town->densite ?></td>
                                <td><?= $town->surface ?></td>
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