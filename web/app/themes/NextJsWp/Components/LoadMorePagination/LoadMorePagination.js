// import "url-polyfill";
// import "isomorphic-fetch";

/**
 * LoadMorePagination component
 */
class LoadMorePagination {
  /**
   * Constructor
   *
   * @param {*} element The DOM element
   */
  constructor(element) {
    this.element = element;

    if (!this.element) {
      this.element = document.querySelector(".loadmore-pagination");
    }

    if (!this.element) {
      return;
    }

    // Parent node
    this.parentNode = this.element.parentNode;

    // The type of pagination
    this.type = this.element.dataset.type;

    // Targeted page number for Load More pagination
    this.targetedPage = this.element.dataset.targetedpage;

    this.init();
  }

  init() {
    if (!this.element) {
      return;
    }

    // Current page number for Load More pagination
    this.currentPage = this.element.dataset.currentpage;

    // If this is a Load More type of pagination
    const loadMoreButton = this.element.querySelector("a");
    const instance = this;

    if (loadMoreButton) {
      loadMoreButton.addEventListener("click", (event) => {
        event.preventDefault();
        instance.handleOnClickLoadMore(event);
      });

      // If the current page is still not as target then paginate
      if (instance.currentPage < instance.targetedPage) {
        loadMoreButton.click();
      }
    }
  }

  /**
   * Handle on click on the Load More pagination
   *
   * @param {*} event The click event
   */
  async handleOnClickLoadMore(event) {
    // Remove the pagination while it loads
    this.element.parentNode.removeChild(this.element);

    // Add the loadMore param to the url
    const url = new URL(event.target.href);

    // Get the data
    const formData = new FormData();
    formData.append("loadMore", "true");

    const request = await fetch(url, {
      method: "post",
      body: formData,
    });

    const answer = await request.text();

    // Send an event with the data
    const loadMoreResponseEvent = new CustomEvent("loadMoreResponse", {
      detail: { render: answer },
    });

    document.dispatchEvent(loadMoreResponseEvent);

    this.element = this.parentNode.querySelector(".loadmore-pagination");
    this.init();

    // TODO: COMMENT THIS IF YOU PREFER NOT TO UPDATE THE URL WITH THE PAGINATION
    // Push the url to the history
    window.history.pushState(null, null, url.origin + url.pathname + url.search);
  }
}

export default LoadMorePagination;
