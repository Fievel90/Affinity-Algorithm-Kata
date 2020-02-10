<?php

namespace Tests\Training\Affinity\Helper;

use Faker\Factory;
use Faker\Generator;

class Faker
{
    private Generator $faker;

    private float $min;

    private float $max;

    /**
     * Faker constructor.
     *
     * @param float $min
     * @param float $max
     */
    public function __construct(float $min = 0.4, float $max = 0.9)
    {
        $this->faker = Factory::create();
        $this->faker->seed(1);

        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param int $num
     *
     * @return array<string>
     */
    public function createPeople(int $num): array
    {
        $list = [];
        for ($i = 0; $i < $num; ++$i) {
            $list[] = $this->faker->firstName;
        }

        return $list;
    }

    /**
     * @param int $num
     *
     * @return array<string>
     */
    public function createHobbies(int $num): array
    {
        /** @var array<string>|string $result */
        $result = \array_rand(\array_flip(Hobbies::LIST), $num);

        return \is_array($result)
            ? $result
            : [$result];
    }

    /**
     * @param array<string> $people
     *
     * @return array<array<string, bool>>
     */
    public function createAffinities(array $people): array
    {
        return \array_reduce($people, function (array $carry, string $person) use ($people) {
            $carry[$person] = $this->createAffinity($people, $person);

            return $carry;
        }, []);
    }

    /**
     * @param array<string> $people
     * @param string        $person
     *
     * @return array<string, bool>
     */
    private function createAffinity(array $people, string $person): array
    {
        $allAffinity = \array_combine(
            $people,
            \array_fill(0, \count($people), false)
        );

        $possibleAffinity = \array_flip($people);
        unset($possibleAffinity[$person]);

        $minRand = (int) \floor(\count($possibleAffinity) * $this->min);
        $minRand = \max($minRand, 0);

        $maxRand = (int) \floor(\count($possibleAffinity) * $this->max);
        $maxRand = \min($maxRand, \count($possibleAffinity));

        if (0 === $mtRand = \mt_rand($minRand, $maxRand)) {
            return [];
        }

        $result = \array_rand($possibleAffinity, $mtRand);
        $possibleAffinity = \is_array($result)
            ? $result
            : [$result];

        if (! \is_array($possibleAffinity)) {
            throw new \LogicException('There is something wrong.');
        }

        $possibleAffinity = \array_combine(
            $possibleAffinity,
            \array_fill(0, \count($possibleAffinity), true)
        );

        if (! \is_array($allAffinity) || ! \is_array($possibleAffinity)) {
            throw new \LogicException('There is something wrong.');
        }

        return \array_replace($allAffinity, $possibleAffinity);
    }
}
