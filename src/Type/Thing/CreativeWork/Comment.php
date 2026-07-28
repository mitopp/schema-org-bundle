<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\AbstractType;
use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

/**
 * @see https://schema.org/Comment
 */
final class Comment extends AbstractType
{
    public function __construct(
        SchemaItemInterface|string $author,
        string $datePublished,
        string $text,
    ) {
        parent::__construct('Comment');

        $this->data['author'] = is_string($author)
            ? ['@id' => $author]
            : $author;
        $this->data['datePublished'] = $datePublished;
        $this->data['text'] = $text;
    }
}
