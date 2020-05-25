export default class Affinity {
  private readonly people: string[];
  private readonly affinities: {} | any;

  constructor(people: string[], affinities: {}) {
    this.people = people;
    this.affinities = affinities;
  }

  // const people : string[] = ['Adah', 'Tianna', 'Sandy', 'Zora'];
  // const affinities = {
  //     'Adah': {'Adah' : false, 'Tianna' : true, 'Sandy' : true, 'Zora': true},
  //     'Tianna': {'Adah' : true, 'Tianna' : false, 'Sandy' : true, 'Zora': true},
  //     'Sandy': {'Adah' : true, 'Tianna' : true, 'Sandy' : false, 'Zora': true},
  //     'Zora': {'Adah' : true, 'Tianna' : false, 'Sandy' : true, 'Zora' :false},
  // };

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
            group
              .filter((n) => n != first)
              .forEach((second) => {
                let check: boolean = this.affinities[first][second] ?? false;
                let iCheck: boolean = this.affinities[second][first] ?? false;

                if (!check || !iCheck) {
                  toExclude = true;
                }
              });
          });
        } // fine 33
      } // fine 31

      if (group.length > 1 && !toExclude) {
        groups.push(group);
      }
    }

    return groups;
  }
}
