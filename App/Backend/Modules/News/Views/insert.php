<div class="container">
  <div class="row">
    <div id="chapteradding" class="col-lg-12 mainContent">
        <h2 class="mainTitles">Ajouter un chapitre</h2>
        <div class="container">
          <div class="row">
        <form class="col-lg-12" action="" method="post">


            <?= $form ?>



          <input type="submit" value="Ajouter" />

        </form>
      </div>
    </div>
    </div>
  </div>
</div>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=41iw6hf6vpe8spj6jwl6c9zun3tdu5vuvx4xdusyruuahpnu"></script>

<script> tinymce.init({
  selector: '#contenu',
  height: 400,
  width: '100%',
  menubar: false,
  branding: false,
  elementpath: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
  ],
  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
});</script>
