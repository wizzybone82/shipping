<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar-wrapper');
        sidebar.classList.toggle('active');
    });

    document.getElementById('close-sidebar').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar-wrapper');
        sidebar.classList.toggle('active');
    });
</script>
</body>
</html>
