<!-- Common scripts -->
<script>
    // Function to enable header scroll behavior
    function initHeaderScrollBehavior() {
        let lastScroll = 0;
        let isScrollingDown = false;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            const header = document.querySelector('header');
            const scrollThreshold = 100;

            if (!header) return;

            if (currentScroll <= 0) {
                header.classList.remove('-translate-y-full');
                return;
            }

            if (currentScroll > scrollThreshold) {
                if (currentScroll > lastScroll && !isScrollingDown) {
                    header.classList.add('-translate-y-full');
                    isScrollingDown = true;
                } else if (currentScroll < lastScroll && isScrollingDown) {
                    header.classList.remove('-translate-y-full');
                    isScrollingDown = false;
                }
            }

            lastScroll = currentScroll;
        });
    }
</script>




<!-- Dashboard.php Scripts -->
<script>
    
</script>
