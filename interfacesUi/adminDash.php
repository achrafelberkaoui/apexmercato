<?php
require_once "header.php";
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
            <h3>Gestion du Roster</h3>
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
                <tbody>
                    <tr>
                        <td>DragonSlayer</td>
                        <td>Joueur</td>
                        <td>France</td>
                        <td>
                            <button>Editer</button>
                            <button>Supprimer</button>
                        </td>
                    </tr>
                    <tr>
                        <td>CoachMaster</td>
                        <td>Coach</td>
                        <td>Allemagne</td>
                        <td>
                            <button>Editer</button>
                            <button>Supprimer</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- TEAMS -->
        <section id="teams" class="page">
            <h3>Management des Équipes</h3>
            <button onclick="alert('Ajouter une équipe')">Ajouter Équipe</button>
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
                    <tr>
                        <td>G2</td>
                        <td>5 000 000 €</td>
                        <td>Maxime</td>
                        <td>
                            <button>Editer</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Karmine Corp</td>
                        <td>3 200 000 €</td>
                        <td>Lucas</td>
                        <td>
                            <button>Editer</button>
                        </td>
                    </tr>
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