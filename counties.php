<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Vissza</a>
    <h1>Megyék</h1>
    <table>
        <thead>
            <th>#id</th><th>Megnevezés</th><th>Művelet&nbsp;<button><a href="./county.php"><i class="fa fa-plus"></i></a></button></th>
        </thead>
        <tbody>
        <form method="post" action="counties.php">
            <input type="text" name="needle" value="">
            <button type="submit" name="btn-search" method="post">Keres</button>
        </form>
            <?php
                require_once('ItemRepository.php');
                $itemRepository = new ItemRepository();

                $counties = $itemRepository->getAllCounties();

                if (isset($_POST['btn-cancel'])) {}
                if (isset($_POST['btn-save'])) {
                    $countyName = $_POST['county_name'];
                    $countyId = $Post['county_id'];

                    $itemRepository->updateCounty($countyId, $countyName);
                }

                foreach ($counties as $county) {
                    echo ''
                    . '<try>'
                        . '<td>' .$county["id"] . '</td>'
                        . '<td>' .$county["name"] . '</td>'
                        . '<td><div style="display: flex">'
                            . '<form method="post action="county.php">
                                <button type="submit">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <input type="hidden" name="id" value="' . $county['id'] . '">
                            </form>'
                            .'<form method="post" action="counties.php"><button type="submit">
                            </button></form>'
                        . '<td>' . '</div></td>'
                    . '</tr>';
                }

                if (isset($_POST['btn-save-new'])) {
                    $countyName = $_POST['county_name'];

                    $itemRepository->saveCounty($countyName);
                }
                if (isset($_POST['btn-search'])) {
                    $countyName = $_POST['needle'];


                    $itemRepository->searchCounty($needle);
                }
                if (!isset($counties)) {
                    $counties = $itemRepository->getAllCounties();
                }
            ?>
        </tbody>
    </table>
</body>
</html>