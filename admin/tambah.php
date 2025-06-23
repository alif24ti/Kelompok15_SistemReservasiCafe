<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>PHP dan MYSQL - form tambah meja</title>
</head>
<body>
    <div class="container"> 
    <h2>Form tambah meja</h2>

    <form action="insert.php" method="post">
        <table class="table table-dark table-striped-columns">
            <thead>
                <th>id meja</td>
                <th><input type= "text" name="id meja" placeholder="id meja" ></td>
            </thead>

            <thead>
                <th>nomor meja</td>
                <th><input type= "text" name="nomor meja" placeholder="nomor meja" ></td>
            </thead>

            <thead>
                <th>kapasitas</td>
                <th><input type= "text" name="kapasitas" placeholder="kapasitas" ></td>
            </thead>
        </table>
        <input type= "submit" name="simpan" value="simpan">
        <input type= "reset" name="batal" value="batal">
        </div>
</body>
</html>