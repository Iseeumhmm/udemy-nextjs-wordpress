import Slider from "@Components/Slider/Slider";
import StickyFooter from "@Components/StickyFooter/StickyFooter";
import Search from "@Components/Search/Search";

// Search
const styleguideSearch = document.querySelector("#styleguide-search");
new Search(styleguideSearch);

// The slider
const styleguideSlider = document.querySelector("#styleguide-slider");
new Slider(styleguideSlider);

// The sticky CTA footer
new StickyFooter();
