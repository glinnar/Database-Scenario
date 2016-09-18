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
            <li><a href="#">Alien</a></li>
            <li><a href="Vapen.php">Vapen</a></li>
            <li><a href="Skepp.php">Skepp</a></li>
            <li><a href="#">Delete</a></li>
        </ul>
    </div>
    <div id="innehall">
        <?php
        $IDkodErr = $pnrErr = $AnamnErr = $PlanetErr = $RasErr = $KanneteckenErr =
        $FarlighetsgradErr ="";

        $IDkod = $pnr = $Anamn = $Planet = $Ras = $Kannetecken =$Farlighetsgrad = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["IDkod"]))
            {$IDkodErr = "IDkod is required";}
            else
            {$IDkod = ALien_input($_POST["IDkod"]);}

            if (empty($_POST["pnr"]))
            {$pnrErr = "pnr is required";}
            else
            {$pnr = Alien_input($_POST["pnr"]);}

            if (empty($_POST["Anamn"]))
            {$AnamnErr = "Namn Is required";}
            else
            {$Anamn = Alien_input($_POST["Anamn"]);}

            if (empty($_POST["Planet"]))
            {$PlanetErr = "Planet is required";}
            else
            {$Planet = Alien_input($_POST["Planet"]);}

            if (empty($_POST["Ras"]))
            {$RasErr = "Ras is required";}
            else
            {$Ras = Alien_input($_POST["Ras"]);}

            if (empty($_POST["Kannetecken"]))
            {$KanneteckenErr = "Kannetecken is required";}
            else
            {$Kannetecken = Alien_input($_POST["Kannetecken"]);}

            if (empty($_POST["Farlighetsgrad"]))
            {$FarlighetsgradErr = "Farlighetsgrad is required";}
            else
            {$Farlighetsgrad = Alien_input($_POST["Farlighetsgrad"]);}
        }
        function Alien_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <form  name ="input"action="Alien.php" method="post" id="Alien"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
            <fieldset>
                <legend><label><h3>Alien</h3></legend>
                <br><br><br><br>
                <label for="name"><b>IDkod:</b></label>
                <br><br><br><br>
                <input type="text" name="IDkod"/>*<span class="error"> <?php echo $IDkodErr;?></span>
                <br>
                <br><br><br>
                <label for="name"><b>pnr:</b></label>
                <br><br><br><br>
                <input type="text" name="pnr"/>*<span class="error"> <?php echo $pnrErr;?></span>
                <br><br><br><br>
                <label for="name"><b>Namn:</b></label>
                <br><br><br><br>
                <input type="text" name="Anamn"/>*<span class="error"> <?php echo $AnamnErr;?></span>
                <br><br><br><br>
                <label for="name"><b>Planet:</b></label>
                <br><br><br><br>
                <input type="text" name="Planet" />*<span class="error"> <?php echo $PlanetErr;?></span>
                <br>
                <br><br><br>
                <label for="name"><b>Ras:</b></label>
                <br><br><br><br>
                <input type="text" name="Ras" />*<span class="error"> <?php echo $RasErr;?></span>
                <br>
                <br><br><br>
                <label for="name"><b>Kannetecken:</b></label>
                <br><br><br><br>
                <input type="text" name="Kannetecken" />*<span class="error"> <?php echo $KanneteckenErr;?></span>
                <br>
                <br><br><br>
                <label for="name"><b>Farlighetsgrad:</b></label>
                <br><br><br><br>
                <input type="text" name="Farlighetsgrad" />*<span class="error"> <?php echo $FarlighetsgradErr;?></span>
                <br>
                <br><br><br>
                <input type="submit"/>
            </fieldset>
        </form>
        <?php
        $pdo = new PDO('mysql:dbname=;host=', '', '');
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

        $querystring='INSERT INTO Alien (IDkod,pnr,Anamn,Planet,Ras,Kannetecken,Farlighetsgrad) 
		VALUES(:IDkod,:pnr,:Anamn,:Planet,:Ras,:Kannetecken,:Farlighetsgrad);';

        $stmt = $pdo->prepare($querystring);
        $stmt->bindParam(':IDkod', $IDkod);
        $stmt->bindParam(':pnr', $pnr);
        $stmt->bindParam(':Anamn', $Anamn);
        $stmt->bindParam(':Planet',$Planet);
        $stmt->bindParam(':Ras',$Ras);
        $stmt->bindParam(':Kannetecken',$Kannetecken);
        $stmt->bindParam(':Farlighetsgrad',$Farlighetsgrad);
        $stmt->execute();
        $pdo->exec("DELETE FROM Alien WHERE IDkod = ''");
        ?>
        <form  action="" method="post" >
            <input type="text" name="Ursprungsnamn" />
            <input type="submit" name="seartchbutton"/>
        </form>
        <?php
        if(isset($_POST['Ursprungsnamn']) && ($_POST['Ursprungsnamn'] != "" )){

            $seartch = $_POST['Ursprungsnamn'];

            echo	"<table border='1'>";
            echo '<tr>';
            echo "<th>IDkod</th>";
            echo "<th>pnr</th>";
            echo "<th>Anamn</th>";
            echo "<th>Planet</th>";
            echo "<th>Ras</th>";
            echo "<th>Kannetecken</th>";
            echo "<th>Farlighetsgrad</th>";
            echo '</tr>';

            foreach($pdo->query( "SELECT * FROM Alien where Planet LIKE '%$seartch%'") as $row){

                echo '<tr>';
                echo '<td>'.$row['IDkod'].'</td>';
                echo '<td>'.$row['pnr'].'</td>';
                echo '<td>'.$row['Anamn'].'</td>';
                echo '<td>'.$row['Planet'].'</td>';
                echo '<td>'.$row['Ras'].'</td>';
                echo '<td>'.$row['Kannetecken'].'</td>';
                echo '<td>'.$row['Farlighetsgrad'].'</td>';
                echo '</tr>';
            }
            echo'</table>';
        }
        if(!isset($_POST['Ursprungsnamn'])){
            echo	"<table border='1'>";
            echo '<tr>';
            echo "<th>IDkod</th>";
            echo "<th>pnr</th>";
            echo "<th>Anamn</th>";
            echo "<th>Planet</th>";
            echo "<th>Ras</th>";
            echo "<th>Kannetecken</th>";
            echo "<th>Farlighetsgrad</th>";
            echo '</tr>';

            foreach($pdo->query( "SELECT * FROM Alien") as $row){

                echo '<tr>';
                echo '<td>'.$row['IDkod'].'</td>';
                echo '<td>'.$row['pnr'].'</td>';
                echo '<td>'.$row['Anamn'].'</td>';
                echo '<td>'.$row['Planet'].'</td>';
                echo '<td>'.$row['Ras'].'</td>';
                echo '<td>'.$row['Kannetecken'].'</td>';
                echo '<td>'.$row['Farlighetsgrad'].'</td>';
                echo '</tr>';
            }
            echo'</table>';
        }

        ?>
    </div>
</div>
</body>
</html>