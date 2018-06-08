<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title><?= isset($title) ? $title : 'Billet simple pour l\'Alaska' ?> - Billet simple pour l'Alaska</title>
  <link href="https://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="/images/thumbnail.png" />
  <link href="/css/style2.css" rel="stylesheet" />
  <!-- <link href="/css/laptop.css" rel="stylesheet" />
  <link href="/css/tablet.css" rel="stylesheet" />
  <link href="/css/tabletS.css" rel="stylesheet" />
  <link href="/css/mobileL.css" rel="stylesheet" />
  <link href="/css/mobileM.css" rel="stylesheet" />
  <link href="/css/mobileS.css" rel="stylesheet" /> -->
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: white;">
      <a class="navbar-brand" href="/">BILLET SIMPLE POUR L'ALASKA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/">Administration</a>
          </li>
          <?php if ($user->isAuthenticated()) { ?>
          <li class="nav-item">
            <a class="nav-link" href="/admin/news-insert.html">Ajouter un chapitre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Logout.php">Déconnexion</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </nav>
  </header>








  <?= $content ?>





  <ul id="socialmedias">
  <li>
    <a href="https://fr-fr.facebook.com/"><i class="fa fa-facebook fa-2x fa-fw" aria-hidden="true"></i></a>
  </li>
  <li>
    <a href="https://twitter.com/?lang=fr"><i class="fa fa-twitter fa-2x fa-fw" aria-hidden="true"></i></a>
  </li>
  <li>
    <a href="https://www.instagram.com/?hl=fr"><i class="fa fa-instagram fa-2x fa-fw" aria-hidden="true"></i></a>
  </li>
  <li>
    <a href="https://www.youtube.com/?gl=FR"><i class="fa fa-youtube fa-2x fa-fw" aria-hidden="true"></i></a>
  </li>
</ul>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="/js/ConnectionPageController.js"></script>
<script src="/js/ResponsiveDesigns.js"></script>
</body>

</html>
