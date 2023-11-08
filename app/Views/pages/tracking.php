<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <title>Tracking POLY-TRANS SUARL</title>
  <meta name="description" content="Tracking des livraisons." />
  <meta name="keywords" content="Transit, POLYTRANS,  Transport, Tranking, Manutention, Consignation, Entreposage, Groupage, Tracking, Livraisons, Logistique, Sénégal" />
  <meta name="author" content="Yankee" />
  <meta name="robots" content="index, follow" />
  <link rel="icon" type="image/png" href="favicon.ico" />
  <meta property="og:title" content="Tracking POLY-TRANS SUARL" />
  <meta property="og:description" content="plateform de suivie des expéditions des livraisons" />
  <meta property="og:image" content="<?= base_url('poly-trans.png') ?>" />
  <meta property="og:url" content="<?= base_url() ?>" />
  <meta property="og:type" content="website" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?= base_url('theme.css') ?>">
  <link rel="stylesheet" href="<?= base_url('style.css') ?>">
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body class="bg-white-50">
  <?= view('pages/components/header', [
    'p' => 'tracking'
  ]) ?>

  <div class="container pt-5 px-3">

    <h1 data-aos="fade-left">Tracking</h1>
    <p data-aos="fade-left" data-aos-delay="100" class="fs-3">Page de suivie des expéditions des livraisons de POLY-TRANS SUARL.</p>
    <div class="row">
      <div id="app" class="col-12">
        <div data-aos="fade-up" data-aos-delay="200" class="card">
          <div class="card-body">
            <form v-on:submit.prevent="handleSubmit" action="#" method="POST">
              <div class=" d-flex gap-2">
                <div class="mb-3 flex-grow-1">
                  <label for="search" class="form-label"><strong>B/L</strong> ou <strong>numéro de conteneur</strong></label>
                  <div class="d-flex gap-2">
                    <input minlength="7" required v-model="search" v-on:change="handleChange" type="search" class="form-control text-uppercase" name="search" id="search" aria-describedby="helpId" placeholder="">
                    <button :disabled="loading" type="submit" class="btn btn-primary d-flex gap-2 align-items-center">
                      <span v-if="loading" class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </span>
                      <span>Tracker</span>
                    </button>
                  </div>
                </div>
              </div>
            </form>

            <div v-if="isSearch">
              <div class="fade-up">
                <h3>Résultat pour <span class="text-primary text-uppercase">{{search}}</span></h3>
              </div>
              <div v-if="tcs.length == 0" class="alert alert-warning" role="alert">
                <strong>Aucun résultat!</strong> Vérifiez l'orthographe et réessayez.
              </div>
              <div class=" d-flex row">
                <div v-for="item in tcs" :key="item.id" class="col-lg-6 mb-3 d-flex">
                  <div class="border p-3 rounded flex-fill fade-up">
                    <small>Nº Conteneur</small>
                    <h3>{{item.conteneur}}</h3>
                    <p>Facturé <strong class="text-primary">{{item.zone}}</strong> <span v-if="item.adresse">à l'adresse exacte <strong class=" text-primary">{{item.adresse}}</strong></span></p>

                    <div class="d-flex gap-1">
                      <span v-if="item.paiement == 'NON'" class="badge bg-danger">Non payé</span>
                      <span v-if="item.paiement == 'OUI'" class="badge bg-success">Payé</span>
                      <span v-if="item.etat == 'EN COURS'" class="badge bg-warning">Livraison en cours</span>
                      <span v-if="item.etat == 'SUR PLATEAU'" class="badge bg-info">En attente</span>
                      <span v-if="item.etat == 'MISE À TERRE'" class="badge bg-dark">Mise à terre</span>
                      <span v-if="item.etat == 'LIVRÉ'" class="badge bg-dark">Livré</span>
                    </div>
                    <hr>
                    <div class="d-flex gap-3">
                      <div class="col">
                        <small>Type</small>
                        <h4>{{item.type}}'</h4>
                        <small>Ligne maritime</small>
                        <h4>{{item.compagnie}}</h4>
                        <small>B/L</small>
                        <h4>{{item.bl}}</h4>
                      </div>
                      <div class="col">
                        <small>Nom du chauffeur</small>
                        <h4>{{item.ch_aller || 'Non défini'}}</h4>
                        <small>Téléphone</small>
                        <h4>{{item.ch_tel || 'Non défini'}}</h4>
                        <small>Immatriculation du tracteur</small>
                        <h4>{{item.cam_aller || 'Non défini'}}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>



          </div>
        </div>
      </div>
      <div class="col-12 mb-5">
        <div data-aos="fade-up" data-aos-delay="300" class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Qu'est ce qu'un B/L ou numéro de conteneur?
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <p>
                  Un numéro de conteneur est un numéro unique composé de 4 lettres (préfixe du conteneur) et de 7 chiffres imprimés sur vos formulaires de réservation et en haut à droite de chaque porte de conteneur.
                </p>
                <p>
                  Le numéro du connaissement (B/L) se compose de 9 caractères. Il peut être trouvé imprimé sur votre formulaire de réservation.
                </p>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Quelles informations obtiendrez-vous grâce au suivi des expéditions et des conteneurs ?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <p>Les informations que vous pourrez avoir:</p>
                <ul>
                  <li>Numéro des conteneurs et type</li>
                  <li>B/L</li>
                  <li>La ligne maritime</li>
                  <li>Zone de facturation</li>
                  <li>Nom du chauffeur en charge de la livraison et son numéro de téléphone</li>
                  <li>Immatruculation du camion</li>
                  <li>Statut du conteneur (EN COURS, MISE À TERRE, ANNULÉ, LIVRÉ)</li>
                  <li>Date de paiement de la livraison</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('app.js') ?>"></script>
  <script>
    const url = '<?= base_url() ?>';
  </script>
  <script src="<?= base_url('trackingModule.js') ?>"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>