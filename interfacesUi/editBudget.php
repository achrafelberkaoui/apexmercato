<?php
require_once "header.php";
require_once "../bd/baseDonne.php";
require_once "../heritage/equipe.php";
if(!isset($_GET['id'])){
    die("id manque");
};
$id = $_GET['id'];
$equipe = new equipe($con);
$team = $equipe->getById($id);
if(!$team){
    die("Equipe introuvable");
}

$errors = [];

    if($_SERVER['REQUEST_METHOD']=== 'POST'){
    if(empty(trim($_POST['budget'])) || $_POST['budget'] <= 0){
    $errors['budget'] = "Veuillez entrer le budget";
    }else{
    $budget = trim($_POST['budget']);
    }
    if(empty($erros)){
    $equipe->modifBudget($id, $budget);
        echo "<p style='color:green'>Budget Modifier avec succès</p>";
        header("refresh:2, url=adminDash.php");
    }

    }


?>

<div class="budget-form-container">

    <h2>Modifier le Budget d’une Équipe</h2>

    <form id="budgetUpdateForm" method= "POST">

        <label>Nom de l’équipe :</label>
        <input type="text" name="team_name" value="<?= htmlspecialchars($team['name']) ?>" readonly>

        <label>Budget actuel (€) :</label>
        <input type="number" name="current_budget" value="<?= htmlspecialchars($team['budget']) ?>" readonly>

        <label>Nouveau budget (€) :</label>
        <input type="number" name="budget" min="0" required>

        <button type="submit" name= "submit">Mettre à jour le budget</button>
    </form>
    <?php if(!empty($errors['budget'])): ?>
    <p style="color:red"><?= $errors['budget'] ?></p>
    <?php endif; ?>


</div>

<?php
require_once "footer.php";
?>


