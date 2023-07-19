<!DOCTYPE html>
<html lang="en">
<head>
    <title>You have been logged out!</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="views/style.css" media="screen" rel="stylesheet" type="text/css">
    <meta http-equiv="refresh" content="2; url=login.php"> <!-- content - how many secons to w8 before we refresh the page, 
                                                            url - what page we want to redirect the user to -->
    
</head>
<body>
    <h1>Logged Out</h1>
    <div id='content'>
        <p>You have been successfully logged out. You will now be redirected to the login page.</p>

        <noscript><a href='login.php'>Login.php</a></noscript> <!--in case they dont have JS enabled and redirect doesnt work for them -->
    </div>
    
</body>
</html>