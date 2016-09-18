<html>
<head>
	<link href="mall.css" rel="stylesheet" type="text/css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="wrapper">
	<div id="meny">
		<ul>
			<li><a href="Agent.php">Agent</a></li>
			<li><a href="Alien.php">Alien</a></li>
			<li><a href="Vapen.php">Vapen</a></li>
			<li><a href="#">Skepp</a></li>
			<li><a href="#">Delete</a></li>
		</ul>
	</div>
	<div id="innehall">
		<?php
		$SkeppIDErr = $KanneteckenErr = $SittplatserErr = $TillverkatErr = "";
		$SkeppID = $Kannetecken = $Sittplatser = $Tillverkat = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["SkeppID"]))
			{$SkeppIDErr = "SkeppID is required";}
			else
			{$SkeppID = Skepp_input($_POST["SkeppID"]);}

			if (empty($_POST["Kannetecken"]))
			{$KanneteckenErr = "Kannetecken is required";}
			else
			{$Kannetecken = Skepp_input($_POST["Kannetecken"]);}

			if (empty($_POST["Sittplatser"]))
			{$SittplatserErr = "Sittplatser Is required";}
			else
			{$Sittplatser = Skepp_input($_POST["Sittplatser"]);}

			if (empty($_POST["Tillverkat"]))
			{$TillverkatErr = "Tillverkat is required";}
			else
			{$Tillverkat = Skepp_input($_POST["Tillverkat"]);}
		}
		function Skepp_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		?>
		<form  name ="input"action="Skepp.php" method="post" id="Skepp"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
			<fieldset>
				<legend><label><h3>Skepp</h3></legend>
				<br><br><br><br><br><br>
				<label for="name"><b>SkeppID:</b></label>
				<br><br><br><br>
				<input type="text" name="SkeppID"/>*<span class="error"> <?php echo $SkeppIDErr;?></span>
				<br>
				<br><br><br>
				<label for="name"><b>Kannetecken:</b></label>
				<br><br><br><br>
				<input type="text" name="Kannetecken"/>*<span class="error"> <?php echo $KanneteckenErr;?></span>
				<br><br><br><br>
				<label for="name"><b>Sittplatser:</b></label>
				<br><br><br><br>
				<input type="text" name="Sittplatser"/>*<span class="error"> <?php echo $SittplatserErr;?></span>
				<br><br><br><br>
				<label for="name"><b>Tillverkar:</b></label>
				<br><br><br><br>
				<input type="text" name="Tillverkat" />*<span class="error"> <?php echo $TillverkatErr;?></span>
				<br>
				<br><br><br>
				<input type="submit"/>
			</fieldset>
		</form>
		<?php
		$pdo = new PDO('mysql:dbname=;host=', '', '');
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

		$querystring='INSERT INTO Skepp (SkeppID,Kannetecken,Sittplatser,Tillverkat) VALUES(:SkeppID,:Kannetecken,:Sittplatser,:Tillverkat);';
		$stmt = $pdo->prepare($querystring);
		$stmt->bindParam(':SkeppID', $SkeppID);
		$stmt->bindParam(':Kannetecken', $Kannetecken);
		$stmt->bindParam(':Sittplatser', $Sittplatser);
		$stmt->bindParam(':Tillverkat' ,$Tillverkat);
		$stmt->execute();
		$pdo->exec("DELETE FROM Skepp WHERE SkeppID = ''");

		echo	"<table border='1'>";
		echo '<tr>';
		echo "<th>SkeppID</th>";
		echo "<th>Kannetecken</th>";
		echo "<th>Sittplatser</th>";
		echo "<th>Tillverkat</th>";
		echo '</tr>';

		foreach($pdo->query( 'SELECT * FROM Skepp ;' ) as $row){

			echo '<tr>';
			echo '<td>'.$row['SkeppID'].'</td>';
			echo '<td>'.$row['Kannetecken'].'</td>';
			echo '<td>'.$row['Sittplatser'].'</td>';
			echo '<td>'.$row['Tillverkat'].'</td>';
			echo '</tr>';
		}
		echo'</table>';
		?>
	</div>
</div>
</body>
</html>