/*AdminPanel Sidebar toggle*/
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
/*Image upload display instantly after selected image in 'input type file' on form*/
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#profile-img-tag')
              .attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
  }
}