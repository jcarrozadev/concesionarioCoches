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
        120000
    );

    setupSlider(
        document.getElementById("min_range_cv"),
        document.getElementById("max_range_cv"),
        document.getElementById("minvalue_cv"),
        document.getElementById("maxvalue_cv"),
        document.getElementById("range_track_cv"),
        0,
        500
    );


    // Take info to show data sheet

    document.querySelectorAll('.card').forEach(function(card) {
        card.addEventListener('click', function() {
            let id = this.getAttribute('data-car-id');
            window.location.href = '/datasheet/' + id;
        });
    });
});