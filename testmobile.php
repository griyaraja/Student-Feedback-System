<?php
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
/*
	// Use the function
if(isMobile())
{
    // Do something for only mobile users
	echo "Mobile Phone";
}
else
{
    // Do something for only desktop users
	echo "Desk top";
}
*/
?>