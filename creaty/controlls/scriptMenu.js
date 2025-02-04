let isActive = false; 

function toggleMenu() {
    const navLinks = document.getElementById('navLinks');
    
    if (isActive) {
        navLinks.classList.remove('active'); 
    } else {
        navLinks.classList.add('active'); 
    }

    isActive = !isActive; 
    console.log('Menu toggled:', isActive ? 'active' : 'inactive'); 
}