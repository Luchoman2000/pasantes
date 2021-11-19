import BulmaModal from './BulmaModal.js'

// document.querySelector(".modal").addEventListener("modal:show", (event) => {
//     console.log(event)
// });
const modals = document.querySelectorAll("[data-toggle='modal']");
modals.forEach((modal) => new BulmaModal(modal));