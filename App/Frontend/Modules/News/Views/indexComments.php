<div class="container">
  <div class="row">
    <div id="indexComments" class="col-lg-12 mainContent">

          <h2 id="indexCommentsTitle" class="mainTitles">
            <?= $titre ?> - Commentaires
          </h2>

          <?php
          foreach ($listeComments as $comment)
          {
          ?>
          <fieldset>
            <legend>
              Posté par <strong><?php echo strip_tags($comment['auteur']) ?></strong> le <?php echo strip_tags($comment['date']->format('d/m/Y à H\hi')) ?>

              <?php if ($user->isAuthenticated()) { ?>
                - <a class="commentmodify" href="admin/comment-update-<?= $comment['id'] ?>.html">Modifier</a> |
                <a class="commentmodify" href="admin/comment-delete-<?= $comment['id'] ?>.html">Supprimer</a>
              <?php }

              else {
                if (!$comment['mark']) { ?>
                   - <a class="commentmodify" href="/signaler-<?= $comment['id'] ?>.html">Signaler ce commentaire </a>
                <?php }
              }?>
            </legend>
            <p id="commentContent"><?= nl2br(strip_tags($comment['contenu'])) ?></p>
          </fieldset></br>
          <?php
          }
          ?>


          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">


              <?php
              if ($pageCourante > 1) {
                echo '<li class="page-item"><a class="page-link" href="/news-' ,$news['id'],'/comments.html?page=' ,$pageCourante - 1,'">Précédent</a></li>';

              }
            ?>


          <?php

          for ($i=1; $i <= $nombrePages ; $i++) {

            if ($pageCourante === $i) {
              echo '<li class="page-item page-item-disabled">',$i,'</li>';
            }
            else {
            echo '<li class="page-item"><a class="page-link" href="/news-' ,$news['id'],'/comments.html?page=' ,$i,'">',$i,'</a></li>';
            }
          }
          ?>
          <?php
          if ($pageCourante < $nombrePages) {
            echo '<li class="page-item"><a class="page-link" href="/news-' ,$news['id'],'/comments.html?page=' ,$pageCourante + 1,'">Suivant</a></li>';

          }
        ?>
          </ul>
        </nav>



    </div>
  </div>
</div>
