<?php declare(strict_types=1);

namespace App\Models;

class Crypto
{
    private int $rank;
    private string $name;
    private string $symbol;
    private float $price;
    private float $change7d;
    private float $marketCap;

    public function __construct(
        int    $rank,
        string $name,
        string $symbol,
        float  $price,
        float  $change7d,
        float  $marketCap
    )

    {
        $this->rank = $rank;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->price = $price;
        $this->change7d = $change7d;
        $this->marketCap = $marketCap;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getChange7d(): float
    {
        return $this->change7d;
    }

    public function getMarketCap(): float
    {
        return $this->marketCap;
    }
}