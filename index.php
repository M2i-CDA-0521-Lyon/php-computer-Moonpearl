<?php include 'data/config.php'; ?>

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
        <form action="actions/compute-config-price.php">
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