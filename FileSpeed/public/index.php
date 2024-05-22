<head>
	<title>FileSpeed</title>
	<link href="index.css" rel="stylesheet">
</head>
<?php include("header.php"); ?>
	<article>
		<p id="openquote"><i>Need to quickly share a file with others but cant decide which website to use?</i></p>
		<p id="openannounce">The answer is simple:<br /><a id="fsspecial">FileSpeed</a></p>
		<p>Because after all...<br />... we are Just another file sharing website.</p>
		<?php echo '<p>Currently hosting <a class="redtext">'.count(glob("./uploads/" . "*")).'</a> uploaded file(s).</p>'; ?>
	</article>
<?php include("footer.php"); ?>