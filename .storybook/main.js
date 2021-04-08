const path = require("path");
module.exports = {
    stories: ["../stories/**/*.stories.js"],
    addons: [
        "@storybook/addon-actions",
        "@storybook/addon-links",
        "@storybook/preset-scss"
    ],
    webpackFinal: async config => {
        config.module.rules.push({
            test: /\.s[ac]ss$/i,
            use: [
                "style-loader",
                {
                    loader: "css-loader",
                    options: {
                        importLoaders: 1,
                        modules: true,
                        localIdentName: "[local]___[hash:base64:5]",
                        exclude: [
                            path.resolve(
                                __dirname,
                                "../resources/sass/app.scss"
                            )
                        ] //not to make it module because it is imported in global
                    }
                },
                "sass-loader"
            ],
            include: path.resolve(__dirname, "../resources")
        });
        return config;
    }
};
