<?php
function errorLog($message)
{
	error_log ( $message . "\n", $message_type = 3, "error.log");
}
?>