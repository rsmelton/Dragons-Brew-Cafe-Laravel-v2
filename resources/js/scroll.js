document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('scrollable-content');

    // Restore scroll position
    const savedPosition = sessionStorage.getItem('scrollPosition');
    sessionStorage.removeItem('scrollPosition');
    if (savedPosition && container) {
        setTimeout(() => {
            container.scrollTop = parseInt(savedPosition);
            // console.log('Restored scroll to:', savedPosition);
        }, 100);
    }

    // Save scroll position on scroll
    if (container) {
        container.addEventListener('scroll', () => {
            sessionStorage.setItem('scrollPosition', container.scrollTop);
            // console.log('Saved scroll at:', container.scrollTop);
        });
    } else {
        // console.warn('No scrollable container found');
    }
});