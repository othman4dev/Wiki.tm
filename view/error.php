<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/style.css">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <title>An Error Occurred</title>
    <style>
        .error-message {
            background-color: #ffcccc;
            color: #ff0000;
            padding: 10px;
            border: 1px solid #ff0000;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            justify-content: space-evenly;
            gap: 10px;
            padding:25px;
        }
    </style>
</head>
<body>
    <div class="error-message">
        <h1> <i class="bi bi-exclamation-triangle-fill"></i> Error</h1>
        <h3>An error occurred while processing your request.</h3>
        <i>This could arise from factors such as an <u>incorrect password</u>, <u>session timeout</u>, <u>invalid input</u>, <u>connectivity issues</u>, or a <u>server error</u>.</i>
    </div>
    <a href="/"><button class="back"><i class="bi bi-caret-left-fill"></i> Return To Dashboard</button></a>
</body>
</html>