<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'auth.php';
    die();
} else { ?>

<?php include __DIR__ . '/templates/header.php'; ?>

      <section class="hero is-background">
        <div class="hero-body">
          <div class="container">
            <div class="columns is-centered">
              <div class="column is-5-tablet is-4-desktop is-3-widescreen">
                <form action="" method="POST" class="box">
                  <div class="field">
                    <label for="" class="label">User Name</label>
                    <div class="control has-icons-left">
                      <input type="text" placeholder="e.g. bob" class="input" name="username" required>
                      <span class="icon is-small is-left">
                        <i class="fa fa-user"></i>
                      </span>
                    </div>
                  </div>
                  <div class="field">
                    <label for="" class="label">Password</label>
                    <div class="control has-icons-left">
                      <input type="password" placeholder="*******" class="input" name="password" required>
                      <span class="icon is-small is-left">
                        <i class="fa fa-lock"></i>
                      </span>
                    </div>
                  </div>
                  <div class="field">
                    <button class="button is-success">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

<?php include __DIR__ . '/templates/footer.php'; ?>

<?php } ?>