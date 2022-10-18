/**
 * Back To Top component
 */
class BackToTop {
  /**
   * Constructor
   * @param {*} element The DOM element
   */
  constructor(element) {
    // If we passed a specific element to the constructor we use this one
    this.element = element;

    // Otherwise we look for the first element with the back-to-top class in the page
    if (!this.element) {
      this.element = document.querySelector(".back-to-top");
    }

    // If we still didn't find anything then abort
    if (!this.element) {
      return;
    }

    // On scroll on the button
    window.addEventListener("scroll", () => {
      // If we scroll more than half the window height then show the button, otherwise hide it
      if (window.scrollY > window.innerHeight / 2) {
        this.element.classList.add("back-to-top--show");
      } else {
        this.element.classList.remove("back-to-top--show");
      }
    });

    // On click on the button
    this.element.addEventListener("click", (e) => {
      e.preventDefault();

      // Smoothly scroll to the top
      window.scroll({
        top: 0,
        behavior: "smooth",
      });
    });
  }
}
export default BackToTop;
