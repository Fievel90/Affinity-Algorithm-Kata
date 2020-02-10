# Affinity Algorithm Training | Facile.it

Imagine you work for a new born "Tinder" company,
and one of your colleagues has been doing some work for a new affinities algorithm.
He estimated this for 8 hours per person, and your colleague has spent 6 hours working on it.
Unfortunately he has now fallen ill.
He says he has completed the work, and the tests all pass.
Your boss has asked you to take over from him.
She wants you to spend an hour or so on the code, you can tidy it up a little and perhaps make some notes,
so you can give your colleague some feedback on his chosen design.
You should also prepare to talk to your boss about the value of this refactoring work.

## Affinity Algorithm

Your colleague designed this new algorithm to find if people have affinity each other.
Take this table for example, you can find if a person likes another one and if this affinity is repaid.

|        | Adah | Tianna | Sandy | Zora |
|--------|:----:|:------:|:-----:|:----:|
| Adah   |      | X      | X     | X    |
| Tianna | X    |        | X     | X    |
| Sandy  | X    | X      |       | X    |
| Zora   | X    |        | X     |      |

The algorithm should return a list of groups, such that each person within a group
have a match with other people from the same group.
From the example above the list of groups are:

| Group of 2    | Group of 3          |
|---------------|---------------------|
| Adah, Tianna  | Adah, Tianna, Sandy |
| Adah, Sandy   | Adah, Sandy, Zora   |
| Tianna, Sandy |                     |
| Adah, Zora    |                     |
| Sandy, Zora   |                     |

## Affinity Scores

After a few months, that algorithm made the company one of the top players on the market.
Your boss asks for further development to improve the efficiency of the software,
one of your colleague takes the work (change branch with one of your friends).
She asks to create a scoring system based on mutual interests between people of the groups,
in order to improve the user experience and have a better precision on the groups affinity.

Take the same people listed above, for example they can have the following interests:

|        | Archery | Birdwatching | Book collecting | Computer programming | Equestrianism | Gymnastics | Kombucha brewing | Record collecting | Shooting | Whale watching | Woodworking |
|--------|:-------:|:------------:|:---------------:|:--------------------:|:-------------:|:----------:|:----------------:|:-----------------:|:--------:|:--------------:|:-----------:|
| Adah   |         | X            | X               |                      |               | X          | X                |                   |          |                | X           |
| Tianna | X       |              | X               |                      | X             |            |                  |                   | X        |                |             |
| Sandy  |         | X            |                 |                      |               |            | X                | X                 | X        | X              |             |
| Zora   |         | X            |                 | X                    | X             |            | X                |                   |          |                | X           |

The revisited algorithm should also return the percentage of shared interests.
From the example above the list of groups with their respective percentage are:

| Groups              | Percentage |
|---------------------|-----------:|
| Adah, Tianna        | 12.5 %     |
| Adah, Sandy         | 25.0 %     |
| Tianna, Sandy       | 12.5 %     |
| Adah, Zora          | 42.9 %     |
| Sandy, Zora         | 25.0 %     |
| Adah, Tianna, Sandy |  0.0 %     |
| Adah, Sandy, Zora   | 20.0 %     |

## Questions to discuss afterwards

- How did it feel to work with such fast, comprehensive tests?
- What would you say to your colleague if they had written this code?
- What would you say to your boss about the value of this refactoring work?
- How did it feel to work on a code refactored by someone else?
