<header class="hero-section text-center py-5">
        <div class="container">
            <h1 class="display-4 t-btn fw-bold">Deploy Your Website in Minutes</h1><br>
            <?
             if(!Session::get('is_login')){
            ?>
            <h1 class="display-6 t-btn fw-bold">Just SignUp and get your free trial</h1>
            <!-- <h1 class="display-6 t-btn fw-bold">Start for free</h1> -->
            <?
            
             }else{
              
                ?>
               
                    <?
                    if(Session::isset('session_user')){
                        $user = Session::get('session_user');
                        // $userobj = new User($user);
                        // print(ucfirst($userobj->getfirstname()));
                        ?>
                        <h1 class="display-6 t-btn fw-bold">"Welcome <?print(ucfirst($user));?>"</h1>
                        <?
                      }
                    ?>

                </h1>
                
                
                <?
                
             }
                ?>

            <p class="lead mb-5 t-black">Simple, fast, and secure web hosting. Upload your project, and we'll handle the rest.<br>Get SSL, custom domain, and 24/7 support included.</p>
            <!-- <a href="#upload" class="btn btn-primary btn-lg">Launch Now</a> -->
             <?
             if(Session::get('is_login')){
                ?>

               <a href="dashboard.php?manage" class="btn btn-primary btn-lg">Dashboard</a>

                <a href="dashboard.php?host" class="btn btn-primary btn-lg">Launch Now</a>
                
                <?}
                else{
                    ?>
                    <a href="signup.php" class="btn btn-primary btn-lg">Start For Free</a>
                    <?
                }
             ?>
            
            <div class="row mt-5 pt-5 g-4 ">
                <div class="col-md-4">
                    <div class="feature-item">
                        <i class="bi bi-lightning-charge"></i>
                        <h3>Lightning Fast</h3>
                        <p>Global CDN ensures your website loads instantly anywhere in the world</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-item">
                        <i class="bi bi-shield-check"></i>
                        <h3>Secure by Default</h3>
                        <p>Free SSL certificates and advanced security features included</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-item">
                        <i class="bi bi-globe"></i>
                        <h3>Custom Domain</h3>
                        <p>Use your own domain or get a free subdomain from us</p>
                    </div>
                </div>
            </div>
        </div>
    </header>