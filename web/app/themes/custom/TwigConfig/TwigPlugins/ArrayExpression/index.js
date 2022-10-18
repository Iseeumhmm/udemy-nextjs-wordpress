/**
 * This file is a copy of prettier-plugin-twig-melody/src/print/ArrayExpression
 * but with a twist copid from prettier-plugin-twig-melody/src/print/ObjectExpression
 * to add a line break after each element of the array
 *
 * Any change to this file requires a reload of VSCode.
 */

const prettier = require("prettier");

const { group, concat, softline, hardline, indent, join } = prettier.doc.builders;
const { STRING_NEEDS_QUOTES } = require("prettier-plugin-twig-melody/src/util");

const p = (node, path, print) => {
  node[STRING_NEEDS_QUOTES] = true;
  const mappedElements = path.map(print, "elements");
  const indentedContent = concat([softline, join(concat([",", hardline]), mappedElements)]);

  return group(concat(["[", indent(indentedContent), softline, "]"]));
};

module.exports = {
  melodyExtensions: [],
  printers: {
    ArrayExpression: p,
  },
};
