console.log("user.js is loaded");

document.addEventListener("DOMContentLoaded", function () {

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
    
            if (maxValue - minValue < 1000) { // Evitar superposición
                if (document.activeElement === minRange) {
                    minRange.value = maxValue - 1000;
                } else {
                    maxRange.value = minValue + 1000;
                }
            }
    
            minValueDisplay.textContent = minValue;
            maxValueDisplay.textContent = maxValue;
    
            let minPercent = ((minValue - minLimit) / totalWidth) * 100;
            let maxPercent = ((maxValue - minLimit) / totalWidth) * 100;
    
            rangeTrack.style.left = minPercent + "%";
            rangeTrack.style.right = (100 - maxPercent) + "%";
        }
    
        minRange.addEventListener("input", updateSlider);
        maxRange.addEventListener("input", updateSlider);
    
        updateSlider();
    }

    // Configuración para precios
    setupSlider(
        document.getElementById("min_range_price"),
        document.getElementById("max_range_price"),
        document.getElementById("minvalue_price"),
        document.getElementById("maxvalue_price"),
        document.getElementById("range_track_price"),
        0,
        120000
    );

    // Configuración para CV
    setupSlider(
        document.getElementById("min_range_cv"),
        document.getElementById("max_range_cv"),
        document.getElementById("minvalue_cv"),
        document.getElementById("maxvalue_cv"),
        document.getElementById("range_track_cv"),
        0,
        500
    );
});
