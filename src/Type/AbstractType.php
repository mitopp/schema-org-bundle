<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type;

use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

abstract class AbstractType implements SchemaItemInterface
{
    /**
     * @var array<string, string|int|float|bool|SchemaItemInterface|mixed|null>
     */
    protected array $data = [];

    public function __construct(string $type, ?string $identifier = null)
    {
        $this->data['@type'] = $type;
        $this->data['@id'] = $identifier;
    }

    public function getIdentifier(): string
    {
        $id = $this->data['@id'] ?? '';

        return is_scalar($id) ? (string) $id : '';
    }

    public function setProperty(string $property, mixed $value): static
    {
        /** @var string|int|float|bool|SchemaItemInterface|mixed|null $castedValue */
        $castedValue = $value;

        $this->data[$property] = $castedValue;

        return $this;
    }

    public function toArray(): array
    {
        $result = [];

        foreach ($this->data as $key => $value) {
            // Ignore empty values to keep the final JSON-LD clean
            if (null === $value) {
                continue;
            }

            if ([] === $value) {
                continue;
            }

            // If the value itself is a Schema object, resolve it recursively
            if ($value instanceof SchemaItemInterface) {
                if ($value->getIdentifier() !== '') {
                    $result[$key] = ['@id' => $value->getIdentifier()];

                    continue;
                }

                $result[$key] = $value->toArray();

                continue;
            }

            // If it is a list of values
            if (is_array($value)) {
                $result[$key] = array_map(
                    static fn ($item): mixed => $item instanceof SchemaItemInterface
                        ? ($item->getIdentifier() !== '' ? ['@id' => $item->getIdentifier()] : $item->toArray())
                        : $item,
                    $value
                );

                continue;
            }

            // Normal Strings, Integers, Booleans
            $result[$key] = $value;
        }

        return $result;
    }
}
