$(document).ready(function(){
   $('#login-form').submit(function() {
     data = $('#login-form').serialize();

     $.post("login-autenticar.php",{
            d: data,
     },
      function (d) {
           if(d == 1){
           $('#myModal').modal('show');
        }else{
          var redirecionar = "/";
         $(window.document.location).attr('href',redirecionar);
        }
      });
      return false;
    });
});