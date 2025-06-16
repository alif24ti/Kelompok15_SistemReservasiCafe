<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP dan MYSQL - form tambah meja</title>
</head>
<body>
    
    <h2>Form tambah meja</h2>

    <form action="insert.php" method="post">
        <table>
            <tr>
                <td>id meja</td>
                <td><input type= "text" name="id meja" placeholder="id meja" size="11"></td>
            </tr>

            <tr>
                <td>nomor meja</td>
                <td><input type= "text" name="nomor meja" placeholder="nomor meja" size="11"></td>
            </tr>

            <tr>
                <td>kapasitas</td>
                <td><input type= "text" name="kapasitas" placeholder="kapasitas" size="11"></td>
            </tr>

            <tr>
                <td>
                    <input type= "submit" name="simpan" value="simpan">
                    <input type= "reset" name="batal" value="batal">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>