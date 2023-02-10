import $ from 'jquery'

export const initDarkModeToggle = () => {
  let darkMode
  const key = 'dark-mode'

  if (localStorage.getItem(key)) {
    // if dark mode is in storage, set variable with that value
    darkMode = localStorage.getItem(key)
  } else {
    // if dark mode is not in storage, set variable to 'light'
    darkMode = 'light'
  }

  // set new localStorage value
  localStorage.setItem(key, darkMode)

  if (localStorage.getItem(key) == 'dark') {
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
    localStorage.setItem(key, 'dark')
  })

  $('.light-button').on('click', function () {
    $('.light-button').hide()
    $('.dark-button').show()
    $('body').removeClass('dark')
    console.log('change')
    // set stored value to 'light'
    localStorage.setItem(key, 'light')
  })
}
