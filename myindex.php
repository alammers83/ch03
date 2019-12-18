<?php # Script 3.7 - index.php #2

// This function outputs theoretical HTML
// for adding ads to a Web page.
function create_ad() {
	echo '<p class="ad">AD!!</p>';
} // End of the function definition.

$page_title = 'Welcome to this Site!';
include ('includes/myheader.html');

// Call the function:
create_ad();
?>

<h1>Welcome to my ITP225 site!</h1>

	<p>This is my main page. Click on the links in the navigation bar above to see some of my work or links about the PHP programming language.</p>

	<p>Learning PHP, like any programming language can best be summed up by these quotes:</p>
<p>"The three great essentials to achieve anything worthwhile are, first, hard work, second, stick-to-itiveness; third, common sense." Thomas Edison</p>
<p>"There are no shortcuts to any place worth going." Beverly Sills "Don't wish it were easier. Wish you were better." Jim Rohn</p>
<p>"I was a Computer Science major. I got out once it got really hard. I made it up to C++. Then I couldn't do the math – it got really confusing. I switched to Communications, which is a ridiculous major – let's be honest," Jimmy Fallon.</p>

<?php

// Call the function again:
create_ad();

include ('includes/myfooter.html');
?>