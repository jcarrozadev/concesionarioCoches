class ColorValidator {
    constructor(formSelector, submitButtonSelector, inputSelector) {
        this.form = document.querySelector(formSelector);
        this.submitButton = document.querySelector(submitButtonSelector);
        this.inputField = this.form.querySelector(inputSelector);
        this.setupEventListeners();
    }

    validateName() {
        const specialChars = /[!@#$%^&*(),.?":{}|<>]/g;
        const inputValue = this.inputField.value;

        if (inputValue === "") {
            this.inputField.classList.remove("is-valid", "is-invalid");
            return false;
        }

        if (inputValue.trim() === "" || specialChars.test(inputValue)) {
            this.inputField.classList.add("is-invalid");
            this.inputField.classList.remove("is-valid");
            return false;
        } else {
            this.inputField.classList.add("is-valid");
            this.inputField.classList.remove("is-invalid");
            return true;
        }
    }

    checkFormValidity() {
        this.submitButton.disabled = !this.validateName();
    }

    setupEventListeners() {
        this.inputField.addEventListener("input", () => {
            this.validateName();
            this.checkFormValidity();
        });
    }
}

export default ColorValidator;
