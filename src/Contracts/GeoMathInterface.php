<?php

declare(strict_types=1);

namespace App\SpatialCore\Contracts;

/**
 * Public Contract for High-Performance Spherical & Spatial Calculations.
 *
 * Keep this interface file UNENCRYPTED so consumer IDEs have full autocompletion,
 * while the concrete implementation in src/Spatial/GeoMath.php is protected/licensed.
 */
interface GeoMathInterface
{
    /**
     * Computes the great-circle distance between two points on a sphere in meters using the Haversine formula.
     *
     * @param float $lat1 Latitude of origin point in degrees
     * @param float $lng1 Longitude of origin point in degrees
     * @param float $lat2 Latitude of destination point in degrees
     * @param float $lng2 Longitude of destination point in degrees
     * @return float Distance in meters
     */
    public function haversineMeters(float $lat1, float $lng1, float $lat2, float $lng2): float;

    /**
     * Determines whether a coordinate point [lng, lat] lies inside a 2D polygon ring
     * using the Jordan Curve (Ray-Casting) theorem.
     *
     * @param float $lng Point longitude (X coordinate)
     * @param float $lat Point latitude (Y coordinate)
     * @param array<array<float>> $ring Array of [lng, lat] coordinate pairs
     * @return bool True if point is inside ring
     */
    public function pointInRing(float $lng, float $lat, array $ring): bool;

    /**
     * Checks if a point lies within an outer polygon boundary and outside any inner exclusion holes.
     *
     * @param float $lng Point longitude
     * @param float $lat Point latitude
     * @param array<array<float>> $outerCoords Exterior ring coordinate pairs
     * @param array<array<array<float>>>|null $innerHoles Optional array of interior hole rings
     * @return bool True if inside outer boundary and outside all holes
     */
    public function pointInPolygon(float $lng, float $lat, array $outerCoords, ?array $innerHoles = null): bool;

    /**
     * Calculates the shortest orthogonal distance in meters from a point C to a line segment AB on a sphere.
     *
     * @param float $latC Latitude of point C
     * @param float $lngC Longitude of point C
     * @param float $latA Latitude of segment start point A
     * @param float $lngA Longitude of segment start point A
     * @param float $latB Latitude of segment end point B
     * @param float $lngB Longitude of segment end point B
     * @return float Shortest distance in meters
     */
    public function distToSegmentMeters(
        float $latC,
        float $lngC,
        float $latA,
        float $lngA,
        float $latB,
        float $lngB
    ): float;

    /**
     * Tests if a polygon perimeter or area intersects with a circular search area of given radius in meters.
     *
     * @param float $centerLat Circle center latitude
     * @param float $centerLng Circle center longitude
     * @param float $radiusMeters Circle radius in meters
     * @param array<array<float>> $outerCoords Polygon ring coordinate pairs
     * @return bool True if circle intersects polygon or contains/is contained by it
     */
    public function polygonIntersectsCircle(
        float $centerLat,
        float $centerLng,
        float $radiusMeters,
        array $outerCoords
    ): bool;

    /**
     * Calculates the bounding box coordinates [minLng, minLat, maxLng, maxLat] expanded by radius meters.
     *
     * @param float $lat Center latitude
     * @param float $lng Center longitude
     * @param float $radiusMeters Radius in meters
     * @return array{minLng: float, minLat: float, maxLng: float, maxLat: float}
     */
    public function expandBoundingBox(float $lat, float $lng, float $radiusMeters): array;
}
