<div class="container">
  <div class="row">
    <div id="connectionpanel" class="col-lg-4 offset-lg-4">
      <form action="" method="post">
        <div class="row">
          <h3 id="connectionpanelTitle" class="col-lg-10 offset-lg-1">BILLET SIMPLE POUR L' ALASKA</h3>
          <p id="connectionpanelSubTitle" class="col-lg-10 offset-lg-1">Espace administrateur</p>
          <input id="login" class="col-lg-8 offset-lg-2" type="text" name="login" placeholder="Nom d'utilisateur" />
          <input id="password" class="col-lg-8 offset-lg-2" type="password" name="password" placeholder="Mot de passe" />
          <?php if ($user->hasFlash()) echo '<p id="invalidPSWD" class="col-lg-10 offset-lg-1">', $user->getFlash(), '</p>'; ?>
          <input id="connectionbutton" class="col-lg-4 offset-lg-4"type="submit" value="Connexion" />
        </div>

      </form>
    </div>
  </div>
</div>
