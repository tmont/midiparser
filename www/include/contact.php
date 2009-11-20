<?php
	
	$errors = array();
	$values = array_fill_keys(array('name', 'email', 'message'), '');
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact'])) {
		$name = @$_POST['name'] ?: null;
		$email = @$_POST['email'] ?: null;
		$message = @$_POST['message'] ?: null;
		
		if (empty($name)) {
			$errors['name'] = 'No name was given';
		}
		if ($email === null || !preg_match('/[\w\.]+@[\w\-]+\.\w+/', $email)) {
			$errors['email'] = 'Invalid email';
		}
		if (empty($message)) {
			$errors['message'] = 'Your message is empty';
		}
		
		if (!empty($errors)) {
			$_SESSION['contact-errors'] = $errors;
			$_SESSION['contact-values'] = array(
				'name' => $name,
				'email' => $email,
				'message' => $message
			);
		} else {
			//send email
			$headers[] = 'Reply-To: ' . $email;
			$headers[] = 'From: contact@phpmidiparser.com';
			
			if (!mail('t.montg@gmail.com', '[PHP MIDI Library] - Message from ' . $name, $message, implode("\r\n", $headers))) {
				$_SESSION['contact-success'] = false;
			} else {
				$_SESSION['contact-success'] = true;
			}
		}
		
		header('Location: /contact');
		exit;
	} else if (isset($_SESSION['contact-errors'])) {
		$errors = $_SESSION['contact-errors'];
		$values = $_SESSION['contact-values'];
		unset($_SESSION['contact-errors'], $_SESSION['contact-values']);
	}
	
	if (isset($_SESSION['contact-success'])) {
		$success = $_SESSION['contact-success'];
		unset($_SESSION['contact-success']);
	}
	
?>
					
					
					<h2>Contact</h2>
					
<?php if (isset($success) && $success === false) { ?>
					<p>
						Your message was unable to be sent. It&#039;s our fault, so please
						do not try again. You can email us directly at
						<a href="mailto:contact@phpmidiparser.com">contact@phpmidiparser.com</a>.
					</p>
<?php } else if (!isset($success)) { ?>
					<form method="post" action="/contact" id="contact-form">
						<table>
							<tr><th><label for="name">Name</label></th></tr>
							<tr><td><input type="text" name="name" id="name"<?php if (isset($errors['name'])) echo ' class="error"'; ?> value="<?php echo escape($values['name']); ?>"/></tr>
							<tr><th><label for="email">Email</label></th></tr>
							<tr><td><input type="text" name="email" id="email"<?php if (isset($errors['email'])) echo ' class="error"'; ?> value="<?php echo escape($values['email']); ?>"/></tr>
							<tr><th><label for="message">Message</label></th></tr>
							<tr><td><textarea name="message" id="message" rows="10" cols="40"<?php if (isset($errors['message'])) echo ' class="error"'; ?>><?php echo escape($values['message']); ?></textarea></tr>
							<tr><td class="submit"><input type="submit" name="contact" value="Submit"/></tr>
						</table>
					</form>
<?php } else { ?>
					<p>Thank you for your message. You are awesome.</p>
<?php } ?>
					