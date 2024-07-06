# Symfony Docker (PHP8 / Caddy / Postgresql / NPM)

### Installing the project locally
- Build fresh images (Run only once after cloning the project). You don't have to build images everytime:
```bash
make build
```
- Install dependencies:
```bash
make dependencies
```

### Running the project
```bash
make run
```

### How the project was created

⚠️ If you're already installed the project, you can skip all these sections. The following instructions are just the steps to configure the project from scratch.

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Build fresh images
```bash
docker compose build --pull --no-cache
```
3. Running containers 
```bash
docker compose up
```
Or run in background
```bash 
docker compose up -d
``` 
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Stop the Docker containers
```bash
docker compose down --remove-orphans
```
6. Displaying logs
```bash
docker compose logs -f
# OR
docker compose logs -f [CONTAINER_NAME]
``` 

### Installing packages
1. Webpack Encore: 
```bash
docker compose exec php composer require symfony/webpack-encore-bundle
docker compose exec php npm install
```

2. Tailwind CSS:
- Adding the package:
```bash
docker compose exec php npm install -D tailwindcss postcss postcss-loader autoprefixer
docker compose exec php npx tailwindcss init -p
```

- Enable PostCSS support in Webpack Encore:
```js
// webpack.config.js
Encore
  // ...
  .enablePostCssLoader()
;
```
- Add the paths to all of your template files in your tailwind.config.js file.
```js
// tailwind.config.js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {},
  },Create
  plugins: [],
}
```

- Add the @tailwind directives for each of Tailwind’s layers to your ./assets/styles/app.css file.

```css
/* ./assets/styles/app.css */
@tailwind base;
@tailwind components;
@tailwind utilities;
```
You may want to speed up the compilation process.
```bash
docker compose exec php npm install -D webpack-watch-files-plugin
```
```js
// webpack.config.js
const WatchExternalFilesPlugin = require('webpack-watch-files-plugin').default;
// [...]
    .addPlugin(new WatchExternalFilesPlugin({
        files: [
            './templates/**/*.html.twig',
        ],
        verbose: true
    }))
```
- Run your build process with npm run watch.
```bash
docker compose exec php npm run watch
```

3. Using React alongside Symfony
- Install React and Babel dependencies:
```bash
docker compose exec php npm install react react-dom prop-types --save
docker compose exec php npm install -D @babel/preset-react @babel/plugin-proposal-class-properties --force
```
```js
// webpack.config.js
Encore
    // ...
    .enableReactPreset()
```
- Adding the Babel configuration file:
    - Comment these lines inside webpack.config.js:
```js
Encore
    // ...
    // configure Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/preset-react');
    // })

    // enables and configure @babel/preset-env polyfills
    // .configureBabelPresetEnv((config) => {
    //     config.useBuiltIns = 'usage';
    //     config.corejs = '3.23';
    // })
```
    - Create a new file babel.config.js:

```js
module.exports = {
presets: ["@babel/preset-env", "@babel/preset-react"],
plugins: ["@babel/plugin-proposal-class-properties"],
};
```

---
