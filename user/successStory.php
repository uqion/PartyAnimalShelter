<?php
    /*Set up*/
    $servername = "localhost";
    $username = "animal";
    $password = "animal";
    $dbname = "partyanimal";
    // Create connections
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    //clear procedure
    function clearConnection($mysql){
        while($mysql->more_results()){
        $mysql->next_result();
        $mysql->use_result();
        }
    }
    //Start session
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="Icon.ico">
        <link rel="stylesheet" href="CSS.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="Script.js" type="text/javascript"></script>                    
        <title>PAS | Application</title>
    </head>
    <body>
       <center><img src="LOGO.png" alt="logo"></center>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="adoptable.php">Adoptable Animals</a></li>
                <li><a href="applicationHistory.php">Application History</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="successStory.php">Success Stories</a></li>
            </ul>
        </nav>
        <main class="succ">
        <?php
            //Create Table
            $result = $conn->query("call GetSuccess()");
            clearConnection($conn);            
            echo "<table>";
            while ($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                    echo "<td rowspan='2'><div><img src='images/animals/" . $row['ID'] . ".jpg'></div></td>";
                    echo "<td><div class='name'>" . $row['names'] . "</div></td>";
                    echo "<td><div class='story'>" . $row['story'] . "</div></td>";
                echo "</tr>";
            }
            echo "</table>";

            //Create div with success count
            $result1 = $conn->query("call GetNumberAdoptedEach()");
            clearConnection($conn);            
            echo "<div class='successBox'>";
            echo"<div id='succTitle'>Click For Adoption Count!</div>";            
            while ($row1 = mysqli_fetch_assoc($result1)){
                echo "<span class='succInfo'>".$row1['Species'].":&nbsp;&nbsp;&nbsp;</span>";
                echo "<span class='succInfo'>".$row1['Successfully_Adopted']."</span><br>";                
            }
            echo "</div>";
            ?>
        </main>
        <footer>
           <p>Party Animal Shelter &copy; | </p>
            <a href="references.html">References</a>
        </footer>
    </body>
</html>
    
