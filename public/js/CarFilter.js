class CarFilter {
    constructor() {
        this.offerCars = document.querySelectorAll('.car-offer');
        this.allCars = document.querySelectorAll('.card-all');
        this.combinedCars = [...this.offerCars, ...this.allCars];

        this.minCvSlider = document.getElementById('min_range_cv');
        this.maxCvSlider = document.getElementById('max_range_cv');
        this.minPriceSlider = document.getElementById('min_range_price');
        this.maxPriceSlider = document.getElementById('max_range_price');

        this.brandFilter = document.getElementById('brandFilter');
        this.nameFilter = document.getElementById('nameFilter');
        this.colorFilter = document.getElementById('colorFilter');
        
        this.restoreButton = document.querySelector('.restore');

        this.maxCarPrice = 0;
        this.maxCarCv = 0;

        this.calculateMaxValues();
        this.setupSliders();
        this.setupEventListeners();
        this.applyFilters();
    }

    calculateMaxValues() {
        this.allCars.forEach(element => {
            let hp = parseFloat(element.getAttribute('data-car-horsepower'));
            let pc = parseFloat(element.getAttribute('data-car-price'));
            if (hp > this.maxCarCv) { this.maxCarCv = hp + 1; }
            if (pc > this.maxCarPrice) { this.maxCarPrice = pc + 1; }
        });
    }

    setupSliders() {
        this.initializeSlider(
            this.minPriceSlider, this.maxPriceSlider, 
            document.getElementById("minvalue_price"), 
            document.getElementById("maxvalue_price"), 
            document.getElementById("range_track_price"), 
            0, this.maxCarPrice
        );

        this.initializeSlider(
            this.minCvSlider, this.maxCvSlider, 
            document.getElementById("minvalue_cv"), 
            document.getElementById("maxvalue_cv"), 
            document.getElementById("range_track_cv"), 
            0, this.maxCarCv
        );
    }

    initializeSlider(minRange, maxRange, minValueDisplay, maxValueDisplay, rangeTrack, minLimit, maxLimit) {
        minRange.min = minLimit;
        minRange.max = maxLimit;
        minRange.value = minLimit;

        maxRange.min = minLimit;
        maxRange.max = maxLimit;
        maxRange.value = maxLimit;

        const updateSlider = () => {
            let minValue = parseInt(minRange.value);
            let maxValue = parseInt(maxRange.value);

            if (minValue > maxValue) {
                if (document.activeElement === minRange) {
                    minRange.value = maxValue;
                } else {
                    maxRange.value = minValue;
                }
            }

            minValueDisplay.textContent = minRange.value;
            maxValueDisplay.textContent = maxRange.value;

            let totalWidth = maxLimit - minLimit;
            let minPercent = ((minRange.value - minLimit) / totalWidth) * 100;
            let maxPercent = ((maxRange.value - minLimit) / totalWidth) * 100;

            rangeTrack.style.left = minPercent + "%";
            rangeTrack.style.right = (100 - maxPercent) + "%";
        };

        minRange.addEventListener("input", updateSlider);
        maxRange.addEventListener("input", updateSlider);

        updateSlider();
    }

    setupEventListeners() {
        const filters = [this.brandFilter, this.nameFilter, this.colorFilter, this.minPriceSlider, this.maxPriceSlider, this.minCvSlider, this.maxCvSlider];

        filters.forEach(filter => {
            filter.addEventListener('input', () => this.applyFilters());
        });

        if (this.restoreButton) {
            this.restoreButton.addEventListener('click', () => this.restoreFilters());
        }

        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', function() {
                let id = this.getAttribute('data-car-id');
                window.location.href = '/datasheet/' + id;
            });
        });
    }

    applyFilters() {
        let brandValue = this.brandFilter.value;
        let nameValue = this.nameFilter.value.toLowerCase().trim();
        let colorValue = this.colorFilter.value;
        let minPrice = parseFloat(this.minPriceSlider.value);
        let maxPrice = parseFloat(this.maxPriceSlider.value);
        let minCv = parseFloat(this.minCvSlider.value);
        let maxCv = parseFloat(this.maxCvSlider.value);

        this.combinedCars.forEach(element => {
            let carBrand = element.getAttribute('data-car-brand');
            let carName = element.getAttribute('data-car-name').toLowerCase().trim();
            let carColor = element.getAttribute('data-car-color');
            let carPrice = parseFloat(element.getAttribute('data-car-price'));
            let carCv = parseFloat(element.getAttribute('data-car-horsepower'));

            const matchesBrand = (brandValue == carBrand || brandValue == 0);
            const matchesName = (nameValue === '' || carName.startsWith(nameValue));
            const matchesColor = (colorValue == carColor || colorValue == 0);
            const matchesPrice = (minPrice <= carPrice && carPrice <= maxPrice);
            const matchesCv = (minCv <= carCv && carCv <= maxCv);

            element.style.display = (matchesBrand && matchesName && matchesColor && matchesPrice && matchesCv) ? 'block' : 'none';
        });
    }

    restoreFilters() {
        this.brandFilter.value = 0;
        this.nameFilter.value = '';
        this.colorFilter.value = 0;
        this.minPriceSlider.value = 0;
        this.maxPriceSlider.value = this.maxCarPrice;
        this.minCvSlider.value = 0;
        this.maxCvSlider.value = this.maxCarCv;

        this.setupSliders();
        this.applyFilters();
    }
}

export default CarFilter;