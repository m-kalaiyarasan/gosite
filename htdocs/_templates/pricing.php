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
                            <span class="t-blasck" id="starterPricePeriod">/month</span>
                        </div>
                        <ul class="feature-list">
                            <p class="">This Plan For</p>
                            <li><i class=" bi bi-arrow-right-circle"></i>Portfolio Page</li>
                            <li><i class=" bi bi-arrow-right-circle"></i>Landing Page</li>
                            <li><i class=" bi bi-arrow-right-circle"></i>Business websites</li>          
                            <li><i class=" bi bi-arrow-right-circle"></i>Lightweight websites</li><br>
                            <li><i class=" bi bi-check-circle-fill"></i>Free SSL Certificate</li>
                            <li><i class=" bi bi-check-circle-fill"></i>Custom Domain Support</li>
                            <li><i class=" bi bi-check-circle-fill"></i>24/7 Support</li>
                        </ul>
                        <?
                        if(Session::get('is_login')){
                            ?>
                            
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#paymentModalStarter" data-plan="starter">Get Started</button>
                            
                         <?
                        }else{

                            ?>
                            <button type="button" class="btn btn-primary w-100" onclick="window.location.href='login.php';">Get Started</button>    
   
                            <?
   
                           }
                           ?>
                        
                        
                    </div>
                </div>
            </div>

            <!-- Professional Plan -->
            <div class="col-lg-4">
                <div class="card pricing-card h-100 btn-price">
                    <div class="card-body">
                        <h3>Wordpress</h3>
                        <div class="price">
                            <span class="amount" id="wordpressPrice">&#8377 199</span>
                            <span class="t-black" id="wordpressPricePeriod">/month</span>
                        </div>
                        <ul class="feature-list">
                            <p class="">This Plan For</p>
                            <li><i class=" bi bi-arrow-right-circle"></i>Business websites</li>
                            <li><i class=" bi bi-arrow-right-circle"></i>Blog websites</li>
                            <li><i class=" bi bi-arrow-right-circle"></i>Medium-scale projects</li><br>
                            <li><i class=" bi bi-check-circle-fill"></i>Database Support</li>
                            <li><i class=" bi bi-check-circle-fill"></i>Free SSL Certificate</li>
                            <li><i class=" bi bi-check-circle-fill"></i>Custom Domain Support</li>
                            <li><i class=" bi bi-check-circle-fill"></i>24/7 Support</li>
                        </ul>
                        <?
                        if(Session::get('is_login')){
                            ?>
                        <!-- <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#paymentModalWordpress" data-plan="wordpress" disabled>Comming Soon</button> -->
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#paymentModalWordpress" data-plan="wordpress" >Get Started</button>
                        
                        <?
                        }else{

                         ?>
                         <button type="button" class="btn btn-primary w-100" onclick="window.location.href='login.php';">Get Started</button>    

                         <?

                        }
                        ?>

                    </div>
                </div>
            </div>

            <!-- Business Plan -->
            <div class="col-lg-4">
                <div class="card pricing-card h-100 btn-price">
                    <div class="card-body">
                        <h3>Business</h3>
                        <div class="price">
                            <span class="amount" id="businessPrice">&#8377 499</span>
                            <span class="t-black" id="businessPricePeriod">/month</span>
                        </div>
                        <ul class="feature-list">
                            <p class="">This Plan For</p>
                            <li><i class=" bi bi-arrow-right-circle"></i>E-learning platforms</li>
                            <li><i class=" bi bi-arrow-right-circle"></i>Online stores</li>
                            <li><i class=" bi bi-arrow-right-circle"></i>High-traffic websites</li><br>
                            <li><i class=" bi bi-check-circle-fill"></i>Database Support</li>
                            <li><i class=" bi bi-check-circle-fill"></i>Storage Support</li>
                            <li><i class=" bi bi-check-circle-fill"></i>Free SSL Certificate</li>
                            <li><i class=" bi bi-check-circle-fill"></i>Custom Domain Support</li>
                            <li><i class=" bi bi-check-circle-fill"></i>24/7 Support</li>
                        </ul>
                        <?
                        if(Session::get('is_login')){
                            ?>
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#paymentModalBusiness" data-plan="business" disabled>Comming Soon</button>
                        
                        <?
                        }else{

                         ?>
                         <button type="button" class="btn btn-primary w-100" onclick="window.location.href='login.php';" >Get Started</button>    

                         <?

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modals for Payment (with form submission) -->
<!-- Starter Plan Modal -->
<div class="modal fade" id="paymentModalStarter" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Confirm your Starter Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentFormStarter" action="libs/cashfree/payment.php" method="POST">
                    <p>Please make the payment to start enjoying all the features of the Starter Plan.</p>
                    <!-- <div class="pricing p-3 rounded mt-4 d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <sup class="inr font-weight-bold">₹</sup>
                            <span class="amount ml-1 mr-1" id="starterAmount">99</span>
                            <span class="year font-weight-bold">/ month</span>
                        </div>
                    </div> -->
                    <div class="email mt-2">
                        <input type="text" class="form-control email-text" placeholder="Your Name" name="name" id="emailStarter" required>
                    </div>
                    <input type="hidden" name="plan" value="starter">
                    <input type="hidden" name="price" id="starterPriceHidden" value="99">
                    <input type="hidden" name="pricingPeriod" id="pricingPeriodStarter" value="monthly">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary payment-button">Proceed to Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Professional Plan Modal -->
<div class="modal fade" id="paymentModalWordpress" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Confirm your Wordpress Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentFormWordpress" action="libs/cashfree/payment.php" method="POST">
                    <p>Please make the payment to start enjoying all the features of the Wordpress Plan.</p>
                    <!-- <div class="pricing p-3 rounded mt-4 d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <sup class="inr font-weight-bold">₹</sup>
                            <span class="amount ml-1 mr-1" id="professionalAmount">199</span>
                            <span class="year font-weight-bold">/ month</span>
                        </div>
                    </div> -->
                    <div class="email mt-2">
                    <input type="text" class="form-control email-text" placeholder="Your Name" name="name" id="emailWordpress" required>

                    </div>
                    <input type="hidden" name="plan" value="wordpress">
                    <input type="hidden" name="price" id="wordpressPriceHidden" value="199">
                    <input type="hidden" name="pricingPeriod" id="pricingPeriodWordpress" value="monthly">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary payment-button">Proceed to Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Business Plan Modal -->
<div class="modal fade" id="paymentModalBusiness" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Confirm your Business Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentFormBusiness" action="libs/cashfree/payment.php" method="POST">
                    <p>Please make the payment to start enjoying all the features of the Business Plan.</p>
                    <!-- <div class="pricing p-3 rounded mt-4 d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <sup class="inr font-weight-bold">₹</sup>
                            <span class="amount ml-1 mr-1" id="businessAmount">499</span>
                            <span class="year font-weight-bold">/ month</span>
                        </div>
                    </div> -->
                    <div class="email mt-2">
                    <input type="text" class="form-control email-text" placeholder="Your Name" name="name" id="emailBusiness" required>

                    </div>
                    <input type="hidden" name="plan" value="business">
                    <input type="hidden" name="price" id="businessPriceHidden" value="499">
                    <input type="hidden" name="pricingPeriod" id="pricingPeriodBusiness" value="monthly">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary payment-button">Proceed to Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const pricingPeriodRadios = document.querySelectorAll('input[name="pricingPeriod"]');
    const plans = ['starter', 'wordpress', 'business'];

    const priceData = {
        monthly: {
            starter: '99',
            wordpress: '199',
            business: '499'
        },
        annual: {
            starter: '999',
            wordpress: '1999',
            business: '4999'
        }
    };

    function updatePrices(period) {
        plans.forEach(plan => {
            const amountElement = document.getElementById(`${plan}Price`);
            const periodLabel = document.getElementById(`${plan}PricePeriod`);
            const hiddenPriceInput = document.getElementById(`${plan}PriceHidden`);
            const hiddenPeriodInput = document.getElementById(`pricingPeriod${capitalize(plan)}`);

            const price = priceData[period][plan];
            amountElement.textContent = `₹${price}`;
            periodLabel.textContent = period === 'monthly' ? '/month' : '/year';

            hiddenPriceInput.value = price;
            hiddenPeriodInput.value = period;
        });
    }

    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    pricingPeriodRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                updatePrices(this.id === 'monthly' ? 'monthly' : 'annual');
            }
        });
    });

    // Initialize with the selected period
    const selectedPeriod = document.querySelector('input[name="pricingPeriod"]:checked').id;
    updatePrices(selectedPeriod === 'monthly' ? 'monthly' : 'annual');
});

</script>
