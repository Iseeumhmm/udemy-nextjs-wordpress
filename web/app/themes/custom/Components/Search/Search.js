/**
 * Search component
 */
class Search {
  /**
   * Constructor
   * @param {*} element The DOM element
   */
  constructor(element) {
    this.element = element;

    // If no element was specified, find first in the page
    if (!this.element) {
      this.element = document.querySelector(".search");
    }

    // If not found at all in the page then stop right here
    if (!this.element) {
      return;
    }

    // Instance
    const current = this;

    // The search icon
    this.icon = this.element.querySelector(".search__icon");

    // The search form
    this.form = this.element.querySelector(".search__form");

    if (this.icon) {
      // On click on the icon toggle the form display
      this.icon.addEventListener("click", () => {
        current.toggle();
      });
    }

    if (this.form) {
      // Reposition at first load
      this.reposition();

      // Reposition when resizing the window
      window.addEventListener("resize", () => {
        current.reposition();
      });
    }

    document.addEventListener("click", (event) => {
      if (event.target !== current.element && !current.element.contains(event.target)) {
        current.close();
      }
    });
  }

  /**
   * Close the search
   */
  close() {
    this.element.classList.remove("search--open");
  }

  /**
   * Open the search
   */
  open() {
    this.element.classList.add("search--open");
    this.element.querySelector(".search__input").focus();
  }

  /**
   * Is the search open?
   *
   * @return {boolean} True if the search is open, false otherwise
   */
  isOpen() {
    return this.element.classList.has("search--open");
  }

  /**
   * Toggle the search
   */
  toggle() {
    this.element.classList.toggle("search--open");
    if (this.element.classList.contains("search--open")) {
      this.reposition();
      this.element.querySelector(".search__input").focus();
    }
  }

  /**
   * Place the form on the left or right
   * depending on available space
   */
  reposition() {
    if (this.form.offsetLeft < this.form.offsetWidth) {
      this.element.classList.add("search--on-the-right");
    } else {
      this.element.classList.remove("search--on-the-right");
    }
  }
}
export default Search;
