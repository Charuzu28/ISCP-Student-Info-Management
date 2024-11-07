const deleteBtns = document.querySelectorAll('.deleteBtn'); // Use querySelectorAll and a class name selector

deleteBtns.forEach(button => {
    button.addEventListener('click', function(event){
        const confirmDelete = confirm('Are you sure you want to delete this?');
        if(!confirmDelete){
            event.preventDefault(); // Prevent the default action if the user cancels
        }
    });
});
