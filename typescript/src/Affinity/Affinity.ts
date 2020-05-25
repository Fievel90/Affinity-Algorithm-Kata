export default class Affinity {
    private readonly people : string[];
    private readonly affinities : {} | any;

    constructor(people: string[], affinities: {}) {
        this.people = people;
        this.affinities = affinities;
    }

    public getGroups(): string[][] {
        const totalPeopleLength : number = this.people.length;
        const groups : string[][] = [];

        // tslint:disable-next-line:no-bitwise
        for (let i : number = 0; i < this.getCombinations(totalPeopleLength); ++i) {
            const group : string[] = [];
            let toExclude : boolean = false;

            for (let j : number = 0; j < totalPeopleLength; ++j) {
                // tslint:disable-next-line:no-bitwise
                if (this.getCombinations(j) & i) {
                    group.push(this.people[j]);
                }
            }
            for (let x : number = 0; x < group.length; ++x) {
                for (let y : number = x + 1; y < group.length; ++y) {
                    const first : string = group[x];
                    const second : string = group[y];
                    if (!(this.hasAffinity(first,second) && this.hasAffinity(second, first))) {
                        toExclude = true;
                    }
                }
            }
            if (group.length > 1 && !toExclude) {
                groups.push(group);
            }
        }
        return groups;
    }

    private getCombinations(totalPeople: number): number {
        // tslint:disable-next-line:no-bitwise
        return Math.pow(2, totalPeople);
    }


    private hasAffinity(first: string, second: string) {
        if (this.affinities.hasOwnProperty(first)
            && this.affinities[first].hasOwnProperty(second)
        ) {
            return this.affinities[first][second] ?? false;
        }
        return false;
    }

}
