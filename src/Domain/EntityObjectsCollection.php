<?php

namespace xVer\Bundle\DomainBundle\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use InvalidArgumentException;

/**
 * @template TEntity of EntityObjectInterface
 * @template-extends ArrayCollection<int,TEntity>
 */
class EntityObjectsCollection extends ArrayCollection
{
    /**
     * {@inheritdoc}
     * @param array<int,TEntity> $elements
     */
    final public function __construct(private readonly array $elements = [])
    {
        foreach ($this->elements as $item) {
            if (false === is_a($item, $this->type())) {
                throw new InvalidArgumentException(
                    sprintf('Found item which is not typed <%s>', $this->type())
                );
            }
        }
        parent::__construct($this->elements);
    }

    /**
     * @return class-string
     */
    public function type(): string
    {
        return EntityObjectInterface::class;
    }

    /**
     * @return array<int,TEntity>
     */
    public function toArray(): array
    {
        return parent::toArray();
    }

    /**
     * @return TEntity|false
     */
    public function first(): object|false
    {
        return parent::first();
    }

    /**
     * @return TEntity|false
     */
    public function last(): object|false
    {
        return parent::last();
    }

    /**
     * {@inheritDoc}
     * @return TEntity|null
     */
    public function offsetGet(mixed $offset): object|null
    {
        if (false === is_int($offset)) {
            throw new InvalidArgumentException();
        }
        return parent::offsetGet($offset);
    }

    public function contains(mixed $element): bool
    {
        if (false === is_a($element, static::type())) {
            throw new InvalidArgumentException();
        }
        return parent::contains($element);
    }
}
