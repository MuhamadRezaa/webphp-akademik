
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 400px;
            background-color: #fff;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-control {
            border: 1px solid #ced4da;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>
<script src="bootstrap/bootstrap.bundle.min.js"></script>

    </body>
</html>
