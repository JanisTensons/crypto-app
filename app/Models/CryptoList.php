<?php declare(strict_types=1);

namespace App\Models;

class CryptoList
{
    private array $cryptos = [];

    public function add(Crypto $crypto): void
    {
        $this->cryptos[] = $crypto;
    }

    public function getCryptos(): array
    {
        return $this->cryptos;
    }
}