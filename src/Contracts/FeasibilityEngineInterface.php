<?php

declare(strict_types=1);

namespace App\SpatialCore\Contracts;

/**
 * Public Contract for Connection Feasibility and Multi-Route Walking Distance Evaluation.
 */
interface FeasibilityEngineInterface
{
    /**
     * Evaluates feasibility by calculating walking road distances concurrently via Google Directions API
     * and enforcing telecom eligibility criteria (road distance <= 200m).
     *
     * @param float $homeLat Customer home latitude
     * @param float $homeLng Customer home longitude
     * @param array<array<string, mixed>> $candidateNodes Array of candidate target nodes with latitude & longitude
     * @return array<array<string, mixed>> Enriched candidates with actual road distance, route polyline, and eligibility
     */
    public function evaluateFeasibility(float $homeLat, float $homeLng, array $candidateNodes): array;
}
