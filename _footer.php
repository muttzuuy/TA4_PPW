</div>
<footer class="mt-5 p-3 text-center bg-white border-top fixed-bottom shadow-sm">
    <div class="container">
        <small class="text-muted">
            Sistem Manajemen Kontak | Praktikum Pemrograman Web &copy; 2025 Laboratorium Teknik Komputer Unila
        </small>
        <?php if(is_logged_in() && !isset($_GET['debug'])): ?>
            <span class="ms-3 text-primary" style="cursor: pointer; font-size: 0.75rem;" onclick="window.location.href='index.php?debug=show'">
                [Show Debug]
            </span>
        <?php endif; ?>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>