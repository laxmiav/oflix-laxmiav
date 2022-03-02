# Routes de l'application

| URL | Méthode HTTP | Contrôleur       | Méthode | Titre HTML           | Commentaire    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/` | `GET`        | `MainController` | `home`  | Bienvenue sur O'flix | Page d'accueil |
| `/movie/{id}` | `GET`        | `MovieController` | `show`  | Détail du film { nom du film} | Page de détail d'un film |
| `/favorites` | `GET`        | `MovieController` | `favorites`  | Vos favoris | Page des favoris |
| `/list` | `GET`        | `MovieController` | `showList`  | Liste des films | Liste de films |



/backoffice/movie/browse > affiche la liste
/backoffice/movie/{id}/read > affiche le détail
/backoffice/movie/{id}/edit > affiche le form de mise à jour
/backoffice/movie/add > affiche le form d'ajout
/backoffice/movie/{id}/delete > supprime et redirige vers la liste