
import { post } from './api'
import { validate } from './validator'
import { Modal } from 'bootstrap'

let myModal = document.querySelector('#myModal') as HTMLElement

// Create a new Bootstrap Modal instance
const modal = new Modal(myModal)

window.addEventListener('load', (): void => {
    modal.show()
})

const form = document.querySelector('#UserForm') as HTMLFormElement

form.addEventListener('submit', async (event): Promise<void> => {
    event.preventDefault()

    if (!validate(form)) {
        return 
    }
    
    const formData = new FormData(form)
    const response = await post('api/createUser', formData)
    const alert = document.querySelector('#Alert') as HTMLElement
 
    if (response.result === false) {
        alert.style.display = 'flex'
    } else {
        alert.style.display = 'none'
        modal.hide()
        document.location.href = '/dashboard'
    }
})







