<?php

$cpus = [
    [
        'name' => 'Acu j3 Dual-Core (9ème génération)',
        'price' => 125,
    ],
    [
        'name' => 'Acu j5 Quad-Core (9ème génération)', 
        'price' => 250
    ],
    [
        'name' => 'Acu j7 Octo-Core (9ème génération)', 
        'price' => 500
    ],
];

$rams = [
    [
        'name' => '2 x 4 Go π-Rate DDR4',
        'price' => 40
    ],
    [
        'name' => '1 x 8 Go π-Rate DDR4',
        'price' => 50,
    ],
    [
        'name' => '2 x 8 Go π-Rate DDR4',
        'price' => 80,
    ],
    [
        'name' => '1 x 16 Go π-Rate DDR4',
        'price' => 100,
    ],
    [
        'name' => '2 x 16 Go π-Rate DDR4',
        'price' => 160,
    ],
    [
        'name' => '1 x 32 Go π-Rate DDR4',
        'price' => 200,
    ]
];

$gpus = [
    [
        'name' => 'MSCOPIA VeStrength 1050 GTX',
        'price' => 300
    ],
    [
        'name' => 'MSCOPIA VeStrength 1650 GTX',
        'price' => 600
    ],
    [
        'name' => 'MSCOPIA VeStrength 2050 GTX',
        'price' => 900
    ]
];

$oss = [
    [
        'name' => 'Pas de système d\'exploitation', 
        'price' => 0
    ],
    [
        'name' => 'Nanosoft Shutters® 10 - édition familiale', 
        'price' => 100
    ],
    [
        'name' => 'Nanosoft Shutters® 10 - édition professionnelle', 
        'price' => 100
    ]
];

$accessories = [
    'keyboard' => [
        'name' => 'Clavier gamer Rationtech K250',
        'price' => 100
    ],
    'mouse' => [
        'name' => 'Souris gamer Rationtech K502',
        'price' => 80
    ],
    'screen' => [
        'name'=>'Ecran MSCOPIA MB2042',
        'price' => 300
    ]
];

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Composez votre PC gaming sur mesure</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <img src="images/Headerbild-pc-gamer-main.jpg" class="img-fluid mb-4" alt="PC gamer" />
        <h1>Composez votre PC gaming sur mesure</h1>
        <form>
            <h2 class="mt-4 mb-2">Composants</h2>
            <div class="form-group">
                <label for="cpu">Processeur</label>
                <select name="cpu" class="form-control">
                    <?php foreach ($cpus as $index => $cpu): ?>
                    <option value="<?= $index ?>"><?= $cpu['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ram">Mémoire vive</label>
                <select name="ram" class="form-control">
                    <?php foreach ($rams as $index => $ram): ?>
                    <option value="<?= $index ?>"><?= $ram['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="gpu">Carte graphique</label>
                <select name="gpu" class="form-control">
                    <?php foreach ($gpus as $index => $gpu): ?>
                    <option value="<?= $index ?>"><?= $gpu['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="os">Système d'exploitation</label>
                <select name="os" class="form-control">
                    <?php foreach ($oss as $index => $os): ?>
                    <option value="<?= $index ?>"><?= $os['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <h2 class="mt-4 mb-2">Accessoires</h2>
            <?php foreach ($accessories as $index => $accessory): ?>
            <div class="form-group form-check">
                <input name="<?= $index ?>" type="checkbox" class="form-check-input">
                <label class="form-check-label" for="<?= $index ?>"><?= $accessory['name'] ?></label>
            </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Calculer</input>
        </form>
    </div>
</body>
</html>