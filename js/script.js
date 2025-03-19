
var modal = document.getElementById("imageModal");
var modalImage = document.getElementById("modalImage");

var images = document.querySelectorAll(".image-clickable");

images.forEach(function(image) {
    image.onclick = function() {
        modal.style.display = "flex"; 
        modalImage.src = this.src; 
    }
});


var closeButton = document.querySelector(".close");
closeButton.onclick = function() {
    modal.style.display = "none"; 
}

window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}
