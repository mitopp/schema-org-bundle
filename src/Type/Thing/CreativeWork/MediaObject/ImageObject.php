<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\MediaObject;

use Mitopp\SchemaOrgBundle\Type\AbstractType;

/**
 * @see https://schema.org/ImageObject
 */
final class ImageObject extends AbstractType
{
    public function __construct(
        /**
         * Required by schema.org
         */
        string $identifier,
        string $url,
    ) {
        parent::__construct('ImageObject', $identifier);

        $this->data['url'] = $url;
    }
}
