<?php declare(strict_types=1);

use App\Models\Crypto;

require_once 'vendor/autoload.php';

echo "---------------------------------\n";
echo "          CRYPTO REPORT          \n";
echo "---------------------------------\n";

$currency = strtoupper(readline('Currency (ex.EUR): '));
$limit = readline('Limit: ');
echo PHP_EOL;

$cryptoList = new \App\Models\CryptoList();
$apiClient = new \App\CryptoApiClient($cryptoList);
$cryptoData = $apiClient->getData($currency, $limit);

foreach ($cryptoData->getCryptos() as $crypto) {
    /** @var Crypto $crypto */
    echo " Rank: {$crypto->getRank()}\n";
    echo " Name: {$crypto->getName()}\n";
    echo " Symbol: {$crypto->getSymbol()}\n";
    echo " Price: $currency " . number_format($crypto->getPrice(), 2) . "\n";

    if (round($crypto->getChange7d(), 2) >= 0) {
        echo " Change 7d(%): \033[92m" . round($crypto->getChange7d(), 2) . "\033[0m\n";
    } else echo " Change 7d(%): \033[91m" . round($crypto->getChange7d(), 2) . "\033[0m\n";

    echo " Market Cap: $currency " . number_format($crypto->getMarketCap(), 2) . "\n\n";
}
