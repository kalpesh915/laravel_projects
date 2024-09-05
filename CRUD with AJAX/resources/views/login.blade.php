<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include("cdn")
</head>
<body>
    <div class="container-fluid">
        <h1 class="bg-primary text-center text-white p-5">Login Form</h1>

        <form method="post" id="loginForm">
            <div class="my-3 form-floating">
                <input type="email" name="email" id="email" placeholder="Enter Email Address" required class="form-control">
                <label class="form-label" for="email">Enter Email Address</label>
            </div>
            <div class="my-3 form-floating">
                <input type="password" name="password" id="password" placeholder="Enter Email Password" required class="form-control">
                <label class="form-label" for="password">Enter Email Password</label>
            </div>
            <div class="my-3">
                <input type="submit" value="Login" class="btn btn-primary">
                <input type="reset" value="Reset" class="btn btn-danger">
            </div>
        </form>
    </div>
</body>
</html>

<script>
    $(document).ready(function(){
        $("#loginForm").submit(function(){
            alert("Called");
        });
    });
<script>