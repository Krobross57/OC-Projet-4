<div class="container">
  <div class="row">
    <div id="ChaptersList" class="col-lg-12 mainContent">
      <h2 id="ChaptersListTitle" class="mainTitles">
        Liste des <?= $nombreNews ?> derniers chapitres
      </h2>

      <?php
        foreach ($listeNews as $news) {
      ?>

      <div class="ChaptersListContent">
          <h2 class="ChaptersTitles">
            <?= $news['titre'] ?>
          </h2>
          <div class="newsContent">
            <?= nl2br($news['contenu']) ?>
          </div>
          <p class="readmore">
            <a href="news-<?= $news['id'] ?>.html">
              Lire la suite
            </a>
          </p>
      </div>

      <?php
      }
      ?>


        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">


            <?php
            if ($pageCourante > 1) {
              echo '<li class="page-item"><a class="page-link" href="/?page=' ,$pageCourante - 1,'">Précédent</a></li>';

            }
          ?>


        <?php

        for ($i=1; $i <= $nombrePages ; $i++) {

          if ($pageCourante === $i) {
            echo '<li class="page-item page-item-disabled">',$i,'</li>';
          }
          else {
          echo '<li class="page-item"><a class="page-link" href="/?page=',$i,'">',$i,'</a></li>';
          }
        }
        ?>
        <?php
        if ($pageCourante < $nombrePages) {
          echo '<li class="page-item"><a class="page-link" href="/?page=' ,$pageCourante + 1,'">Suivant</a></li>';

        }
      ?>
        </ul>
      </nav>



      </div>
    </div>


  </div>
</div>
