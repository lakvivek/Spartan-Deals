<?php
function get_data($url)
{
    $curl = curl_init();
    $timeout = 5;
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

$content = get_data('http://www.lvivek.com/prod_market_place.php');
echo $content;
$rows = json_decode($content, true);

print_r($rows);

foreach ($rows as $row ) {
    print 'row id is: ' . $row[ProductId];
    echo '<br /> <hr>';
}
?>