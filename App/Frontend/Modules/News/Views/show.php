<div class="container">
  <div class="row">
    <div id="chapterItem" class="col-lg-12 mainContent">

    <h2 id="chapterTitle"><?php echo strip_tags($news['titre']) ?></h2>
    <div id="addedon">
      <p>
        <i class="fa fa-calendar" aria-hidden="true"></i>
        <span id="addingdate"><?= $news['dateAjout']->format('d/m/Y à H\hi') ?></span>
      </p>
      <p><i class="fa fa-user" aria-hidden="true"></i><span id="addingauthor"><?php echo strip_tags($news['auteur']) ?></span></p>
    </div>



    <div id="chapterContent"><?= nl2br($news['contenu']) ?>
      <div id="lastModif">
        <?php if ($news['dateAjout'] != $news['dateModif']) { ?>
          <p style="text-align: right;"><small><em>Modifié le <?php echo $news['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
        <?php } ?>
      </div>
    </div>

    <h2 id="commentsTitle">Commentaires</h2>


    <?php
    if (empty($comments))
    {
    ?>
    <p id="nocomment">Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
    <?php
    }

    foreach ($comments as $comment)
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
             - <a class="commentmodify" href="signaler-<?= $comment['id'] ?>.html">Signaler ce commentaire </a>
          <?php }
        }?>
      </legend>
      <p id="commentContent"><?php echo nl2br(strip_tags($comment['contenu'])) ?></p>
    </fieldset></br>
    <?php
    }
    ?>

    <?php if ($user->hasFlash()) echo '<p class="flashes" id="commentAdded" style="text-align: center;">', $user->getFlash(), '</p>'; ?>

    <p id="addComment"><a href="commenter-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>

    <?php if (count($totalComments) > 5) { ?>

      <p id="allComments"><a href="/news-<?= $news['id'] ?>/comments.html">Voir tous les commentaires ( <?= count($totalComments) ?> )</a></p>

    <?php } ?>

    </div>
  </div>
</div>
