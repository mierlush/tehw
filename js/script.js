function startSlideshow() {
    const galleries = document.querySelectorAll('.gallery'); // Select all gallery sections

    galleries.forEach(gallery => {
        const galleryImages = gallery.querySelectorAll('img'); // Get images in this gallery
        let currentIndex = 0;

        // Hide all images initially in this gallery
        galleryImages.forEach(img => img.style.opacity = 0);
        // Show the first image in this gallery
        galleryImages[currentIndex].style.opacity = 1;

        // Set up an interval for this gallery
        setInterval(() => {
            // Hide the current image
            galleryImages[currentIndex].style.opacity = 0;
            // Move to the next image
            currentIndex = (currentIndex + 1) % galleryImages.length;
            // Show the new image
            galleryImages[currentIndex].style.opacity = 1;
        }, 5000);
    });
}

window.addEventListener('load', startSlideshow);