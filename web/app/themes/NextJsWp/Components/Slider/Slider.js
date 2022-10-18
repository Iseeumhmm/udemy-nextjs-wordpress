import Glider from "@Vendors/glider-js/glider";

/**
 * Slider component
 */
class Slider {
  /**
   * Constructor
   *
   * @param {*} element The DOM element
   * @param {*} slidesToShow The number of slides to show
   */
  constructor(element, slidesToShow) {
    this.element = element;
    if (!this.element) {
      this.element = document.querySelector(".slider");
    }

    if (!this.element) {
      return;
    }

    // Setting slidesToShow from the constructor param
    this.slidesToShow = slidesToShow;
    // Setting slidesToShow from the data-slidesToShow attribute in the HTML
    if (!this.slidesToShow && this.element.dataset.slidestoshow) {
      this.slidesToShow = parseInt(this.element.dataset.slidestoshow, 10);
    }
    // Defaults to 1 if nothing was set before
    if (!this.slidesToShow) {
      this.slidesToShow = 1;
    }
    // Init of the slider
    this.glider = new Glider(this.element.querySelector(".glider"), {
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: this.element.querySelector(".dots"),
      draggable: false,
      scrollLock: true,
      arrows: {
        prev: this.element.querySelector(".glider-prev"),
        next: this.element.querySelector(".glider-next"),
      },
      responsive: [
        {
          // screens greater than >= 775px
          breakpoint: 600,
          settings: {
            slidesToShow: this.slidesToShow,
            slidesToScroll: this.slidesToShow,
          },
        },
      ],
    });
  }
}

export default Slider;
