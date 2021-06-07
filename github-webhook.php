<?php

// Download web page from GitHub.
// Web-Hook to be called by GitHub.

// We want to see errors. There is nothing confidential in here.
ini_set("display_errors", 1);

// Open file for writing
$fp = fopen("index.html", "c");

// Try to obtain exclusive lock
if (!flock($fp, LOCK_EX)) {
	throw new Exception("Could not lock file.");
} else {
	// Download file
	$ch = curl_init("https://raw.githubusercontent.com/hacklschorsch/flosse.works/main/index.html?token=AADO7TPAZBZX4LCVC4FA73LAXXPCI");
	curl_setopt($ch, CURLOPT_FILE, $fp); 
	curl_exec($ch);

	flock($fp, LOCK_UN); // release the lock
}

fclose($fp);

echo "OK."

?>
