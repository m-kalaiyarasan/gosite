document.addEventListener('DOMContentLoaded', function() {
    const monthlyRadio = document.getElementById('monthly');
    const annualRadio = document.getElementById('annual');
    const prices = document.querySelectorAll('.price .amount');
    
    const priceData = {
        monthly: ['99', '199', '499'],
        annual: ['999', '1999', '4999']
    };

    function updatePrices(period) {
        prices.forEach((price, index) => {
            price.textContent = '₹' + priceData[period][index];
            const periodLabel = price.nextElementSibling;
            periodLabel.textContent = period === 'monthly' ? '/month' : '/year';
        });
    }

    monthlyRadio.addEventListener('change', () => updatePrices('monthly'));
    annualRadio.addEventListener('change', () => updatePrices('annual'));
});