<?php

namespace Tests\Training\Affinity;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Output\OutputInterface;
use Tests\Training\Affinity\Helper\Printer;

class AbstractTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Printer::getOutput()->setVerbosity(OutputInterface::VERBOSITY_QUIET);
        \array_walk($_SERVER['argv'], function ($arg) {
            switch ($arg) {
                case '-v':
                case '--verbose':
                    Printer::getOutput()->setVerbosity(OutputInterface::VERBOSITY_NORMAL);
                    break;
            }
        });
    }

    /**
     * @param array<string>              $initialPeople
     * @param array<array<string, bool>> $initialAffinities
     * @param array<array<string>>       $actualGroups
     */
    protected static function assertGroupsIntegrity(
        array $initialPeople,
        array $initialAffinities,
        array $actualGroups
    ): void {
        $combinations = static::combinations($initialPeople, $initialAffinities);

        static::assertCount(\count($combinations), $actualGroups);
        static::assertEquals($combinations, $actualGroups);
    }

    /**
     * @param array<string>              $people
     * @param array<array<string, bool>> $affinities
     *
     * @return array<array<string>>
     */
    private static function combinations(array $people, array $affinities): array
    {
        $combinations = [[]];
        foreach ($people as $element) {
            foreach ($combinations as $combination) {
                \array_push($combinations, \array_merge($combination, [$element]));
            }
        }

        return \array_values(\array_filter($combinations, function (array $combination) use ($affinities) {
            if (\count($combination) <= 1) {
                return false;
            }

            foreach ($combination as $first) {
                foreach ($combination as $second) {
                    if ($first !== $second
                        && false === ($affinities[$first][$second] ?? false)
                    ) {
                        return false;
                    }
                }
            }

            return true;
        }));
    }
}
