export default class Affinity {
  private readonly people: string[];
  private readonly affinities: {} | any;

  constructor(people: string[], affinities: {}) {
    this.people = people;
    this.affinities = affinities;
  }

  public getGroups(): string[][] {
    const num: number = this.people.length;
    const groups: string[][] = [];

    // tslint:disable-next-line:no-bitwise
    for (let i: number = 0; i < 1 << num; ++i) {
      const group: string[] = [];
      let toExclude: boolean = false;

      for (let j: number = 0; j < num; ++j) {
        // tslint:disable-next-line:no-bitwise
        if ((1 << j) & i) {
          group.push(this.people[j]);

          group.forEach((first) => {
            if (toExclude) {
              return false;
            }

            group
              .filter((n) => n != first)
              .forEach((second) => {
                toExclude = this.isAlreadyExists(first, second);
              });
          });
        } // fine 29
      } // fine 27

      if (group.length > 1 && !toExclude) {
        groups.push(group);
      }
    }

    return groups;
  }

  isAlreadyExists(first: any, second: any): boolean {
    let check: boolean = this.affinities[first][second] ?? false;
    let iCheck: boolean = this.affinities[second][first] ?? false;

    if (!check || !iCheck) {
      return true;
    }

    return false;
  }
}
