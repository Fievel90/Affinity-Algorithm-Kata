<?php

namespace Tests\Training\Affinity\Helper;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableStyle;
use Symfony\Component\Console\Output\ConsoleOutput;

class Printer
{
    private static ConsoleOutput $output;

    public static function getOutput(): ConsoleOutput
    {
        return self::$output ?? self::$output = new ConsoleOutput();
    }

    /**
     * @param array<string>              $people
     * @param array<array<string, bool>> $affinities
     */
    public static function affinitiesTable(array $people, array $affinities): void
    {
        $headers = \array_merge([''], $people);

        $rows = [];
        \array_walk($affinities, function (array $affinity, string $person) use (&$rows) {
            $rows[] = \array_merge([$person], \array_map(function (bool $v) {
                return $v ? 'X' : '';
            }, $affinity));
        });

        $output = self::getOutput();
        $output->writeln(['']);
        $output->writeln('<info>Affinities Table</info>');

        if (\count($rows) > 0) {
            $table = new Table($output);
            $table
                ->setStyle(new TableStyle())
                ->setHeaders($headers)
                ->setRows($rows);
            $table->render();
        } else {
            $output->writeln('<comment>Empty data</comment>');
        }

        $output->writeln(['']);
    }

    /**
     * @param array<array<string>> $groups
     */
    public static function groups(array $groups): void
    {
        $rows = \array_reduce($groups, function (array $carry, array $group) {
            $carry[\count($group)][] = \implode(', ', $group);

            return $carry;
        }, []);

        $headers = \array_map(function (int $i) {
            return "Group of {$i}";
        }, \array_keys($rows));

        $output = self::getOutput();
        $output->writeln('<info>Resulting Groups</info>');

        if (\count($rows) > 0) {
            $rows = \array_map(null, ...$rows);
            if (\is_string($rows[0])) {
                $rows = [$rows];
            }

            $table = new Table($output);
            $table
                ->setStyle(new TableStyle())
                ->setHeaders($headers)
                ->setRows($rows);
            $table->render();
        } else {
            $output->writeln('<comment>Empty data</comment>');
        }

        $output->writeln(['']);
    }
}
