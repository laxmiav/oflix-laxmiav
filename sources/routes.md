# Routes de l'application

| URL | Méthode HTTP | Contrôleur       | Méthode | Titre HTML           | Commentaire    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/` | `GET`        | `MainController` | `home`  | Bienvenue sur O'flix | Page d'accueil |
| `/movie/{id}` | `GET`        | `MovieController` | `show`  | Détail du film { nom du film} | Page de détail d'un film |
| `/favorites` | `GET`        | `MovieController` | `favorites`  | Vos favoris | Page des favoris |
| `/list` | `GET`        | `MovieController` | `showList`  | Liste des films | Liste de films |
