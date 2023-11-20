## Inscription Entreprise

### Table `users`

- `id`* : Identifiant unique de l'utilisateur
- `email`* : Adresse email de l'utilisateur
- `password`* : Mot de passe de l'utilisateur
- `lastname` : Nom de l'utilisateur
- `firstname` : Prénom de l'utilisateur
- `role` : Rôle de l'utilisateur (ADMIN, COMPANY, EMPLOYEE, ACCOUNTANT)

### Table `company`

- `id`* : Identifiant unique de l'entreprise
- `name`* : Nom de l'entreprise
- `siret`* : Numéro SIRET de l'entreprise
- `address`* : Adresse de l'entreprise
- `description` : Description de l'entreprise
- `logo` : Logo de l'entreprise
- `phone` : Numéro de téléphone de l'entreprise
- `user_id`* : Identifiant du gérant de l'entreprise

### Table `category`

- `id`* : Identifiant unique de la catégorie
- `name`* : Nom de la catégorie

### Table `category_company`
- `category_id`* : Identifiant de la catégorie
- `company_id`* : Identifiant de l'entreprise

### Table `sub_category`

- `id`* : Identifiant unique de la sous-catégorie
- `name`* : Nom de la sous-catégorie
- `category_id`* : Identifiant de la catégorie

### Table `product`
- `id`* : Identifiant unique du produit
- `name`* : Nom du produit
- `description` : Description du produit
- `price`* : Prix du produit

### Table `product_sub_category`
- `product_id`* : Identifiant du produit
- `sub_category_id`* : Identifiant de la sous-catégorie

### Table `customer`
- `id`* : Identifiant unique du client
- `email`* : Adresse email du client
- `company_id`* : Identifiant de l'entreprise
- `lastname`* : Nom du client
- `firstname`* : Prénom du client
- `address`* : Adresse du client
- `phone`* : Numéro de téléphone du client


### Table `quote`
- `id`* : Identifiant unique du devis
- `date`* : Date du devis
- `status`* : Statut du devis (WAITING, ACCEPTED, REFUSED)
- `customer_id`* : Identifiant du client
- `total_price`* : Prix total du devis
- `discount` : Réduction du devis

### Table `invoice`
- `id`* : Identifiant unique de la facture
- `date`* : Date de la facture
- `payement_status`* : Statut du paiement la facture (WAITING, PAID, CANCELED)
- `quote_id`* : Identifiant du devis

### Table `quote_product`
- `invoice_id`* : Identifiant de la facture
- `product_id`* : Identifiant du produit
- `quantity`* : Quantité du produit
- `discount` : Réduction du produit

### Table `payement`
- `id`* : Identifiant unique du paiement
- `type`: Type de paiement (CB, CHEQUE, CASH)
- `date`* : Date du paiement
