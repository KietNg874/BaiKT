<?php include __DIR__ . '/../shares/header.php'; ?>
<h1>Thêm Nhân Viên Mới</h1>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form method="POST" action="/QL_NhanSu/Employee/save">
    <div class="form-group">
        <label for="maNV">Mã Nhân Viên:</label>
        <input type="text" id="maNV" name="maNV" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="tenNV">Họ và Tên:</label>
        <input type="text" id="tenNV" name="tenNV" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phai">Giới Tính:</label>
        <select id="phai" name="phai" class="form-control" required>
            <option value="NAM">Nam</option>
            <option value="NU">Nữ</option>
        </select>
    </div>
    <div class="form-group">
        <label for="noiSinh">Nơi Sinh:</label>
        <input type="text" id="noiSinh" name="noiSinh" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="maPhong">Phòng Ban:</label>
        <select id="maPhong" name="maPhong" class="form-control" required>
            <?php foreach ($departments as $department): ?>
                <option value="<?php echo $department->MaPhong; ?>">
                    <?php echo htmlspecialchars($department->TenPhong, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="luong">Lương:</label>
        <input type="number" id="luong" name="luong" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Thêm Nhân Viên</button>
</form>
<a href="/QL_NhanSu/Employee/list" class="btn btn-secondary mt-2">Quay Lại Danh Sách Nhân Viên</a>
<?php include __DIR__ . '/../shares/footer.php'; ?>