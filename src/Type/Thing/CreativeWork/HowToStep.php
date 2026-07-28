<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\AbstractType;
use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

/**
 * @see https://schema.org/HowToStep
 */
class HowToStep extends AbstractType
{
    public function __construct(
        string $text,
        ?string $name = null,
        ?string $url = null,
        SchemaItemInterface|string|null $image = null,
    ) {
        parent::__construct('HowToStep');

        $this->data['text'] = $text;

        if (null !== $name) {
            $this->data['name'] = $name;
        }

        if (null !== $url) {
            $this->data['url'] = $url;
        }

        if (null !== $image) {
            $this->data['image'] = is_string($image)
                ? ['@id' => $image]
                : $image;
        }
    }
}
