<?php

declare(strict_types=1);

namespace GildedRose;

interface UpdateQualityStrategy
{
    public function updateQuality(Item $item): void;
}

class DefaultUpdateQualityStrategy implements UpdateQualityStrategy
{
    public function updateQuality(Item $item): void
    {
        if ($item->quality > 0) {
            $item->quality = $item->quality - 1;
        }
    }
}

class AgedBrieUpdateQualityStrategy implements UpdateQualityStrategy
{
    public function updateQuality(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }
    }
}

class BackstagePassesUpdateQualityStrategy implements UpdateQualityStrategy
{
    public function updateQuality(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
            if ($item->sellIn < 11 && $item->quality < 50) {
                $item->quality = $item->quality + 1;
            }
        }
    }
}

final class GildedRose
{
    private array $updateQualityStrategies;

    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
        $this->updateQualityStrategies = [
            'Aged Brie' => new AgedBrieUpdateQualityStrategy(),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePassesUpdateQualityStrategy(),
            'default' => new DefaultUpdateQualityStrategy(),
        ];
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $strategy = $this->updateQualityStrategies[$item->name] ?? $this->updateQualityStrategies['default'];
            $strategy->updateQuality($item);
        }
    }
}