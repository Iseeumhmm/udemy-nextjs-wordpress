import Header from "@Components/Header/Header";
import BackToTop from "@Components/BackToTop/BackToTop";
import LoadMorePagination from "@Components/LoadMorePagination/LoadMorePagination";

// The header of the site
new Header();

// The Back To Top button
new BackToTop();

const htmlElement = document.querySelector("html");

const mobileMenuToggle = document.getElementById("mobile-menu-toggle");

function isMobileMenuOpen() {
  return htmlElement.classList.contains("mobile-menu-open");
}

/**
 * Toggle of the mobile menu
 */
function toggleMobileMenu() {
  htmlElement.classList.toggle("mobile-menu-open");

  if (isMobileMenuOpen()) {
    window.history.pushState(null, document.title, window.location);
    window.history.pushState(null, document.title, window.location);
  } else {
    window.history.back();
  }
}

// Add the click on the burger button
if (mobileMenuToggle) {
  mobileMenuToggle.addEventListener("click", () => {
    toggleMobileMenu();
  });
}

if (window.history && window.history.pushState) {
  window.addEventListener(
    "popstate",
    (e) => {
      if (isMobileMenuOpen()) {
        toggleMobileMenu();
        e.stopPropagation();
      }
    },
    false
  );
}

// Handling Load More Pagination
// TODO: DELETE IF YOU ARE NOT USING LOAD MORE PAGINATION
new LoadMorePagination();

// Listen to the responses from the Load More Pagination
document.addEventListener("loadMoreResponse", (event) => {
  // Appends the response to the proper element in the template
  document.querySelector(".cards-wrapper").innerHTML += event.detail.render;
});
