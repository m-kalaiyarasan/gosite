<nav class="navbar navbar-expand-lg navbar-light nav-color shadow-sm">
        <div class="container">
            
            <a class="navbar-brand d-flex  align-items-center" href="#">

                            <img class="mb-2 "src="logo.png" alt="" width="50" height="50" alt="">
                  
                <span class="color-1 fw-bold" style="font-size: 30px;">GoSite</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">   
                        <a class="color-1 nav-link" href="index.php">Home</a>
                    </li>
                    <li class="t nav-item">
                        <a class="color-1 nav-link" href="index.php#pricing">Pricing</a>
                    </li>
                    
                    <li class="t nav-item">
                        <a class="color-1 nav-link" href="contact.php">Support</a>
                    </li>
                    
                        <!-- <a class="btn btn-primary ms-2" href="signup.php">Sign up</a> -->
                         <?
                         if(Session::get('is_login')){
                                ?>
                                 <li class="nav-item">
                                <!-- <a class="btn btn-primary ms-2" href="dashboard.php?manage">Dashboard</a> -->

                                <a class="btn btn-primary ms-2" href="logintest.php?logout">Logout</a>
                                <?
                            }
                            else{
                                ?>
                                <li class="nav-item">
                                <a class="btn btn-primary ms-2" href="signup.php">Get Started</a>

                                <a class="btn btn-primary ms-2" href="login.php">Login</a>
                                <?
                         }
                         ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>