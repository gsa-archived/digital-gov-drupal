<?php
$stdout = fopen('php://stdout', 'w');
fwrite($stdout, "This should be writing to to STDOUT update 1!!!\n");
fclose($stdout);
?>
<html>
<head><title>Hello World update 1!</title></head>
<body>
<h1>STDOUT Test</h1>
<p>Should have written to STDOUT</p>
</body>
</html>
