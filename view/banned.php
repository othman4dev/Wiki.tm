<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/style/style.css">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="/assets/images/favicon.svg" type="image/x-icon">
    <title>404 - Page Not Found</title>
    <style>
        body {
            text-align: center;
            padding: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        h1 {
            font-size: 48px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
        .notFound {
            background-color: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="notFound">
        <h1><i class="bi bi-exclamation-triangle-fill"></i>Your account was banned</h1>
        <div class="account-view">
            <i class="bi bi-person-exclamation" style="font-size: 99px"></i>
            <div style="display:flex;flex-direction:column;gap:0px;height:fit-content">
                <p class="info-acc"><?=$_SESSION['user']['name']?></p>
                <p class="info-acc"><?=$_SESSION['user']['email']?></p>
            </div>
            <p class="info-ac">You can't create an other account with this email</p>
        </div>
        <br><br>
        <p>Contact the admin for more information</p>
        <p>Go back to <a href="/logout">login with an other account</a>.</p>
    </div>
</body>
</html>