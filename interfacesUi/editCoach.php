<?php
session_start();
require_once "header.php";
require_once "../autloading/Autloading.php";
use Bd\BaseDonne;
use Heritage\Coach;


if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: interfaceLogin.php");
    exit;
}

$con = BaseDonne::database();
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID coach manquant");
}

$id = intval($_GET['id']);
$getcoach = new Coach($con,"", "", "", "", 0, 0);
$Coach = $getcoach->getById($id);

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $name = $_POST['name'];
    $nationality = $_POST['nationality'];
    $style = $_POST['style'];
    $experience = $_POST['experience'];
    $id_equip = $_POST['id_equip'];
    $data = [
        "name" => $name,
        "nationalite" => $nationality,
        "style_coach" => $style,
        "annee_Experience" => $experience,
        "equipe_id" => $id_equip
    ];
    $getcoach->update($id, $data);
        echo "<p style='color:green'>Coach Modifier avec succès</p>";
        header("refresh:2, url=adminDash.php");
    }
?>

<div class="coach-edit-container">

    <h2>Modifier un Coach</h2>

    <form id="coachEditForm" method = "POST">

        <label>Nom :</label>
        <input type="text" name="name" value="<?= htmlspecialchars($Coach['name']) ?>" required>

        <label>Style de coaching :</label>
        <input type="text" name="style" value="<?= htmlspecialchars($Coach['style_coach']) ?>" required>

        <label>Années d’expérience :</label>
        <input type="number" name="experience" value="<?=$Coach['annee_Experience']?>" min="0" required>

        <label>Nationalité :</label>
        <input type="text" name="nationality" value="<?= htmlspecialchars($Coach['nationalite']) ?>" required>

       <label>Id Equipe :</label>
        <input type="number" value="<?= htmlspecialchars($Coach['equipe_id']) ?>" name="id_equip" required>

        <button type="submit">Mettre à jour le coach</button>
    </form>

</div>


<?php
require_once "footer.php";
?>



