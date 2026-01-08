<!-- Mobile Menu Toggle Script -->
    <script>
        // Mobile menu toggle
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        
        if(toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }

        // Auto-hide alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert-auto-hide');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 3000);

        // Delete confirmation
        function confirmDelete(formId) {
            if(confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById(formId).submit();
            }
        }
    </script>
</body>
</html>