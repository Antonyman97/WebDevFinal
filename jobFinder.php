<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <title>Job Results</title>
  <meta charset="utf-8" />
  <meta name="Author" content="Anthony Rodrigues" />
  <meta name="generator" content="Notepad++" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="style.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script>
$(document).ready(function(){
  $("button").click(function(){
   $("#hero-text").fadeOut();
    $("#form-text").fadeIn();

  });
});
</script>


    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        /* Change the link color to #111 (black) on hover */
        li a:hover {
            background-color: #055857;
        }
    </style>


</head>
<body>

<ul>
    <li><a class="active" href="http://elvis.rowan.edu/~rodrig43/Final/Career_Finder_Index.php">Home</a></li>
    <!-- <li><a href="#about">About</a></li> -->
</ul>



<div class="job-image">
  
  <div id="found-text">
	
  
<table>
	<tr>
		<?php 

# jobFinder.php
# Takes input from jobForm.php and uses it to display jobs 
# M Henning

require_once('debughelp.php');
require_once('Connect.php');

echo "<!--\n";

echo $_SERVER['QUERY_STRING'] . "\n";

echo "-->\n";

#Check if any entry is blank
if( EMPTY(($_REQUEST['major']))){ 

    die("No input for Major.");
}

if( EMPTY(($_REQUEST['payment']))){ 

    die("No input for Payment.");
}

if( EMPTY(($_REQUEST['people']))){ 

    die("No input for working with others.");
}

if( EMPTY(($_REQUEST['travel']))){ 

    die("No input for Travel preference.");
}

if( EMPTY(($_REQUEST['weekends']))){

    die("No input for Weekend preference.");
}


# --- ----
echo "<tr>Your Test Answers:</tr>";

$dbh = ConnectDB();

# Get Major from Form
try {
    if ( $_REQUEST['major'] != -1){
        $query = "select code, title from majors where major_id = :major";
        $stmt=$dbh->prepare($query);
        $stmt->bindValue(':major', $_REQUEST['major']);
        $stmt->execute();
		$major_data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt = null;
    }
}
catch(PDOException $e)
{
    die ('PDO error adding major": ' . $e->getMessage() );
}

echo "<td>\n";

foreach ($major_data as $majorinfo) {
    echo "Major: ", $majorinfo->title, ' ', $majorinfo->code,
		 "\n";
	}

	
echo "</td></tr>\n";

# Show payment
if ( $_REQUEST['payment'] == 1)
{
echo "<tr>
		<td>Payment: Hourly<td>
	 </tr>";
	 
echo " ";
} else{
	
	echo "<tr>
		<td>Payment: Salary<td>
	 </tr>";
}

#Show People

if ( $_REQUEST['people'] == 1)
{
echo "<tr>
		<td>Likes to work with people.<td>
	 </tr>";
	 
echo " ";
} else{
	
echo "<tr>
		<td>Doesn't like to work with people<td>
	 </tr>";

}

# Display Travel

if ( $_REQUEST['travel'] == 1)
{
echo "<tr>
		<td>Likes to travel.<td>
	 </tr>";
	 
echo " ";
} else {
	
echo "<tr>
		<td>Doesn't like to travel.<td>
	 </tr>";
	 
echo " ";
	
}

# Display weekends

if ( $_REQUEST['weekends'] == 1)
{
echo "<tr>
		<td>Will work on weekends.<td>
	 </tr>";
	 
echo " ";
} else {
	
echo "<tr>
		<td>Would prefer to not work weekends.<td>
	 </tr>";
	 
echo " ";

}

# HOURLY 1
# SALARY 2

# YES 1 
# NO 2

# DISPLAY JOB INFORMATION BASED ON USER INPUT

try {
    if ( $_REQUEST['major'] != -1){
        $query = "select major_id, jobtitle, website, Location, req, company from jobs where major_id = :major and " .
				  "payment = :payment and people = :people and travel = :travel and weekends = :weekends";
        $stmt=$dbh->prepare($query);
        $stmt->bindValue(':major', $_REQUEST['major']);
		$stmt->bindValue(':payment', $_REQUEST['payment']);
		$stmt->bindValue(':people', $_REQUEST['people']);
		$stmt->bindValue(':travel', $_REQUEST['travel']);
		$stmt->bindValue(':weekends', $_REQUEST['weekends']);
        $stmt->execute();
		$job_data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt = null;
    }
}
catch(PDOException $e)
{
    die ('PDO error displaying job": ' . $e->getMessage() );
}

foreach ($job_data as $jobinfo) {
	
	echo "<td>";
    echo 'Suggested Job: ', $jobinfo->jobtitle, ' at ', $jobinfo->company, ' in ', $jobinfo->Location;
	echo "</td></tr>\n";
	echo "<tr>
			<td>", 'School Requirement: ', $jobinfo->req, ' ', "<a href='$jobinfo->website'>More info...</a>";
	echo "</td></tr>";
	echo "<tr></tr>";
	}
	
# CHECK IF ANY JOB MATCHED

if ( EMPTY($job_data)){
	
	echo "<tr>";
	echo "<td>No jobs were matched. Here are some suggestions:</td>";
	echo "</tr>";
	
	try {
    if ( $_REQUEST['major'] != -1){
        $query = "select major_id, jobtitle, Location, website, req, company from jobs where major_id = :major";
        $stmt=$dbh->prepare($query);
        $stmt->bindValue(':major', $_REQUEST['major']);
        $stmt->execute();
		$job_data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt = null;
    }
}
catch(PDOException $e)
{
    die ('PDO error displaying job: ' . $e->getMessage() );
}

foreach ($job_data as $jobinfo) {
	
	echo "<tr>";
    echo '<td>', $jobinfo->jobtitle, ' at ', $jobinfo->company, ' in ', $jobinfo->Location, ', ', 
		 'Requirement: ', $jobinfo->req, ' ', "<a href='$jobinfo->website'>More info...</a>", '</td>';
	echo "</tr>";
	echo "<tr></tr>";
}

}

# -- ID = 2 BIOINFORMATICS --
# -- ID = 3 BIOLOGICAL SCIENCE --
# -- ID = 4 BIOPHYSICS --
# -- ID = 5 CHEMISTRY --
# -- ID = 6 COMPUTER SCIENCE --
# -- ID = 7 COMPUTING AND INFORMATICS --
# -- ID = 8 MATHEMATICS --
# -- ID = 9 PHYSICS --
# -- ID = 10 PSYCHOLOGY --


#header('Location: ./jobDisplay.html');



?>
  
    </tr></table></div>



</div>



<div class = "footer">
 <a href="http://elvis.rowan.edu/~Rodrig43/" 
    title="Link to my home page">
    A. Rodrigues
 </a>

   , M.Henning, L.Oden, Howard Jones

    <span style="float: right;">


    <a href="http://validator.w3.org/check/referer">
        <img style="border:0;width:88px;height:31px"
            src="http://www.w3.org/Icons/valid-xhtml11"
            alt="Valid CSS!" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="Valid CSS!" />
    </a>
</span>
</div>





</body>


</html>
