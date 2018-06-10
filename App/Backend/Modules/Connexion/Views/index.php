<div class="container">
  <div class="row">
    <div id="connectionpanel" class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1">
      <form action="" method="post">
        <div class="row">
          <h3 id="connectionpanelTitle" class="col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-sm-10 offset-sm-1">BILLET SIMPLE POUR L' ALASKA</h3>
          <p id="connectionpanelSubTitle" class="col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-sm-10 offset-sm-1 col-12">Espace administrateur</p>
          <input id="login" class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-10 offset-sm-1 col-10 offset-1" type="text" name="login" placeholder="Nom d'utilisateur" />
          <input id="password" class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-10 offset-sm-1 col-10 offset-1" type="password" name="password" placeholder="Mot de passe" />
          <?php if ($user->hasFlash()) echo '<p id="invalidPSWD" class="col-lg-10 offset-lg-1">', $user->getFlash(), '</p>'; ?>
          <input id="connectionbutton" class="col-lg-4 offset-lg-4 col-md-4 offset-md-4 col-sm-4 offset-sm-4 col-6 offset-3"type="submit" value="Connexion" />
        </div>

      </form>
    </div>
  </div>
</div>
