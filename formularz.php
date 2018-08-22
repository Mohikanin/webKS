<?php
if (count($_POST))
{
	////////// USTAWIENIA //////////
	$email = 'sieciowezakupy@wp.pl';	// Adres e-mail adresata
	$subject = 'list ze strony';	// Temat listu
	$message = 'Dziękujemy za wysłanie formularza';	// Komunikat
	$error = 'Wystąpił błąd podczas wysyłania formularza';	// Komunikat błędu
	$charset = 'iso-8859-2';	// Strona kodowa
	//////////////////////////////
	
	$head =
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/plain; charset=$charset\r\n" .
		"Content-Transfer-Encoding: 8bit";
	$body = '';
	foreach ($_POST as $name => $value)
	{
		if (is_array($value))
		{
			for ($i = 0; $i < count($value); $i++)
			{
				$body .= "$name=" . (get_magic_quotes_gpc() ? stripslashes($value[$i]) : $value[$i]) . "\r\n";
			}
		}
		else $body .= "$name=" . (get_magic_quotes_gpc() ? stripslashes($value) : $value) . "\r\n";
	}
	echo mail($email, "=?$charset?B?" . base64_encode($subject) . "?=", $body, $head) ? $message : $error;
}
else
{
?>
<form action="?" method="post">

<form method="post" action="formularz.php">
				<p>imię i nazwisko
				<br /><input type="text" name="imie" id="imie"/></p>
				
				<p>wpisz swojego mejla
				</br><input type="text" name="mejl" id="mejl"/></p>
				
				<p>Na pewno nie jesteś robotem? A ile jest dwa dodać trzy?
				</br><select name="wynik[]"  id="wynik"/>
				<option value="17">17</option>
				<option value="0">0</option>
				<option value="5">5</option>
				<option value="105">105</option>
				</select></p>
				
				<p>Tutaj napisz coś do nas:<br />
				<textarea name="wpis" id="wpis" cols="30" row="5" >
				</textarea></p>

				<p><input type="submit" name="wyslij" id="wyslij"
						value="Wyśij" /></p>
				</form>

</form>
<?php
}
?>