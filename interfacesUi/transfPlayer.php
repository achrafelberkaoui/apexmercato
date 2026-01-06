<?php
require_once "header.php";
require_once "../autloading/Autloading.php";
use Bd\BaseDonne;
use ClassFinal\FinancialEngine;
use ClassFinal\TransferService;
use Heritage\Transfert;

$con = BaseDonne::database();
$players = $con->query("SELECT id,name FROM joueur")->fetchAll(PDO::FETCH_ASSOC);
$coachs = $con->query("SELECT id,name FROM coach")->fetchAll(PDO::FETCH_ASSOC);
$teams = $con->query("SELECT id,name FROM equipe")->fetchAll(PDO::FETCH_ASSOC);

$msg = "";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $type = $_POST['type'];
    $toTeam = $_POST['to_team'];
    $fromTeam = $_POST['from_team'];
    $playerId = isset($_POST['player_id']) ? (int)$_POST['player_id'] : null;
    $coachId = isset($_POST['coach_id']) ? (int)$_POST['coach_id'] : null;

    $errors = [];

    if($type === "player" && !$playerId) 
        $errors[] = "Veuillez choissier un joueur";
    if($type === "coach" && !$coachId)  
        $errors[] = "Veuillez choissier un coach";
    if($fromTeam === $toTeam) 
        $errors[] = "Veuillez choissier les equipes different";

    if(empty($errors)){
    $transfert = New Transfert($con);
    $transfert->conne($con,"transfert");
    $msg = "<p style='color:green'>Transfert ajouté avec succès !</p>";
        header("refresh:2, url=adminDash.php");
    $Data = [
        "equipeA_id" => $fromTeam,
        "equipeB_id" => $toTeam,
        "joueur_id" => $playerId,
        "coach_id" => $coachId
    ];
    $transfert->creatNew($Data);
    } else {
        foreach($errors as $e) 
        $msg .= "<p style='color:red'>$e</p>";
    }
}
?>

<div class="form-box">
    <h3>🔁 Transfert Joueur/Coach</h3>
    <?= $msg ?>
    <form method="POST">
        <label>Type de transfert :</label><br>
        <input type="radio" name="type" value="player" id="playerRadio" required>Joueur
        <input type="radio" name="type" value="coach" id="coachRadio">Coach

        <label>Équipe actuelle :</label>
        <select name="from_team" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach($teams as $t): ?>
                <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Nouvelle équipe :</label>
        <select name="to_team" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach($teams as $t): ?>
                <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <div id="playerDiv" style="display:none;">
            <label>Joueur :</label>
            <select name="player_id">
                <?php foreach($players as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="coachDiv" style="display:none;">
            <label>Coach :</label>
            <select name="coach_id">
                <?php foreach($coachs as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Effectuer le transfert</button>
    </form>
</div>

<script>
const playerRadio = document.getElementById('playerRadio');
const coachRadio  = document.getElementById('coachRadio');
const playerDiv = document.getElementById('playerDiv');
const coachDiv = document.getElementById('coachDiv');

playerRadio.addEventListener('change', ()=>{ playerDiv.style.display='block'; coachDiv.style.display='none'; });
coachRadio.addEventListener('change', ()=>{ playerDiv.style.display='none'; coachDiv.style.display='block'; });
</script>
