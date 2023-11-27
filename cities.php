<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Vissza</a>
    <h1>Városok</h1>
        <form>
            <select name ="countyDropdown" id = "countyDropdown">
                <option value="">Válassz megyét</option>
                <?php
                require_once('ItemRepository.php');

                $itemRepository = new ItemRepository();
                $counties = $itemRepository->getAllCounties();
                ?>

</body>
</html>