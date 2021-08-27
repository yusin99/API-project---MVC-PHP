<!DOCTYPE HTML>
<html>
<?php require_once "views/common/header.php";?>
<?php

require_once "models/VillesManager.class.php";
if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $code_postal = htmlspecialchars($_POST['code_postal']);
    $name = htmlspecialchars($_POST['nom']);
    $densite = (int) $_POST['densite'];
    $departement = htmlspecialchars($_POST['departement']);
    $surface = htmlspecialchars($_POST['surface']);
    $population = htmlspecialchars($_POST['population']);
    $canton = htmlspecialchars($_POST['canton']);
    $url = 'http://localhost/apiPHP/apiv2/api/ville/' . $code_postal . '/update' . '/' . $id;
    $data_array = [
        'id' => $id,
        'departement' => $departement,
        'nom' => $name,
        'code_postal' => $code_postal,
        'canton' => $canton,
        'densite' => $densite,
        'population' => $population,
        'surface' => $surface,
    ];
    $manager = new VillesManager();
    $manager->curlCall($url,$data_array);
}
?>

<body class="is-preload">

    <?php require_once "views/common/navbar.php";?>

    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Main -->
        <section id="main" class="wrapper">
            <div class="inner">
                <h1 class="major">Liste de tous les villes avec code postal <?=$code_postal?></h1>
                <!-- Table -->

                <?php
foreach ($town_update as $town) {
    ?>
                <form action="" method="POST">
                    <label for="">N°ID</label>
                    <input type="text" name='id' value='<?=$town->id?>' readonly>
                    <label for="">Departement</label>
                    <input type="text" name='departement' value="<?=$town->departement?>">
                    <label for="">Nom de la ville</label>
                    <input type="text" name='nom' value="<?=$town->nom?>">
                    <label for="">code_postal</label>
                    <input type="text" name='code_postal' value="<?=$town->code_postal?>">
                    <label for="">Canton</label>
                    <input type="text" name='canton' value='<?=$town->canton?>'>
                    <label for="">Population</label>
                    <input type="text" name='population' value='<?=$town->population?>'>
                    <label for="">Densite</label>
                    <input type="text" name='densite' value='<?=$town->densite?>'>
                    <label for="">Surface</label>
                    <input type="text" name='surface' value='<?=$town->surface?>'>
                    <input type="submit" name='modifier' value="Modifier">
                </form>
                <?php }?>

            </div>
        </section>

    </div>

    <?php require_once "views/common/footer.php";?>
</body>

</html>