import Affinity from "../../src/Affinity/Affinity";
import Faker from "./Helper/Faker";
import Printer from "./Helper/Printer";

Printer.setVerbosityLevel();

describe("Affinity", () => {
    it("testGetGroupsStatic", () => {
        const people : string[] = ['Adah', 'Tianna', 'Sandy', 'Zora'];
        const affinities = {
            'Adah': {'Adah' : false, 'Tianna' : true, 'Sandy' : true, 'Zora': true},
            'Tianna': {'Adah' : true, 'Tianna' : false, 'Sandy' : true, 'Zora': true},
            'Sandy': {'Adah' : true, 'Tianna' : true, 'Sandy' : false, 'Zora': true},
            'Zora': {'Adah' : true, 'Tianna' : false, 'Sandy' : true, 'Zora' :false},
        };
        const expected : string[][] = [
            ['Adah', 'Tianna'],
            ['Adah', 'Sandy'],
            ['Tianna', 'Sandy'],
            ['Adah', 'Tianna', 'Sandy'],
            ['Adah', 'Zora'],
            ['Sandy', 'Zora'],
            ['Adah', 'Sandy', 'Zora'],
        ];

        const affinity : Affinity = new Affinity(people, affinities);
        const groups : string[][] = affinity.getGroups();

        expect(groups).toEqual(expected);
    });

    it.each(dataProvider())("testGetGroupsRandom", (size: number, faker: Faker) => {
        const people = faker.createPeople(size);
        const affinities = faker.createAffinities(people);
        Printer.affinitiesTable(people, affinities);

        const affinity : Affinity = new Affinity(people, affinities);
        const groups : string[][] = affinity.getGroups();
        Printer.groups(groups);

        const expected = faker.combinations(people, affinities);
        expect(groups).toHaveLength(expected.length);
        expect(groups).toEqual(expected);
    });

    function dataProvider(): [number, Faker][]
    {
        const empty = new Faker(0, 0);
        const full = new Faker(1, 1);

        return [
            [0, empty],
            [4, empty],
            [10, empty],

            [4, full],
            [10, full],

            [4, new Faker(0.7, 0.9)],
            [10, new Faker(0.4, 0.9)],
        ];
    }
});
