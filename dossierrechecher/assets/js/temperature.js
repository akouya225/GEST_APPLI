document.addEventListener('DOMContentLoaded', function () {
    const apiKey = 'VOTRE_CLE_API';  // Remplacez par votre clé API
    const city = 'Abidjan';
    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

    // Fonction pour mettre à jour la température
    function updateTemperature() {
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const temperature = data.main.temp;
                document.getElementById('temperature').innerHTML = `${temperature}<sup>°C</sup>`;
            })
            .catch(error => console.error('Erreur :', error));
    }

    // Fonction pour mettre à jour la date actuelle
    function updateDate() {
        const currentDate = new Date();
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        document.getElementById('currentDate').innerText = currentDate.toLocaleDateString('fr-FR', options);
    }

    // Appeler les fonctions pour les mettre à jour au chargement de la page
    updateTemperature();
    updateDate();

    // Mettre à jour la température toutes les 10 minutes
    setInterval(updateTemperature, 600000);
});
