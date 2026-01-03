<?php
require_once "header.php";
require_once "../bd/baseDonne.php";
require_once "../heritage/player.php";
require_once "../heritage/coach.php";
require_once "../heritage/equipe.php";
$playerObj = new Player($con, "", "", "", "", 0, 0);
$players = $playerObj->all();

$coachObj = new Coach($con, "", "", "", "", 0, 0);
$coachs = $coachObj->all();

$equipObj = new Equipe($con);
$equips = $equipObj->all();


?>

<div class="dashboard-container">

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li class="active" data-page="roster">Roster</li>
            <li data-page="teams">Équipes</li>
            <li data-page="contracts">Contrats</li>
            <li data-page="transfers">Transferts</li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <!-- ROSTER -->
        <section id="roster" class="page active">
            <h3>PLAYERS</h3>
           <a href="ajouteJou.php" class = "btn-addJou" >Ajouter Joueur</a>
           <a href="ajouteCoach.php" class = "btn-addJou" >Ajouter Coach</a>
            <table>
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Rôle</th>
                        <th>Nationalité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody><?php foreach($players as $player): ?>
                    <tr>
                        <td><?= htmlspecialchars($player['name']) ?></td>
                        <td><?= htmlspecialchars($player['role']) ?></td>
                        <td><?= htmlspecialchars($player['nationalite']) ?></td>
                        <td>
                            <a class = "btn-addJou" href="editPlayer.php?id=<?= $player['id'] ?>">Editer</a>
                            <a class = "btn-addJou" href="deletePlayer.php?id=<?= $player['id'] ?>" onclick="return confirm('Supprimer ce joueur?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

            <!-- coach -->
                 <h3>COACHS</h3>
                <table>
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Style</th>
                        <th>Nationalité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody><?php foreach($coachs as $coach): ?>
                    <tr>
                        <td><?= htmlspecialchars($coach['name']) ?></td>
                        <td><?= htmlspecialchars($coach['style_coach']) ?></td>
                        <td><?= htmlspecialchars($coach['nationalite']) ?></td>
                        <td>
                            <a class = "btn-addJou" href="editCoach.php?id=<?= $coach['id'] ?>">Editer</a>
                            <a class = "btn-addJou" href="deleteCoach.php?id=<?= $coach['id'] ?>" onclick="return confirm('Supprimer ce coach?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </section>

        <!-- TEAMS -->
        <section id="teams" class="page">
            <h3>Management des Équipes</h3>
           <a href="ajoutEquip.php" class = "btn-addJou" >Ajouter Équipe</a>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Budget</th>
                        <th>Manager</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($equips as $equip): ?>
                    <tr>
                    

                        <td><?= htmlspecialchars($equip['name']) ?></td>
                        <td><?= htmlspecialchars($equip['budget']) . "$" ?></td>
                        <td><?= htmlspecialchars($equip['manager']) ?></td>
                        <td>
                            <a class = "btn-addJou" href="editEquipe.php?id=<?= $equip['id'] ?>">Editer</a>
                            <a class = "btn-addJou" href="editBudget.php?id=<?= $equip['id'] ?>">Modifier Budget</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- CONTRACTS -->
        <section id="contracts" class="page">
            <h3>Contrôle Contractuel</h3>
            <button onclick="alert('Créer un contrat')">Créer Contrat</button>
            <table>
                <thead>
                    <tr>
                        <th>Joueur/Coach</th>
                        <th>Salaire</th>
                        <th>Clause de rachat</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DragonSlayer</td>
                        <td>120 000 € / an</td>
                        <td>500 000 €</td>
                        <td>01/01/2025</td>
                        <td>31/12/2025</td>
                        <td>
                            <button>Editer</button>
                            <button>Supprimer</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- TRANSFERS -->
        <section id="transfers" class="page">
            <h3>Exécution des Transferts</h3>
            <button onclick="alert('Lancer transfert')">Nouveau Transfert</button>
            <table>
                <thead>
                    <tr>
                        <th>Joueur</th>
                        <th>Équipe départ</th>
                        <th>Équipe arrivée</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DragonSlayer</td>
                        <td>G2</td>
                        <td>Karmine Corp</td>
                        <td>500 000 €</td>
                        <td>Confirmé</td>
                        <td>
                            <button>Voir</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>
</div>

<script>
const sidebarItems = document.querySelectorAll('.sidebar ul li');
const pages = document.querySelectorAll('.page');

sidebarItems.forEach(item=>{
    item.addEventListener('click',()=>{
        // sidebar active
        sidebarItems.forEach(i=>i.classList.remove('active'));
        item.classList.add('active');

        // show page
        const pageId = item.getAttribute('data-page');
        pages.forEach(p=>{
            p.id === pageId ? p.classList.add('active') : p.classList.remove('active');
        });
    });
});
</script>

<?php
require_once "footer.php";
?>