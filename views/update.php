<!DOCTYPE HTML>
<html>
<?php require_once "views/common/header.php";?>
<?php

require_once "models/VillesManager.class.php";
if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $departement = htmlspecialchars($_POST['departement']);
    $nom = htmlspecialchars($_POST['nom']);
    $zip = htmlspecialchars($_POST['zip']);
    $canton = htmlspecialchars($_POST['canton']);
    $densite = (int) $_POST['densite'];
    $population = htmlspecialchars($_POST['population']);
    $surface = htmlspecialchars($_POST['surface']);
    // echo $surface, $population, $departement, $id, $canton;
    
    $url = 'http://localhost/apiPHP/apiv2/api/ville/' . $zip . '/update' . '/' . $id;
    $data_array = array(
        'id' => $id,
        'departement' => $departement,
        'nom' => $nom,
        'code_postal' => $code_postal,
        'canton' => $canton,
        'densite' => $densite,
        'population' => $population,
        'surface' => $surface,
    );
    $manager = new VillesManager();
    $manager->curlCall($url,$data_array);


    // $url = "https://reqbin.com/echo/post/json";


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
foreach ($villesU as $ville) {
    ?>
                <form action="" method="POST">
                    <label for="">N°ID</label>
                    <input type="text" name='id' value='<?=$ville->id?>' readonly>
                    <label for="">Departement</label>
                    <input type="text" name='departement' value="<?=$ville->departement?>">
                    <label for="">Nom de la ville</label>
                    <input type="text" name='nom' value="<?=$ville->nom?>">
                    <label for="">Code postal</label>
                    <input type="text" name='zip' value="<?=$ville->code_postal?>">
                    <label for="">Canton</label>
                    <input type="text" name='canton' value='<?=$ville->canton?>'>
                    <label for="">Population</label>
                    <input type="text" name='population' value='<?=$ville->population?>'>
                    <label for="">Densite</label>
                    <input type="number" name='densite' value='<?=$ville->densite?>'>
                    <label for="">Surface</label>
                    <input type="number" name='surface' value='<?=$ville->surface?>'>
                    <input type="submit" name='modifier' value="Modifier">
                </form>
                <?php }?>

            </div>
        </section>

    </div>

    <?php require_once "views/common/footer.php";?>
</body>

</html>