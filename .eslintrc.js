module.exports = {
  // A configuration file, once extended, can inherit all the traits of another configuration file
  extends: ["airbnb-base", "plugin:prettier/recommended"],
  // This file is at the root, prevents ESLint to keep looking further
  root: true,
  // An environment provides predefined global variables.
  env: {
    // browser global variables.
    browser: true,
    // enable all ECMAScript 6 features except for modules.
    es6: true,
    // Node.js global variables and Node.js scoping.
    node: true,
  },
  rules: {
    // Enforces semicolons on all statements
    semi: ["error", "always"],
    // Return statements to either always or never specify values
    "consistent-return": ["error"],
    // Dangling underscores are dumb
    "no-underscore-dangle": ["error"],
    // This rule enforces a maximum depth that callbacks can be nested to increase code clarity.
    "max-nested-callbacks": ["warn", 3],
    // Forbids the use of mutable exports with var or let.
    "import/no-mutable-exports": ["warn"],
    // This rule disallows the unary operators ++ and --, except in loop statements.
    "no-plusplus": [
      "warn",
      {
        allowForLoopAfterthoughts: true,
      },
    ],
    // This rule aims to prevent unintended behavior caused by modification or reassignment of function parameters.
    // off means we can do it
    "no-param-reassign": ["off"],
    // This rule disallows calling some Object.prototype methods directly on object instances.
    // off means we can do it
    "no-prototype-builtins": ["off"],
    // This rule enforces valid and consistent JSDoc comments.
    "valid-jsdoc": [
      "warn",
      {
        prefer: {
          returns: "return",
          property: "prop",
        },
        requireReturn: false,
      },
    ],
    // This rule is aimed at eliminating unused variables
    "no-unused-vars": ["warn"],
    // This rule authorize to instanciate objects without storing them in variables
    "no-new": ["off"],
    // Requires linebreaks to be placed after the operator
    "operator-linebreak": [
      "error",
      "after",
      {
        overrides: {
          "?": "ignore",
          ":": "ignore",
        },
      },
    ],
    // Forbid the import of external modules that are not declared in the package.json
    "import/no-extraneous-dependencies": [
      "error",
      {
        devDependencies: true,
      },
    ],
    // Warns about extension in imports, should be done without extension
    "import/extensions": ["warn"],
  },
  settings: {
    "import/resolver": {
      // ESLint isn't aware of any Webpack aliases so it is required
      alias: {
        map: [
          ["@Blocks", "./web/app/themes/%THEME_NAME%/Blocks"],
          ["@Components", "./web/app/themes/%THEME_NAME%/Components"],
          ["@Templates", "./web/app/themes/%THEME_NAME%/Templates"],
          ["@Utils", "./web/app/themes/%THEME_NAME%/Utils"],
          ["@Assets", "./web/app/themes/%THEME_NAME%/Assets"],
          ["@Vendors", "./web/app/themes/%THEME_NAME%/Vendors"],
        ],
        extensions: [".js", ".jsx", ".json"],
      },
    },
  },
};
