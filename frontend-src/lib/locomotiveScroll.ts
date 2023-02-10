import gsap from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'
import LocomotiveScroll from 'locomotive-scroll'

gsap.registerPlugin(ScrollTrigger)

export const initLocomotiveScroll = (container: HTMLElement) => {
  /* SMOOTH SCROLL */
  const scroller = new LocomotiveScroll({
    el: container,
    smooth: true,
  })

  scroller.on('scroll', ScrollTrigger.update)

  scroller.on('scroll', ScrollTrigger.update)

  ScrollTrigger.scrollerProxy(container, {
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
    pinType: container.style.transform ? 'transform' : 'fixed',
  })

  return { scroller }
}
