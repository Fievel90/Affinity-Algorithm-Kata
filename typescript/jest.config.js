// For a detailed explanation regarding each configuration property, visit:
// https://jestjs.io/docs/en/configuration.html

module.exports = {
  clearMocks: true,
  coverageDirectory: "coverage",
  moduleFileExtensions: [
    "js",
    "json",
    "jsx",
    "ts",
    "tsx",
    "node"
  ],
  roots: [
    "<rootDir>/src",
    "<rootDir>/tests",
  ],
  testEnvironment: "node",
  testRegex: [
    '(/__tests__/.*|(\\.|/)(test|spec))\\.tsx?$',
  ],
  transform: {
    '^.+\\.tsx?$': 'ts-jest',
  },
  verbose: true,
};
