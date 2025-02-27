document.addEventListener("DOMContentLoaded", function () {
    /////////////////// Filters Dinamic ///////////////////////
    let offerCars = document.querySelectorAll('.car-offer');
    let allCars = document.querySelectorAll('.card-all');
    let combinedCars = [...offerCars, ...allCars];

    let minCvSlider = document.getElementById('min_range_cv');
    let maxCvSlider = document.getElementById('max_range_cv')
    let minPriceSlider = document.getElementById('min_range_price');
    let maxPriceSlider = document.getElementById('max_range_price');

    let maxCarPrice = 0;
    let maxCarCv = 0;

    allCars.forEach(element => {
        let hp = parseFloat(element.getAttribute('data-car-horsepower'));
        let pc = parseFloat(element.getAttribute('data-car-price'));
        if(hp>maxCarCv){ maxCarCv = hp+1 }
        if(pc>maxCarPrice){ maxCarPrice = pc+1 }
    });
    console.log(maxCarPrice);
    

    function setupSlider(minRange, maxRange, minValueDisplay, maxValueDisplay, rangeTrack, minLimit, maxLimit) {
        minRange.min = minLimit;
        minRange.max = maxLimit;
        minRange.value = minLimit;

        maxRange.min = minLimit;
        maxRange.max = maxLimit;
        maxRange.value = maxLimit;

        let totalWidth = maxLimit - minLimit;

        function updateSlider() {
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

            let minPercent = ((minRange.value - minLimit) / totalWidth) * 100;
            let maxPercent = ((maxRange.value - minLimit) / totalWidth) * 100;

            rangeTrack.style.left = minPercent + "%";
            rangeTrack.style.right = (100 - maxPercent) + "%";
        }

        minRange.addEventListener("input", updateSlider);
        maxRange.addEventListener("input", updateSlider);

        updateSlider();
    }

    setupSlider(
        document.getElementById("min_range_price"),
        document.getElementById("max_range_price"),
        document.getElementById("minvalue_price"),
        document.getElementById("maxvalue_price"),
        document.getElementById("range_track_price"),
        0,
        maxCarPrice
    );

    setupSlider(
        document.getElementById("min_range_cv"),
        document.getElementById("max_range_cv"),
        document.getElementById("minvalue_cv"),
        document.getElementById("maxvalue_cv"),
        document.getElementById("range_track_cv"),
        0,
        maxCarCv
    );


    document.querySelectorAll('.card').forEach(function(card) {
        card.addEventListener('click', function() {
            let id = this.getAttribute('data-car-id');
            window.location.href = '/datasheet/' + id;
        });
    });

    const brandFilter = document.getElementById('brandFilter');
    const nameFilter = document.getElementById('nameFilter');
    const colorFilter = document.getElementById('colorFilter');
    const filters = [brandFilter, nameFilter, colorFilter, minPriceSlider, maxPriceSlider, minCvSlider, maxCvSlider];
    
    filters.forEach(filter => {
        filter.addEventListener('input', applyFilters);
    });
    
    function applyFilters() {
        let brandValue = brandFilter.value;
        let nameValue = nameFilter.value.toLowerCase().trim();
        let colorValue = colorFilter.value;
        let minPrice = parseFloat(minPriceSlider.value);
        let maxPrice = parseFloat(maxPriceSlider.value);
        let minCv = parseFloat(minCvSlider.value);
        let maxCv = parseFloat(maxCvSlider.value);
    
        combinedCars.forEach(element => {
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
    
            if (matchesBrand && matchesName && matchesColor && matchesPrice && matchesCv) {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        });
    }
    
    document.querySelector('.restore').addEventListener('click', function (e) {
        brandFilter.value = 0;
        nameFilter.value = '';
        colorFilter.value = 0;
        minPriceSlider.value = 0;
        maxPriceSlider.value = maxCarPrice;
        minCvSlider.value = 0;
        maxCvSlider.value = maxCarCv;
        setupSlider(
            document.getElementById("min_range_price"),
            document.getElementById("max_range_price"),
            document.getElementById("minvalue_price"),
            document.getElementById("maxvalue_price"),
            document.getElementById("range_track_price"),
            0,
            maxCarPrice
        );
    
        setupSlider(
            document.getElementById("min_range_cv"),
            document.getElementById("max_range_cv"),
            document.getElementById("minvalue_cv"),
            document.getElementById("maxvalue_cv"),
            document.getElementById("range_track_cv"),
            0,
            maxCarCv
        );
        applyFilters();
    });
    
    brandFilter.value = 0;
    nameFilter.value = '';
    colorFilter.value = 0;
    minPriceSlider.value = 0;
    maxPriceSlider.value = maxCarPrice;
    minCvSlider.value = 0;
    maxCvSlider.value = maxCarCv;

    applyFilters();
});