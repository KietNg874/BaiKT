<?php 
include __DIR__ . '/../shares/header.php'; 
?>
<div class="container mt-4">
    <h1 class="mb-4">TRANG NHÂN VIÊN</h1>
    
    <div class="mb-3">
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="/QL_NhanSu/Employee/add" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Thêm Nhân Viên
            </a>
        <?php endif; ?>
        <a href="/QL_NhanSu/Login/logout" class="btn btn-secondary float-end">Đăng Xuất</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="bg-secondary">
                <tr>
                    <th scope="col" class="text-center">Mã NV</th>
                    <th scope="col" class="text-center">Tên</th>
                    <th scope="col" class="text-center">Giới tính</th>
                    <th scope="col" class="text-center">Nơi Sinh</th>
                    <th scope="col" class="text-center">Tên Phòng</th>
                    <th scope="col" class="text-center">Lương</th>
                    <th scope="col" class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($employees)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Không tìm thấy nhân viên</td> 
                    </tr>
                <?php else: ?>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td class="text-center"><?php echo htmlspecialchars($employee->MaNV, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($employee->TenNV, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center">
                                <?php if ($employee->Phai === 'NU'): ?>
                                    <img src="/QL_NhanSu/public/images/woman.jpg" alt="Woman" style="width: 30px; height: auto; display: block; margin: 0 auto;">
                                <?php else: ?>
                                    <img src="/QL_NhanSu/public/images/man.jpg" alt="Man" style="width: 30px; height: auto; display: block; margin: 0 auto;">
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?php echo htmlspecialchars($employee->NoiSinh, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($employee->TenPhong ?? 'None', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center"><?php echo number_format($employee->Luong, 0, ',', '.'); ?> VNĐ</td>
                            <td class="text-center">
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                    <a href="/QL_NhanSu/Employee/edit/<?php echo $employee->MaNV; ?>" 
                                       class="btn btn-primary btn-sm me-1" 
                                       title="Chỉnh sửa">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/QL_NhanSu/Employee/delete/<?php echo $employee->MaNV; ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Bạn muốn xóa nhân viên này?');"
                                       title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-3">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="/QL_NhanSu/Employee/list?page=<?php echo $page - 1; ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                        <a class="page-link" href="/QL_NhanSu/Employee/list?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="/QL_NhanSu/Employee/list?page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>
<?php include __DIR__ . '/../shares/footer.php'; ?>