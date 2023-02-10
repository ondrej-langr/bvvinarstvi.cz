$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  autoplay: true,
  fade: false,
  speed: 600,
  autoplaySpeed: 9000,
  adaptiveHeight: true,
  infinite: false,
  prevArrow: '<button class="slide-arrow prev-arrow"></button>',
  nextArrow: '<button class="slide-arrow next-arrow"></button>',
  asNavFor: '.slider-bg',
})
$('.slider-bg').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  infinite: false,
  asNavFor: '.slider-for',
})

$('a[data-slide]').click(function (e) {
  e.preventDefault()
  var slideno = $(this).data('slide')
  $('.slider-for,.slider-bg').slick('slickGoTo', slideno - 1)
})

$('.slider-for').on('afterChange', function () {
  console.log($('.slider-for').slick('slickCurrentSlide'))
  var currentSlide = $('.slider-for').slick('slickCurrentSlide')
  if (currentSlide == 0) {
    $('.prev-arrow').addClass('disable')
    $('.next-arrow').removeClass('disable')
  } else if (currentSlide == 4) {
    $('.next-arrow').addClass('disable')
    $('.prev-arrow').removeClass('disable')
  }

  if (currentSlide > 0 && currentSlide < 4) {
    $('.prev-arrow').removeClass('disable')
    $('.next-arrow').removeClass('disable')
  }
})

$(document).ready(function () {
  var currentSlide = $('.slider-for').slick('slickCurrentSlide')
  if (currentSlide == 0) {
    $('.prev-arrow').addClass('disable')
  } else if (currentSlide == 4) {
    $('.next-arrow').addClass('disable')
  }
})
AOS.init()
window.addEventListener('load', AOS.refresh)
// You can also pass an optional settings object
// below listed default settings
AOS.init({
  // Global settings:
  disable: 'mobile', // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
  startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
  initClassName: 'aos-init', // class applied after initialization
  animatedClassName: 'aos-animate', // class applied on animation
  useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
  disableMutationObserver: false, // disables automatic mutations' detections (advanced)
  debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
  throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)

  // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
  offset: 0, // offset (in px) from the original trigger point
  delay: 300, // values from 0 to 3000, with step 50ms
  duration: 1250, // values from 0 to 3000, with step 50ms
  easing: 'ease', // default easing for AOS animations
  once: true, // whether animation should happen only once - while scrolling down
  mirror: false, // whether elements should animate out while scrolling past them
  anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
})
var darkMode

if (localStorage.getItem('dark-mode')) {
  // if dark mode is in storage, set variable with that value
  darkMode = localStorage.getItem('dark-mode')
} else {
  // if dark mode is not in storage, set variable to 'light'
  darkMode = 'light'
}

// set new localStorage value
localStorage.setItem('dark-mode', darkMode)

if (localStorage.getItem('dark-mode') == 'dark') {
  // if the above is 'dark' then apply .dark to the body
  $('body').addClass('dark')
  // hide the 'dark' button
  $('.dark-button').hide()
  // show the 'light' button
  $('.light-button').show()
}
$('.dark-button').on('click', function () {
  $('.dark-button').hide()
  $('.light-button').show()
  $('body').addClass('dark')
  // set stored value to 'dark'
  localStorage.setItem('dark-mode', 'dark')
})

$('.light-button').on('click', function () {
  $('.light-button').hide()
  $('.dark-button').show()
  $('body').removeClass('dark')
  // set stored value to 'light'
  localStorage.setItem('dark-mode', 'light')
})
