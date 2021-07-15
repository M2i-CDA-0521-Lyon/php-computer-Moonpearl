<?php

include '../data/config.php';

// Si les query parameters ne sont pas vides, c'est donc que l'utilisateur vient de valider le formulaire
if (!empty($_GET)) {
    // Vérifie que toutes les clés indispensables dans le formulaire sont bien présentes dans les query parameters
    if (isset($_GET['cpu']) &&
        isset($_GET['ram']) &&
        isset($_GET['gpu']) &&
        isset($_GET['os'])
    ) {
        // Récupère l'index des différents composants dans les query parameters
        $cpuIndex = intval($_GET['cpu']);
        $ramIndex = intval($_GET['ram']);
        $gpuIndex = intval($_GET['gpu']);
        $osIndex = intval($_GET['os']);
    
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

        // Affiche le prix total dans la page
        echo $totalPrice;
    // Sinon, c'est que la requête HTTP a été falsifiée
    } else {
        // Affiche un message d'erreur dans la page
        echo 'Formulaire invalide';
    }
}

// Redirige vers la page d'accueil
header('Location: /?totalPrice=' . $totalPrice);
