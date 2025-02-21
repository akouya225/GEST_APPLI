<?php include 'paramettre/entete.php'; ?>

<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Bienvenue à la DSIB</h3>
        Date et L'heure:

        <span id="clock"></span>

        <script>
          function updateClock() {
            let now = new Date();
            let dateString = now.toLocaleDateString(); // Format automatique selon la langue du navigateur
            let timeString = now.toLocaleTimeString(); // Heure locale formatée
            document.getElementById("clock").textContent = dateString + " " + timeString;
          }

          // Mettre à jour l'heure et la date toutes les secondes
          setInterval(updateClock, 1000);

          // Appel initial pour éviter l'attente d'une seconde
          updateClock();
        </script>



      </div>
      <div class="col-12 col-xl-4">
        <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2"
              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <i class="mdi mdi-calendar"></i> <span id="currentDate">Today (Fév 2025)</span></button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
              <a class="dropdown-item" href="#">January - February</a>
              <a class="dropdown-item" href="#">March - April</a>
              <a class="dropdown-item" href="#">June - August</a>
              <a class="dropdown-item" href="#">August - November</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card tale-bg">
      <div class="card-people mt-auto">
        <img src="assets/images/dashboard/people.svg" alt="people">
        <div class="weather-info">
          <div class="d-flex">
            <div>

              <h2 class="mb-0 font-weight-normal"><i class="icon-sun me-2"></i></h2>
            </div>
            <div class="ms-2">
              <h4 class="location font-weight-normal">Abidjan</h4>
              <h6 class="font-weight-normal">application</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin transparent">
    <div class="row">
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-tale">
          <div class="card-body">
            <button type="submit" class="right btn" onclick="location.href='application.php'">
              <p class="mb-4-white">APPLICATION</p>
            </button>
            <p class="fs-30 mb-2">25</p>

          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-dark-blue">
          <div class="card-body">
            <button type="submit" class="right btn" onclick="location.href='personne.php'">
              <p class="mb-4-white">PERSONNE</p>
            </button>

            <p class="fs-30 mb-2">20</p>

          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <button type="submit" class="right btn" onclick="location.href='architecture.php'">
              <p class="mb-4-white">
              <p class="mb-4">PARAMETRES</p>
            </button>


            <p class="fs-30 mb-2">118</p>

          </div>
        </div>
      </div>


    </div>
  </div>
</div>

<?php include 'paramettre/piedpage.php'; ?>