<div class="container">
  <div class="row">
    <div id="adminCommentsList" class="col-lg-12 mainContent">

      <h3 id="adminCommentsListTitle" class="mainTitles">Commentaires en attente de modération</h3>

      <table id="adminCommentsListTable">
        <tr><th>Auteur</th><th>Date</th><th>Contenu</th><th>Actions</th></tr>
        <?php
        foreach ($comments as $comment) {
            echo '<tr><td>', $comment['auteur'], '</td><td>le ', $comment['date']->format('d/m/Y à H\hi'), '</td><td>', $comment['contenu'], '</td><td
            class="Actions2"><a href="comment-unmark-', $comment['id'], '.html"><i class="fa fa-check" aria-hidden="true"></i></a> <a href="comment-update-', $comment['id'], '.html"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="comment-delete-', $comment['id'], '.html"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td></tr>', "\n";
        }
        ?>




      </table>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">


          <?php
          if ($pageCourante > 1) {
            echo '<li class="page-item"><a class="page-link" href="/admin/?page=' ,$pageCourante - 1,'">Précédent</a></li>';

          }
        ?>


      <?php

      for ($i=1; $i <= $nombrePagesComments ; $i++) {

        if ($pageCourante === $i) {
          echo '<li class="page-item page-item-disabled">',$i,'</li>';
        }
        else {
        echo '<li class="page-item"><a class="page-link" href="/admin/?page=',$i,'">',$i,'</a></li>';
        }
      }
      ?>
      <?php
      if ($pageCourante < $nombrePagesComments) {
        echo '<li class="page-item"><a class="page-link" href="/admin/?page=' ,$pageCourante + 1,'">Suivant</a></li>';

      }
      ?>
      </ul>
      </nav>

      <a id="backtodashboard" href="/admin/"><i class="fa fa-arrow-left" aria-hidden="true"></i>Tableau de bord</a>
    </div>

  </div>
</div>
