<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Pay Check</title>
  <link rel="stylesheet" href="includes/style.css" type="text/css" />
</head>
<?php
// Store form data if submitted
// Also make it sticky
if(count($_POST) == 4)
{
  // Store the input form data in variables
  $firstName = trim($_POST["firstName"]);
  $lastName = trim($_POST["lastName"]);
  $hoursWorked = (int) trim($_POST["hoursWorked"]);
  $hourlyRate= (float) trim($_POST["hourlyRate"]);
}
else
{
  // Create blank strings for sticky form
  $firstName = "";
  $lastName = "";
  $hoursWorked = "";
  $hourlyRate= "";
}
?>
<body>
  <h1>Paycheck Calculator</h1>
  <form method="post" action="#">
    <span><span>First Name:</span>
      <input type="text" name="firstName" id="firstName" value="<?php echo $firstName; ?>" />
      </span>
    <span><span>lastName:</span>
      <input type="text" name="lastName" id="lastName" value="<?php echo $lastName; ?>" />
      </span>
      <span><span>Hours worked:</span>
      <input type="text" name="hoursWorked" id="hoursWorked" value="<?php echo $hoursWorked; ?>" />
      </span>
      <span><span>Hourly Rate:</span>
      <input type="text" name="hourlyRate" id="hourlyRate" value="<?php echo $hourlyRate; ?>" /><br /><br />
    </span><br />
      <span><span><input type="submit" value="Calculate" /></span></span>
      </span>
  </form>
<?php
if(count($_POST) == 4)
{
  // Error flag
  $error = false;

  if(strlen($firstName) == 0)
  {
    echo "<p>You forgot to enter your First Name.<span></p>";
    $error = true;
  }

  if(strlen($lastName) == 0)
  {
    echo "<p>You forgot to enter your Last Name.</p>";
    $error = true;
  }

  if(strlen(trim($_POST["hoursWorked"])) == 0 || $hoursWorked < 0 || $hoursWorked > 80)
  {
    echo "<p>You must enter Hours Worked that is between 0.0 and 80.0.</p>";
    $error = true;
  }

  if(strlen(trim($_POST["hourlyRate"])) == 0 || $hourlyRate < 7.25 || $hourlyRate > 100)
  {
    echo "<p>You must enter an Hourly Rate that is between 7.25 and 100.0.</p>";
    $error = true;
  }

  if($error)
  {
    echo "<p>Please fill out the fields as required and submit again.</p>";
  }
  else
  {
    // No error so process the form
    // Fixed values;
    $FICA = 5.65;
    $stateTax = 5.75;
    $fedTax = 28.00;

    //calculate the output
    $overtimeHours = ($hoursWorked > 40) ? ($hoursWorked - 40) : 0;
    $regularHours = $hoursWorked - $overtimeHours;
    $regPay = $regularHours * $hourlyRate;
    $overtimePay = $overtimeHours * $hourlyRate * 1.5;
    $grossPay = $regPay + $overtimePay;
    $stateWithheld = $stateTax * $grossPay * 0.01;
    $fedWithheld = $fedTax * $grossPay * 0.01;
    $FICAwithheld = $FICA * $grossPay * 0.01;
    $totalTax = $FICAwithheld + $stateWithheld + $fedWithheld;
    $netPay = $grossPay - $totalTax;
    $formattedName = $firstName . ' ' . $lastName ;

    //format the numbers
    $hourlyRate = number_format($hourlyRate, 2);
    $regPay = number_format($regPay, 2);
    $overtimePay = number_format($overtimePay, 2);
    $grossPay = number_format($grossPay, 2);
    $FICA = number_format($FICA, 2);
    $FICAwithheld = number_format($FICAwithheld, 2);
    $stateTax = number_format($stateTax, 2);
    $stateWithheld = number_format($stateWithheld, 2);
    $fedTax = number_format($fedTax, 2);
    $fedWithheld = number_format($fedWithheld, 2);
    $totalTax = number_format($totalTax, 2);
    $netPay = number_format($netPay, 2);
  }

  if(!$error)
  {
  // Display the table using heredoc
      echo <<<EndOfTable
<table id="customers">
<tr>
  <th colspan="3">Paycheck Calculator</th>
</tr>
<tr>
<td>Employee Name</td>
<td>{$formattedName}</td>
</tr>
<tr class="alt">
<td>Regular Hours Worked (between 0 and 40)</td>
<td>{$regularHours}</td>
</tr>
<tr>
<td>Overtime Hours Worked (between 0 and 40)</td>
<td>{$overtimeHours}</td>
</tr>
<tr class="alt">
<td>Hourly Rate (between 0 and 99.99)</td>
<td>\${$hourlyRate}</td>
</tr>
<tr>
<td>Regular Pay</td>
<td>\${$regPay}</td>
</tr>
<tr class="alt">
<td>Overtime Pay</td>
<td>\${$overtimePay}</td>
</tr>
<tr>
<td>Gross Pay</td>
<td>\${$grossPay}</td>
</tr>
<tr class="alt">
<td>FICA Tax Rate (ex. 5.65)</td>
<td>{$FICA}%</td>
</tr>
<tr>
<td>FICA Taxes Withheld</td>
<td>\${$FICAwithheld}</td>
</tr>
<tr class="alt">
<td>State Tax Rate (ex. 5.75)</td>
<td>{$stateTax}%</td>
</tr>
<tr>
<td>State Taxes Withheld</td>
<td>\${$stateWithheld}</td>
</tr>
<tr class="alt">
<td>Federal Tax Rate (ex. 28.00)</td>
<td>{$fedTax}%</td>
</tr>
<tr>
<td>Federal Taxes Withheld</td>
<td>\${$fedWithheld}</td>
</tr>
<tr class="alt">
<td>Total Taxes</td>
<td>\${$totalTax}</td>
</tr>
<tr>
<td>Net Pay</td>
<td>\${$netPay}</td>
</tr>
</table>
EndOfTable;
  }
}
?>
</body>
</html>
