<?php
require_once "header.php";
?>
<!-- dashboard-journaliste.php -->
<?php
// header.php déjà inclus
?>

<!-- dashboard-journaliste.php -->
<?php
// header.php déjà inclus
?>

<div class="journal-dashboard-container">

    <!-- Sidebar Navigation -->
    <aside class="journal-sidebar">
        <h2>Journaliste Dashboard</h2>
        <ul>
            <li class="journal-active" data-page="market">Marché</li>
            <li data-page="compare">Comparaison</li>
            <li data-page="news">Flux Privé</li>
            <li data-page="filter">Filtrer Joueurs</li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="journal-main-content">

        <!-- MARCHÉ -->
        <section id="market" class="journal-page journal-active">
            <h3>Suivi Avancé du Mercato</h3>
            <table class="journal-table">
                <thead>
                    <tr>
                        <th>Joueur</th>
                        <th>Équipe actuelle</th>
                        <th>Clause de rachat</th>
                        <th>Salaire</th>
                        <th>Transfert</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DragonSlayer</td>
                        <td>G2</td>
                        <td>500 000 €</td>
                        <td>120 000 € / an</td>
                        <td>Confirmé</td>
                    </tr>
                    <tr>
                        <td>LightShadow</td>
                        <td>Karmine Corp</td>
                        <td>300 000 €</td>
                        <td>90 000 € / an</td>
                        <td>En attente</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- COMPARAISON -->
        <section id="compare" class="journal-page">
            <h3>Comparaison des Coûts Annuels</h3>
            <table class="journal-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Rôle</th>
                        <th>Coût Annuel</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DragonSlayer</td>
                        <td>Joueur</td>
                        <td>120 000 € + bonus</td>
                    </tr>
                    <tr>
                        <td>CoachMaster</td>
                        <td>Coach</td>
                        <td>80 000 €</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- FLUX DE NEWS -->
        <section id="news" class="journal-page">
            <h3>Flux Privé de News</h3>
            <ul class="journal-news-feed">
                <li>[2025-01-10] DragonSlayer transféré de G2 vers Karmine Corp</li>
                <li>[2025-01-08] Nouveau contrat signé par CoachMaster</li>
                <li>[2025-01-05] Valeur marchande de LightShadow augmentée de 10%</li>
            </ul>
        </section>

        <!-- FILTRE DYNAMIQUE -->
        <section id="filter" class="journal-page">
            <h3>Filtrer Joueurs par Valeur Marchande</h3>
            <input type="number" id="journal-minValue" placeholder="Valeur minimale (€)" style="padding:8px;width:200px;">
            <button onclick="journalFilterPlayers()">Filtrer</button>
            <table class="journal-table" id="journal-playerTable">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Équipe</th>
                        <th>Valeur Marchande</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DragonSlayer</td>
                        <td>G2</td>
                        <td>500000</td>
                    </tr>
                    <tr>
                        <td>LightShadow</td>
                        <td>Karmine Corp</td>
                        <td>300000</td>
                    </tr>
                    <tr>
                        <td>StarBlade</td>
                        <td>Vitality</td>
                        <td>700000</td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>
</div>

<script>
const journalSidebarItems = document.querySelectorAll('.journal-sidebar ul li');
const journalPages = document.querySelectorAll('.journal-page');

journalSidebarItems.forEach(item=>{
    item.addEventListener('click',()=>{
        journalSidebarItems.forEach(i=>i.classList.remove('journal-active'));
        item.classList.add('journal-active');

        const pageId = item.getAttribute('data-page');
        journalPages.forEach(p=>{
            p.id === pageId ? p.classList.add('journal-active') : p.classList.remove('journal-active');
        });
    });
});

</script>

<?php
require_once "footer.php";
?>