<?php
	$id = $_GET['id'];
	require_once("./Contact.php");
	
	if($id != "") {
		$contact = new Contact();
		$contact->load($id);
		
		$name = $contact->getData('name');
		$email = $contact->getData('email');
		
		$info = '<tr bgcolor="#dedede"><td>'.$id.'</td><td>'.$name.'</td><td><a href="mailto:'.$email.'">'.$email.'</a></td></tr>';
	}
	
?>

<!DOCTYPE html>
<head>
  <title>Customer Paradigm | Development Test</title>
  
  <style type="text/css">
  	body { font-family: 'Times New Roman', Times, serif; }
  	.wrap { margin:30px; padding:0 30px 30px 30px; border-radius:10px; border:solid 3px #777; width:400px; }
  	h2 { font-variant: small-caps; font-size:32px; color:#555; }
  	p { font-size: 16px; }
  	th { text-align: left; }
  </style>
</head>
<body>
	<div class="wrap">
		<h2>Retrieve Contact</h2>
		<p>
		<form action="index.php" method="get">
		<strong>Enter Contact ID:</strong><input type="text" name="id" size="10"> &nbsp; <input type="submit" value="GO">
		</form>
		</p>
		<? if($id != "") { ?>
			<table border="#444444" cellspacing="0" cellpadding="10">
				<tr><th>ID</th><th>Name</th><th>Email</th></tr>
				<?=$info?>
			</table>
		<?	} ?>
	</div>
</body>
</html>