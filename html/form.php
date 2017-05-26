<?php


///////////////////////////////////////////////
// SECTION: 1 Initialize variables
//

// SECTION: 1a.
// variables for the classroom purposes to help find errors.
$debug = false;

if (isset($_GET["debug"])) { //only do this in a classroom environment
    $debug = true;
}
if ($debug)
    print "<p>DEBUG MODE IS ON</P>";



// SECTION: 1b Security
$yourURL = $domain . $phpSelf;


// SECTION: 1c form variables
$firstName = "";
$lastName = "";
$email = "";
$recipe = "";
$projectTime = "";
//check box choices
$beefStew = true;
$goulash = false;
$lasagna = false;
$casserole = false;
//comments
$comments = "";

// SECTION: 1d form error flags
$firstNameERROR = false;
$lastNameERROR = false;
$emailERROR = false;


// SECTION: 1e misc variables
$errorMsg = array();
// array used to hold form values that will be written to a CSV file
$dataRecord = array();

$mailed = false; // have we mailed the information to the user?
// SECTION: 2 Process for when the form is submitted


if (isset($_POST["btnSubmit"])) {
    // SECTION: 2a Security
    if (!securityCheck(true)) {
        $msg = "<p>Sorry you cannot access this page. ";
        $msg.= "Security breach detected and reported</p>";
        die($msg);
    }

    // SECTION: 2b Sanitize (clean) data
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;

    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lastName;

    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;

    $projectTime = htmlentities($_POST["radTime"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $projectTime;

    $comments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $comments;


    // SECTION: 2c Validation
    // First name error checks
    if ($firstName == "") {
        $errorMsg[] = "<h3>Please enter your first name</h3>";
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "<h3>Your first name appears to have extra characters.</h3>";
        $firstNameERROR = true;
    }
    //Last name error checks
    if ($lastName == "") {
        $errorMsg[] = "<h3>Please eneter your last name</h3>";
        $lastNameERROR = true;
    } elseif (!verifyAlphaNum($lastName)) {
        $errorMsg[] = "<h3>Your last name appears to have extra characters.</h3>";
        $lastNameERROR = true;
    }
    //Error checks for emails
    if ($email == "") {
        $errorMsg[] = "<h3>Please enter your email address</h3>";
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = "<h3>Your email address appears to be incorrect</h3>";
        $emailERROR = true;
    }
    //Drop down list box
    $recipe = htmlentities($_POST["lstJob"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $recipe;





    // SECTION: 2d Process Form - Passed Validation
    if (!$errorMsg) {
        if ($debug)
            print "<p>Form is valid</p>";
        // SECTION: 2e Save Data
        $fileExt = ".csv";

        $myFileName = "data/registration";

        $filename = $myFileName . $fileExt;

        if ($debug)
            print "\n\n<p>filename is " . $filename;

        // now we just open the file for append
        $file = fopen($filename, 'a');

        // write the forms informations
        fputcsv($file, $dataRecord);

        // close the file
        fclose($file);


        // SECTION: 2f Create message
        $message = '<h2>Review of your response!</h2>';
        foreach ($_POST as $key => $value) {
            if ($key != "btnSubmit") {
                $message .="<p>";
                $camelCase = preg_split('/(?=[A-Z])/', substr($key, 3));
                foreach ($camelCase as $one) {
                    $message .=$one . "";
                }
                $message .= "=" . htmlentities($value, ENT_QUOTES, "UTF-8") . "</p>";
            }
        }

        // SECTION: 2g Mail to user
        $to = $email; // the person who filled out the form
        $toMe = "lotoole37@gmail.com";
        $cc = "";
        $bcc = "";
        $from = "Liam O'Toole <noreply@yoursite.com>";

        // subject of mail should make sense to your form
        $todaysDate = strftime("%x");
        $subject = "Review of your project specs!: " . $todaysDate;

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
        $mailed = sendMail($toMe, $cc, $bcc, $from, $subject, $message);
    } //end if form is valid.
}// ends if form was submitted.
///////////////////////////////////////////////
// SECTION 3 Display Form
//
?>
<article id="main">


    <?php
//####################################
//
    // SECTION 3a.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) {
        print "<h1>Your request has ";
        if (!$mailed) {
            print "not ";
        }

        print "been processed</h1>";
        print "<p>A copy of this message has ";
        if (!$mailed) {
            print "not ";
        }
        print "been sent</p>";
        print "<p>To: " . $email . "</p>";
        print "<p>Mail Message:</p>";


        print $message;
    } else {
/////////////////////////////////////////
        // SECTION 3b Error Messages

        if ($errorMsg) {
            print '<div id="errors">';
            print "<ol>\n";
            foreach ($errorMsg as $err) {
                print "<li>" . $err . "</li>\n";
            }
            print "</ol>\n";
            print '</div>';
        }









        //####################################
        //
        // SECTION 3c html Form
        //
        /* Display the HTML form. note that the action is to this same page. $phpSelf
          is defined in top.php

         */
        ?>
        <div class="form-wrapper">
        <div class="get-in-touch">
          <h1>Get in touch</h1>
          <h3>Looking to discuss a project? Have any questions about my business? Feel free
          to conact me for anything!</h3>
        </div>

        <form action='<?php print $phpSelf; ?>'
              method='post'
              id='frmRegister'>
                <div class="float-left">
                      <label for="txtFirstName" class="required">First Name
                      </label>
                      <input type="text" id="txtFirstName" name="txtFirstName"
                             value="<?php print $firstName; ?>"
                             tabindex="100" maxlength="20" placeholder="Enter your first name"
                             <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                             onfocus="this.select()"
                             autofocus>
                </div>
               <div class="float-left">
                  <label for="txtLastName" id="move-right" class="required" >Last Name
                  </label>
                  <input for="txtLastName" id="txtLastName" name="txtLastName"
                         value="<?php print $lastName; ?>"
                         tabindex="100" maxlength="20" placeholder="Enter your last name"
                         <?php if ($lastNameERROR) print 'class="mistake"'; ?>
                         onfocus="this.select()"
                         >
               </div>
                    <div class="float-left">
                        <label for="txtEmail" id="nline" class="required">Email
                        </label>
                        <input type="text" id="txtEmail" name="txtEmail"
                               value="<?php print $email; ?>" placeholder="Enter your email"
                               tabindex="120" maxlength='45' <?php if ($emailERROR) print 'class="mistake"'; ?>
                               onfocus="this.select()"
                               >
                    </div>
            <div class="float-left text-on-top">
                    <label for="txtComments" class="required" id="topbox">Comments that will help me understand your project</label>
                    <textarea id="txtComments" name="txtComments" tabindex="200"
                    <?php if ($emailERROR) print 'class="mistake"'; ?>
                              onfocus="this.select()"
                               ><?php print $comments; ?></textarea>
                    <!-- NOTE: no blank spaces inside the text area -->
            </div>
            <div class="form-button-wrap">
            <input type="submit" id="btnSubmit" name="btnSubmit" value="Register" tabindex="900" class="button">
          </div>
        </form>
        </div>
        <?php
    }
    ?>
</article>
