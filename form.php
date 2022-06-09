<?php
// nothing
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <div class="container mt-5">
        <form action="main.php" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3 mt-3">
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter email">
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="text" name="age" class="form-control" id="age" placeholder="18...">
                <label for="username">Age</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="text" name="text" class="form-control" id="text" placeholder="Enter text">
                <label for="email">Text</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="text" name="email" class="form-control" id="email" placeholder="Enter text">
                <label for="email">E-mail</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="text" name="date" class="form-control" id="date" placeholder="Enter text">
                <label for="date">Date</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <textarea rows="10" name="tags" class="form-control" id="tags" style="min-height: 100px" placeholder="Enter text"></textarea>
                <label for="tags">Tags</label>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">File</label>
                <input type="file" name="upload_file" class="form-control form-control-lg" id="formFile">
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="text" name="password" class="form-control" id="password" placeholder="Enter password">
                <label for="password">Password</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>