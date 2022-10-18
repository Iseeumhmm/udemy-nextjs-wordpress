const fs = require("fs");
const { exec } = require("child_process");
const replace = require("replace");
const fsExtra = require("fs-extra");
const glob = require("glob");

class ThemeSetup {
  constructor(themeNameArg) {
    /**
     * @property {string} themeNameArg The themename variable from the npm call
     */
    this.themeNameArg = themeNameArg;
    /**
     * @property {string} themeName ThemeName turning it to Camelcase and removing characters other than letters
     */
    this.themeName = this.themeNameArg.charAt(0).toUpperCase() + this.themeNameArg.slice(1);
    /**
     * @property {string} currPath The path to the default theme folder
     */
    this.currPath = "./web/app/themes/custom";
    /**
     * @property {string} newPath The path to the new theme folder
     */
    this.newPath = `./web/app/themes/${this.themeName}`;
  }

  /**
   * Function to set up the theme with several operations:
   *    1. Renaming the theme directory
   *    2. Creating the symlink now that we changed the theme directory name
   *    3. Search and replace the theme name
   *    4. Search and replace the namespace
   *    5. Search and replace the CSS suffix
   *    6. Search and replace the File suffix in file names and Search and replace the File suffix
   */
  setup() {
    // Renaming the theme directory
    this.renameThemeDirectory();
    // Creating the symlink now that we changed the theme directory name
    console.log("Creating the public symlink...");
    ThemeSetup.sh(`cd web/app && ln -sf themes/${this.themeName}/public public`);
    // Create symlink for cta-tables
    console.log("Creating the symlinks for anonymized plugins...");
    ThemeSetup.sh(`cd web/app && ln -sf plugins modules`);
    // Search and replace the theme name
    this.replaceThemeName();
    // Search and replace the namespace
    this.replaceNamespace();
    // Search and replace the CSS suffix
    this.replaceCssPrefix();
    // Search and replace the File suffix in file names and Search and replace the File suffix
    this.replaceFilePrefix();
  }

  /**
   * Create the new theme folder by copying all the content of the custom folder inside
   */
  renameThemeDirectory() {
    console.log("Renaming the theme directory...");
    try {
      fsExtra.copySync(this.currPath, this.newPath);
      fs.rmdirSync(this.currPath, { recursive: true });
      console.log("Successfully renamed the theme directory.");
    } catch (err) {
      console.log(err);
    }
  }

  /**
   * Replace the "%THEME_NAME%" variable contained in all project files by the name of the theme
   */
  replaceThemeName() {
    console.log("Replacing %THEME_NAME%...");

    replace({
      regex: "%THEME_NAME%",
      replacement: this.themeName,
      paths: ["."],
      recursive: true,
      silent: false,
      exclude: "setup.js,setups,vendor,node_modules,plugins,web/wp",
    });
  }

  /**
   * Replace the "%_NAMESPACE_%" variable contained in all the project files by the new namespace which contains the theme name
   */
  replaceNamespace() {
    console.log("Replacing _NAMESPACE_...");

    replace({
      regex: "_NAMESPACE_",
      replacement: this.themeName,
      paths: ["."],
      recursive: true,
      silent: false,
      exclude: "setup.js,setups,vendor,node_modules,plugins,web/wp",
    });
  }

  /**
   * Replace the "%CSS_PREFIX%" variable contained in all the project files by the new prefix which is the name of the theme
   */
  replaceCssPrefix() {
    console.log("Replacing %CSS_PREFIX%...");

    replace({
      regex: "%CSS_PREFIX%",
      replacement: `${this.themeName.toLowerCase()}-`,
      paths: ["."],
      recursive: true,
      silent: false,
      exclude: "setup.js,setups,vendor,node_modules,plugins,web/wp",
    });
  }

  /**
   * Replace the "_FILE_PREFIX_" variable contained in all the project's file names by the new prefix which is the name of the theme.
   *
   * Replace the "%FILE_PREFIX%" variable contained in all the project files by the new prefix which is the name of the theme.
   */
  replaceFilePrefix() {
    console.log("Replacing _FILE_PREFIX_ in file names...");
    const { themeName } = this;

    glob(`${this.newPath}/**/_FILE_PREFIX_*`, function (er, files) {
      files.forEach(function (filePath) {
        try {
          const newFilePath = filePath.replace("_FILE_PREFIX_", themeName);
          fs.renameSync(filePath, newFilePath);
          console.log(`Successfully renamed ${filePath} to ${newFilePath}`);
        } catch (err) {
          console.log(err);
        }
      });
    });

    console.log("Replacing %FILE_PREFIX% ...");
    replace({
      regex: "%FILE_PREFIX%",
      replacement: this.themeName,
      paths: ["."],
      recursive: true,
      silent: false,
      exclude: "setup.js,setups,vendor,node_modules,plugins,web/wp",
    });
  }

  /**
   * Allows to check if the site has been setup
   *
   * @return {boolean}
   */
  static isSetup() {
    // check if directory exists
    if (fs.existsSync("./web/app/themes/custom")) {
      console.log("The theme has not been setup yet.");
      return false;
    }

    return true;
  }

  /**
   * Execute simple shell command (async wrapper).
   * @param {String} cmd
   * @return {Object} { stdout: String, stderr: String }
   */
  static async sh(cmd) {
    return new Promise((resolve, reject) => {
      exec(cmd, (err, stdout, stderr) => {
        if (err) {
          reject(err);
        }

        if (stderr) {
          reject(stderr);

          return;
        }

        resolve({ stdout, stderr });
      });
    });
  }
}

module.exports = ThemeSetup;
