// ------------------------------------------------

document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function(event) {
        const postId = this.getAttribute('data-post-id');
        const confirmDelete = confirm("Are you sure you want to delete this post?");
    });
});
