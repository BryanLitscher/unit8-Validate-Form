
<?php // Check if form was submitted:
require 'formvalidation.php';
$formStatus = "";
$errMessages = array();

$name = $phonenumber = $email= $registrationtype = $badgeholder = $fridaydinner = $saturdaylunch = $sundayawardbrunch = $specialrequests = "" ;


if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {

	
	
	$formData = $_POST;

	//trim whitespace from sides of values in tests array
	foreach($formData as $x=>$y){
		$formData[$x] =trim($y);
	}
	//remove default registration type
	if(isset($formData["registrationtype"]) && $formData["registrationtype"]=="none" ){
		unset($formData["registrationtype"]);
	}
	//set groups that are validated together
	$elementGroups = array(
		"badgeholder"=> array("badgeholder"),
		"registrationtype" => array("registrationtype")
		);
		
	//create object
	$a = new validator($formData);
	$a->setElementGroups($elementGroups);
	if ( $a->validateForm() ){ 
		$formStatus = "Successful Form Submission";
		$formData= array();
	}else{
		$formStatus = "Form Submission Failure";
		$errMessages = $a->getErrorMessages();
	}

} ?>



<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP - Self Posting Form</title>

	<style>
		#orderArea	{
			width:600px;
			border:thin solid black;
			margin: auto auto;
			padding-left: 20px;
		}

		#orderArea h3	{
			text-align:center;	
		}
		.error	{
			color:red;
			font-style:italic;	
		}	
	
	</style>
</head>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>Unit-8 - Form Validation Assignment</h2>


<div id="orderArea">
<!--<form name="form3" method="post" action="">-->
<form method="POST">  
   <h3>Customer Registration Form</h3>
	<p><?php echo $formStatus ?></p>

      <p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $formData["name"]??"" ?>">
		<p class="error"><?php echo $errMessages["name"]??""; ?></p>
      </p>
      <p>
        <label for="phonenumber">Phone Number:</label>
        <input type="text" name="phonenumber" id="phonenumber" value="<?php  echo $formData["phonenumber"]??""  ?>">
		<p class="error"><?php echo $errMessages["phonenumber"]??""; ?></p>
      </p>
      <p>
        <label for="email">Email Address: </label>
        <input type="text" name="email" id="email" value="<?php   echo $formData["email"]??""  ?>">
		<p class="error"><?php echo $errMessages["email"]??""; ?></p>
      </p>
      <p>
        <label for="registrationtype">Registration: </label>
        <select name="registrationtype" id="select">
			<?php 
			
			?>
          <option value="none" >Choose Type</option>
          <option value="attendee" <?php echo ($formData["registrationtype"]??"")==="attendee"?"selected":""; ?>>Attendee</option>
          <option value="presenter" <?php echo ($formData["registrationtype"]??"")==="presenter"?"selected":""; ?>>Presenter</option>
          <option value="volunteer" <?php echo ($formData["registrationtype"]??"")==="volunteer"?"selected":""; ?>>Volunteer</option>
          <option value="guest" <?php echo ($formData["registrationtype"]??"")==="guest"?"selected":""; ?>>Guest</option>
        </select>
		  <p class="error"><?php echo $errMessages["registrationtype"]??""; ?></p>
      </p>
      <p>Badge Holder:</p>
      <p>
        <input type="radio" name="badgeholder" id="clip" value="clip" <?php echo ($formData["badgeholder"]??"")==="clip"?"checked":""; ?>>
        <label for="clip">Clip</label> <br>
        <input type="radio" name="badgeholder" id="lanyard" value="lanyard" <?php echo ($formData["badgeholder"]??"")==="lanyard"?"checked":""; ?>>
        <label for="lanyard">Lanyard</label> <br>
        <input type="radio" name="badgeholder" id="magnet" value="magnet" <?php echo ($formData["badgeholder"]??"")==="magnet"?"checked":""; ?>>
        <label for="magnet">Magnet</label>
		<p class="error"><?php echo $errMessages["badgeholder"]??""; ?></p>
      </p>
      <p>Provided Meals (Select all that apply):</p>
      <p>
        <input type="checkbox" name="fridaydinner" id="fridaydinner" <?php echo ($formData["fridaydinner"]??"")?"checked":""; ?>>
        <label for="fridaydinner">Friday Dinner</label><br>
        <input type="checkbox" name="saturdaylunch" id="saturdaylunch" <?php echo ($formData["saturdaylunch"]??"")?"checked":""; ?>>
        <label for="saturdaylunch">Saturday Lunch</label><br>
        <input type="checkbox" name="sundayawardbrunch" id="sundayawardbrunch" <?php echo ($formData["sundayawardbrunch"]??"")?"checked":""; ?>>
        <label for="sundayawardbrunch">Sunday Award Brunch</label>
      </p>
      <p>
        <label for="specialrequests">Special Requests/Requirements: (Limit 200 characters)<br>
        </label>
        <textarea name="specialrequests" cols="40" rows="5" id="specialrequests"><?php echo ($formData["specialrequests"]??"") ?></textarea>
		<p class="error"><?php echo $errMessages["specialrequests"]??""; ?></p>
      </p>
   
  <p>
    <input type="submit" name="submit" id="submit" value="Submit">
    <input type="reset" name="button4" id="button4" value="Reset">
  </p>
</form>




</div>

</body>
</html>

