
<!DOCTYPE html>
<html lang="en">

<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gosite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-light nav-color shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex  align-items-center" href="#">
                <i class="bi bi-server logo-colour fs-4 me-2"></i>
                <span class="color-1 fw-bold">GoSite</span>
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
                                                         <li class="nav-item">
                                <a class="btn btn-primary ms-2" href="https://test.kalaiyarasan.me/gosite/htdocs/index.php#upload">Get Started</a>

                                <a class="btn btn-primary ms-2" href="login.php">Login</a>
                                                    </li>
                </ul>
            </div>
        </div>
    </nav>    <!-- <button id="dark-mode-toggle">Toggle Dark Mode</button> -->


    <!-- banner Section -->
 
    <header class="hero-section text-center py-5">
        <div class="container">
            <h1 class="display-4 t-btn fw-bold">Deploy Your Website in Minutes</h1>
            <p class="lead mb-5 t-black">Simple, fast, and secure web hosting. Upload your project, and we'll handle the rest.<br>Get SSL, custom domain, and 24/7 support included.</p>
            <!-- <a href="#upload" class="btn btn-primary btn-lg">Launch Now</a> -->
                                 <a href="signup.php" class="btn btn-primary btn-lg">Launch Now</a>
                                
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

    <!-- Pricing Section -->

    <section id="pricing" class="pricing-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Pricing For You :)</h2>

        <div class="pricing-toggle text-center mb-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pricingPeriod" id="monthly" checked>
                <label class="form-check-label" for="monthly">Monthly</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pricingPeriod" id="annual">
                <label class="form-check-label" for="annual">Annual (Save 15%)</label>
            </div>
        </div>

        <div class="row g-4">
            <!-- Starter Plan -->
            <div class="col-lg-4">
                <div class="card pricing-card h-100 btn-price">
                    <div class="card-body">
                        <h3>Starter</h3>
                        <div class="price">
                            <span class="amount" id="starterPrice">&#8377 99</span>
                            <span class="t-white" id="starterPricePeriod">/month</span>
                        </div>
                        <ul class="feature-list">
                            <p class="">This Plan For</p>
                            <li><i class="bi bi-arrow-right-circle"></i>Portfolio Page</li>
                            <li><i class="bi bi-arrow-right-circle"></i>Landing Page</li>
                            <li><i class="bi bi-arrow-right-circle"></i>Lightweight websites</li>
                            <li><i class="bi bi-check-circle-fill"></i>Free SSL Certificate</li>
                            <li><i class="bi bi-check-circle-fill"></i>Custom Domain</li>
                            <li><i class="bi bi-check-circle-fill"></i>24/7 Support</li>
                        </ul>
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#paymentModalStarter" data-plan="starter">Get Started</button>
                    </div>
                </div>
            </div>

          


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const monthlyRadio = document.getElementById('monthly');
        const annualRadio = document.getElementById('annual');
        const prices = document.querySelectorAll('.price .amount');

        const priceData = {
            monthly: {
                starter: '99',
                professional: '199',
                business: '499'
            },
            annual: {
                starter: '999',
                professional: '1999',
                business: '4999'
            }
        };

        function updatePrices(period) {
            // Update price based on selected period (monthly or annual)
            prices.forEach(price => {
                const planType = price.closest('.card').querySelector('h3').textContent.toLowerCase();
                const amount = document.getElementById(planType + 'Price');
                const periodLabel = amount.nextElementSibling;
                amount.textContent = '₹' + priceData[period][planType];
                periodLabel.textContent = period === 'monthly' ? '/month' : '/year';

                // Update the hidden input fields
                document.getElementById(planType + 'PriceHidden').value = priceData[period][planType];
                document.getElementById('pricingPeriod' + planType.charAt(0).toUpperCase() + planType.slice(1)).value = period;
            });
        }

        monthlyRadio.addEventListener('change', () => updatePrices('monthly'));
        annualRadio.addEventListener('change', () => updatePrices('annual'));

        // Initialize with the selected monthly period
        updatePrices('monthly');
    });
</script>


    <!-- Upload Section -->
    
    


    <!-- Footer -->
<footer class=" text-center ">
  <!-- Grid container -->
  <div class="container p-4">

    <!-- Section: Social media -->
    
    <!-- Section: Social media -->



    <!-- Section: Text -->

    <!-- Section: Text -->


  </div>
  <!-- Grid container -->
  <section class="mb-4 p-3">
      <p>
      "Your vision, our commitment to hosting excellence.
      Together, we build the future of the web."
      </p>
    </section>

  <!-- Copyright -->
   <div>
    <a class="text-dark p-4" href="policy/Refund-Policy.php">Refund Policy</a>  
    <a class="text-dark p-4" href="policy/Terms-of-Service.php">Terms of Service</a>  
    <a class="text-dark p-4" href="policy/privacy-policy.php">Privacy Policy</a>  
</div>
  <div class="text-center p-3" style="background-color:#106cbb; color: white;">
  <!-- <div>
    <a class="text-dark p-4" href="https://kalaiyarasan.me/">Refund Policy</a>  
    <a class="text-dark p-4" href="https://kalaiyarasan.me/">Terms of Service</a>  
    <a class="text-dark p-4" href="https://kalaiyarasan.me/">Privacy Policy</a>  
</div> -->
    © 2025 Copyright
    <a class="text-white" href="https://kalaiyarasan.me/">@Kalaiyarasan</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
