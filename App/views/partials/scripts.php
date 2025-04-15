<!-- Common Scripts -->
<script>
    // Scroll behavior for header
    let lastScroll = 0;
    let isScrollingDown = false;
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        const header = document.querySelector('header');
        const scrollThreshold = 100;
        
        if (currentScroll <= 0) {
            header.classList.remove('hide');
            return;
        }
    
        if (currentScroll > scrollThreshold) {
            if (currentScroll > lastScroll && !isScrollingDown) {
                // Scrolling down
                header.classList.add('hide');
                isScrollingDown = true;
            } else if (currentScroll < lastScroll && isScrollingDown) {
                // Scrolling up
                header.classList.remove('hide');
                isScrollingDown = false;
            }
        }
        lastScroll = currentScroll;
    });
</script>