<?php
require_once "header.php";
?>

<div class="form-container">
    <h2>Ajouter un Coach</h2>
    <form id="addCoachForm">
        <label>Nom :</label>
        <input type="text" name="name" required>

        <label>Style de Coaching :</label>
        <input type="text" name="style" required>

        <label>Années d'expérience :</label>
        <input type="number" name="experience" required>

        <label>Nationalité :</label>
        <input type="text" name="nationality" required>

        <button type="submit">Ajouter Coach</button>
    </form>
</div>

<?php
require_once "footer.php";
?>