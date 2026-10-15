<?php

declare(strict_types=1);

namespace App\SpatialCore\Contracts;

/**
 * Public Contract for Administrative District Naming & Standardization.
 */
interface AreaNormalizerInterface
{
    /**
     * Normalizes raw district name by stripping prefixes/suffixes,
     * non-alphabetic noise, and excessive whitespace.
     *
     * @param string|null $rawName Raw district string (e.g. "District District1", "Sub-district Subdistrict1")
     * @return string Title-cased normalized string (e.g. "District1", "Subdistrict1")
     */
    public function normalize(?string $rawName): string;

    /**
     * Converts normalized district name to a file/URL-safe snake_case slug
     * matching quadrant JSON file naming (e.g. "district_one", "district_two").
     *
     * @param string|null $rawName
     * @return string
     */
    public function toSlug(?string $rawName): string;

    /**
     * Converts to uppercase uppercase format matching database lookup keys.
     *
     * @param string|null $rawName
     * @return string
     */
    public function toUpper(?string $rawName): string;
}
