import MainNav from "@Components/MainNav/MainNav";

/**
 * Header component
 */
class Header {
  /**
   * Constructor
   * @param {*} element The DOM element
   */
  constructor(element) {
    this.element = element;
    if (!this.element) {
      this.element = document.querySelector("header");
    }

    // Init of the menu
    const headerMenuElement = this.element.querySelector(".menu");
    this.mainNav = new MainNav(headerMenuElement);
  }
}
export default Header;
