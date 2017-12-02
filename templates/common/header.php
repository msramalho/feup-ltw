<!DOCTYPE html>
<html lang="<?= $PAGE["lang"] ?>">
<head>
	<title><?= $PAGE["title"] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php foreach ($PAGE["styles"] as $style) : ?>
		<link href="<?= $PAGE["cssFolder"] . $style ?>" rel="stylesheet">
	<?php endforeach; ?>

	<?php foreach ($PAGE["scripts"] as $scriptName) : ?>
		<script type="text/javascript" src="<?= $PAGE["jsFolder"] . $scriptName ?>" defer></script>
	<?php endforeach; ?>

</head>
<?php
	if ($PAGE["includeCSRF"])
		echo "<body data-csrf='" . $_SESSION["csrf"] . "'>";
	else
		echo "<body>";
?>