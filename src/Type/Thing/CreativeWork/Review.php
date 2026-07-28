<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\AbstractType;
use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

/**
 * @see https://schema.org/Review
 */
final class Review extends AbstractType
{
    public function __construct(
        string $datePublished,
        string $reviewBody,
        int|float $ratingValue,
        SchemaItemInterface|string $author,
        ?string $identifier = null,
    ) {
        parent::__construct('Review', $identifier);

        $this->data['datePublished'] = $datePublished;
        $this->data['reviewBody'] = $reviewBody;

        $this->data['author'] = is_string($author)
            ? ['@id' => $author]
            : $author;

        $this->data['reviewRating'] = [
            '@type' => 'Rating',
            'ratingValue' => $ratingValue,
        ];
    }
}
