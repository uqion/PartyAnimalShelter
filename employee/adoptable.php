<?php
//Start session
session_start();

$result='';
if(isset($_POST['search'])){
        if ($_POST['Species'] == 'All' && $_POST['Age'] == 'All' && $_POST['Temp'] == 'All' && $_POST['House'] == 'All' && $_POST['Sex'] == 'All' && $_POST['InLoc'] == 'All' && $_POST['InCon'] == 'All' && $_POST['app'] == 'All') {
            $sql = "SELECT * FROM animal_and_med_info";
            $result = filterTable($sql);
        }else{
            $sChoice=$_POST['Species'];
            $aChoice=$_POST['Age'];   
            $tChoice=$_POST['Temp'];               
            $hChoice=$_POST['House'];               
            $sexChoice=$_POST['Sex'];
            $inLocChoice=$_POST['InLoc'];               
            $inConChoice=$_POST['InCon'];               
            $appChoice=$_POST['app'];                          
            $count=0;     
            $sql = "SELECT * FROM animal_and_med_info WHERE";
            if($sChoice != 'All'){
                $count++;
                $sql=$sql. " Species = '" .$sChoice. "'";
            }
            if($_POST['Age']!= 'All'){
                if($count !=0){
                    $sql=$sql. " AND Age = '" .$aChoice. "'";                
                }else{
                    $sql=$sql. " Age = '" .$aChoice. "'";
                }
                $count++;                
            }
            if($_POST['Temp']!= 'All'){
                if($count !=0){
                    $sql=$sql. " AND Temperament = '" .$tChoice. "'";                
                }else{
                    $sql=$sql. " Temperament = '" .$tChoice. "'";
                }
                $count++;                
            }
            if($_POST['House']!= 'All'){
                if($count !=0){
                    $sql=$sql. " AND Housebroken = '" .$hChoice. "'";                
                }else{
                    $sql=$sql. " Housebroken = '" .$hChoice. "'";
                }
                $count++;                
            }
            if($_POST['Sex']!= 'All'){
                if($count !=0){
                    $sql=$sql. " AND Sex = '" .$sexChoice. "'";                
                }else{
                    $sql=$sql. " Sex = '" .$sexChoice. "'";
                }
                $count++;                                
            }
            if($_POST['InCon']!= 'All'){
                if($count !=0){
                    $sql=$sql. " AND Intake_Condition = '" .$inConChoice. "'";                
                }else{
                    $sql=$sql. " Intake_Condition = '" .$inConChoice. "'";
                }
                $count++;                                
            }
            if($_POST['InLoc']!= 'All'){
                if($count !=0){
                    $sql=$sql. " AND Intake_Location = '" .$inLocChoice. "'";                
                }else{
                    $sql=$sql. " Intake_Location = '" .$inLocChoice. "'";
                }
                $count++;                                
            }
            if($_POST['app'] !='All'){
                if($count !=0){
                    $sql=$sql. " AND Application_Status = '" .$appChoice. "'";                
                }else{
                    $sql=$sql. " Application_Status = '" .$appChoice. "'";
                }
            }
            //echo $sql;
            $result = filterTable($sql);
        }        
}else {
    $sql = "SELECT * FROM animal_and_med_info";
    $result = filterTable($sql);
}
                
// function to connect and execute the query
function filterTable($sql){
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

    $filterResult = mysqli_query($conn, $sql);
    return $filterResult;
}
                
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PAS | Animals</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS.css">
        <link rel="icon" href="Icon.ico">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="Script.js" type="text/javascript"></script>                    
    </head>

    <body>
        <center><img src="LOGO.png" alt="logo"></center>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="adoptable.php">Animals</a></li>
                <li><a href="editApplications.php">Applications</a></li>
                <li><a href="editAnimals.php">Animal Profiles</a></li> 
                <?php    
                // Create connections
                $servername = "localhost";
                $username = "animal";
                $password = "animal";
                $dbname = "partyanimal";
                // Create connections
                $conn = new mysqli($servername, $username, $password, $dbname);

                $email =  $_SESSION['email'];
                $sql1 = "SELECT EmpID FROM employees WHERE Email = '$email'";
                $result1 = mysqli_query($conn,$sql1);
                $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
                if($row1['EmpID'] == 1) {
                    echo "<li><a href='staff.php'>Staff</a></li>";
                }
                ?>              
            </ul>
        </nav>
        <main class=adoptable>  
        
<form action="adoptable.php" method="post" class="form">
    <div class="searchOption">    
        <span>Type: </span>
        <select name="Species">
            <option value="All">All</option>
            <option value="Cat">Cat</option>
            <option value="Dog">Dog</option>
            <option value="Rabbit">Rabbit</option>
            <option value="Chinchilla">Chinchilla</option>
            <option value="Lovebird">Lovebird</option>
            <option value="Parrot">Parrot</option> 
        </select>
    </div>
    <div class="searchOption">
        <span>Age: </span>
        <select name="Age">
            <option value="All">All</option>
            <option value="Juvenile">Juvenile</option>
            <option value="Young Adult">Young Adult</option>
            <option value="Adult">Adult</option>
            <option value="Senior">Senior</option>
        </select>
    </div>
    <div class="searchOption">
        <span>Temperament: </span>
        <select name="Temp">
            <option value="All">All</option>
            <option value="Silent Companion">Silent Companion</option>
            <option value="Hidden Gem">Hidden Gem</option>
            <option value="Gatorade">Gatorade</option>
            <option value="Secret Agent">Secret Agent</option>
            <option value="Mac Daddy">Mac Daddy</option>
        </select>
    </div>
    <div class="searchOption">
        <span>Housebroken: </span>
        <select name="House">
            <option value="All">All</option>
            <option value="Y">Yes</option>
            <option value="N">No</option>
        </select>
    </div>
    <div class="searchOption">
        <span>Sex: </span>
        <select name="Sex">
            <option value="All">All</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>
    </div>
    <div class="searchOption">
        <span>Intake Condition: </span>
        <select name="InCon">
            <option value="All">All</option>
            <option value="domst">Domesticated</option>
            <option value="abusd">Abused</option>
            <option value="surnd">Surrendered</option>
            <option value="stray">Stray</option>
            <option value="feral">Feral</option>
        </select>
    </div>
    <div class="searchOption">
        <span>Intake Location: </span>
        <select name="InLoc">
            <option value="All">All</option>
            <option value="RCAS Cat Sanctuary">RCAS Cat Sanctuary</option>
            <option value="RCAS">RCAS</option>
            <option value="DCAS">DCAS</option>
            <option value="West Van Sanctuary">West Van Sanctuary</option>
            <option value="Party Animal Rescue">Party Animal Rescue</option>
        </select>
    </div>
    <div class="searchOption">
        <span>Application Status: </span>
        <select name="app">
            <option value="All">All</option>
            <option value="No Applicants">No Applicants</option>
            <option value="Pending">Pending</option>
            <option value="Adopted">Adopted</option>
        </select>
    </div>
    <br><button class="submit" type="submit" name="search">Search</button>
    </form>
        <?php
                //Create Table          
                echo "<table id='animalTable'>";
                if(mysqli_num_rows($result)==0){
                    echo"<div class=noResults>We don't have the animals you are looking for. Try a different search.</div>";
                    echo "<img src='images/error.jpg' alt='error cat'>";
                    echo "<style>.click{display:none;}</style>";
                } 
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                        echo "<td><div><img src='images/animals/" . $row['AnimalID'] . ".jpg'></div></td>";
                        echo "<td>
                                    <span>
                                    <strong><a href= 'editAnimals.php?id=" . $row['AnimalID'] ."'>ID: </strong>" . $row['AnimalID'] . "</a>
                                    <strong>Name: </strong>" . $row['Name']. 
                                    "  <strong>Species: </strong>" . $row['Species']. 
                                    "  <strong>Breed: </strong>" . $row['Breed']. "
                                    </span><br>
                                    <span>
                                    <strong>Sex: </strong>" . $row['Sex']. 
                                    "  <strong>Age: </strong>" . $row['Age']. 
                                    "  <span class='vetEmp'><strong>Weight: </strong>" . $row['Weight']. "</span>
                                    </span><br>
                                    <span><strong>Application Status: </strong>" . $row['Application_Status']. "</span><br>
                                    <span>
                                    <strong>Housebroken: </strong>" . $row['Housebroken']. 
                                    "  <strong>Temperament: </strong>" . $row['Temperament']. "
                                    </span></br>
                                    <span>
                                    <strong>Intake Date: </strong>" . $row['Intake_Date'].
                                    "  <span class='vetEmp'><strong>Intake Condition: </strong>" . $row['Intake_Condition']. "</span>                                    
                                       <span class='vetEmp'><strong>Intake Location: </strong>" . $row['Intake_Location']. "</span>
                                    </span></br>";
                                    echo  "<button class='showMore'>Medical</button>";
                                    echo "<div class='med'>";                                  
                                        if(!empty($row['Animal'])){
                                            echo "<span><strong>Vet ID: </strong>" . $row['VID']. 
                                            "  <strong>Last Checkup: </strong>" . $row['Last_Checkup']."</span></br>
                                            <span><strong>Vaccinated: </strong>" . $row['Vaccinated']. 
                                            "  <strong>Decalwed: </strong>" . $row['Declawed']. 
                                            "  <strong>Special Needs: </strong>"; 
                                            if (empty($row['Special_Needs'])){
                                                echo "none";
                                            }else{
                                                echo $row['Special_Needs'];
                                            } 
                                            echo "</span></br>
                                            <span><strong>Pregnant: </strong>" . $row['Pregnant']. 
                                            "  <strong>Offspring: </strong>" . $row['Offspring']. "</span></br>
                                            <span><strong>Taggged: </strong>" . $row['Tagged']. 
                                            "  <strong>Tag ID: </strong>";
                                            if (empty($row['Tag_ID'])){
                                                echo "none";
                                            }else{
                                                echo $row['Tag_ID'];
                                            } 
                                            echo "</span></br>
                                            <span><strong>Parasites: </strong>";
                                            if (empty($row['Parasites'])){
                                                echo "none";
                                            }else{
                                                echo $row['Parasites'];
                                            } 
                                            echo "  <strong>Major Illness: </strong>";
                                            if (empty($row['Major_Illness'])){
                                                echo "none";
                                            }else{
                                                echo $row['Major_Illness'];
                                            } 
                                            echo "  <strong>Spayed or Neutered: </strong>" . $row['Spay_Neut']. "</span>
                                            <br>";                                        
                                        }else{
                                            echo "No medical record available";
                                        }
                                
                                    echo "<div><br>";
                        echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<button class='click'>Show More</button>";
                ?>
        </main>
        <footer>
            <p>Party Animal Shelter &copy; | </p>
            <a href="references.html">References</a>
        </footer>
    </body>
</html>