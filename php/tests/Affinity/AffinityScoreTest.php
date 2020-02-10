<?php

namespace Tests\Training\Affinity;

use Training\Affinity\Affinity;

class AffinityScoreTest extends AbstractTestCase
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
        $hobbies = [
            'Adah' => ['Book collecting', 'Gymnastics', 'Kombucha brewing', 'Birdwatching', 'Woodworking'],
            'Tianna' => ['Archery', 'Equestrianism', 'Book collecting', 'Shooting'],
            'Sandy' => ['Birdwatching', 'Kombucha brewing', 'Record collecting', 'Shooting', 'Whale watching'],
            'Zora' => ['Birdwatching', 'Kombucha brewing', 'Computer programming', 'Equestrianism', 'Woodworking'],
        ];

        $expected = [
            [
                'group' => ['Adah', 'Tianna'],
                'percentage' => 12.5,
            ],
            [
                'group' => ['Adah', 'Sandy'],
                'percentage' => 25.0,
            ],
            [
                'group' => ['Tianna', 'Sandy'],
                'percentage' => 12.5,
            ],
            [
                'group' => ['Adah', 'Tianna', 'Sandy'],
                'percentage' => 0.0,
            ],
            [
                'group' => ['Adah', 'Zora'],
                'percentage' => 42.9,
            ],
            [
                'group' => ['Sandy', 'Zora'],
                'percentage' => 25.0,
            ],
            [
                'group' => ['Adah', 'Sandy', 'Zora'],
                'percentage' => 20.0,
            ],
        ];

        static::markTestIncomplete('Incomplete - Affinity Algorithm Training (Part 2)');

        $affinity = new Affinity($people, $affinities, $hobbies);
        $groups = $affinity->getGroups();

        static::assertEquals($expected, $groups);
    }
}
