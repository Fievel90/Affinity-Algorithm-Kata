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
    public function getGroups2(): array
    {
        $num = \count($this->people);
        $groups = [];

        for ($i = 0; $i < (1 << $num); ++$i) {
            $group = [];

            for ($j = 0; $j < $num; ++$j) {
                if ((1 << $j) & $i) {
                    $group[] = $this->people[$j];
                    $inGroupCount = \count($group);

                    //Confronta sequenzialmente ogni membro del gruppo
                    for ($x = 0; $x < $inGroupCount; ++$x) {
                        for ($y = $x + 1; $y < $inGroupCount; ++$y) {
                            $first = $group[$x];
                            $second = $group[$y];
                            $check = ($this->affinities[$first][$second] ?? false);
                            $iCheck = ($this->affinities[$second][$first] ?? false);
                            if (false === $check || false === $iCheck) {
                                // Non c'è bisogno di continuare
                                continue 4;
                            }
                        }
                    }
                }
            }

            if (\count($group) > 1) {
                $groups[] = $group;
            }
        }

        return $groups;
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

                    $count = \count($group);

                    for ($x = 0; $x < $count; ++$x) {
                        for ($y = $x + 1; $y < $count; ++$y) {
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
