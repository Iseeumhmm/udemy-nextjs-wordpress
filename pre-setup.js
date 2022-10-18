const readlineSync = require("readline-sync");
const ThemeSetup = require("./setups/ThemeSetup");

if (!ThemeSetup.isSetup()) {
  let themeName = "";
  while (themeName === "") {
    themeName = readlineSync.question("Enter the name for your theme: ");

    if (themeName === "") {
      console.log("\x1b[31m", "The theme name cannot be empty!", "\x1b[0m");
    }
  }

  const themeSetup = new ThemeSetup(themeName);
  // run setup script
  themeSetup.setup();
}
