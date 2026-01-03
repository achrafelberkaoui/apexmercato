<?php
require_once "header.php";
require_once "../bd/baseDonne.php";
require_once "../trait/CRUD.php";
require_once "../heritage/equipe.php";

$errors = [];
if($_SERVER['REQUEST_METHOD']==="POST"){
    
if(empty(trim($_POST['team_name']))){
    $errors['team_name'] = "Veuillez entrer name de l'equipe";
}else{
    $team_name = trim($_POST['team_name']);
}
if(empty(trim($_POST['budget'])) || $_POST['budget'] <= 0){
    $errors['budget'] = "Veuillez entrer le budget";
}else{
    $budget = trim($_POST['budget']);
}

if(empty(trim($_POST['manager']))){
    $errors['manager'] = "Veuillez entrer la manager de l'Equipe";
}else{
    $manager = trim($_POST['manager']);
};

if(!empty($errors)){
    foreach ($errors as $err) {
        echo "<p style='color:red'>$err</p>";
    }
        echo "<p style='color:green'>Équipe ajoutée avec succès</p>";
        header("refresh:2, url=adminDash.php");
    exit;
}else{
    $equipe = New equipe($con);
    $equipe->conne($con,"equipe");

    $Data = [
        "name" => $team_name,
        "manager" => $manager,
        "budget" => $budget
    ];
    $equipe->creatNew($Data);
    echo "<p style='color:green'>Équipe ajoutée avec succès</p>";
    header("refresh:2, url=adminDash.php");
}
}

?>

<div class="team-form-container">

    <h2>Ajouter une Équipe</h2>

    <form id="teamAddForm" method = "POST">

        <label>Nom de l'équipe :</label>
        <input type="text" name="team_name" required>

        <label>Budget (€) :</label>
        <input type="number" name="budget" min="0" required>

        <label>Manager :</label>
        <input type="text" name="manager" required>

        <button type="submit" name="submit">Enregistrer l’équipe</button>
    </form>

</div>

<?php
require_once "footer.php";
?>

