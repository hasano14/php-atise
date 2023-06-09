<!-- header section strats -->
<header class="header_section">
  <div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="index.php">
        <span>
          Fior
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
          <ul class="navbar-nav  ">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html"> About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gallery.html"> Gallery </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact us</a>
            </li>
            <li class="nav-item">
              <?php
              //If session has started, display logout button
              if (isset($_SESSION['email'])) {
                echo '<a class="nav-link" href="logout.php">Log out</a>';
              } else {
                echo '<a class="nav-link" href="login.php">Log in</a>';
              }
              ?>
            </li>
          </ul>
        </div>
        <div class="quote_btn-container nav-item ">
          <a href="">
            <img src="images/cart.png" alt="">
          </a>
          <form class="form-inline">
            <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
          </form>
        </div>
      </div>
    </nav>
  </div>
</header>
<!-- end header section -->