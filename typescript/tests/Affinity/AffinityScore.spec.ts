import Affinity from "../../src/Affinity/Affinity";

describe("AffinityScore", () => {
    it("testGetGroupsStatic", () => {
        const people : string[] = ['Adah', 'Tianna', 'Sandy', 'Zora'];
        const affinities = {
            'Adah': {'Adah' : false, 'Tianna' : true, 'Sandy' : true, 'Zora': true},
            'Tianna': {'Adah' : true, 'Tianna' : false, 'Sandy' : true, 'Zora': true},
            'Sandy': {'Adah' : true, 'Tianna' : true, 'Sandy' : false, 'Zora': true},
            'Zora': {'Adah' : true, 'Tianna' : false, 'Sandy' : true, 'Zora' :false},
        };
        const hobbies = {
            'Adah': ['Book collecting', 'Gymnastics', 'Kombucha brewing', 'Birdwatching', 'Woodworking'],
            'Tianna': ['Archery', 'Equestrianism', 'Book collecting', 'Shooting'],
            'Sandy': ['Birdwatching', 'Kombucha brewing', 'Record collecting', 'Shooting', 'Whale watching'],
            'Zora': ['Birdwatching', 'Kombucha brewing', 'Computer programming', 'Equestrianism', 'Woodworking'],
        };

        const expected : {}[] = [
            {
                'group': ['Adah', 'Tianna'],
                'percentage': 12.5,
            },
            {
                'group': ['Adah', 'Sandy'],
                'percentage': 25.0,
            },
            {
                'group': ['Tianna', 'Sandy'],
                'percentage': 12.5,
            },
            {
                'group': ['Adah', 'Tianna', 'Sandy'],
                'percentage': 0.0,
            },
            {
                'group': ['Adah', 'Zora'],
                'percentage': 42.9,
            },
            {
                'group': ['Sandy', 'Zora'],
                'percentage': 25.0,
            },
            {
                'group': ['Adah', 'Sandy', 'Zora'],
                'percentage': 20.0,
            },
        ];

        const affinity : Affinity = new Affinity(people, affinities, hobbies);
        const groups : string[][] = affinity.getGroups();

        expect(groups).toEqual(expected);
    });
});
