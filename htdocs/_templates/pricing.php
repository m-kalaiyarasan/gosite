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

            <!-- Professional Plan -->
            <div class="col-lg-4">
                <div class="card pricing-card h-100 btn-price">
                    <div class="card-body">
                        <h3>Professional</h3>
                        <div class="price">
                            <span class="amount" id="professionalPrice">&#8377 199</span>
                            <span class="t-white" id="professionalPricePeriod">/month</span>
                        </div>
                        <ul class="feature-list">
                            <p class="">This Plan For</p>
                            <li><i class="bi bi-arrow-right-circle"></i>Business websites</li>
                            <li><i class="bi bi-arrow-right-circle"></i>Blog websites</li>
                            <li><i class="bi bi-arrow-right-circle"></i>Medium-scale projects</li>
                            <li><i class="bi bi-check-circle-fill"></i>Database Support</li>
                            <li><i class="bi bi-check-circle-fill"></i>Free SSL Certificate</li>
                            <li><i class="bi bi-check-circle-fill"></i>Custom Domain</li>
                            <li><i class="bi bi-check-circle-fill"></i>24/7 Support</li>
                        </ul>
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#paymentModalProfessional" data-plan="professional">Get Started</button>
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
                            <span class="t-white" id="businessPricePeriod">/month</span>
                        </div>
                        <ul class="feature-list">
                            <p class="">This Plan For</p>
                            <li><i class="bi bi-arrow-right-circle"></i>E-learning platforms</li>
                            <li><i class="bi bi-arrow-right-circle"></i>Online stores</li>
                            <li><i class="bi bi-arrow-right-circle"></i>High-traffic websites</li>
                            <li><i class="bi bi-check-circle-fill"></i>Database Support</li>
                            <li><i class="bi bi-check-circle-fill"></i>Storage Support</li>
                            <i class="bi bi-check-circle-fill"></i>Free SSL Certificate</li>
                            <li><i class="bi bi-check-circle-fill"></i>Custom Domain</li>
                            <li><i class="bi bi-check-circle-fill"></i>24/7 Support</li>
                        </ul>
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#paymentModalBusiness" data-plan="business">Get Started</button>
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
                <form id="paymentFormStarter" action="razorpay/payment.php" method="POST">
                    <p>Please make the payment to start enjoying all the features of the Starter Plan.</p>
                    <!-- <div class="pricing p-3 rounded mt-4 d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <sup class="inr font-weight-bold">₹</sup>
                            <span class="amount ml-1 mr-1" id="starterAmount">99</span>
                            <span class="year font-weight-bold">/ month</span>
                        </div>
                    </div> -->
                    <div class="email mt-2">
                        <input type="email" class="form-control email-text" placeholder="Email Address" name="email" id="emailStarter" required>
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
<div class="modal fade" id="paymentModalProfessional" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Confirm your Professional Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentFormProfessional" action="razorpay/payment.php" method="POST">
                    <p>Please make the payment to start enjoying all the features of the Professional Plan.</p>
                    <!-- <div class="pricing p-3 rounded mt-4 d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <sup class="inr font-weight-bold">₹</sup>
                            <span class="amount ml-1 mr-1" id="professionalAmount">199</span>
                            <span class="year font-weight-bold">/ month</span>
                        </div>
                    </div> -->
                    <div class="email mt-2">
                        <input type="email" class="form-control email-text" placeholder="Email Address" name="email" id="emailProfessional" required>
                    </div>
                    <input type="hidden" name="plan" value="professional">
                    <input type="hidden" name="price" id="professionalPriceHidden" value="199">
                    <input type="hidden" name="pricingPeriod" id="pricingPeriodProfessional" value="monthly">
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
                <form id="paymentFormBusiness" action="razorpay/payment.php" method="POST">
                    <p>Please make the payment to start enjoying all the features of the Business Plan.</p>
                    <!-- <div class="pricing p-3 rounded mt-4 d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <sup class="inr font-weight-bold">₹</sup>
                            <span class="amount ml-1 mr-1" id="businessAmount">499</span>
                            <span class="year font-weight-bold">/ month</span>
                        </div>
                    </div> -->
                    <div class="email mt-2">
                        <input type="email" class="form-control email-text" placeholder="Email Address" name="email" id="emailBusiness" required>
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
