<?php

$ip=isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:null;

$link = new mysqli('103.228.29.233', 'a0602084441', '76805947', 'a0602084441');

$sql = "insert into pv values(null, $ip, now());";

$link->query($sql);

// $link->close;

?>