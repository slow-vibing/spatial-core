<?php

declare(strict_types=1);

namespace App\SpatialCore\Contracts;

/**
 * Public Contract for High-Performance SQLite R-Tree Spatial Query Engine.
 */
interface SpatialStoreInterface
{
    /**
     * Checks if the underlying SQLite spatial database file exists and is readable.
     *
     * @return bool
     */
    public function isAvailable(): bool;

    /**
     * Searches spatial features whose bounding boxes intersect with a query radius around [lat, lng].
     *
     * @param float $lat Search latitude
     * @param float $lng Search longitude
     * @param float $radiusMeters Search radius in meters
     * @return array<array<string, mixed>> Raw matched candidate records
     */
    public function searchCandidates(float $lat, float $lng, float $radiusMeters): array;
}
