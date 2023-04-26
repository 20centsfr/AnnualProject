<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php include('includes/header.php') ?>

  <body>
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="light">
        <div class="container"><a class="navbar-brand" href="index.php"><img src="assets/img/icons/logo.png" height="50" alt="logo" /></a><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        </div>
      </nav>

<section class="background-radial-gradient overflow-hidden">
  <style>
    .background-radial-gradient {
      background-color: hsl(218, 41%, 15%);
      background-image: radial-gradient(650px circle at 0% 0%,
          hsl(218, 41%, 35%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%),
        radial-gradient(1250px circle at 100% 100%,
          hsl(218, 41%, 45%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%);
    }

    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -60px;
      right: -110px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }
  </style>

  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
          TOGETHER <br />
          <span style="color: hsl(218, 81%, 75%)">&STRONGER</span>
        </h1>
        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
          Inscription
        </p>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">
          <div class="card-body px-4 py-5 px-md-5">
            <form action="verifins.php" method="POST" enctype="multipart/form-data">
              <div class="form-outline mb-4">
                <input type="text" name="prenom" id="prenom" class="form-control" required=""/>
                <label class="form-label">Prenom</label>
              </div>
              <div class="form-outline mb-4">
                <input type="text" name="nom" id="nom" class="form-control" required=""/>
                <label class="form-label">Nom</label>
              </div>
              <div class="form-outline mb-4">
                <input type="text" name="entreprise" id="entreprise" class="form-control" required=""/>
                <label class="form-label">Entreprise</label>
              </div>
              <div class="form-outline mb-4">
                <input type="email" name="email" id="email" class="form-control" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>" required=""/>
                <label class="form-label">Addresse mail</label>
              </div>
              <div class="form-outline mb-4">
                <input type="password" name="mdp" id="mdp" class="form-control" required="" />
                <label class="form-label">Mot de passe</label>
              </div>
              <div class="form-outline mb-4">
                <input type="password" name="mdp2" id="mdp" class="form-control" required="" />
                <label class="form-label">Confirmer le mot de passe</label>
              </div>
              <? include 'includes/message.php' ?>
              <!--<button type="submit" class="btn btn-primary btn-block mb-4">S'inscrire</button>-->
              <input class="btn btn-primary btn-block mb-4" type="submit" value="S'inscrire">
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
    </main>

  </body>

</html>