<html>
<head>
	<link href="mall.css" rel="stylesheet" type="text/css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="jquery-1.10.2.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.box').hide();
			$('#dropdown').change(function() {
				$('.box').hide();
				$('.' + $(this).val()).show();
			});
		});
	</script>
</head>
<body>



<div id="wrapper">
	<div id="meny">
		<ul>
			<li><a href="Agent.php">Agent</a></li>
			<li><a href="Alien.php">Alien</a></li>
			<li><a href="#">Vapen</a></li>
			<li><a href="Skepp.php">Skepp</a></li>
			<li><a href="#">Delete</a></li>
		</ul>
	</div>
	<div id="innehall">


		Vänligen välj formulär: <select id="dropdown" name='dropdownFar'  >
			<option>--- Välj Typ ---</option>
			<option value="1">Alienvapen</option>
			<option value="2">Agentvapen</option>
		</select>

		<br>
		<br>

		<div class="box 1">

			<?php
			$IDnrErr = $TillverkatErr = $FarlighetstypErr = $InkopsplatsErr = $VapentypErr = "";
			$IDnr = $Tillverkat = $Farlighetstyp = $Inkopsplats = $Vapentyp = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{

				if (empty($_POST["IDnr"]))
				{$IDnrErr = "IDnr is required";}
				else
				{$IDnr = Vapen_input($_POST["IDnr"]);}

				if (empty($_POST["Tillverkat"]))
				{$TillverkatErr = "Tillverkat is required";}
				else
				{$Tillverkat = Vapen_input($_POST["Tillverkat"]);}

				if (empty($_POST["Farlighetstyp"]))
				{$FarlighetstypErr = "Farlighetstyp Is required";}
				else
				{$Farlighetstyp = Vapen_input($_POST["Farlighetstyp"]);}

				if (empty($_POST["Inkopsplats"]))
				{$InkopsplatsErr = "Inkopsplats is required";}
				else
				{$Inkopsplats = Vapen_input($_POST["Inkopsplats"]);}

				if (empty($_POST["Vapentyp"]))
				{$VapentypErr = "Vapentyp is required";}
				else
				{$Vapentyp = Vapen_input($_POST["Vapentyp"]);}
			}
			function Vapen_input($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			?>


			<form  name ="input"action="Vapen.php" method="post" id="Vapen"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
				<fieldset>
					<legend><label><h3>Vapen</h3></legend>
					<br><br><br><br><br>
					<label for="name"><b>IDnr:</b></label>
					<br>
					<br><br><br>
					<input type="text" name="IDnr"/>*<span class="error"> <?php echo $IDnr;?></span>
					<br>
					<br><br><br>
					<label for="name"><b>Tillverkat:</b></label>
					<br><br><br><br>
					<input type="text" name="Tillverkat"/>*<span class="error"> <?php echo $TillverkatErr;?></span>
					<br><br><br><br>
					<label for="name"><b>Farlighetstyp:</b></label>
					<br><br><br><br>
					<input type="text" name="Farlighetstyp"/>*<span class="error"> <?php echo $FarlighetstypErr;?></span>
					<br><br><br><br>
					<label for="name"><b>Inköpsplats:</b></label>
					<br><br><br>
					<input type="text" name="Inkopsplats" />*<span class="error"> <?php echo $InkopsplatsErr;?></span>
					<br><br>
					<br><br><br>
					<label for="name"><b>Vapentyp:</b></label>
					<br><br>
					<input type="text" name="Vapentyp" />*<span class="error"> <?php echo $VapentypErr;?></span>
					<br>
					<input type="submit"/>
				</fieldset>
			</form>
			<?php

			$pdo = new PDO('mysql:dbname=;host=', '', '');
			$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

			$querystring='INSERT INTO Vapen (IDnr,Tillverkat,Farlighetstyp,Inkopsplats,Vapentyp) 
		VALUES(:IDnr,:Tillverkat,:Farlighetstyp,:Inkopsplats,:Vapentyp);';

			$stmt = $pdo->prepare($querystring);
			$stmt->bindParam(':IDnr', $IDnr);
			$stmt->bindParam(':Tillverkat', $Tillverkat);
			$stmt->bindParam(':Farlighetstyp', $Farlighetstyp);
			$stmt->bindParam(':Inkopsplats', $Inkopsplats);
			$stmt->bindParam(':Vapentyp', $Vapentyp);
			$stmt->execute();
			$pdo->exec("DELETE FROM Vapen WHERE IDnr = ''");



			echo	"<table border='1'>";
			echo '<tr>';
			echo "<th>IDnr</th>";
			echo "<th>Tillverkat</th>";
			echo "<th>Farlighetstyp</th>";
			echo "<th>Inkopsplats</th>";
			echo "<th>Vapentyp</th>";
			echo '</tr>';

			foreach($pdo->query( 'SELECT * FROM Vapen ;' ) as $row){

				echo '<tr>';
				echo '<td>'.$row['IDnr'].'</td>';
				echo '<td>'.$row['Tillverkat'].'</td>';
				echo '<td>'.$row['Farlighetstyp'].'</td>';
				echo '<td>'.$row['Inkopsplats'].'</td>';
				echo '<td>'.$row['Vapentyp'].'</td>';
				echo '</tr>';








			}
			echo'</table>';

			?>
		</div>

		<div class="box 2">
			<?php
			$NamnErr = $NrErr = $BeskrivningErr = "";
			$Namn = $Nr = $Beskrivning = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{

				if (empty($_POST["Namn"]))
				{$NamnErr = "Namn is required";}
				else
				{$Namn = Agentvapen_input($_POST["Namn"]);}

				if (empty($_POST["Nr"]))
				{$NrErr = "Nr is required";}
				else
				{$Nr = Agentvapen_input($_POST["Nr"]);}

				if (empty($_POST["Beskrivning"]))
				{$BeskrivningErr = "Beskrivning Is required";}
				else
				{$Beskrivning = Agentvapen_input($_POST["Beskrivning"]);}

			}
			function Agentvapen_input($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			?>


			<form  name ="input"action="Vapen.php" method="post" id="Agentvapen"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
				<fieldset>
					<legend><label><h3>Agentvapen</h3></legend>
					<br><br><br><br>
					<label for="name"><b>IDnr:</b></label>
					<br>
					<br><br><br>
					<input type="text" name="Namn"/>*<span class="error"> <?php echo $NamnErr;?></span>
					<br>
					<br><br><br>
					<label for="name"><b>Nr:</b></label>
					<br><br><br><br>
					<input type="text" name="Nr"/>*<span class="error"> <?php echo $NrErr;?></span>
					<br><br><br><br>
					<label for="name"><b>Beskrivning:</b></label>
					<br><br><br><br>
					<input type="text" name="Beskrivning"/>*<span class="error"> <?php echo $BeskrivningErr;?></span>
					<br><br><br><br>

					<input type="submit"/>
				</fieldset>
			</form>
			<?php

			$pdo = new PDO('mysql:dbname=;host=', '', '');
			$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

			$querystring='INSERT INTO Agentvapen (Namn,Nr,Beskrivning) VALUES(:Namn,:Nr,:Beskrivning);';

			$stmt = $pdo->prepare($querystring);
			$stmt->bindParam(':Namn', $Namn);
			$stmt->bindParam(':Nr', $Nr);
			$stmt->bindParam(':Beskrivning', $Beskrivning);
			$stmt->execute();
			$pdo->exec("DELETE FROM Agentvapen WHERE Namn = ''");



			echo	"<table border='1'>";
			echo '<tr>';
			echo "<th>Namn</th>";
			echo "<th>Nr</th>";
			echo "<th>Beskrivning</th>";
			echo '</tr>';

			foreach($pdo->query( 'SELECT * FROM Agentvapen ;' ) as $row){

				echo '<tr>';
				echo '<td>'.$row['Namn'].'</td>';
				echo '<td>'.$row['Nr'].'</td>';
				echo '<td>'.$row['Beskrivning'].'</td>';
				echo '</tr>';








			}
			echo'</table>';

			?>
		</div>
	</div>
</div>
</body>
</html>