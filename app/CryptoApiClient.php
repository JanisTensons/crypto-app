<?php declare(strict_types=1);

namespace App;

use App\Models\CryptoList;
use GuzzleHttp\Client;

class CryptoApiClient
{
    private Client $client;
    private const API_KEY = '009d5718-b79e-456a-9dc9-9b678882c6e9';
    private \App\Models\CryptoList $cryptoList;

    public function __construct(\App\Models\CryptoList $cryptoList)
    {
        $this->client = new Client();
        $this->cryptoList = $cryptoList;
    }

    public function getData(string $currency, string $limit): CryptoList
    {
        $apiKey = self::API_KEY;
        $parameters = [
            'start' => '1',
            'limit' => $limit,
            'convert' => $currency
        ];
        $queryString = http_build_query($parameters);
        $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest";
        $request = "{$url}?{$queryString}&CMC_PRO_API_KEY={$apiKey}";
        $response = $this->client->request('GET', $request);
        $cryptoData = json_decode($response->getBody()->getContents());

        foreach ($cryptoData->data as $crypto) {
            $this->cryptoList->add(new \App\Models\Crypto(
                $crypto->cmc_rank,
                $crypto->name,
                $crypto->symbol,
                $crypto->quote->{$parameters['convert']}->price,
                $crypto->quote->{$parameters['convert']}->percent_change_7d,
                $crypto->quote->{$parameters['convert']}->market_cap
            ));
        }
        return $this->cryptoList;
    }
}