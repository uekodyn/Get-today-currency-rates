<?php

$x = simplexml_load_file ( "https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml?5105e8233f9433cf70ac379d6ccc5775" );

function getRateEuro($symbol,$xml) {     
  $xml->registerXPathNamespace("ecb", "http://www.ecb.int/vocabulary/2002-08-01/eurofxref");
  $array = $xml->xpath("//ecb:Cube[@currency='".$symbol."']/@rate");
  $rate = (string) $array[0]['rate'];
  return $rate;
} 


  $hoje = date('d/m/Y');

$stringDate = $hoje;

echo "1 EUR = " . getRateEuro('USD',$x) . " USD\n";
echo "file with today's currency rates generated in CSV";


$headers = ['Currency Code', 'Rate'];
$list = array (
  array ( 'USD',  getRateEuro('USD',$x))
);

$delimitador = ';';

$file = fopen ("usd_currency_rates_{date}.csv", 'w');

fputcsv($file, $headers, $delimitador);

/*looping through the set of values and writing to the file*/
foreach ($list as $row) {
  fputcsv($file, $row, $delimitador);
}

fclose($file);


?>