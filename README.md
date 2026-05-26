# Projet 2 — Option A : ChauveQuiPeut

Site vitrine + gestion des réservations pour un salon de coiffure.
Stack : **PHP 8** + **PDO** + **MariaDB / MySQL**, sans framework.

---

## 1. Pré-requis

- **XAMPP** (Apache + MySQL + PHP ≥ 8.0)
- **phpMyAdmin** (fourni avec XAMPP)

### Démarrer Apache et MySQL

1. Ouvrir le **XAMPP Control Panel**.
2. Cliquer sur **Start** à côté de **Apache** *et* de **MySQL**.

### Placer le projet dans XAMPP

Copier le dossier du projet dans `htdocs` de XAMPP :

- Windows : `C:\xampp\htdocs\salon-coiffure\`
- macOS   : `/Applications/XAMPP/htdocs/salon-coiffure/`

### Créer la base via phpMyAdmin

1. Ouvrir [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Cliquer sur l'onglet **Nouvelle base de données**.
3. Nom : `salon-coiffure` — Interclassement : `utf8mb4_unicode_ci` — **Créer**.
4. Sélectionner la base `salon-coiffure` dans la barre de gauche.
5. Onglet **SQL** → coller le schéma ci-dessous → **Exécuter**.

Schéma minimal :

```sql
CREATE DATABASE IF NOT EXISTS `salon-coiffure`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `salon-coiffure`;

CREATE TABLE disponibilites (
  Id_disponibilites INT AUTO_INCREMENT PRIMARY KEY,
  jour_semaine VARCHAR(50) NOT NULL,
  heure_debut  TIME NOT NULL,
  heure_fin    TIME DEFAULT NULL,
  actif        TINYINT(1) NOT NULL DEFAULT 1
);

CREATE TABLE services (
  Id_services    INT AUTO_INCREMENT PRIMARY KEY,
  nom            VARCHAR(50)  NOT NULL,
  description    TEXT         NOT NULL,
  duree_minutes  INT          NOT NULL,
  prix_euros     DECIMAL(15,2) NOT NULL
);

CREATE TABLE reservations (
  Id_reservations    INT AUTO_INCREMENT PRIMARY KEY,
  date_rdv           DATE         NOT NULL,
  heure_rdv          TIME         NOT NULL,
  nom_client         VARCHAR(50)  NOT NULL,
  email_client       VARCHAR(255) NOT NULL,
  telephone          VARCHAR(10)  NOT NULL,
  statut             VARCHAR(50)  NOT NULL DEFAULT 'en_attente',
  Id_disponibilites  INT NOT NULL,
  Id_services        INT NOT NULL,
  FOREIGN KEY (Id_disponibilites) REFERENCES disponibilites(Id_disponibilites),
  FOREIGN KEY (Id_services)       REFERENCES services(Id_services)
);
```

### Lancer le projet

Une fois Apache et MySQL démarrés dans le XAMPP Control Panel, ouvrir :

[http://localhost/salon-coiffure/](http://localhost/salon-coiffure/)

(adapter le segment d'URL au nom du dossier copié dans `htdocs`).

---

## 2. Configuration

Les paramètres de connexion sont dans `config.php` :

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'salon-coiffure');
define('DB_USER', 'root');
define('DB_PASS', '');
```

PDO est configuré en **`ERRMODE_EXCEPTION`** + **`FETCH_ASSOC`** (les requêtes lancent des exceptions, les `fetch` renvoient des tableaux associatifs).

---

## 3. Structure du projet

```
.
├── config.php                  # Connexion PDO
├── index.php                   # Page d'accueil
├── contact.php                 # Page contact
├── reservations.php            # READ — liste des réservations
├── ajouter-reservation.php     # CREATE — (à implémenter)
├── modifier-reservation.php    # UPDATE — formulaire + traitement
├── supprimer-reservation.php   # DELETE — traitement + redirection
├── css/
│   ├── style.css               # Styles communs (header, footer, base)
│   ├── index.css               # Styles de l'accueil
│   └── contact.css             # Styles de la page contact
└── includes/
    ├── header.php              # <head>, navigation, top-bar
    └── footer.php              # Footer + scripts
```

---

## 4. CRUD étape par étape

Toutes les opérations utilisent **PDO en requêtes préparées** pour éviter les injections SQL. Les FK `Id_services` et `Id_disponibilites` garantissent l'intégrité référentielle.

### C — Create : créer une réservation

> Fichier : `ajouter-reservation.php` *(à implémenter)*

Bouton d'entrée : **`+ Nouvelle réservation`** sur `reservations.php`.

Étapes attendues (mêmes principes que `modifier-reservation.php`) :

1. **GET** : afficher un formulaire vide avec les selects `services` et `disponibilites` chargés depuis la BDD.
2. **POST** :
   - Récupérer les champs (`date_rdv`, `heure_rdv`, `nom_client`, `email_client`, `telephone`, `statut`, `Id_services`, `Id_disponibilites`).
   - Valider côté serveur (email, téléphone 10 chiffres, statut dans la liste, FK > 0).
   - `INSERT INTO reservations (...) VALUES (...)` via requête préparée.
   - Rediriger vers `reservations.php?cree=1`.
3. **Affichage du succès** : sur `reservations.php`, ajouter un bandeau pour `?cree=1`.

---

### R — Read : lister les réservations

> Fichier : `reservations.php`

**Étape 1 — Connexion BDD**

```php
require 'config.php';   // $pdo disponible
```

**Étape 2 — Requête SQL avec jointure**

```php
$sql = "SELECT r.*, s.nom AS service_nom
        FROM reservations r
        LEFT JOIN services s ON r.Id_services = s.Id_services
        ORDER BY r.date_rdv DESC, r.heure_rdv DESC";
$reservations = $pdo->query($sql)->fetchAll();
```

- `LEFT JOIN` pour récupérer le nom du service dans la même ligne.
- `ORDER BY` pour montrer les réservations les plus récentes en premier.

**Étape 3 — Affichage HTML**

- Si `$reservations` est vide → alert Bootstrap *"Aucune réservation pour le moment."*.
- Sinon, boucle `foreach` qui rend un `<tr>` par ligne avec :
  - Client, email, téléphone, date, heure, service, statut (badge coloré).
  - Liens **Modifier** et **Supprimer** vers les autres scripts CRUD.

**Étape 4 — Bandeaux de feedback**

- `?supprime=1` → "Réservation supprimée avec succès."
- `?modifie=1`  → "Réservation modifiée avec succès."
- `?cree=1`     → "Réservation créée avec succès." *(à ajouter avec le Create)*

---

### U — Update : modifier une réservation

> Fichier : `modifier-reservation.php`
> URL : `modifier-reservation.php?id={Id_reservations}`

**Étape 1 — Récupérer l'ID depuis l'URL**

```php
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) { header('Location: reservations.php'); exit; }
```

Cast `(int)` = blindage minimum contre les injections via paramètre.

**Étape 2 — Traitement du POST (avant de réafficher le form)**

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 2a. Récupérer chaque champ : trim() + cast (int) pour les FK
    // 2b. Valider : email FILTER_VALIDATE_EMAIL, téléphone /^\d{10}$/, etc.
    // 2c. Si pas d'erreurs : UPDATE et redirect ?modifie=1
}
```

UPDATE en requête préparée :

```php
$stmt = $pdo->prepare(
  "UPDATE reservations
   SET date_rdv = ?, heure_rdv = ?, nom_client = ?, email_client = ?,
       telephone = ?, statut = ?, Id_services = ?, Id_disponibilites = ?
   WHERE Id_reservations = ?"
);
$stmt->execute([...]);
```

Redirection après succès → `reservations.php?modifie=1` puis `exit`.

**Étape 3 — Charger la réservation à modifier (pour pré-remplir le form)**

```php
$stmt = $pdo->prepare("SELECT * FROM reservations WHERE Id_reservations = ?");
$stmt->execute([$id]);
$resa = $stmt->fetch();
if (!$resa) { header('Location: reservations.php'); exit; }
```

Si POST a échoué (erreurs de validation), on fusionne les valeurs saisies dans `$resa` pour ne pas perdre la saisie de l'utilisateur.

**Étape 4 — Charger les listes pour les `<select>`**

```php
$services       = $pdo->query("SELECT Id_services, nom FROM services ORDER BY nom")->fetchAll();
$disponibilites = $pdo->query("SELECT Id_disponibilites, jour_semaine, ... FROM disponibilites ORDER BY Id_disponibilites")->fetchAll();
```

**Étape 5 — Afficher le formulaire**

- Inputs `<input value="<?= htmlspecialchars(...) ?>">` pour empêcher l'XSS.
- Selects avec `selected` sur l'option correspondant à la valeur courante (`$resa['Id_services']`, etc.).
- Bloc `alert-danger` listant chaque erreur si la validation a échoué.

---

### D — Delete : supprimer une réservation

> Fichier : `supprimer-reservation.php`
> URL : `supprimer-reservation.php?id={Id_reservations}`

**Étape 1 — Connexion BDD**

```php
require 'config.php';
```

**Étape 2 — Récupérer et valider l'ID**

```php
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
```

**Étape 3 — Suppression (requête préparée + WHERE obligatoire)**

```php
if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM reservations WHERE Id_reservations = ?");
    $stmt->execute([$id]);
}
```

Deux sécurités essentielles :
- **Requête préparée** → pas d'injection SQL possible via `?id=`.
- **WHERE obligatoire** → impossible de vider toute la table par erreur.

**Étape 4 — Redirection avec feedback**

```php
header("Location: reservations.php?supprime=1");
exit;
```

Le `exit` est obligatoire après `header()` pour stopper l'exécution du script.

**Étape 5 — Côté liste**

Le bouton supprimer dans `reservations.php` demande une confirmation JavaScript avant d'ouvrir le lien :

```html
<a href="supprimer-reservation.php?id=<?= (int) $resa['Id_reservations'] ?>"
   onclick="return confirm('Supprimer cette réservation ?')">Supprimer</a>
```

---

## 5. Sécurité — récap

| Risque | Mesure prise |
|---|---|
| Injection SQL | Toutes les écritures passent par `PDO::prepare()` + `execute([...])`. |
| XSS | `htmlspecialchars()` sur tout output dynamique dans le HTML. |
| Suppression accidentelle de toute la table | `WHERE Id_reservations = ?` obligatoire, cast `(int)` sur l'id. |
| FK orphelines | Contraintes `FOREIGN KEY` sur `Id_services` et `Id_disponibilites`. |
| Validation côté serveur | Email (`FILTER_VALIDATE_EMAIL`), téléphone (`/^\d{10}$/`), statut dans liste blanche. |

---

## 6. Statuts possibles

`en_attente` · `confirmé` · `annulé`

Le badge affiché sur la liste est rouge (`bg-danger`) si `annulé`, vert (`bg-success`) sinon.
