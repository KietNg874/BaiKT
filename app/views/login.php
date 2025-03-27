<?php include __DIR__ . '/shares/header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Đăng Nhập Hệ Thống</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    <form method="POST" action="/QL_NhanSu/Login/login">
        <div class="mb-3">
            <label for="username" class="form-label">Tên Đăng Nhập:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật Khẩu:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
    </form>
</div>
<?php include __DIR__ . '/shares/footer.php'; ?>