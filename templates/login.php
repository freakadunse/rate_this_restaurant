<article class="posts">
    <?php
	include("./config/recaptcha.lib");
    if(!empty($this->_['errors'])): ?>
        <p class="line error">
            <?php 
            echo $this->_['errors']; ?>
        </p>
        <?php 
    endif;
    if(!empty($this->_['success'])): ?>
        <p class="line success">
            <?php 
            echo $this->_['success']; ?>
        </p>
        <?php 
    endif; ?>
    <p class="line">Du musst Dich erst einloggen um Dein Lokal hier eintragen zu k&ouml;nnen ...</p>
    <form id="login" action="/?view=edit" method="post">
        <input type="hidden" name="action" value="login" />
        <p class="line">
            <label for="emailadresse">Deine Emailadresse*:</label>
            <input name="emailadresse" id="emailadresse" type="email" required="required" tabindex="1"/><br/>
        </p>
        <p class="line">
            <label for="passwort">Dein Passwort*:</label>
            <input name="passwort" id="p1" type="password" required="required" tabindex="2"/><br/>
        </p>
        <p class="line">
            <label for="login_passwort2">Passwort wiederholen*:</label>
            <input name="login_passwort2" id="p2" type="password" required="required" tabindex="3" onblur="checkPass($('#p1').val(),$(this));"/><br/>
        </p>
        <input id="login_button" class="button" type="submit" value="Login" tabindex="5" disabled/>
    </form>
    <p class="line">... oder registriere Dich neu!</p>
    <form id="register" action="/?view=edit" method="post">
        <input type="hidden" name="action" value="register" />
        <p class="line">
            <label for="emailadresse">Deine Emailadresse*:</label>
            <input name="emailadresse" id="emailadresse" type="email" required="required" tabindex="6"/><br/>
        </p>
        <p class="line">
            <label for="passwort">Dein Passwort*:</label>
            <input name="passwort" id="p3" type="password" required="required" tabindex="7"/><br/>
        </p>
        <p class="line">
            <label for="register_passwort2">Passwort wiederholen*:</label>
            <input name="register_passwort2" id="p4" type="password" required="required" tabindex="8" onblur="checkPass($('#p3').val(),$(this));"/><br/>
        </p>
        <p class="line">
            <label for="name">Name des Lokals*:</label>
            <input name="name" id="name" type="text" required="required" tabindex="9"/><br/>
        </p>
        <p class="line">
            <label for="anschrift">Anschrift*:</label>
            <input name="anschrift" id="anschrift" type="text" required="required" tabindex="10"/><br/>
        </p>
        <p class="line">
            <label for="beschreibung">Kurzbeschreibung:</label>
            <textarea name="beschreibung" id="beschreibung" rows="4" tabindex="11"></textarea><br/>
        </p>
        <input class="button" type="submit" value="Registrieren"  tabindex="12" disabled/>
		<?php
		// Get a key from https://www.google.com/recaptcha/admin/create
		$publickey = "";
		$privatekey = "";

		# the response from reCAPTCHA
		$resp = null;
		# the error code from reCAPTCHA, if any
		$error = null;

		# was there a reCAPTCHA response?
		if ($_POST["recaptcha_response_field"]) {
				$resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

			if ($resp->is_valid) {
                echo "You got it!";
			} else {
                # set the error code so that we can display it
                $error = $resp->error;
			}	
		}
		echo recaptcha_get_html($publickey, $error);
		?>
    </form>
    <p class="line">* Pflichtfelder</p>
</article>
