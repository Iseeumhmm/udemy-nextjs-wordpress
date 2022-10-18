const webpack = require("webpack");
const { merge } = require("webpack-merge");
const path = require("path");
const ExtraWatchWebpackPlugin = require("extra-watch-webpack-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const yaml = require("yaml");
const fs = require("fs");
const StylelintPlugin = require("stylelint-webpack-plugin");
const ESLintPlugin = require("eslint-webpack-plugin");
const common = require("./webpack.common").default;
const { paths } = require("./webpack.common");

const file = fs.readFileSync(path.join(__dirname, ".hatchery.yml"), "utf-8");
const hatchery = yaml.parse(file);

module.exports = (env, argv, process) => merge(common(env, argv, process), {
  mode: "development",

  // Activate the watch
  watch: true,
  watchOptions: {
    // Wait for 200ms after a file change before actually running,
    // to aggregate close changes
    aggregateTimeout: 200,

    // If the OS on which you are developing does not support events,
    // the watch will look every 1 sec for changes
    poll: true,

    // The watch should not look into vendors nor public
    ignored: ["node_modules/**", path.resolve(paths.themePathAbsolute, "public")],
  },

  // Allows to produce .map files for debuging
  devtool: "cheap-source-map",

  output: {
    // How to name splitted files
    chunkFilename: "js/[name].chunk.js",
  },

  devServer: {
    inline: true,
  },

  plugins: [
    // Adds new files to the watch while running
    new ExtraWatchWebpackPlugin({
      dirs: [paths.themePathAbsolute],
    }),

    new webpack.DefinePlugin({
      "process.env.NODE_ENV": JSON.stringify("development"),
    }),

    // Linting is done only on dev mode to prevent blocking build on prod in case there is an issue just with linting

    // SCSS linting
    new StylelintPlugin({
      context: "web/app/themes/**/",
      // This makes linting happen only on files that we edit and save while the watch is running
      // Meaning it won't run the linting on all files even at start
      lintDirtyModulesOnly: true,
    }),

    // JS linting
    new ESLintPlugin(),

    // Browsersync to refresh the browser when a change happens
    new BrowserSyncPlugin({
      host: `${hatchery.name}.localdev.chalk.bet`,
      port: 3000,
      proxy: `https://${hatchery.name}.localdev.chalk.bet/`,
      open: false,
      ui: false,
      https: {
        cert: path.join(__dirname, "../ssl/cert.pem"),
        key: path.join(__dirname, "../ssl/privkey.pem"),
      },
      // watch for changes in template files
      files: ["./web/themes/NextJsWp/"],
    }),
  ],
});
