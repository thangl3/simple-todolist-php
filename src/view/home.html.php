<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List to do</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
</head>
<style>
    .table td {
        padding: 0.75rem 0.5rem;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">ToDo</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/create">Create</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="row">

            <?php if (isset($sucess)) { ?>
            <div class="col-12">
                <div class="alert alert-success text-center" role="alert">
                    <?= $sucess ?>
                </div>
            </div>
            <?php } ?>

            <?php if (isset($notify)) { ?>
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    <?= $notify ?>
                </div>
            </div>
            <?php } ?>

            <div class="col-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Task name</th>
                            <th scope="col">Start date</th>
                            <th scope="col">End date</th>
                            <th scope="col" class="text-center" colspan="3">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($works as $key => $work) { ?>
                        <tr>
                            <th scope="row"><?= $work->workId ?></th>
                            <td><?= $work->workName ?></td>
                            <td><?= $work->startDate ?></td>
                            <td><?= $work->endDate ?></td>
                            <td>
                                <a href="/edit?id=<?= $work->workId ?>">
                                    <i class="far fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a href="/view?id=<?= $work->workId ?>">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                            <td>
                                <a href="/delete?id=<?= $work->workId ?>">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</html>