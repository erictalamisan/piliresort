<!-- header section starts  -->


<nav class="navbar navbar-expand-lg bg-light py-3 px-5">
        <div class="container-fluid navbar-container pl-5">
          <a class="navbar-brand mr-auto ml-5" href="home.php">
            <img src="../images/favicon.jpg" alt="Logo"> <span>Pili Beach Resort</span>
          </a>
  
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item active">
                <a data-toggle="tooltip" data-placement="bottom" title="Tooltip" class="nav-link" href="home.php">Home</a>
              </li>
            </ul>
          </div>
          
          <ul class="navbar-nav">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                      <strong><?php echo $name; ?></strong>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="../signout.php">Sign Out</a>
                  </div>
              </li>
          </ul>
        </div>
      </nav>



<!-- home section starts  -->