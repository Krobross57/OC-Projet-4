<div class="container">
  <div class="row">
    <div id="chapteradding" class="col-lg-12 mainContent">
      <form action="" method="post">
        <h2 class="mainTitles">Modifier un chapitre</h2>

          <?= $form ?>


          <input type="submit" value="Modifier" />

      </form>
    </div>
  </div>
</div>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=41iw6hf6vpe8spj6jwl6c9zun3tdu5vuvx4xdusyruuahpnu"></script>

<script> tinymce.init({
  selector: '#contenu',
  height: 400,
  width: '90%',
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
