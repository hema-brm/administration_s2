# Répartition des tâches

### 1. Racha Ramoul

> Github: RachaRamoul

- Suivi de paiement
  - Ajout / Modification / Suppression / Liste
  - Sécurité
- Devis v1.0
  - Ajout / Modification / Suppression / Liste
- Gestion partie comptable
  - Dashboard (Factures / Paiements / Graphes)
  - Rapport (Graphes: mois / année) + Vente par produits
  - Sécurité

### 2. Sarah Lina Salamani

> Github: Sarahlyna
 
- Authentification
  - Création table utilisateurs
  - Page de connexion v1.0
  - Page d'inscription v1.0
- Gestion des employés v1.0
  - Ajout / Modification / Suppression / Liste
- Gestion des factures v1.0
  - Transformation des devis en factures
  - Géneration des PDF des factures
  - Filtre des factures (par dates)
- Gestion des devis
  - Génération des PDF des devis 

### 3. Hemavathi Birabourame 

> Github: hema-brm
 
- Gestion des produits
  - Ajout / Modification / Suppression / Liste
  - Recherche des produits
  - Sécurité
- Gestion des catégories
  - Ajout / Modification / Suppression / Liste
  - Sécurité
- Design Liste (Devis / Facture)
- Envoi des mails
  - Devis (Création / Rappel / Renvoi)
  - Factures (Création / Rappel / Renvoi / Retard)
  - Réinitialisation de mot de passe
- Suppression multiple (Employés / Clients / Devis / Factures / Produits / Catégories)
- Fixture (user, entreprise, category, produit)
- Sécurité factures


### 4. Johan Mickaël RAKOTONIAINA

> Github: johan-mickael-myges
- Mise en place de l'environnement de développement
- Integration
  - Tailwind
  - Stimulus
  - Turbo UX
  - Twig Live Component
- Création des composants
  - Pagination
  - Champs des formulaires
  - Bouttons
  - Popup
  - Dropdown
  - Modale
  - Alert
  - Badge
  - Card
  - Clickable Table Row
- Gestion des devis v2.0
  - Nouvelle affichage + mode de création
  - Ajout des produits
  - Gestion des remises globales et par produit
  - Gestion des TVA pour chaque produits
- Gestion des factures v2.0
  - Nouvelle affichage + mode de création
  - Ajout des produits
  - Gestion des remises globales et par produit
  - gestion des tva pour chaque produit
- Gestion des clients
  - CRUD
- Responsivité du site
- Paramètres de l'utilisateur connecté
  - Réinitialisation du mot de passe
  - Modification des informations personnelles
- Page Login + Inscription v2.0 (Design)
- Thèmes du site
- Mise en production
- Résolution des bugs constatés
- Rédaction des documentations (Techniques + Guideline des composants)

---

---

---

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

### Contributing
- Pushing

You have to push only verified commits. To do so, you have to sign your commits with your GPG key.
See this [documentation](docs/setting-up-signed-commit.md) to setup your GPG key.

- Branching

Always create a new branch from `main` branch. The name of the branch should be the name of the feature you're working on.
Example: `feature/adding-new-feature`

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
