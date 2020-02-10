// tslint:disable:no-console

export default class Printer {
    private static verbose : boolean = false;

    static setVerbosityLevel()
    {
        if (process.argv.includes('--verbose')) {
            this.verbose = true;
        }
    }

    static affinitiesTable(people : string[], affinities : {} | any) : void
    {
        if (this.verbose) {
            console.log('Affinities Table');
            if (people.length > 0) {
                console.table(affinities);
            } else {
                console.log('Empty data');
            }
        }
    }

    static groups(groups : string[][]): void
    {
        if (this.verbose) {
            console.log('Resulting Groups');
            if (groups.length > 0) {
                console.table(groups);
            } else {
                console.log('Empty data');
            }
        }
    }
};
