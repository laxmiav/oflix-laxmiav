# Formulaires

[La doc](https://symfony.com/doc/current/forms.html)

- Installer le composant

`composer require symfony/form`

- Créer la classe de formulaire

`bin/console make:form`

- Configurer la classe en spécifiant les types et les options pour chaque champ

## Dans le controller

- créer l'objet formulaire et le founir à la vue ( avec `$this->renderForm` )

## Dans la vue twig

- Afficher le formulaire grace aux fonctions form_ [Cf La doc](https://symfony.com/doc/current/form/form_customization.html)

## Traitement du formulaire ( retour dans le meme controller )

on ajoute la partie

```php
$form->handleRequest($request)
if($form->isSubmitted() && $form->isValid)
{
    // traitement du formulaire 
    // redirection
}
```
