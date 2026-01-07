<?php
session_start();
require_once "header.php";
require_once "../autloading/Autloading.php";
use Heritage\Coach;
use Heritage\Player;
use Heritage\Equipe;
use ReadonlyContrat\Contract;
use Bd\BaseDonne;

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: interfaceLogin.php");
    exit;
}

$con = BaseDonne::database();
$playerObj = new Player($con, "", "", "", "", 0, 0);
$players = $playerObj->all();

$coachObj = new Coach($con, "", "", "", "", 0, 0);
$coachs = $coachObj->all();

$teamObj = new Equipe($con,"","",0);
$teams = $teamObj->all();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $type = $_POST['type'];
    $date = $_POST['date_contrat'];
    $equipe_id = $_POST['equipe_id'] ?? null;

    
    $errors = [];

    if($type === 'player'){
        if(!$equipe_id)
        $errors[] = "Veuillez sélectionner une équipe";
        $joueur_id = $_POST['joueur_id'];
        $coach_id = null;
        if(!$joueur_id) 
        $errors[] = "Veuillez sélectionner un joueur";
    } elseif($type === 'coach'){
        $coach_id = $_POST['coach_id'];
        $joueur_id = null;
        if(!$coach_id) 
        $errors[] = "Veuillez sélectionner un coach";

    } else {
        $errors[] = "Veuillez choisir le type de contrat";
    }

    if(empty($date)) $errors[] = "Veuillez sélectionner la date du contrat";

    if(empty($errors)){
        $contract = new Contract($con, $joueur_id,$equipe_id, $coach_id,date("y-m-d"), null);
        $contract->save();
        echo "<p style='color:green'>Contrat ajouté avec succès</p>";
        header("refresh:2, url=adminDash.php");
        exit;
    } else {
        foreach($errors as $err){
            echo "<p style='color:red'>$err</p>";
        }
    }
}
?>

<div class="contract-form-container">
    <h2>Ajouter un Contrat</h2>

    <form method="POST">

            <label>Choisir équipe :</label>
        <select name="equipe_id" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach($teams as $team): ?>
                <option value="<?= $team['id'] ?>">
                    <?= htmlspecialchars($team['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>
            <input type="radio" name="type" value="player" id="typePlayer" required> Contrat Joueur
        </label>

        <label>
            <input type="radio" name="type" value="coach" id="typeCoach" required> Contrat Coach
        </label>

        <div id="playerSelect" style="display:none;">
            <label>Choisir Joueur :</label>
            <select name="joueur_id">
                <?php foreach($players as $player): ?>
                    <option value="<?= $player['id'] ?>"><?= htmlspecialchars($player['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="coachSelect" style="display:none;">
            <label>Choisir Coach :</label>
            <select name="coach_id">
                <?php foreach($coachs as $coach): ?>
                    <option value="<?= $coach['id'] ?>"><?= htmlspecialchars($coach['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <label>Date du contrat :</label>
        <input type="date" name="date_contrat" required>

        <button type="submit">Ajouter Contrat</button>
    </form>
</div>

<script>
const typePlayer = document.getElementById('typePlayer');
const typeCoach = document.getElementById('typeCoach');
const playerSelectDiv = document.getElementById('playerSelect');
const coachSelectDiv = document.getElementById('coachSelect');

typePlayer.addEventListener('change', () => {
    playerSelectDiv.style.display = 'block';
    coachSelectDiv.style.display = 'none';
});

typeCoach.addEventListener('change', () => {
    playerSelectDiv.style.display = 'none';
    coachSelectDiv.style.display = 'block';
});
</script>

<?php require_once "footer.php"; ?>
