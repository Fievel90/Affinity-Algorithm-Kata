import * as generator from "faker";
import {hobbies} from "./Hobbies";

export default class Faker {
    private readonly min : number;
    private readonly max : number;

    constructor(min: number, max: number) {
        this.min = min;
        this.max = max;

        generator.seed(1);
    }

    public createPeople(num: number): string[]
    {
        const list = [];
        for (let i = 0; i < num; ++i) {
            list.push(generator.name.firstName());
        }

        return list;
    }

    public createHobbies(num: number): string[]
    {
        return generator.helpers.shuffle(hobbies).slice(0, num);
    }

    public createAffinities(people: string[]): {}
    {
        return people.reduce((carry: any | {}, person: string) => {
            carry[person] = this.createAffinity(people, person);

            return carry;
        }, {});
    }

    public combinations(people: string[], affinities: {} | any): string[][]
    {
        const combinations : string[][] = [[]];
        for (const value of people) {
            const copy = [...combinations];
            for (const prefix of copy) {
                combinations.push(prefix.concat(value));
            }
        }

        return combinations.filter((combination: string[]) => {
            if (combination.length <= 1) {
                return false;
            }

            let isValid : boolean = true;
            combination.forEach((first: string) => {
                combination.forEach((second: string) => {
                    let check : boolean = false;
                    if (affinities.hasOwnProperty(first)
                        && affinities[first].hasOwnProperty(second)
                    ) {
                        check = affinities[first][second] ?? false;
                    }

                    if (first !== second && !check) {
                        isValid = false;
                    }
                });
            });

            return isValid;
        });
    }

    private createAffinity(people: string[], person: string): {}
    {
        const allAffinity = people.reduce((carry: any | {}, value: string) => {
            carry[value] = false;

            return carry;
        }, {});

        let otherPeople: string[] = people.filter((v: string) => {
            return v !== person;
        });

        let minRand: number = Math.floor(otherPeople.length * this.min);
        minRand = Math.max(minRand, 0);

        let maxRand: number = Math.floor(otherPeople.length * this.max);
        maxRand = Math.min(maxRand, otherPeople.length);

        const mtRand: number = Math.floor(Math.random() * (maxRand - minRand)) + minRand;
        if (0 === mtRand) {
            return [];
        }

        otherPeople = generator.helpers.shuffle(otherPeople).slice(0, mtRand);
        return otherPeople.reduce((carry: any | {}, value: string) => {
            carry[value] = true;

            return carry;
        }, allAffinity);
    }
};