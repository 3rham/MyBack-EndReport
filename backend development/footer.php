<!-- Just there to use in case -->
</div>
    
<footer class="footer text-center p-3 mt-5" style="background-color: #333; color: white;">
        <p>&copy; <?php echo date('Y'); ?> St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            var dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('click', function(e) {
                    e.preventDefault();
                    var dropdownMenu = this.nextElementSibling;
                    dropdownMenu.classList.toggle('show');
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.matches('.dropdown-toggle')) {
                    var dropdowns = document.querySelectorAll('.dropdown-menu');
                    dropdowns.forEach(function(dropdown) {
                        dropdown.classList.remove('show');
                    });
                }
            });
        });
    </script>
</body>
</html>