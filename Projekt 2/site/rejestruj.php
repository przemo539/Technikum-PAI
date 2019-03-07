<h2>Rejestruj</h2>
<?php 
	if(isset($_POST['ok'])){
		$login =  addslashes($_POST['login']);
		$haslo = md5($_POST['haslo']);
		$haslo2 = md5($_POST['haslo2']);
		$email = addslashes($_POST['email']);
		$email2 = addslashes($_POST['email2']);
		$klucz = md5($_POST['klucz']);
		
		if(!is_null($login) or !is_null($haslo) or !is_null($haslo2) or !is_null($email) or !is_null($email2) or !is_null($klucz) or $haslo != $haslo2 or $email != $email2){
				$test = mysql_query("INSERT INTO user (login, password, email, klucz, activity) VALUES ('$login', '$haslo', '$email', '$klucz', ".time().") ");
				if($test)
					echo DONE("Zostałeś poprawnie zarejestrowany. Możesz się zalogować :) ");
				else
					echo ERROR("Coś poszło nie tak. Spróbuj ponownie później ");
		}else{
			echo '<div class="ZLE">Wystąpił błąd spróbuj ponownie później</div>';
		}
	}
?>
<form method="POST" id="myForm">
<div id="rejestruj" >
<div id="blad" class="ZLE" style="-webkit-hyphens: auto;
    -moz-hyphens: 20;
    -ms-hyphens: auto;
    hyphens: auto;"></div>
Login: <input type="login" name="login" id="login" class="odsun"/> <img class="odsun" style="display:none;" src="http://barefootmi.com/_include/images/icons/error-cross.png" width="20" alt="błąd" id="blad_login"/><br>
Hasło: <input type="password" name="haslo" id="haslo" class="odsun"/> <img class="odsun" style="display:none;" src="http://barefootmi.com/_include/images/icons/error-cross.png" width="20" alt="błąd" id="blad_haslo"/><br>
Hasło2:<input type="password" name="haslo2" id="haslo2" class="odsun2"/> <img class="odsun" style="display:none;" src="http://barefootmi.com/_include/images/icons/error-cross.png" width="20" alt="błąd" id="blad_haslo2"/><br>
Email: <input type="email" name="email" id="email" class="odsun"/> <img class="odsun" style="display:none;" src="http://barefootmi.com/_include/images/icons/error-cross.png" width="20" alt="błąd" id="blad_email"/><br>
Email2:<input type="email" name="email2" id="email2" class="odsun2"/> <img class="odsun" style="display:none;" src="http://barefootmi.com/_include/images/icons/error-cross.png" width="20" alt="błąd" id="blad_email2"/><br>
Klucz: <input type="password" name="klucz" id="klucz" class="odsun"/> <img class="odsun" style="display:none;" src="http://barefootmi.com/_include/images/icons/error-cross.png" width="20" alt="błąd" id="blad_klucz"/><br>
<input type="hidden" name="ok" value="ok" />
<div style="font-size:10pt;font-style:italic;">Służy do odzyskiwania hasła</div>
<br><input type="reset" value="Wyczyść" />&nbsp;<input type="submit" value="Wyślij" />
</div>
<script type="text/javascript" >
				$(function() {

					var $form = $('#myForm');

					$form.find('input[type="submit"]').click(function() {
						$.ajax({
						  	type:"GET",
							url:"<?php echo $_SESSION['adres'];?>/jquery/rejestruj.php",
							data: {
								login:  $('#login').val(), 
								email: $('#email').val()
							}
						}).success(function(response) {
							
							
							$('#blad').html('');
							if( ($('#login').val()).length < 6){
								$('#blad_login').show();
								$('#blad').append('Zbyt krótki login min 6 znaków!! <br>');
							}else
								$('#blad_login').hide();
							
							if(($('#haslo').val()).length < 6){
								$('#blad_haslo').show();
								$('#blad').append('Zbyt krótkie haslo min 6 znaków!! <br>');
							}else
								$('#blad_haslo').hide();
							
							if(($('#haslo2').val()).length < 6){
								$('#blad_haslo2').show();
								$('#blad').append('Zbyt krótkie haslo2 min 6 znaków!! <br>');
							}else 
								$('#blad_haslo2').hide();
							
							if(($('#email').val()).length < 6){
								$('#blad_email').show();
								$('#blad').append('Zbyt krótki email min 6 znaków!! <br>');
							}else
								$('#blad_email').hide();;
							
							if(($('#email2').val()).length < 6){
								$('#blad_email2').show();
								$('#blad').append('Zbyt krótki email2 min 6 znaków!! <br>');
							}else
								$('#blad_email2').hide();
							
							if(($('#klucz').val()).length < 6){
								$('#blad_klucz').show();
								$('#blad').append('Zbyt krótkie slowo klucz min 6 znaków!! <br>');
							}else
								$('#blad_klucz').hide();
							
							if(parseInt(response[0]) > 0){
								$('#blad_login').show();
								$('#blad').append('Login zajęty <br>');
							}	
							
							if(parseInt(response[1]) > 0){
								$('#blad_email').show();
								$('#blad').append('Email zajęty <br>');
							}
								
							
							if($('#email2').val() != $('#email').val()){
								$('#blad').append('Emaile nie zgadzaja sie <br>');
							}							
							
							if($('#haslo').val() != $('#haslo2').val()){
								$('#blad').append('Hasla nie zgadzaja sie <br>');
							}
							
							if($('#blad').html() == ''){
								$form.submit();
							}

						}); 
						return false;

					});
				});

</script>