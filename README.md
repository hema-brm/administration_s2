# Symfony Docker (PHP8 / Caddy / Postgresql / NPM)

### Installer le projet en local

- Cloner l'application  
_via https_
```bash
git clone https://github.com/hema-brm/administration_s2.git
```  
_via ssh_
```bash
git clone git@github.com:hema-brm/administration_s2.git
```

- Build l'application
```bash
docker compose build --no-cache --pull
```

- Lancer l'application
```bash
docker compose up -d
```

- Installer les dépendances
```bash
docker compose exec php composer install
```
```bash
docker compose exec php npm install
```

- Entrer l'url sur un navigateur  
  [https://localhost:8443](https://localhost:8443/)

- Arrêter docker
```bash
docker compose down --remove-orphans
```

### Accèder à l'application en prod
voici le lien qui dirige vers :
  - l'application : [easy.zorglux.eu](https://easy.zorglux.eu/)
  - l'adminer : [easy.zorglux.eu/adminer](https://easy.zorglux.eu/adminer)

### Emplacement

- **Adminer** se situe dans le docker-compose.
- **Nginx** se situe dans le serveur de d'hébergement.
- **Toutes** les configurations ont été effectuées sur le serveur d'hebergement.

