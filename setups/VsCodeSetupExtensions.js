const fs = require("fs");
const { execSync } = require("child_process");

class VsCodeSetupExtensions {
  constructor(fileExtensions) {
    /**
     * @property {string} extensionsFile The full path to the extension configuration file
     */
    this.extensionsFile = fileExtensions !== undefined && fileExtensions !== null ? fileExtensions : `${__dirname}/../.vscode/extensions.json`;
    /**
     * @property {object} extensions contain all extensions settings
     */
    this.extensions = {};
    /**
     * @property {object} extensionsInstalled contain all extensions installed
     */
    this.extensionsInstalled = [];
  }

  /**
   * function call to install extensions recommend in ".vscode/extensions.json".
   *
   * !IMPORTANT: if the extension is installed but not activated the command does not activate the extension.
   */
  setup() {
    this.extensions = JSON.parse(fs.readFileSync(this.extensionsFile));
    this.extensionsInstalled = VsCodeSetupExtensions.listExtensions();

    let index = 0;
    const extensionsTotal = this.extensions.recommendations.length;
    for (index; index < extensionsTotal; index++) {
      const extension = this.extensions.recommendations[index];

      if (!this.extensionsInstalled.includes(extension)) {
        VsCodeSetupExtensions.installExtension(extension, null, true);
      }
    }
  }

  /**
   * Uninstall an extension. Provide the full extension name publisher.extension as an argument.
   * @see https://code.visualstudio.com/docs/setup/mac#_launching-from-the-command-line
   *
   * @return {boolean} Indique if command line is installed or not
   */
  static hasCommandLineInstalled() {
    let codeCommandEnabled = true;
    try {
      execSync("command -v code").toString();
    } catch (error) {
      codeCommandEnabled = false;
    }

    return codeCommandEnabled;
  }

  /**
   * Uninstall an extension. Provide the full extension name publisher.extension as an argument.
   * @see https://code.visualstudio.com/docs/editor/command-line
   *
   * @param {string} extension the full extension name
   * @param {string} version The specifique version number for package
   * @param {boolean} force Use --force argument to avoid prompts.
   */
  static installExtension(extension, version, force) {
    version = version !== undefined && version !== null ? `@${version.replace("@", "")}` : "";
    force = force !== undefined && force !== null ? "--force" : "";
    execSync(`code --install-extension ${extension}${version} ${force}`);
  }

  /**
   * Uninstall an extension. Provide the full extension name publisher.extension as an argument.
   * @see https://code.visualstudio.com/docs/editor/command-line
   *
   * @param {string} extension the full extension name
   */
  static unInstallExtension(extension) {
    execSync(`code --uninstall-extension ${extension}`);
  }

  /**
   * List the installed extensions.
   * @see https://code.visualstudio.com/docs/editor/command-line
   *
   * @param {boolean} showVersion Used for return the version with plugin if setted to true
   *
   * @return {array} List with all extensions installed and version if showVersion = true
   */
  static listExtensions(showVersion) {
    showVersion = showVersion !== undefined && showVersion !== null ? "--show-versions" : "";
    return execSync(`code --list-extensions ${showVersion}`).toString().split(/\r?\n/);
  }
}

module.exports = VsCodeSetupExtensions;
