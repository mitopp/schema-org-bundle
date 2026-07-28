<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\Intangible\Rating;

use Mitopp\SchemaOrgBundle\Type\AbstractType;

/**
 * @see https://schema.org/AggregateRating
 */
final class AggregateRating extends AbstractType
{
    public function __construct(
        float|int $ratingValue,
        int $reviewCount,
        int|float $bestRating = 5,
        int|float $worstRating = 1,
    ) {
        parent::__construct('AggregateRating');

        $this->data['ratingValue'] = $ratingValue;
        $this->data['reviewCount'] = $reviewCount;
        $this->data['bestRating'] = $bestRating;
        $this->data['worstRating'] = $worstRating;
    }
}
