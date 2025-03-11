class CarValidator {
    static validateField(input) {
        const value = input.value.trim();
        const inputId = input.id;
        let isValid = true;

        if (input.hasAttribute('required') && value === '') {
            isValid = false;
        }

        if (inputId === 'addNameCar' || inputId === 'editNameCar') {
            const regex = /^[a-zA-Z0-9\s]+$/;
            if (!regex.test(value)) {
                isValid = false;
            }
        }

        if (inputId === 'addYearCar' || inputId === 'editYearCar') {
            const year = parseInt(value, 10);
            if (isNaN(year) || year < 1990 || year > 2025) {
                isValid = false;
            }
        }

        if (inputId === 'addCvCar' || inputId === 'editCvCar') {
            const number = parseFloat(value);
            if (isNaN(number) || number < 1) {
                isValid = false;
            }
        }

        if (inputId === 'addPriceCar' || inputId === 'editPriceCar') {
            const number = parseFloat(value);
            if (isNaN(number) || number < 1) {
                isValid = false;
            }
        }

        if (inputId === 'addFormFile' || inputId === 'editFormFile') {
            const fileInput = input.files[0];
            if (input.files.length === 0 || !fileInput) {
                isValid = false;
            } else {
                const allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                const maxSize = 2048 * 1024; // 2048 KB in bytes

                if (!allowedMimes.includes(fileInput.type)) {
                    isValid = false;
                }

                if (fileInput.size > maxSize) {
                    isValid = false;
                }
            }
        }

        if (isValid) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
        }

        return isValid;
    }

    static validateForm(form) {
        const inputs = form.querySelectorAll('input, select');
        let formIsValid = true;

        inputs.forEach(input => {
            if (!CarValidator.validateField(input)) {
                formIsValid = false;
            }
        });

        return formIsValid;
    }
}

export default CarValidator;