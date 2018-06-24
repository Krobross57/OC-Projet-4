<div class="container">
  <div class="row">
    <div id="dashBoard" class="col-lg-12 mainContent">
      <h2 id="dashBoardTitle" class="mainTitles">Tableau de bord</h2>

      <div class="container">

        <div class="row">

          <div id="quicklook" class="col-lg-5">

              <div class="row">
                <h3 id="quicklooktitle" class="col-lg-12">Aperçu rapide</h3>
              </div>

              <div class="row">
                  <div id="quicklookcontent" class="col-lg-12">

                    <p id="howmanynews"><i class="fa fa-file-text-o fa-lg" aria-hidden="true"></i><a href="/admin/news.html"><?php echo $newsPubliees ?> chapitre(s) publié(s)</a></p>

                    <?php if ($commentsAModerer > 0) { ?>
                      <p id="howmanycomments"><i class="fa fa-comment-o fa-lg" aria-hidden="true"></i><a href="/admin/comments.html"><?php echo $commentsAModerer ?> commentaire(s) à modérer</a></p>
                    <?php }
                          else { ?>
                            <p id="howmanycomments"><i class="fa fa-comment-o fa-lg" aria-hidden="true"></i><?php echo $commentsAModerer ?> commentaire(s) à modérer</p>

                          <?php
                            }
                          ?>


                  </div>
              </div>

              <div class="row">
                <div id="adminBadge" class="col-lg-12">

                    <h1 id="adminBadgetitle">BILLET SIMPLE POUR L' ALASKA</h1>

                    <h2 id="adminBadgeauthor">PAR JEAN FORTEROCHE</h2>

                </div>
              </div>

          </div>

        <div id="lastPost" class="col-lg-6 offset-lg-1">

          <div class="row">
          <h3 id="lastPostTitle" class="col-lg-12">Derniers ajouts</h3>
          </div>


          <div class="row">

          <div id="lastChapter" class="col-lg-12">

            <?php
              foreach ($lastNews as $news) {
            ?>

              <h4 id="lastChapterTitle"><a href="/news-<?= $news['id'] ?>.html"><?php echo strip_tags($news['titre']) ?></a></h4>

              <div id="lastChapterContent"><?php echo $news['contenu'] ?></div>

              <p id="lastChapterDate">Le <?php echo strip_tags($news['dateAjout']->format('d/m/Y à H\hi')) ?> par <?php echo strip_tags($news['auteur']) ?></p>

              <?php
              }
              ?>
          </div>

          </div>

          <div class="row">

            <div id="lastComment" class="col-lg-12">

              <?php
                foreach ($lastComments as $comments) {
              ?>

              <h4 id="lastCommentTitle"><a href="/news-<?= $comments['news'] ?>/comments.html">Commentaire</a></h4>

              <div id="lastCommentContent"><?php echo strip_tags($comments['contenu']) ?></div>

              <p id="lastCommentDate">Le <?php echo strip_tags($comments['date']->format('d/m/Y à H\hi')) ?> par <?php echo strip_tags($comments['auteur']) ?></p>

              <?php
              }
              ?>

            </div>

          </div>

        </div>

      </div>

      </div>
    </div>
  </div>
</div>
