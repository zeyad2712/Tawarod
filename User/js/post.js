document.addEventListener("DOMContentLoaded", function () {
    var popup = document.getElementById("popupForm");
    var openButton = document.getElementById("openPopupBtn");
    var closeButton = document.getElementById("closePopup");

    // Open the pop-up
    openButton.addEventListener("click", function () {
        popup.style.display = "flex";
    });

    // Close the pop-up when clicking on the  button
    closeButton.addEventListener("click", function () {
        popup.style.display = "none";
    });

    // Close the pop-up when clicking outside the pop-up content
    window.addEventListener("click", function (event) {
        if (event.target == popup) {
            popup.style.display = "none";
        }
    });
});

// -----------------------------------------

document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function (event) {
        const postId = this.getAttribute('data-post-id');
        const confirmDelete = confirm("Are you sure you want to delete this post?");
    });
});

// ---------------------------------------------------
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}

// --------------------------------

function mypopFunction() {
    document.getElementById("mydropdown").classList.toggle("show");
}

function popup2Function() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("mydropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}
