<?php 
require __DIR__ . '/vendor/autoload.php';

 use \Dompdf\Dompdf;

$dompdf = new Dompdf();

$html = '<html><body><p>Hello, world!</p></body></html>';
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('output.pdf'); //html to pdf  code