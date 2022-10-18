import Search from "@Components/Search/Search";
// import Menu from "@Components/Menu/Menu";

/**
 * Main Nav component
 */
class MainNav {
  /**
   * Constructor
   * @param {*} element The DOM element
   */
  constructor() {
    // The corresponding DOM element
    this.element = document.querySelector(".main-nav");

    this.mobileMenuToggle = this.element.querySelector(".main-nav__mobile-menu-toggle");

    // Init of the search
    this.search = new Search(this.element.querySelector(".search"));

    // Menu items with submenus
    this.menuItems = this.element.querySelectorAll(".menu-item-has-children");

    // CSS classes
    this.mobileMenuOpenClass = "mobile-menu-open";
    this.showItemClass = "show";

    // Is the mobile menu open?
    this.mobileMenuOpen = false;

    // Reference of the current class
    const current = this;

    // For every item with submenus
    for (let i = 0; i < this.menuItems.length; i++) {
      // On mouseover open the item if we are on desktop style
      this.menuItems[i].addEventListener("mouseover", () => {
        // Close the search when hovering a menu item
        current.search.close();

        // If the mobile menu is not open
        if (!current.mobileMenuOpen) {
          const parentOpened = this.menuItems[i].closest(".show");

          if (parentOpened === null) {
            // Close all the items open
            current.closeAllItems(this.menuItems[i]);
          }

          current.openItem(this.menuItems[i]);

          clearTimeout(current.timer);
        }
      });
      // On mouse out close the item after 1 second if we are on desktop style
      this.menuItems[i].addEventListener("mouseout", (event) => {
        // If the mobile menu is not open
        if (!current.mobileMenuOpen) {
          current.timer = setTimeout(() => {
            const parentOpened = event.relatedTarget.closest(".show");

            if (parentOpened === null) {
              // Close all the items open
              current.closeItem(this.menuItems[i]);
            }
          }, 300);
        }
      });

      // Mobile click on sub-menu-opener tags
      const menuItemLink = this.menuItems[i].querySelector("a.menu__sub-menu-opener");
      if (menuItemLink) {
        menuItemLink.addEventListener("click", (event) => {
          // This is only for mobile, open one item at a time on click
          if (current.mobileMenuOpen) {
            event.preventDefault();
            event.stopPropagation();

            const parentOpened = this.menuItems[i].closest(".show");

            if (parentOpened === null) {
              // Close all the items open
              current.closeAllItems(this.menuItems[i]);
            }

            // And then toggle the clicked item
            current.toggleItem(this.menuItems[i]);
          }
        });
      }
    }

    // Add the click on the burger button
    if (this.mobileMenuToggle) {
      this.mobileMenuToggle.addEventListener("click", () => {
        this.toggleMobileMenu();
      });
    }
  }

  /**
   * Open a menu item
   * @param {*} item The menu item
   */
  openItem(item) {
    item.classList.add(this.showItemClass);
    item.setAttribute("aria-expanded", "true");
  }

  /**
   * Close a menu item
   * @param {*} item The menu item
   */
  closeItem(item) {
    item.classList.remove(this.showItemClass);
    item.setAttribute("aria-expanded", "false");
  }

  /**
   * Close all menu items
   * @param {*} exceptThisElement This element is an exception
   */
  closeAllItems(exceptThisElement) {
    // Close all the items open
    [].forEach.call(this.menuItems, (el) => {
      // except for the element clicked, remove active class
      if (el !== exceptThisElement) {
        this.closeItem(el);
      }
    });
  }

  /**
   * Toggle a menu item
   * @param {*} item The menu item
   */
  toggleItem(item) {
    if (item.getAttribute("aria-expanded") === "true") {
      this.closeItem(item);
    } else {
      this.openItem(item);
    }
  }

  /**
   * Toggle of the mobile menu
   */
  toggleMobileMenu() {
    this.element.classList.toggle("main-nav--mobile-menu-open");
    this.mobileMenuOpen = !this.mobileMenuOpen;
  }
}

export default MainNav;
