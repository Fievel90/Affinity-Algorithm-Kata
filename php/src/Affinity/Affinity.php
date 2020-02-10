<?php

namespace Training\Affinity;

class Affinity
{
    /** @var array<string> */
    private array $people;

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
        $this->people = $people;
        $this->affinities = $affinities;
    }

    /**
     * @return array<array<string>>
     */
    public function getGroups(): array
    {
        $num = \count($this->people);
        $groups = [];

        for ($i = 0; $i < (1 << $num); ++$i) {
            $group = [];
            $toExclude = false;

            for ($j = 0; $j < $num; ++$j) {
                if ((1 << $j) & $i) {
                    $group[] = $this->people[$j];

                    for ($x = 0; $x < \count($group); ++$x) {
                        for ($y = $x + 1; $y < \count($group); ++$y) {
                            $first = $group[$x];
                            $second = $group[$y];
                            $check = ($this->affinities[$first][$second] ?? false);
                            $iCheck = ($this->affinities[$second][$first] ?? false);
                            if (false === $check || false === $iCheck) {
                                $toExclude = true;
                            }
                        }
                    }
                }
            }

            if (\count($group) > 1 && false === $toExclude) {
                $groups[] = $group;
            }
        }

        return $groups;
    }
}
