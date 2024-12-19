function filterContent() {
    // Get the value of the input field
    let filter = document.getElementById('search').value.toUpperCase();
    // Get all the content items
    let items = document.querySelectorAll('.product-description');

    // Loop through all list items and hide those that don't match the search query
    items.forEach(item => {
        let text = item.textContent || item.innerText;
        if (text.toUpperCase().indexOf(filter) > -1) {
            item.parentElement.style.display = ""; // Show the item
        } else {
            item.parentElement.style.display = "none"; // Hide the item
        }
    });
}

