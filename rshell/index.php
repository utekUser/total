<?php
echo time() . "<br>";
shell_exec('php /opt/web/sites/total/total/application/zfcli.php -a update > /dev/null 2>/dev/null &');
echo time() . "<br>";
