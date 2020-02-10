<?php

namespace Tests\Training\Affinity;

use Tests\Training\Affinity\Helper\Faker;
use Tests\Training\Affinity\Helper\Printer;
use Training\Affinity\Affinity;

class AffinityTest extends AbstractTestCase
{
    public function testGetGroupsStatic(): void
    {
        $people = ['Adah', 'Tianna', 'Sandy', 'Zora'];
        $affinities = [
            'Adah' => ['Adah' => false, 'Tianna' => true, 'Sandy' => true, 'Zora' => true],
            'Tianna' => ['Adah' => true, 'Tianna' => false, 'Sandy' => true, 'Zora' => true],
            'Sandy' => ['Adah' => true, 'Tianna' => true, 'Sandy' => false, 'Zora' => true],
            'Zora' => ['Adah' => true, 'Tianna' => false, 'Sandy' => true, 'Zora' => false],
        ];
        $expected = [
            ['Adah', 'Tianna'],
            ['Adah', 'Sandy'],
            ['Tianna', 'Sandy'],
            ['Adah', 'Tianna', 'Sandy'],
            ['Adah', 'Zora'],
            ['Sandy', 'Zora'],
            ['Adah', 'Sandy', 'Zora'],
        ];

        $affinity = new Affinity($people, $affinities);
        $groups = $affinity->getGroups();

        static::assertEquals($expected, $groups);
        static::assertGroupsIntegrity($people, $affinities, $groups);
    }

    /**
     * @dataProvider dataProvider
     *
     * @param int   $size
     * @param Faker $faker
     */
    public function testGetGroupsRandom(int $size, Faker $faker): void
    {
        $people = $faker->createPeople($size);
        $affinities = $faker->createAffinities($people);
        Printer::affinitiesTable($people, $affinities);

        $affinity = new Affinity($people, $affinities);
        $groups = $affinity->getGroups();
        Printer::groups($groups);

        static::assertGroupsIntegrity($people, $affinities, $groups);
    }

    /**
     * @return array<string, array>
     */
    public function dataProvider(): array
    {
        $empty = new Faker(0, 0);
        $full = new Faker(1, 1);

        return [
            'No people with 0% affinities' => [0, $empty],
            'Four people with 0% affinities' => [4, $empty],
            'Ten people with 0% affinities' => [10, $empty],

            'Four people with 100% affinities' => [4, $full],
            'Ten people with 100% affinities' => [10, $full],

            'Four people with random % affinities' => [4, new Faker(0.7, 0.9)],
            'Ten people with random % affinities' => [10, new Faker(0.4, 0.9)],
        ];
    }
}
