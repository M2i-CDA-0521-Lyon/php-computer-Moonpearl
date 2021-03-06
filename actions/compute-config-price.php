<?php

include '../data/config.php';

// Définit le fonctionnement normal du processus
try {
    // Si les query parameters sont vides, c'est donc que l'utilisateur a tenté d'accéder à ce script sans passer par le formulaire
    if (empty($_GET)) {
        // Génère une erreur qui interrompt brutalement le processus
        throw new Error('Query parameters should not be empty.', 0);
    }

    // Vérifie que toutes les clés indispensables dans le formulaire sont bien présentes dans les query parameters
    if (!isset($_GET['cpu']) ||
        !isset($_GET['ram']) ||
        !isset($_GET['gpu']) ||
        !isset($_GET['os'])
    ) {
        // Génère une erreur qui interrompt brutalement le processus
        throw new Error('Query parameter is missing.', 1);
    }

    // Récupère l'index des différents composants dans les query parameters
    $cpuIndex = intval($_GET['cpu']);
    $ramIndex = intval($_GET['ram']);
    $gpuIndex = intval($_GET['gpu']);
    $osIndex = intval($_GET['os']);

    // Si l'un des query parameters fait référence à un enregistrement non-existant dans les données
    if (!isset($cpus[$cpuIndex]) ||
        !isset($rams[$ramIndex]) ||
        !isset($gpus[$gpuIndex]) ||
        !isset($oss[$osIndex])
    ) {
        // Génère une erreur qui interrompt brutalement le processus
        throw new Error('Query parameter refers to non-existing record.', 2);
    }
        
    // Ajoute le prix de chaque composant au prix total
    $totalPrice =
        $cpus[$cpuIndex]['price'] +
        $rams[$ramIndex]['price'] +
        $gpus[$gpuIndex]['price'] +
        $oss[$osIndex]['price']
    ;
            
    // Si la case "clavier" a été cochée
    if (isset($_GET['keyboard']) && $_GET['keyboard'] === 'on') {
        // Ajoute la prix du clavier au prix total
        $totalPrice += $accessories['keyboard']['price'];
    }

    // Si la case "souris" a été cochée
    if (isset($_GET['mouse']) && $_GET['mouse'] === 'on') {
        // Ajoute la prix du souris au prix total
        $totalPrice += $accessories['mouse']['price'];
    }

    // Si la case "écran" a été cochée
    if (isset($_GET['screen']) && $_GET['screen'] === 'on') {
        // Ajoute la prix du écran au prix total
        $totalPrice += $accessories['screen']['price'];
    }

    // Redirige vers la page d'accueil en précisant le prix total et l'ensemble des composants choisis
    header('Location: /?totalPrice=' . $totalPrice . '&' . http_build_query($_GET));
}
// Si une erreur a été rencontrée à n'importe quel niveau du processus
catch (Error $error) {
    // Redirige vers la page d'accueil en précisant un code d'erreur
    header('Location: /?error=' . $error->getCode());
}
