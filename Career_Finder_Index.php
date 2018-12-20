<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <title>Job Finder</title>
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
  

</head>
<body>

<div class="form-image">
  <div id="hero-text">
    <h1 style="font-size:50px">Find a Job thats right for you!</h1>
    <button>Try it</button>
  </div>
  
  <div id="form-text">
	<h1> What do you want in a job?</h1>
	
  
	<table>
	<tr>
		<td>Use the dropdown to select a STEM Major:</td>
		<td><?php 

# jobForm.php

# M Henning

require_once('debughelp.php');
require_once('Connect.php');

echo "<!--\n";

echo $_SERVER['QUERY_STRING'] . "\n";

echo "-->\n";

$dbh = ConnectDB();

echo "<form action='jobFinder.php'>\n";

try {
	$query = "select major_id, title, code from majors;";
	$stmt = $dbh->prepare($query);
	$stmt->execute();
	$major_data = $stmt->fetchAll(PDO::FETCH_OBJ);
	$stmt = null;
}
catch(PDOException $e)
{
	die ('PDO error fetching major": ' . $e->getMessage());
}

#start of the MAJOR select dropdown, tag for adding to list
echo "<select name='major'>\n";

#puts an option at the top of the dropdown
echo "<option value='-1'>Select a Major...</option>";

foreach ($major_data as $majorinfo) {
    echo "<option value='" . $majorinfo->major_id . "'> 
		 $majorinfo->title $majorinfo->code </option>\n";
} 

echo "</select>\n";


#header('Location: ./majorForm.html');

?></td>	
	</tr>
	<tr>
		<td>Hourly or Salary?</td>
		<td><input type="radio" name="payment" id="hourly" value="1" title="Hourly"/>  <label for="hourly">Hourly </label>
		<input type="radio" name="payment" id="salary" value="2" title="Salary"/>  <label for="salary">Salary </label></td>
	</tr>
	<tr>
		<td>Do you like working with other people?</td>
		<td><input type="radio" name="people" id="people_yes" value="1" title="Yes"/>  <label for="people_yes">Yes </label>
		<input type="radio" name="people" id="people_no" value="2" title="No"/>  <label for="people_no">No </label></td>
	</tr>
	<tr>
		<td>Do you like to travel?</td>
		<td><input type="radio" name="travel" id="travel_yes" value="1" title="Yes"/>  <label for="travel_yes">Yes </label>
		<input type="radio" name="travel" id="travel_no" value="2" title="No"/>  <label for="travel_no">No </label></td>
	</tr>
	<tr>
		<td>Are you ok with working on weekends?</td>
		<td><input type="radio" name="weekends" id="weekends_yes" value="1" title="Yes"/>  <label for="weekends_yes">Yes </label>
		<input type="radio" name="weekends" id="weekends_no" value="2" title="No"/>  <label for="weekends_no">No </label></td>
	</tr>
</table>

<input type='submit' value="Find your Job!"/>

</form>

  
  </div>
  
  
  
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
