<?php
$base_url = getenv('MWN_BASE_URL') ?: '/webnotepad4';
$save_path = getenv('MWN_SAVE_PATH') ?: '_notes';
$emtpy_str = "Now this is an empty notepad. 
Feel free to delete the content and use.

`https://n.xtqzcm.com/` : to create an empty notepad with random name
`https://n.xtqzcm.com/<anyname>` : to create a notepad named <anyname>
`https://n.xtqzcm.com/<name>` : to reconnect the notepad named <name>





--------------------------------------------------------------
				Privacy Warning:
  Anyone may access this page through the same url!
  (But you may use this feature to reconnect or share)
--------------------------------------------------------------
Powered by xtqzcm.com";

header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

function save($path, $text)
{
	file_put_contents($path, $text);
	if (!strlen($text)) {
		unlink($path);
	}
	return true;
}

if (isset($_GET['new'])) {
	$path_url = substr(str_shuffle('234579abcdefghjkmnpqrstwxyz'), -5);
	$path = $save_path . '/' . $path_url;
	$url = $base_url . '/' . $path_url;
	if (isset($_GET['text'])) {
		$text = $_GET['text'];
		if (save($path, $text)) {
			echo ("$url");
		}
		die;
	}
	if (isset($_POST['text'])) {
		$text = $_POST['text'];
		if (save($path, $text)) {
			echo ("$url");
		}
		die;
	}
}

if (!isset($_GET['note']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_GET['note']) || strlen($_GET['note']) > 64) {
	header("Location: $base_url/" . substr(str_shuffle('234579abcdefghjkmnpqrstwxyz'), -5));
	die;
}

$path = $save_path . '/' . $_GET['note'];
if (isset($_POST['text'])) {
	$text = $_POST['text'];
	if (save($path, $text)) {
		echo ("saved");
	}
	die;
}
if (isset($_GET['text'])) {
	$text = $_GET['text'];
	if (save($path, $text)) {
		echo ("saved");
	}
	die;
}
if (isset($_GET['raw'])) {
	if (is_file($path)) {
		echo (file_get_contents($path));
	} else {
		header('HTTP/1.0 404 Not Found');
	}
	die;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php print $_GET['note'];
			?></title>
	<link rel="shortcut icon" href="<?php print $base_url; ?>/favicon.ico">
	<link rel="stylesheet" href="<?php print $base_url; ?>/styles.css">
</head>

<body>
	<div class="container">
		<textarea id="content"><?php
								if (is_file($path)) {
									print htmlspecialchars(file_get_contents($path), ENT_QUOTES, 'UTF-8');
								}
								else{
									print $emtpy_str;
								}
								?></textarea>
	</div>
	<pre id="printable"></pre>
	<script src="<?php print $base_url; ?>/script.js"></script>
</body>

</html>