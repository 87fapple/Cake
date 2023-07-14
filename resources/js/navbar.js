// Navbar Hambuger
const toggleButton = document.getElementsByClassName('hambuger')[0]
const navbarLinks = document.getElementsByClassName('navbarLink')[0]

toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
})
