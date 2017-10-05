
<meta charset='UTF8' />

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link href="lity/dist/lity.css" rel="stylesheet">
<script src="lity/vendor/jquery.js"></script>
<script src="lity/dist/lity.js"></script>

<script type="text/javascript">


  $(document).ready( function() {
    var now = new Date();
 
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);

    var today = now.getFullYear()+"/"+(month)+"/"+(day) ;


   $('#datePicker').val(today);
    
    $('#test').click(function(){
        
        testClicked();
        
    });
});
function testClicked()
{
    
console.log(    $('#datePicker').val());    
}




</script>


<style type="text/css">
 @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,600,400italic);
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-font-smoothing: antialiased;
  -o-font-smoothing: antialiased;
  font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
}

body {
  font-family: "Roboto", Helvetica, Arial, sans-serif;
  font-weight: 100;
  font-size: 12px;
  line-height: 30px;
  color: #777;
  background: #4CAF50;
}

.container {
  max-width: 400px;
  width: 100%;
  margin: 0 auto;
  position: relative;
}

#contact input[type="text"],
#contact input[type="email"],
#contact input[type="tel"],
#contact input[type="url"],
#contact textarea,
#contact button[type="submit"] {
  font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
}

#contact {
  background: #F9F9F9;
  padding: 25px;
  margin: 150px 0;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

#contact h3 {
  display: block;
  font-size: 30px;
  font-weight: 300;
  margin-bottom: 10px;
}

#contact h4 {
  margin: 5px 0 15px;
  display: block;
  font-size: 13px;
  font-weight: 400;
}

fieldset {
  border: medium none !important;
  margin: 0 0 10px;
  min-width: 100%;
  padding: 0;
  width: 100%;
}

#contact input[type="text"],
#contact input[type="email"],
#contact input[type="tel"],
#contact input[type="url"],
#contact textarea {
  width: 100%;
  border: 1px solid #ccc;
  background: #FFF;
  margin: 0 0 5px;
  padding: 10px;
}

#contact input[type="text"]:hover,
#contact input[type="email"]:hover,
#contact input[type="tel"]:hover,
#contact input[type="url"]:hover,
#contact textarea:hover {
  -webkit-transition: border-color 0.3s ease-in-out;
  -moz-transition: border-color 0.3s ease-in-out;
  transition: border-color 0.3s ease-in-out;
  border: 1px solid #aaa;
}

#contact textarea {
  height: 100px;
  max-width: 100%;
  resize: none;
}

#contact button[type="submit"] {
  cursor: pointer;
  width: 100%;
  border: none;
  background: #4CAF50;
  color: #FFF;
  margin: 0 0 5px;
  padding: 10px;
  font-size: 15px;
}

#contact button[type="submit"]:hover {
  background: #43A047;
  -webkit-transition: background 0.3s ease-in-out;
  -moz-transition: background 0.3s ease-in-out;
  transition: background-color 0.3s ease-in-out;
}

#contact button[type="submit"]:active {
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
}

.copyright {
  text-align: center;
}

#contact input:focus,
#contact textarea:focus {
  outline: 0;
  border: 1px solid #aaa;
}

::-webkit-input-placeholder {
  color: #888;
}

:-moz-placeholder {
  color: #888;
}

::-moz-placeholder {
  color: #888;
}

:-ms-input-placeholder {
  color: #888;
} 


  
</style>

<div class="container">  


  <form id="contact" action="action1.php" method="post">
    <h3>Adicionar Jogos Adiados ou Cancelados</h3>
    <h4>O bot enviará ao grupo um alerta aṕós 24 horas do momento do evento.</h4>
    <?php


      if (@$_GET['alert'] == 'cadastrado'){
                    echo '<div class="alert alert-success">
  <strong>Adicionado!</strong> Deseja cadastrar outro? 
</div>';

      }

        ?>
    <fieldset>
      <input placeholder="Evento" type="text" tabindex="1" name="nome" required autofocus>
    </fieldset>
        <fieldset>
      <input placeholder="Data Evento (FORMATO: DD/MM/AAAA)" type="datetime-local" name="data" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
  <select id="operador" name="operador" required>
  <option disabled selected value> Selecione um operador </option>
    <option value="Arthur">Arthur</option>
    <option value="Jair">Jair</option>
    <option value="Oseias">Oseias</option>
    <option value="Pierre">Pierre</option>
    <option value="Ramon">Ramon</option>
    <option value="Rodrigo">Rodrigo</option>
    <option value="Romero">Romero</option>
  </select>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Salvando">Salvar</button>
    </fieldset>
      
      <!-- Secondary, outline button -->
<center><a href="lista.php" class="btn btn-secondary" data-lity><button type="button" class="btn btn-secondary" style="color:black">ÚLTIMOS CADASTROS</button></a></center>
    <p class="copyright">Jogos_Adiados_Bot v1.2 by Peter</a></p>
</form>
</div>