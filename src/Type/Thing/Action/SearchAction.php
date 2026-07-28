<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\Action;

use Mitopp\SchemaOrgBundle\Type\AbstractType;

/**
 * @see https://schema.org/SearchAction
 */
final class SearchAction extends AbstractType
{
    public function __construct(
        string $urlTemplate,
        string $queryInput = 'required name=search_term_string',
        ?string $identifier = null,
    ) {
        parent::__construct('SearchAction', $identifier);

        $this->data['target'] = [
            '@type' => 'EntryPoint',
            'urlTemplate' => $urlTemplate,
        ];

        $this->data['query-input'] = $queryInput;
    }
}
