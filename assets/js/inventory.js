document.addEventListener("DOMContentLoaded", function () {
    //Search bar
    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.querySelector('table tbody');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toLowerCase().includes(filter)) {
                    match = true;
                    break;
                }
            }

            rows[i].style.display = match ? '' : 'none';
        }
    }

    // Attach event listener to the search button
    document.querySelector('.btn-primary[onclick="filterTable()"]').addEventListener('click', filterTable);

    // Edit button
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('edit-id').value = button.getAttribute('data-part-id');
            document.getElementById('edit-part-name').value = button.getAttribute('data-part-name');
            document.getElementById('edit-brand').value = button.getAttribute('data-brand');
            document.getElementById('edit-stocks').value = button.getAttribute('data-stocks');
            document.getElementById('edit-cost').value = button.getAttribute('data-cost');
            document.getElementById('edit-supplier').value = button.getAttribute('data-supplier');
        });
    });

    //Delete button
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function () {
            if (confirm('Are you sure you want to delete this inventory part?')) {
                const partId = this.getAttribute('data-part-id');
                window.location.href = `/Tech-Part-Inventory/controller/inventoryController.php?delete_id=${partId}`;
            }
        });
    });
})