# Spatial Core Engine (`app/spatial-core`)

High-performance PHP geospatial calculation, administrative area normalization, SQLite R-Tree spatial indexing, and walking route feasibility engine.

---

## 📋 Requirements

- **PHP**: `^8.2` or higher
- **Extensions**: `pdo`, `openssl`, `json`, `curl`
- **License**: Valid signed `license.lic` file issued by the provider.

---

## 🚀 Installation

### Option 1: Direct from Public GitHub Repository

Add this repository to your project's `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/slow-vibing/spatial-core.git"
        }
    ],
    "require": {
        "app/spatial-core": "^1.0"
    }
}
```

Then update your dependencies:
```bash
composer update app/spatial-core
```

### Option 2: Via Packagist (If Published)

```bash
composer require app/spatial-core
```

---

## 🔑 License Setup (Required)

This library is proprietary and protected by a licensing engine. It will **not** execute without a valid `license.lic` file issued for your environment.

### 1. Obtain Your License
Contact your provider to obtain your signed `license.lic` file with your authorized server IP(s) and validity period.

### 2. Place the License File
Place `license.lic` in any of the following standard locations:
- Your application root folder (e.g. `license.lic`)
- Your writable folder (e.g. `writable/license.lic`)
- Or set a custom environment variable in `.env`:
  ```ini
  SPATIAL_LICENSE_PATH="/path/to/your/license.lic"
  ```

### 3. Verify License Validity
You can check your license expiration date and authorized IPs at any time using the bundled verification tool:

```bash
php vendor/app/spatial-core/bin/spatial-licverify --file=license.lic
```

---

## 💻 Quickstart Code Examples

### 1. Haversine Great-Circle Distance
Computes high-precision distance between two geographic coordinates on a sphere in meters:

```php
use App\SpatialCore\Spatial\GeoMath;

$geo = new GeoMath();

// Distance calculation between two lat/lng coordinates
$distanceMeters = $geo->haversineMeters(-6.175392, 106.827153, -6.902484, 107.618770);

echo "Distance: " . round($distanceMeters / 1000, 2) . " km\n";
```

### 2. Point-in-Polygon with Interior Exclusion Holes
Determines if coordinates fall within an outer polygon boundary and outside any interior exclusion holes:

```php
use App\SpatialCore\Spatial\GeoMath;

$geo = new GeoMath();

$outerRing = [
    [106.820, -6.170],
    [106.830, -6.170],
    [106.830, -6.180],
    [106.820, -6.180],
    [106.820, -6.170]
];

$innerHole = [
    [106.824, -6.174],
    [106.826, -6.174],
    [106.826, -6.176],
    [106.824, -6.176],
    [106.824, -6.174]
];

$isCovered = $geo->pointInPolygon(106.822, -6.172, $outerRing, [$innerHole]);
```

### 3. Administrative District Naming Standardization
Normalizes raw district strings into clean title case or file-safe quadrant slugs:

```php
use App\SpatialCore\Spatial\AreaNormalizer;

$normalizer = new AreaNormalizer();

// Cleans noise: 'District', 'Sub-district', 'Adm.', excess spaces
echo $normalizer->normalize('District D1');       // Output: "D1"
echo $normalizer->normalize('Sub-district SD1');   // Output: "SD1"
echo $normalizer->toSlug('District d2 A');      // Output: "d2_a"
echo $normalizer->toUpper('District G123');          // Output: "G123"
```

### 4. Walking Road Distance & Feasibility Router
Evaluates candidate target points against a location using concurrent walking directions and enforces road distance threshold rules:

```php
use App\SpatialCore\Routing\FeasibilityEngine;

$engine = new FeasibilityEngine(
    googleMapsApiKey: env('app.googleMapsKey'),
    maxRoadDistanceMeters: 200 // Threshold limit in meters
);

$candidateNodes = [
    [
        'fat_code'      => 'NODE-001',
        'fat_latitude'  => -6.175900,
        'fat_longitude' => 106.827900
    ],
    [
        'fat_code'      => 'NODE-002',
        'fat_latitude'  => -6.179500,
        'fat_longitude' => 106.832000
    ]
];

$results = $engine->evaluateFeasibility(-6.175392, 106.827153, $candidateNodes);

foreach ($results as $res) {
    echo "Node: {$res['fat_code']}\n";
    echo "Road Distance: {$res['road_distance_m']} m ({$res['duration_text']})\n";
    echo "Eligible: " . ($res['is_eligible'] ? "YES" : "NO: {$res['ineligibility_reason']}") . "\n";
}
```

---

## ⚠️ Troubleshooting & Error Handling

If a license check fails, the library throws specific exceptions under the `App\SpatialCore\Exceptions` namespace:

| Exception | Cause | Resolution |
| :--- | :--- | :--- |
| `LicenseNotFoundException` | No `license.lic` found in search paths. | Place your `license.lic` in your project root or set `SPATIAL_LICENSE_PATH`. |
| `LicenseExpiredException` | License validity period has passed. | Contact the provider for a renewed license file. |
| `IpRestrictionException` | Current server IP is not in allowed list. | Ensure server IP is registered in the license or request an updated license. |
| `LicenseTamperedException` | License file signature is invalid. | Re-download the original unmodified `license.lic` file. |
| `FeatureNotLicensedException` | Requested feature is not enabled. | Request activation of the specific feature from the provider. |

---

## 🔒 Security & Intellectual Property

This library is proprietary and protected by copyright. Decompilation, unauthorized modification, or bypassing the cryptographic licensing verification is strictly prohibited.
