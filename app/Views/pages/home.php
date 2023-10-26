<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <title>Entreprise de Transit & Logistique au Sénégal | POLY-TRANS SUARL</title>
  <meta name="description" content="POLY-TRANS SUARL offre des services de transit, transport, manutention, consignation, entreposage et groupage au Sénégal. Contactez-nous pour des solutions logistiques sur mesure." />
  <meta name="keywords" content="Transit, Transport, Manutention, Consignation, Entreposage, Groupage, Logistique, Sénégal" />
  <meta name="author" content="Yankee" />
  <meta name="robots" content="index, follow" />
  <link rel="icon" type="image/png" href="favicon.png" />
  <meta property="og:title" content="POLY-TRANS SUARL - Votre partenaire en logistique au Sénégal" />
  <meta property="og:description" content="Offrant des services de transit, transport, manutention, consignation, entreposage, groupage et conseils sur mesure depuis 2017." />
  <meta property="og:image" content="<?= base_url('poly-trans.png') ?>" />
  <meta property="og:url" content="<?= base_url() ?>" />
  <meta property="og:type" content="website" />

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?= base_url('theme.css') ?>">
  <link rel="stylesheet" href="<?= base_url('style.css') ?>">
  <?= $this->renderSection('css'); ?>
</head>

<body class=" bg-white position-relative">

  <main class="hero" style="background-image: url(<?= base_url('trucks.svg') ?>);">
    <div class="overlay">
      yankee
    </div>
  </main>



  <?= $this->renderSection('body'); ?>
  <script src="<?= base_url('app.js') ?>"></script>
  <?= $this->renderSection('script'); ?>
</body>

</html>