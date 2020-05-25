<?php

namespace Training\Affinity;

use function foo\func;

class Affinity
{
    /** @var People */
    private People $people;

    /** @var array<array<string, bool>> */
    private array $affinities;

    /**
     * Affinity constructor.
     *
     * @param array<string>              $people
     * @param array<array<string, bool>> $affinities
     */
    public function __construct(array $people, array $affinities)
    {
        $this->people = new People();
        foreach ($people as $person) {
            $this->people[] = new Person($person, $affinities[$person]);
        }
    }

    /**
     * @return array<array<string>>
     */
    public function getGroups(): array
    {
        $num = $this->people->count();
        $groups = [];

        for ($i = 0; $i < $this->people->getCombinationCount(); ++$i) {
            $group = [];
            $toExclude = false;

            for ($j = 0; $j < $num; ++$j) {
                if ((1 << $j) & $i) {
                    $group[] = $this->people[$j];

                    for ($x = 0; $x < \count($group); ++$x) {
                        for ($y = $x + 1; $y < \count($group); ++$y) {
                            $first = $group[$x];
                            $second = $group[$y];
//                            $check = ($this->affinities[$first][$second] ?? false);
//                            $iCheck = ($this->affinities[$second][$first] ?? false);
                            if (!$first->hasAffinity($second)) {
                                $toExclude = true;
                            }
                        }
                    }
                }
            }

            if (\count($group) > 1 && false === $toExclude) {
                $groups[] = array_map(function($person) { return $person->getName();}, $group);
            }
        }

        return $groups;
    }
}
