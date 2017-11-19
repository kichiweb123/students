<?php
header("Content-type: text/html; charset=utf-8");
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Retry-After: 300');
echo "сайт временно недоступен, вот контакты администратора example@mail.ru";
?>