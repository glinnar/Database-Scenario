<?php error_reporting(0); ?>
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
            <li><a href="#">Agent</a></li>
            <li><a href="Alien.php">Alien</a></li>
            <li><a href="Vapen.php">Vapen</a></li>
            <li><a href="Skepp.php">Skepp</a></li>
            <li><a href="#">Delete</a></li>
        </ul>
    </div>
    <div id="innehall">
        Vänligen välj formulär: <select id="dropdown" name='dropdownFar'  >
            <option>--- Välj Typ ---</option>
            <option value="1">Faltagent</option>
            <option value="2">Gruppledare</option>
            <option value="3">Handledare</option>
            <option value="4">Desinformatör</option>
        </select>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="box 1">
            <?php
            $FnamnErr = $FnrErr = $KompetensErr= $SpecialitetErr = $AntaloperationerErr =$LyckadeoperationerErr = $LonErr =$UrsprungsnamnErr =  "";
            $Fnamn = $Fnr = $Kompetens= $Specialitet = $Antaloperationer = $Lyckadeoperationer = $Lon =$Ursprungsnamn = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {

                if (empty($_POST["Fnamn"]))
                {$FnamnErr = "Namn is required";}
                else
                {$Fnamn = Faltagent_input($_POST["Fnamn"]);}

                if (empty($_POST["Fnr"]))
                {$FnrErr = "Nr is required";}
                else
                {$Fnr = Faltagent_input($_POST["Fnr"]);}

                if (empty($_POST["Kompetens"]))
                {$KompetensErr = "Kompetens is required";}
                else
                {$Kompetens = Faltagent_input($_POST["Kompetens"]);}

                if (empty($_POST["Specialitet"]))
                {$SpecialitetErr = "Specialitet Is required";}
                else
                {$Specialitet = Faltagent_input($_POST["Specialitet"]);}

                if (empty($_POST["Antaloperationer"]))
                {$AntaloperationerErr = "Antaloperationer is required";}
                else
                {$Antaloperationer = Faltagent_input($_POST["Antaloperationer"]);}

                if (empty($_POST["Lyckadeoperationer"]))
                {$LyckadeoperationerErr = "Lyckadeoperationer is required";}
                else
                {$Lyckadeoperationer = Faltagent_input($_POST["Lyckadeoperationer"]);}

                if (empty($_POST["Lon"]))
                {$LonErr = "Lon is required";}
                else
                {$Lon = Faltagent_input($_POST["Lon"]);}

                if (empty($_POST["Ursprungsnamn"]))

                {$UrsprungsnamnErr= "Ursprungsnamn is required";}
                else
                {$Ursprungsnamn = Faltagent_input($_POST["Ursprungsnamn"]);}
            }
            function Faltagent_input($ksdata)
            {
                $data = trim($ksdata);
                $data = stripslashes($ksdata);
                $data = htmlspecialchars($ksdata);
                return $data;
            }
            ?>
            <form action="Agent.php" method="post" id="Faltagent"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                <fieldset>
                    <legend><h3>Faltagent</h3></legend>
                    <br><br><br><br>
                    <label for="name"><b>Namn:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Fnamn"/>*<span class="error"> <?php echo $FnamnErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Nr:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Fnr"/>*<span class="error"> <?php echo $FnrErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Kompetens:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Kompetens"/>*<span class="error"> <?php echo $KompetensErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Specialitet:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Specialitet"/>*<span class="error"> <?php echo $SpecialitetErr;?></span>
                    <br><br>
                    <label for="name"><b>Antaloperationer:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Antaloperationer" />*<span class="error"> <?php echo $AntaloperationerErr;?></span>
                    <br><br><br><br><br>
                    <label for="name"><b>Lyckadeoperationer:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Lyckadeoperationer" />*<span class="error"> <?php echo $LyckadeoperationerErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Lon:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Lon" />*<span class="error"> <?php echo $LonErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Ursprungsnamn:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Ursprungsnamn" />*<span class="error"> <?php echo $UrsprungsnamnErr;?></span>
                    <br><br><br><br>
                    <input type="submit" />
                </fieldset>
            </form>

            <?php

            $pdo = new PDO('mysql:dbname=;host=', 'dbname', 'password');
            $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

            $querystring='INSERT INTO Faltagent (Fnamn,Fnr,Kompetens,Specialitet,Antaloperationer,Lyckadeoperationer,Lon,Ursprungsnamn) 
			  VALUES(:Fnamn,:Fnr,:Kompetens,:Specialitet,:Antaloperationer,:Lyckadeoperationer,:Lon,:Ursprungsnamn);';

            $stmt = $pdo->prepare($querystring);
            $stmt->bindParam(':Fnamn', $Fnamn);
            $stmt->bindParam(':Fnr', $Fnr);
            $stmt->bindParam(':Kompetens', $Kompetens);
            $stmt->bindParam(':Specialitet', $Specialitet);
            $stmt->bindParam(':Antaloperationer', $Antaloperationer);
            $stmt->bindParam(':Lyckadeoperationer', $Lyckadeoperationer);
            $stmt->bindParam(':Lon', $Lon);
            $stmt->bindParam(':Ursprungsnamn', $Ursprungsnamn);
            $stmt->execute();
            $pdo->exec("DELETE FROM Faltagent WHERE Antaloperationer = '0' and Lyckadeoperationer ='0' and Lon='0'");

            echo	"<table border='1'>";
            echo '<tr>';
            echo "<th>Namn</th>";
            echo "<th>Nr</th>";
            echo "<th>Kompetens</th>";
            echo "<th>Specialitet</th>";
            echo "<th>Antaloperationer</th>";
            echo "<th>Lyckadeoperationer</th>";
            echo "<th>Lon</th>";
            echo "<th>Ursprungsnamn</th>";
            echo '</tr>';

            foreach($pdo->query( 'SELECT * FROM Faltagent ;' ) as $row){

                echo "<tr>
					<td>".$row['Fnamn']."</td>                                                                                                                                                                                                                                            
					<td>".$row['Fnr']."</td>
					<td>".$row['Kompetens']."</td> 
					<td>".$row['Specialitet']."</td>       
					<td>".$row['Antaloperationer']."</td>
					<td>".$row['Lyckadeoperationer']."</td>
					<td>".$row['Lon']."</td>
					<td>".$row['Ursprungsnamn']."</td> 
					
			<td> 
			
			<form action='Agent.php' method='POST'> 
				<input type='hidden' name='deleteAgent' value='{$row['ID']}'>  
				<input type='submit' Value='Delete'>  
			</form>
		</td>                                                                                                                
	</tr>";

                if($_POST['deleteAgent']){

                    $pdo->exec("DELETE FROM Faltagent WHERE ID = '{$_POST['deleteAgent']}' ") or die(mysql_error());

                    echo"<script language='javascript' type='text/javascript'>
			     	window.location='Agent.php?p=Faltagent';
			 	</script>";
                }
            }
            echo '</table>';
            ?>
        </div>
        <div class="box 2">
            <?php
            $GnamnErr = $GnrErr = $AoperationerErr =$LoperationerErr =$LonErr =$UrsprungsnamnErr =  "";
            $Gnamn = $Gnr = $Aoperationer = $Loperationer =$Lon = $Ursprungsnamn =  "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["Gnamn"]))
                {$GnamnErr = "Namn is required";}
                else
                {$Gnamn = Gruppledare_input($_POST["Gnamn"]);}

                if (empty($_POST["Gnr"]))
                {$GnrErr = "Nr is required";}
                else
                {$Gnr = Gruppledare_input($_POST["Gnr"]);}

                if (empty($_POST["Aoperationer"]))
                {$AoperationerErr = "Antaloperationer is required";}
                else
                {$Aoperationer = Gruppledare_input($_POST["Aoperationer"]);}

                if (empty($_POST["Loperationer"]))
                {$LoperationerErr = "Lyckadeoperationer is required";}
                else
                {$Loperationer = Gruppledare_input($_POST["Loperationer"]);}

                if (empty($_POST["Lon"]))
                {$LonErr = "Lon is required";}
                else
                {$Lon = Gruppledare_input($_POST["Loperationer"]);}

                if (empty($_POST["Ursprungsnamn"]))
                {$UrsprungsnamnErr = "Ursprungsnamn is required";}
                else
                {$Ursprungsnamn = Gruppledare_input($_POST["Ursprungsnamn"]);}

            }
            function Gruppledare_input($Gdata)
            {
                $data = trim($Gdata);
                $data = stripslashes($Gdata);
                $data = htmlspecialchars($Gdata);
                return $data;
            }

            ?>
            <form action="Agent.php" method="post" id="Gruppchef"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                <fieldset>
                    <legend><h3>Gruppledare</h3></legend>
                    <br><br><br><br><br>
                    <label for="name"><b>Namn:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Gnamn"/>*<span class="error"> <?php echo $GnamnErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Nr:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Gnr"/>*<span class="error"> <?php echo $GnrErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Antaloperationer:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Aoperationer" />*<span class="error"> <?php echo $AoperationerErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Lyckadeoperationer:</b></label>
                    <br><br><br><br><br>
                    <input type="text" name="Loperationer" />*<span class="error"> <?php echo $LoperationerErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Lon:</b></label>
                    <br><br><br><br><br>
                    <input type="text" name="Lon" />*<span class="error"> <?php echo $LonErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Ursprungsnamn:</b></label>
                    <br><br><br><br><br>
                    <input type="text" name="Ursprungsnamn" />*<span class="error"> <?php echo $UrsprungsnamnErr;?></span>
                    <br><br><br><br>
                    <input type="submit" />
                </fieldset>
            </form>

            <?php
            $pdo = new PDO('mysql:dbname=;host=', '', '');
            $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

            $querystring='INSERT INTO Gruppledare (Gnamn,Gnr,Aoperationer,Loperationer,Lon,Ursprungsnamn) 
			  VALUES(:Gnamn,:Gnr,:Aoperationer,:Loperationer,:Lon,:Ursprungsnamn);';

            $stmt = $pdo->prepare($querystring);
            $stmt->bindParam(':Gnamn', $Gnamn);
            $stmt->bindParam(':Gnr', $Gnr);
            $stmt->bindParam(':Aoperationer', $Aoperationer);
            $stmt->bindParam(':Loperationer', $Loperationer);
            $stmt->bindParam(':Lon', $Lon);
            $stmt->bindParam(':Ursprungsnamn', $Ursprungsnamn);
            $stmt->execute();
            $pdo->exec("DELETE FROM Gruppledare WHERE Aoperationer = '0' and Loperationer ='0' and Lon ='0'");

            echo	"<table border='1'>";
            echo '<tr>';
            echo "<th>Namn</th>";
            echo "<th>Nr</th>";
            echo "<th>Antaloperationer</th>";
            echo "<th>Lyckadeoperationer</th>";
            echo "<th>Lon</th>";
            echo "<th>Ursprungsnamn</th>";
            echo '</tr>';

            foreach($pdo->query( 'SELECT * FROM Gruppledare ;' ) as $row){

                echo '<tr>';
                echo '<td>'.$row['Gnamn'].'</td>';
                echo '<td>'.$row['Gnr'].'</td>';
                echo '<td>'.$row['Aoperationer'].'</td>';
                echo '<td>'.$row['Loperationer'].'</td>';
                echo '<td>'.$row['Lon'].'</td>';
                echo '<td>'.$row['Ursprungsnamn'].'</td>';
                echo '</tr>';
            }
            echo '</table>';
            ?>
        </div>

        <div class="box 4">

            <?php
            $HnamnErr = $HnrErr =$IncidentErr =$ObservationerErr =$OperationerErr = $LonErr =$UrsprungsnamnErr ="";
            $Hnamn = $Hnr =$Incident =$Observationer = $Operationer =$Lon =$Ursprungsnamn = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["Hnamn"]))
                {$HnamnErr = "Namn is required";}
                else
                {$Hnamn = Handledare_input($_POST["Hnamn"]);}

                if (empty($_POST["Hnr"]))
                {$HnrErr = "Nr is required";}
                else
                {$Hnr = Handledare_input($_POST["Hnr"]);}

                if (empty($_POST["Incident"]))
                {$IncidentErr = "Incident is required";}
                else
                {$Incident = Handledare_input($_POST["Incident"]);}

                if (empty($_POST["Observationer"]))
                {$ObservationerErr = "Observationer is required";}
                else
                {$Observationer = Handledare_input($_POST["Observationer"]);}

                if (empty($_POST["Operationer"]))
                {$OperationerErr = "Operationer is required";}
                else
                {$Operationer = Handledare_input($_POST["Oerationer"]);}

                if (empty($_POST["Lon"]))
                {$LonErr = "Lon is required";}
                else
                {$Lon = Handledare_input($_POST["Lon"]);}

                if (empty($_POST["Ursprungsnamn"]))
                {$UrsprungsnamnErr = "Ursprungsnamn is required";}
                else
                {$Ursprungsnamn = Handledare_input($_POST["Ursprungsnamn"]);}
            }
            function Handledare_input($Hdata)
            {
                $data = trim($Hdata);
                $data = stripslashes($Hdata);
                $data = htmlspecialchars($Hdata);
                return $data;
            }

            ?>

            <form action="Agent.php" method="post" id="Handledare"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                <fieldset>
                    <legend><h3>Handledare</h3></legend>
                    <br><br><br><br><br>
                    <label for="name"><b>Namn:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Hnamn"/>*<span class="error"> <?php echo $HnamnErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Nr:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Hnr"/>*<span class="error"> <?php echo $HnrErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Incident:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Incident"/>*<span class="error"> <?php echo $IncidentErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Observationer:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Observationer" />*<span class="error"> <?php echo $ObservationerErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Operationer:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Operationer" />*<span class="error"> <?php echo $OperationerErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Lon:</b></label>
                    <br><br><br><br><br>
                    <input type="text" name="Lon" />*<span class="error"> <?php echo $LonErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Ursprungsnamn:</b></label>
                    <br><br><br><br><br>
                    <input type="text" name="Ursprungsnamn" />*<span class="error"> <?php echo $UrsprungsnamnErr;?></span>
                    <br><br><br><br>
                    <input type="submit" />
                </fieldset>
            </form>

            <?php

            $pdo = new PDO('mysql:dbname=;host=', '', '');
            $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

            $querystring='INSERT INTO Handledare (Hnamn,Hnr,Incident,Observationer,Operationer,Lon,Ursprungsnamn) 
			  VALUES(:Hnamn,:Hnr,:Incident,:Observationer,:Operationer,:Lon,:Ursprungsnamn);';

            $stmt = $pdo->prepare($querystring);
            $stmt->bindParam(':Hnamn', $Hnamn);
            $stmt->bindParam(':Hnr', $Hnr);
            $stmt->bindParam(':Incident',$Incident);
            $stmt->bindParam(':Observationer', $Observationer);
            $stmt->bindParam(':Operationer', $Operationer);
            $stmt->bindParam(':Lon', $Lon);
            $stmt->bindParam(':Ursprungsnamn', $Ursprungsnamn);
            $stmt->execute();
            $pdo->exec("DELETE FROM Handledare WHERE Incident = '0' and Observationer ='0' and Operationer ='0' and Lon ='0'");

            echo	"<table border='1'>";
            echo '<tr>';
            echo "<th>Namn</th>";
            echo "<th>Nr</th>";
            echo "<th>Incident</th>";
            echo "<th>Observationer</th>";
            echo "<th>Operationer</th>";
            echo "<th>Lon</th>";
            echo "<th>Ursprungsnamn</th>";
            echo "<th>Rate</th>";
            echo '</tr>';

            foreach($pdo->query( 'SELECT * FROM Handledare ;' ) as $row){
                echo '<tr>';
                echo '<td>'.$row['Hnamn'].'</td>';
                echo '<td>'.$row['Hnr'].'</td>';
                echo '<td>'.$row['Incident'].'</td>';
                echo '<td>'.$row['Observationer'].'</td>';
                echo '<td>'.$row['Operationer'].'</td>';
                echo '<td>'.$row['Lon'].'</td>';
                echo '<td>'.$row['Ursprungsnamn'].'</td>';
                echo '</tr>';
            }
            echo '</table>';
            ?>
        </div>

        <div class="box 5">
            <?php
            $DnamnErr = $DnrErr =$SpecialiterErr =$AntalkampanjerErr =$LonErr = $UrsprungsnamnErr =  "";
            $Dnamn = $Dnr =$Specialiter =$Antalkampanjer =$Lon = $Ursprungsnamn =  "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["Dnamn"]))
                {$DnamnErr = "Namn is required";}
                else
                {$Dnamn = testas_input($_POST["Dnamn"]);}

                if (empty($_POST["Dnr"]))
                {$DnrErr = "Nr is required";}
                else
                {$Dnr = testas_input($_POST["Dnr"]);}

                if (empty($_POST["Specialiter"]))
                {$SpecialiterErr = "Specialiter is required";}
                else
                {$Specialiter = testas_input($_POST["Specialiter"]);}

                if (empty($_POST["Antalkampanjer"]))
                {$AntalkampanjerErr = "Antalkampanjer is required";}
                else
                {$Antalkampanjer = testas_input($_POST["Antalkampanjer"]);}
            }
            function Desinformation_input($Ddata)
            {
                $data = trim($Ddata);
                $data = stripslashes($Ddata);
                $data = htmlspecialchars($Ddata);
                return $data;
            }

            ?>
            <form action="Agent.php" method="post" id="Desinformatör"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                <fieldset>
                    <legend><h3>Desinformatör</h3></legend>
                    <br><br><br><br><br>
                    <label for="name"><b>Namn:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Dnamn"/>*<span class="error"> <?php echo $DnamnErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Nr:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Dnr"/>*<span class="error"> <?php echo $DnrErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Specialiter:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Specialiter"/>*<span class="error"> <?php echo $SpecialiterErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Antalkampanjer:</b></label>
                    <br><br><br><br>
                    <input type="text" name="Antalkampanjer" />*<span class="error"> <?php echo $AntalkampanjerErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Lon:</b></label>
                    <br><br><br><br><br>
                    <input type="text" name="Lon" />*<span class="error"> <?php echo $LonErr;?></span>
                    <br><br><br><br>
                    <label for="name"><b>Ursprungsnamn:</b></label>
                    <br><br><br><br><br>
                    <input type="text" name="Ursprungsnamn" />*<span class="error"> <?php echo $UrsprungsnamnErr;?></span>
                    <br><br><br><br>
                    <input type="submit" />
                </fieldset>
            </form>

            <?php
            $pdo = new PDO('mysql:dbname=;host=', '', '');
            $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

            $querystring='INSERT INTO Desinformation (Dnamn,Dnr,Specialiter,Antalkampanjer,Lon,Ursprungsnamn) 
			  VALUES(:Dnamn,:Dnr,:Specialiter,:Antalkampanjer,:Lon,:Ursprungsnamn);';
            $stmt = $pdo->prepare($querystring);
            $stmt->bindParam(':Dnamn', $Dnamn);
            $stmt->bindParam(':Dnr', $Dnr);
            $stmt->bindParam(':Specialiter',$Specialiter);
            $stmt->bindParam(':Antalkampanjer', $Antalkampanjer);
            $stmt->bindParam(':Lon', $Lon);
            $stmt->bindParam(':Ursprungsnamn', $Ursprungsnamn);
            $stmt->execute();
            $pdo->exec("DELETE FROM Desinformation WHERE Antalkampanjer = '0' and Lon='0'");
            echo	"<table border='1'>";
            echo '<tr>';
            echo "<th>Namn</th>";
            echo "<th>Nr</th>";
            echo "<th>Specialiter</th>";
            echo "<th>Antalkampanjer</th>";
            echo "<th>Lon</th>";
            echo "<th>Ursprungsnamn</th>";
            echo '</tr>';

            foreach($pdo->query( 'SELECT * FROM Desinformation ;' ) as $row){

                echo '<tr>';
                echo '<td>'.$row['Dnamn'].'</td>';
                echo '<td>'.$row['Dnr'].'</td>';
                echo '<td>'.$row['Specialiter'].'</td>';
                echo '<td>'.$row['Antalkampanjer'].'</td>';
                echo '<td>'.$row['Lon'].'</td>';
                echo '<td>'.$row['Ursprungsnamn'].'</td>';
                echo '</tr>';

            }
            echo '</table>';
            ?>
        </div>
    </div>
</div>
</body>
</html>