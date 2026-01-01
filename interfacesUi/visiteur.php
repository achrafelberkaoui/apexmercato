
<?php
require_once "header.php";
?>

<div class="visitor-dashboard-container">

    <!-- Sidebar Navigation -->
    <aside class="visitor-sidebar">
        <h2>Visiteur</h2>
        <ul>
            <li class="visitor-active" data-page="market">Marché</li>
            <li data-page="history">Historique Transferts</li>
            <li data-page="search">Recherche</li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="visitor-main-content">

        <!-- MARCHÉ -->
        <section id="market" class="visitor-page visitor-active">
            <h3>Marché des joueurs</h3>
            <table class="visitor-table">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Rôle</th>
                        <th>Équipe actuelle</th>
                        <th>Nationalité</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DragonSlayer</td>
                        <td>Joueur</td>
                        <td>G2</td>
                        <td>France</td>
                    </tr>
                    <tr>
                        <td>LightShadow</td>
                        <td>Joueur</td>
                        <td>Karmine Corp</td>
                        <td>Allemagne</td>
                    </tr>
                    <tr>
                        <td>CoachMaster</td>
                        <td>Coach</td>
                        <td>G2</td>
                        <td>France</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- HISTORIQUE TRANSFERTS -->
        <section id="history" class="visitor-page">
            <h3>Historique Public des Transferts</h3>
            <table class="visitor-table">
                <thead>
                    <tr>
                        <th>Joueur</th>
                        <th>Équipe départ</th>
                        <th>Équipe arrivée</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DragonSlayer</td>
                        <td>G2</td>
                        <td>Karmine Corp</td>
                        <td>500 000 €</td>
                    </tr>
                    <tr>
                        <td>LightShadow</td>
                        <td>Karmine Corp</td>
                        <td>Vitality</td>
                        <td>300 000 €</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- RECHERCHE -->
        <section id="search" class="visitor-page">
            <h3>Recherche Joueur/Équipe</h3>
            <input type="text" id="visitor-searchInput" placeholder="Nom joueur ou équipe" style="padding:8px;width:250px;">
            <button onclick="visitorSearch()">Rechercher</button>

            <table class="visitor-table" id="visitor-searchTable">
                <thead>
                    <tr>
                        <th>Pseudo / Équipe</th>
                        <th>Rôle</th>
                        <th>Nationalité</th>
                        <th>Équipe actuelle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DragonSlayer</td>
                        <td>Joueur</td>
                        <td>France</td>
                        <td>G2</td>
                    </tr>
                    <tr>
                        <td>LightShadow</td>
                        <td>Joueur</td>
                        <td>Allemagne</td>
                        <td>Karmine Corp</td>
                    </tr>
                    <tr>
                        <td>CoachMaster</td>
                        <td>Coach</td>
                        <td>France</td>
                        <td>G2</td>
                    </tr>
                    <tr>
                        <td>Karmine Corp</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Vitality</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>
</div>

<script>
const visitorSidebarItems = document.querySelectorAll('.visitor-sidebar ul li');
const visitorPages = document.querySelectorAll('.visitor-page');

visitorSidebarItems.forEach(item=>{
    item.addEventListener('click',()=>{
        visitorSidebarItems.forEach(i=>i.classList.remove('visitor-active'));
        item.classList.add('visitor-active');

        const pageId = item.getAttribute('data-page');
        visitorPages.forEach(p=>{
            p.id === pageId ? p.classList.add('visitor-active') : p.classList.remove('visitor-active');
        });
    });
});

</script>

<?php
require_once "footer.php"; 
?>