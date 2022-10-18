const { merge } = require("webpack-merge");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const common = require("./webpack.common").default;

module.exports = (env, argv, process) => merge(common(env, argv, process), {
  mode: "production",

  // Fail out on the first error instead of tolerating it.
  bail: true,

  optimization: {
    minimize: true,
    minimizer: [new TerserPlugin(), new CssMinimizerPlugin()],
  },
});
