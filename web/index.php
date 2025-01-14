<?php
$stdout = fopen('php://stdout', 'w');
fwrite($stdout, "This should be writing to to STDOUT!!!\n");
fclose($stdout);
?>
<html>
<head><title>Hello World!</title></head>
<body>
<h1>STDOUT Test</h1>
<p>Should have written to STDOUT</p>
</body>
</html>
