<?php

namespace Training\Affinity;

class Affinity
{
    /** @var array<string> */
    private array $people;

    /** @var array<array<string, bool>> */
    private array $likes;

    /**
     * Affinity constructor.
     *
     * @param array<string>              $people
     * @param array<array<string, bool>> $likes
     */
    public function __construct(array $people, array $likes)
    {
        $this->people = $people;
        $this->likes = $likes;
    }

    /**
     * @return array<array<string>>
     */
    public function getGroups(): array
    {
        $groups = [];

        $indexShift = 1 << \count($this->people);
        for ($i = 0; $i < $indexShift; ++$i) {
            $group = [];
            $toExclude = false;

            for ($j = 0; $j < \count($this->people); ++$j) {
                $shiftSecondPerson = 1 << $j;
                if ($shiftSecondPerson & $i) {
                    $group[] = $this->people[$j];
                    $toExclude = $this->checkAffinity($group, $toExclude);
                }
            }

            if (\count($group) > 1 && false === $toExclude) {
                $groups[] = $group;
            }
        }

        return $groups;
    }

    /**
     * @param array<string> $group
     * @param bool          $toExclude
     *
     * @return bool
     */
    protected function checkAffinity(array $group, bool $toExclude): bool
    {
        if (true === $toExclude) {
            return $toExclude;
        }

        for ($x = 0; $x < \count($group); ++$x) {
            for ($y = $x + 1; $y < \count($group); ++$y) {
                $first = $group[$x];
                $second = $group[$y];
                $check = ($this->likes[$first][$second] ?? false);
                $iCheck = ($this->likes[$second][$first] ?? false);
                if (false === $check || false === $iCheck) {
                    $toExclude = true;
                }
            }
        }

        return $toExclude;
    }
}
