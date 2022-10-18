/**
 *  This script is composed of several classes for various setup
 * 
 *  It is launched by the Hatchery repository with the command "./start.sh" but can be launched separately with : 
 *  npm run setup-theme --themename=YOUR_FOLDER_NAME
 * 
 *  ThemeSetup : 
 *    - This script runs search replace across the theme
 *    - to replace placeholders by the passed value.
 * 
 *  VsCodeSetupExtensions (The Command Cli need to be installed for this setup):
 *  @see https://code.visualstudio.com/docs/setup/mac#_launching-from-the-command-line
 *    - This script allows to install vscode extensions which are recommended in the configuration './vscode/extensions.json'.
 *    - !Important: If the extensions are already installed but deactivated then you have to activate them manually 
 * 
 */
 const VsCodeSetupExtensions = require("./setups/VsCodeSetupExtensions");
 const ThemeSetup = require("./setups/ThemeSetup");
 
 if(!process.env.npm_config_themename){
   console.log("Error: the --themename parameter was not specified.");
   return;
 }
 
 // Run VsCode Extensions setup
 if (VsCodeSetupExtensions.hasCommandLineInstalled()) {
   console.log('Command Line VsCode installed');
   const VsCodeExtensions = new VsCodeSetupExtensions();
   VsCodeExtensions.setup();
 } else {
   console.log('Command Line VSCode not installed, you will have to install required extensions manually.');
 }
 
 // Getting the themename variable from the npm call,
 // turning it to Camelcase and removing characters other than letters
 const themeNameArg = process.env.npm_config_themename.toLowerCase().replace(/[^A-Za-z]/g, '');
 const themeSetup = new ThemeSetup(themeNameArg);
 // Run Theme setup
 themeSetup.setup();