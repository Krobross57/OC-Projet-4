<div class="container">
  <div class="row">
    <div id="adminChapterList" class="col-lg-12 mainContent">

    <h2 id="adminChapterListTitle" class="mainTitles">Liste des chapitres</h2>

    <table id="adminChapterListTable">
    <tr><th>Auteur</th><th>Titre</th><th>Date de création</th><th>Dernière modification</th><th>Nombre de commentaires</th><th>Actions</th></tr>
    <?php
    foreach ($listeNews as $news) {
      echo '<tr><td>', strip_tags($news['auteur']), '</td><td><a class="adminChapterTitles" href="/news-', $news['id'], '.html">', strip_tags($news['titre']), '</a></td><td>le ', $news['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', ($news['dateAjout'] == $news['dateModif'] ? ' - ' : 'le '.$news['dateModif']->format('d/m/Y à H\hi')), '</td><td><a href="/news-',$news['id'],'/comments.html">'
      ,count($comments->getCompleteListOf($news['id'])),' commentaire(s)</a></td><td class="Actions"><a href="news-update-', $news['id'], '.html"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="news-delete-', $news['id'], '.html"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td></tr>', "\n";
    }
    ?>
    </table>

    <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">


      <?php
      if ($pageCourante > 1) {
        echo '<li class="page-item"><a class="page-link" href="/admin/news.html?page=' ,$pageCourante - 1,'">Précédent</a></li>';

      }
    ?>


    <?php

    for ($i=1; $i <= $nombrePagesNews ; $i++) {

    if ($pageCourante === $i) {
      echo '<li class="page-item page-item-disabled">',$i,'</li>';
    }
    else {
    echo '<li class="page-item"><a class="page-link" href="/admin/news.html?page=',$i,'">',$i,'</a></li>';
    }
    }
    ?>
    <?php
    if ($pageCourante < $nombrePagesNews) {
    echo '<li class="page-item"><a class="page-link" href="/admin/news.html?page=' ,$pageCourante + 1,'">Suivant</a></li>';

    }
    ?>
    </ul>
    </nav>

    <?php if ($user->hasFlash()) {
      echo '<p class="flashes" style="text-align: center;">', $user->getFlash(), '</p>';
    } ?>

    <a id="backtodashboard" href="/admin/"><i class="fa fa-arrow-left" aria-hidden="true"></i>Tableau de bord</a>

    </div>

  </div>
</div>
