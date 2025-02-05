<script>
    document.getElementById('occasionFilter').addEventListener('change', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#ordersTableBody tr');

        rows.forEach(row => {
            let occasionCell = row.cells[3];
            if (occasionCell) {
                let occasionText = occasionCell.textContent.toLowerCase();
                if (filter === "" || occasionText.includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        });
    });
</script>