import './bootstrap';
import './chartsdraw';


function reloadOnResize() {
    window.addEventListener('resize', function() {
        location.reload();
    });
}

// Call the function to reload on resize
reloadOnResize();

