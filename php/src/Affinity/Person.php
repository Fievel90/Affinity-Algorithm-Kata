<?php

namespace Training\Affinity;

class Person
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var array<Person>
     */
    private array $affinities;

    /**
     * Person constructor.
     *
     * @param string        $name
     * @param array<Person> $affinities
     */
    public function __construct(string $name, array $affinities)
    {
        $this->name = $name;
        $this->affinities = $affinities;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Person $person
     *
     * @return bool
     */
    public function likesPerson(Person $person): bool
    {
        return \in_array($person->name, $this->affinities);
    }

    /**
     * @param Person $person
     *
     * @return bool
     */
    public function hasAffinity(Person $person): bool
    {
        return $person->likesPerson($this) && $this->likesPerson($person);
    }
}
