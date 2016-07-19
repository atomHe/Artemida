<?php

// Получаем из запроса имя исходного файла
$in = 'css/artemida.less';
// Файл результата будет в той же папке
// и с тем же именем, но с расширением .css
$out = pathinfo($in);
$out = 'css/artemida.css';

// Сюда поместим код CSS
$style = "";

// Проверка наличия и актуальности кэша
if(!is_file($out) || filemtime($in) > filemtime($out)) {
	require_once("lessc.inc.php");
	$lc = new lessc($in);
	try {
		$style = $lc->parse();
	} catch (exception $ex) {
		print "LESSC FEHLER:";
		print $ex->getMessage();
		exit;
	}
	file_put_contents($out,$style);
}
else {
	$style = file_get_contents($out);
}