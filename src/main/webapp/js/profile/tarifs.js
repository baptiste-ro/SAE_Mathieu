import { show_stat_page } from "./admin.js";

// Quand la page est entièrement chargée, on exécute la fonction
document.addEventListener('DOMContentLoaded', () => {
  show_stat_page();
  const loaded_id = localStorage.getItem('loaded_id') || -1;

  // On récupère les éléments HTML où l'on va injecter du contenu
  const results_container_tarifs = document.querySelector('#results-container-tarifs');
  const liste_container = document.querySelector('#liste_container');

  // On ajoute un "listener" sur le select existant
  if (liste_container) {
    if (loaded_id > 0) {
      loadTarifs(loaded_id);
    }
    liste_container.addEventListener('change', (event) => {
      const selectedId = event.target.value;
      if (selectedId) {
        loadTarifs(selectedId);
      }
    });
  }

  // Fonction qui va chercher les tarifs d'une traversée sélectionnée
  function loadTarifs(idTraversee) {
    fetch('resultsHandler_tarifs.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'text/plain'
      },
      body: idTraversee
    })
      .then(response => {
        if (!response.ok) throw new Error('Erreur de fetch tarifs');
        return response.json();
      })
      .then(data => {
        if (data && (data.passagers.length > 0 || data.vehicules_moins_2m.length > 0 || data.vehicules_plus_2m.length > 0)) {
          let html = '<div class="table-responsive">';
          html += '<table class="table table-bordered">';
          html += '<thead><tr><th>Catégorie</th><th>Type</th><th>Prix</th><th>Période</th></tr></thead>';
          html += '<tbody>';

          // Passagers
          data.passagers.forEach(tarif => {
            html += `<tr>
              <td>Passagers</td>
              <td>${tarif.type}</td>
              <td>${tarif.prix} €</td>
              <td>${tarif.periode}</td>
            </tr>`;
          });

          // Véhicules < 2m
          data.vehicules_moins_2m.forEach(tarif => {
            html += `<tr>
              <td>Véhicules < 2m</td>
              <td>${tarif.type}</td>
              <td>${tarif.prix} €</td>
              <td>${tarif.periode}</td>
            </tr>`;
          });

          // Véhicules > 2m
          data.vehicules_plus_2m.forEach(tarif => {
            html += `<tr>
              <td>Véhicules > 2m</td>
              <td>${tarif.type}</td>
              <td>${tarif.prix} €</td>
              <td>${tarif.periode}</td>
            </tr>`;
          });

          html += '</tbody></table></div>';
          results_container_tarifs.innerHTML = html;
        } else {
          results_container_tarifs.innerHTML = '<p>Aucun tarif disponible pour cette traversée.</p>';
        }
      })
      .catch(error => {
        console.error('Erreur lors du chargement des tarifs :', error);
        results_container_tarifs.innerHTML = '<p>Erreur lors du chargement des tarifs.</p>';
      });
  }
});
