<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gosite - Website Hosting Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="bi bi-server text-primary fs-4 me-2"></i>
                <span class="fw-bold">GoSite</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="#upload">Get Started</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Deploy Your Website in Minutes</h1>
            <p class="lead text-muted mb-5">Simple, fast, and secure web hosting. Upload your project, and we'll handle the rest.<br>Get SSL, custom domain, and 24/7 support included.</p>
            <a href="#upload" class="btn btn-primary btn-lg">Launch Now</a>
            
            <div class="row mt-5 pt-5 g-4">
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
    <section id="pricing" class="pricing-section py-5 bg-light">
        <div class="container">
            
            <h2 class="text-center mb-5">Pricing For You :)</h2>
            
            <div class="pricing-toggle text-center mb-4">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pricingPeriod" id="monthly" checked>
                    <label class="form-check-label" for="monthly">Monthly</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pricingPeriod" id="annual">
                    <label class="form-check-label" for="annual">Annual (Save 20%)</label>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card pricing-card h-100">
                        <div class="card-body">
                            <h3>Starter</h3>
                            <div class="price">
                                <span class="amount">&#8377 99</span>
                                <span class="period">/month</span>
                            </div>
                            <ul class="feature-list">
                                <p class="text-muted">This Plan For</p>

                                <li><i class="bi bi-arrow-right-circle"></i>Portfolio Page</li>
                                <li><i class="bi bi-arrow-right-circle"></i>Landing Page</li>
                                <li><i class="bi bi-arrow-right-circle"></i>Lightweight websites</li><br>
                                <!-- <li><i class="bi bi-check-circle-fill"></i></li>    -->
                                <li><i class="bi bi-check-circle-fill"></i>Free SSL Certificate</li>   
                                <li><i class="bi bi-check-circle-fill"></i>Custom Domain</li>
                                <li><i class="bi bi-check-circle-fill"></i>24/7 Support</li>
                            </ul>
                            <button class="btn btn-primary w-100">Get Started</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card pricing-card h-100">
                        <div class="card-body">
                            <h3>Professional</h3>
                            <div class="price">
                                <span class="amount">&#8377 199</span>
                                <span class="period">/month</span>
                            </div>
                            <ul class="feature-list">
                                <p class="text-muted">This Plan For</p>
                                <li><i class="bi bi-arrow-right-circle"></i>Business websites</li>
                                <li><i class="bi bi-arrow-right-circle"></i>Blogs websites</li>
                                <li><i class="bi bi-arrow-right-circle"></i>Medium-scale projects</li><br>
                                <li><i class="bi bi-check-circle-fill"></i>Database Support</li>   
                                <li><i class="bi bi-check-circle-fill"></i>Free SSL Certificate</li>   
                                <li><i class="bi bi-check-circle-fill"></i>Custom Domain</li>
                                <li><i class="bi bi-check-circle-fill"></i>24/7 Support</li>
                            </ul>
                            <button class="btn btn-primary w-100">Get Started</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card pricing-card h-100">
                        <div class="card-body">
                            <h3>Business</h3>
                            <div class="price">
                                <span class="amount">&#8377 499</span>
                                <span class="period">/month</span>
                            </div>
                            <ul class="feature-list">
                                <p class="text-muted">This Plan For</p>
                                <li><i class="bi bi-arrow-right-circle"></i>E-learning platforms</li>
                                <li><i class="bi bi-arrow-right-circle"></i>Online stores</li>
                                <li><i class="bi bi-arrow-right-circle"></i>High-traffic websites</li><br>
                                <li><i class="bi bi-check-circle-fill"></i>Database Support</li>   
                                <li><i class="bi bi-check-circle-fill"></i>Storage Support</li>   
                                <li><i class="bi bi-check-circle-fill"></i>Free SSL Certificate</li>   
                                <li><i class="bi bi-check-circle-fill"></i>Custom Domain</li>
                                <li><i class="bi bi-check-circle-fill"></i>24/7 Support</li>
                            </ul>
                            <button class="btn btn-primary w-100">Get Started</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Upload Section -->
    <section id="upload" class="upload-section py-5">
        <div class="container">
            <h2 class="text-center mb-4">Launch Your Websites <i class="fa fa-rocket" style="font-size:48px;color:rgb(255, 62, 62)"></i>
            </h2>
            <div class="upload-area mx-auto">
                <div class="upload-content">
                    <i class="bi bi-cloud-upload"></i>
                    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <h6>Enter Subdomain Name</h6>
        <input class="form-control" type="text" id="domain" name="domain" required placeholder="" />
        <br><br>

        <h6>Upload Your Project: (.zip)</h6>
        <input type="file" class="form-control form-control-lg" id="file" name="file" accept=".zip" />
        <br><br>
        <button type="submit" class="btn btn-primary">Deploy Now</button>
                    </form>
               </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/pricing.js"></script>
    <script src="js/upload.js"></script>
</body>
</html>
