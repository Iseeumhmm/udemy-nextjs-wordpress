/**
 * Sticky Footer component
 */
class StickyFooter {
  /**
   * Constructor
   * @param {*} element The DOM element
   */
  constructor(element) {
    // If we passed a specific element to the constructor we use this one
    this.element = element;

    // Otherwise we look for the first element with the sticky-footer class in the page
    if (!this.element) {
      this.element = document.querySelector(".sticky-footer");
    }

    // If we still didn't find anything then abort
    if (!this.element) {
      return;
    }

    // Add a class to Html when scrolled down
    window.onscroll = () => {
      if (window.scrollY > window.innerHeight) {
        this.show();
      } else {
        this.hide();
      }
    };

    // When clicking on the close button, close the sticky footer
    this.element.querySelector(".sticky-footer__close-button").addEventListener("click", () => {
      this.close();
    });
  }

  /**
   * Show only if not closed
   */
  show() {
    if (!this.closed) {
      this.element.classList.add("sticky-footer--show");
    }
  }

  /**
   * Hide
   */
  hide() {
    this.element.classList.remove("sticky-footer--show");
  }

  /**
   * Close
   */
  close() {
    this.closed = true;
    this.element.classList.remove("sticky-footer--show");
  }
}

export default StickyFooter;
