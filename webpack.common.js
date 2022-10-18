const path = require("path");
const glob = require("glob");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const RemoveEmptyScriptsPlugin = require("webpack-remove-empty-scripts");
const CopyPlugin = require("copy-webpack-plugin");
const { WebpackManifestPlugin } = require("webpack-manifest-plugin");

// Paths
const themePath = "./web/app/themes/**";
const themePathAbsolute = "/web/app/themes/%THEME_NAME%";
const publicPathAbsolute = `/app/public/`;
const assetsPathAbsolute = path.resolve(__dirname, "web/app/themes/%THEME_NAME%/Assets");

/**
 * Generate the entries
 * Reads the Assets/Templates folders in search for JS ans SCSS files
 *
 * @return {Array} The entries
 */
function generateEntries() {
  const entries = {};

  const files = glob
    .sync(`${themePath}/Assets/Scss/*.scss`)
    .concat(glob.sync(`${themePath}/Assets/Js/*.js`))
    .concat(glob.sync(`${themePath}/Blocks/**/*.{js,scss}`))
    .concat(glob.sync(`${themePath}/Templates/**/*.{js,scss}`));

  files.forEach((entry) => {
    // Howdy 🤠, Making sure no entry key starts with a number
    const filename = `Howdy${path.basename(entry).split(".").slice(0, -1).join(".")}`;
    if (!entries[filename]) {
      entries[filename] = [];
    }
    entries[filename].push(entry);
  });

  return entries;
}

module.exports.default = (env, argv, process) => {
  return {
    entry: generateEntries,

    optimization: {
      runtimeChunk: "single",
    },

    module: {
      rules: [
        // handle SCSS
        {
          test: /\.(sa|sc|c)ss$/,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: "css-loader",
            },
            {
              loader: "postcss-loader",
              options: {
                postcssOptions: {
                  plugins: [["postcss-preset-env"]],
                },
              },
            },
            "sass-loader",
          ],
        },

        // Handle JS
        {
          test: /\.(js)$/,
          exclude: [/node_modules/],
          use: ["babel-loader"],
        },

        // Handle fonts
        // always external files
        {
          test: /\.(ttf|eot|woff|woff2)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
          type: "asset/resource",
        },

        // Handle images
        // above 1kb the asset will be an external file, below it will be inlined
        {
          test: /\.(png|jpg|gif|svg)$/,
          type: "asset",
          parser: {
            dataUrlCondition: {
              maxSize: 1 * 1024,
            },
          },
        },
      ],
    },
    plugins: [
      // Handles css files
      new MiniCssExtractPlugin({
        filename: (pathData) => {
          if (env.development) {
            // Howdy no more, removing prepended string from entry key before being outputed
            return `css/${pathData.chunk.name.replace("Howdy", "")}.${pathData.chunk.hash}.css`;
          }

          return `css/${pathData.chunk.hash}.css`;
        },
      }),

      // Prevents empty JS files to be created from SCSS files in the entries
      new RemoveEmptyScriptsPlugin(),

      // Copying assets
      new CopyPlugin({
        patterns: [{ from: path.resolve(assetsPathAbsolute, "Images"), to: path.resolve(__dirname, "web/app/public/assets") }],
      }),

      // Manifest Plugin
      new WebpackManifestPlugin({
        // Remove relative path in value 
        publicPath: "",
        // Exclude all picture file in manifest
        filter: (file) => {
          const extension = path.extname(file.name).slice(1);

          return ["css", "js"].includes(extension);
        },
        // // Howdy no more, removing prepended string from key in manifest file
        map: (file) => {
          const extension = path.extname(file.name).slice(1);

          return {
            ...file,
            name: ["css", "js"].includes(extension) ? `${file.name.replace("Howdy", "")}` : file.name,
          };
        },
      }),
    ],

    resolve: {
      alias: {
        "@Blocks": `${themePathAbsolute}/Blocks`,
        "@Components": `${themePathAbsolute}/Components`,
        "@Templates": `${themePathAbsolute}/Templates`,
        "@Utils": `${themePathAbsolute}/Utils`,
        "@Elements": `${themePathAbsolute}/Elements`,
        "@Assets": assetsPathAbsolute,
        "@Vendors": `${themePathAbsolute}/Vendors`,
      },
    },
    output: {
      filename: (pathData) => {
        if (env.development) {
          // Howdy no more, removing prepended string from entry key before being outputed
          return `js/${pathData.chunk.name.replace("Howdy", "")}.${pathData.chunk.hash}.js`;
        }

        return `js/${pathData.chunk.hash}.js`;
      },
      chunkFilename: "js/[name].chunk.js",

      path: path.resolve(__dirname, "web/app/public"), // NOTE: THIS REMOVES THE NEED FOR OTHER PATHS TO PREPEND THIS

      publicPath: publicPathAbsolute,

      library: "[name]",
      libraryTarget: "var",

      // Assets
      // We output everything under public/assets, we can't have separate outputs but also we don't need that.
      // Using the hash prevents caching as the hash would be different with any modification to the file.
      // If prefered you can use [name] in place of [hash] but I wouldn't recommend it for the cache reason.
      assetModuleFilename: "assets/[hash][ext][query]",

      // Clean the output folder exctept the .gitkeep before a new build
      clean: {
        keep(asset) {
          return asset.includes(".gitkeep");
        },
      },
    },
  };
};

module.exports.paths = {
  themePath,
  themePathAbsolute,
  publicPathAbsolute,
  assetsPathAbsolute,
};
