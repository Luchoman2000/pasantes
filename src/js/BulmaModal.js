class BulmaModal {
  constructor(modalButton) {
    const target = modalButton.dataset.target;

    if (target) {
      this.button = modalButton;
      this.modal = document.querySelector(target);
      this.html = document.querySelector("html");

      this.openEvent();
      this.closeEvents();
    }
  }

  show() {
    this.modal.classList.toggle("is-active");
    this.html.classList.add("is-clipped");

    this.onShow();
  }

  close() {
    // console.log(this);
    // this.modal.classList.toggle("is-active");
    // this.html.classList.toggle("is-clipped");

    $(this.html).removeClass("is-clipped");

    $(this.modal).removeClass("is-active");

    this.onClose();
  }

  openEvent() {
    // console.log(this.button);
    this.button.addEventListener("click", (e) => {
      e.preventDefault();
      this.show();
    });
  }

  closeEvents() {
    const closeElements = this.modal.querySelectorAll(".modal-background, .modal-close");
    // const closeElements = this.modal.querySelectorAll(".modal-close");

    closeElements.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.preventDefault();

        this.close();
      });
    });
  }

  onShow() {
    const event = new Event("modal:show");
    this.modal.dispatchEvent(event);
  }

  onClose() {
    const event = new Event("modal:close");
    this.modal.dispatchEvent(event);
  }
}

export default BulmaModal;