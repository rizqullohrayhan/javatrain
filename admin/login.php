<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="img/javatrain.png" type="image/x-icon">
    <title>Login - Admin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background-image:url(img/shinkansen.jpg);
            background-size:cover;
            background-repeat:no-repeat;
            background-position:center;
            background-attachment:fixed;
        }
    </style>
  </head>

  <body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-md-8 col-lg-6">
            <div class="card bg-dark text-white">
              <div class="card-body p-5">
                <form class="mb-3 mt-md-4" action="db/dblogin.php" method="POST">
                  <h2 class="fw-bold mb-2 text-uppercase ">JAVATRAIN</h2>
                  <p class=" mb-5">Masukkan username dan password Anda!</p>
                  <div class="mb-3">
                    <label for="username" class="form-label ">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label ">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                  </div>
                  <div class="d-grid">
                    <button class="btn btn-light" name="login" type="submit">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </body>

</html>