import LoadMorePagination from "@Components/LoadMorePagination/LoadMorePagination";

new LoadMorePagination();

// Listen to the responses from the Load More Pagination
document.addEventListener("loadMoreResponse", (event) => {
  // Appends the response to the proper element in the template
  document.querySelector(".cards-wrapper").innerHTML += event.detail.render;
});
