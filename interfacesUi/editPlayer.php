<?php
require_once "header.php";
require_once "../autloading/Autloading.php";
use Bd\BaseDonne;
use Heritage\Player;


$con = BaseDonne::database();
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID joueur manquant");
}

$id = intval($_GET['id']);
$getPlayer = new Player($con,"", "", "", "", 0, 0);
$Player = $getPlayer->getById($id);

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $name = $_POST['pseudo'];
    $nationality = $_POST['nationality'];
    $role = $_POST['role'];
    $value = $_POST['value'];
    $id_equip = $_POST['id_equip'];
    $data = [
        "name" => $name,
        "nationalite" => $nationality,
        "role" => $role,
        "valeur_marches" => $value,
        "equipe_id" => $id_equip
    ];
    $getPlayer->update($id, $data);
        echo "<p style='color:green'>Joueur Modifier avec succès</p>";
        header("refresh:2, url=adminDash.php");
    }
?>

<div class="player-edit-container">

    <h2>Modifier un Joueur</h2>

    <form id="playerEditForm" method = "POST">

        <label>Pseudo :</label>
        <input type="text" name="pseudo" value="<?= htmlspecialchars($Player['name']) ?>" required>

        <label>Rôle :</label>
        <select name="role" value="<?= htmlspecialchars($Player['role']) ?>" required >
            <option>Top</option>
            <option>Jungle</option>
            <option>Mid</option>
            <option>ADC</option>
            <option>Support</option>
        </select>

        <label>Nationalité :</label>
        <input type="text" name="nationality" value="<?= htmlspecialchars($Player['nationalite']) ?>" required>

        <label>Valeur Marchande (€) :</label>
        <input type="number" name="value" value="<?= htmlspecialchars($Player['valeur_marches']) ?>" required>

        <label>Id Equipe :</label>
        <input type="number" value="<?= htmlspecialchars($Player['equipe_id']) ?>" name="id_equip" required>

        <button type="submit">Mettre à jour le joueur</button>
    </form>

</div>

<?php
require_once "footer.php";
?>



