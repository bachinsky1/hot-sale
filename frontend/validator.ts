

const validate = (form: HTMLFormElement): boolean => {

    const result: boolean = form.checkValidity()

    if (!result) {
        form.classList.add('was-validated')
    }

    const Password = document.querySelector("#Password") as HTMLInputElement
    const ConfirmPassword = document.querySelector("#ConfirmPassword") as HTMLInputElement

    if (Password.value !== ConfirmPassword.value) {
        alert("Password mismatch")
        return false
    }
    
    return result
}

export { validate }