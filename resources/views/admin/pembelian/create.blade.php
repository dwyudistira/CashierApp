<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pembelian</title>
</head>
<body>
    <div class="form">
        <form action="{{ admin.store }}" method="POST">
            @csrf

            <div>
                <label for=""></label>
                <input type="text">
            </div>
            <div>
                <label for=""></label>
                <input type="text">
            </div>
            <div>
                <label for=""></label>
                <input type="text">
            </div>

        </form>
    </div>
</body>
</html>