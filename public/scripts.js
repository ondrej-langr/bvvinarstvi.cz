function ShowImg1() {
  document.getElementById('image').src = 'images/img1.jpg'
}

function ShowImg2() {
  document.getElementById('image').src = 'images/img2.jpg'
}

function ShowImg3() {
  document.getElementById('image').src = 'images/img3.jpg'
}

function ShowImg4() {
  document.getElementById('image').src = 'images/img4.jpg'
}
function ShowImg5() {
  document.getElementById('image').src = 'images/img5.jpg'
}

$(document).ready(function () {
  setTimeout(function () {
    $('#popup-mainpage-bg').addClass('toggled')
  }, 1000)
})

$(function () {
  $('.menu-trigger').on('click', function () {
    $('.menu-trigger, .menu, .menu-item').toggleClass('active')
    return false
  })
})

$(function () {
  console.log($('.close'))

  $('.close').on('click', function () {
    $('.popup-bg').removeClass('toggled')
    return false
  })
})

gsap.registerPlugin(ScrollTrigger)

const pageContainer = document.querySelector('.container')

/* SMOOTH SCROLL */
const scroller = new LocomotiveScroll({
  el: pageContainer,
  smooth: true,
})

scroller.on('scroll', ScrollTrigger.update)

ScrollTrigger.scrollerProxy(pageContainer, {
  scrollTop(value) {
    return arguments.length
      ? scroller.scrollTo(value, 0, 0)
      : scroller.scroll.instance.scroll.y
  },
  getBoundingClientRect() {
    return {
      left: 0,
      top: 0,
      width: window.innerWidth,
      height: window.innerHeight,
    }
  },
  pinType: pageContainer.style.transform ? 'transform' : 'fixed',
})

////////////////////////////////////
////////////////////////////////////
window.addEventListener('load', function () {
  let pinBoxes = document.querySelectorAll('.pin-wrap > *')
  let pinWrap = document.querySelector('.pin-wrap')
  let pinWrapWidth = pinWrap.offsetWidth
  let horizontalScrollLength = pinWrapWidth - window.innerWidth

  // Pinning and horizontal scrolling

  gsap.to('.pin-wrap', {
    scrollTrigger: {
      scroller: pageContainer, //locomotive-scroll
      scrub: true,
      trigger: '#sectionPin',
      pin: true,
      // anticipatePin: 1,
      start: 'top top',
      end: pinWrapWidth,
    },
    x: -horizontalScrollLength,
    ease: 'none',
  })

  ScrollTrigger.addEventListener('refresh', () => scroller.update()) //locomotive-scroll

  ScrollTrigger.refresh()
})
