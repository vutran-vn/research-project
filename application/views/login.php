<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
        <style>
            header {
                text-align: center;
            }
            form {
                margin: 0 auto;
                width: 400px;
                height: 250px;
                border: 2px solid #e6ffe6;
                border-radius: 5px;
                color: #004d00;
                background-color: #e6ffe6;
            }
            .input-group {
                margin: 20px;
            }
            .input-group.password {
                margin-bottom: 0;
            }
            .input-group.remember-me {
                margin: 5px 20px 20px 20px;
                border-bottom: 1px solid #004d00;
                padding-bottom: 20px;
            }
            form label:first-child {
                float: left;
                width: 100px;
                margin: 10px 0;
            }
            input[type=text] {
                padding: 12px 20px;
                border: 1px solid #b3ffb3;
                border-radius: 4px;
                box-sizing: border-box;
                width: 260px;
            }
            input[type=password] {
                padding: 12px 20px;
                border: 1px solid #b3ffb3;
                border-radius: 0 4px 4px 0;
                border-left: 0px;
                box-sizing: border-box;
                width: 225px;
            }
            input[type=submit] {
                font-size: 15px;
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: #45a049;
            }
            #forgot-password {
                float: right;
                font-size: 12px;
                text-decoration: none;
                margin-top: 25px;
                color: #000000;
            }
            #forgot-password:hover {
                color: #4CAF50;
            }
            .input-group-addon {
                float: left;
                padding: 11px 6px;
                border: 1px solid #b3ffb3;
            }
        </style>
    </head>
    <body>
        <header>
            <h2>32933 Research Project - Autumn 2016</h2>
            <hr>
        </header>
        <form action="index.php/login/check_input" method="POST">
            <div class="input-group username">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
            </div>

            <div class="input-group password">
                <label for="password">Password</label>
                <span class="input-group-addon"><i class="fa fa-lock fa-fw" aria-hidden="true"></i></span>
                <input type="password" id="password" name="password">
            </div>

            <div class="input-group remember-me">
                <label></label>
                <label><input type="checkbox" id="remember-me" name="remember-me">Remember me</label>
            </div>

            <div class="input-group">
                <label></label>
                <input type="submit" value="Login">
                <a href="#" id="forgot-password">Forgot password?</a>
            </div>
        </form>
    </body>
</html>
