<?php

declare(strict_types=1);

namespace App\SpatialCore\Contracts;

/**
 * Public Contract for the Tamper-Proof Cryptographic Licensing Engine.
 */
interface LicenseManagerInterface
{
    /**
     * Asserts that a valid, unexpired, signed license exists for the current host and requested feature.
     * Throws an appropriate LicenseException if invalid.
     *
     * @param string|null $requiredFeature Specific feature code to verify (e.g. 'geomath', 'feasibility')
     * @return bool True if valid
     * @throws \App\SpatialCore\Exceptions\LicenseException
     */
    public function assertValid(?string $requiredFeature = null): bool;

    /**
     * Gets the parsed and verified license payload.
     *
     * @return array<string, mixed>
     */
    public function getLicenseInfo(): array;
}
