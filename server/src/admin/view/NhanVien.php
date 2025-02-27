<main id="admin-employee-main">
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Quản Lý <b>Nhân Viên</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="#addEmployeeModal" class="btn btn-success add" data-toggle="modal">
								<i class="material-icons">&#xE147;</i>
								<span>Thêm</span>
							</a>
							<a href="#deleteEmployeeModal" class="btn btn-danger delete" data-toggle="modal">
								<i class="material-icons">&#xE15C;</i>
								<span>Xóa</span>
							</a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>
								<span class="custom-checkbox">
									<input type="checkbox" id="selectAll">
									<label for="selectAll"></label>
								</span>
							</th>
							<th style="cursor: pointer;" onclick="sortTable('#admin-employee-main table.table', 1)">Mã nhân viên</th>
							<th style="cursor: pointer;" onclick="sortTable('#admin-employee-main table.table', 2)">Nhân viên</th>
							<th style="cursor: pointer;" onclick="sortTable('#admin-employee-main table.table', 3)">Tuổi</th>
							<th style="cursor: pointer;" onclick="sortTable('#admin-employee-main table.table', 4)">Số điện thoại</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody class="admin-employee-list">
						
					</tbody>
				</table>
				<div class="clearfix">
				<div class="hint-text"></div>
					<div id="pagination">
					</div>
					<input type="hidden" name="currentpage" id="currentpage" value="1">
				</div>
			</div>
		</div>
	</div>

	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Thêm nhân viên</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Mã Nhân Viên</label>
							<input type="text" class="form-control" readonly="true" required id="admin-nhanvien-manhanvien">
						</div>
						<div class="form-group">
							<label>Nhân Viên</label>
							<input type="text" class="form-control" required id="admin-nhanvien-tennhanvien">
						</div>
						<div class="form-group">
							<label>Tuổi</label>
							<input type="number" class="form-control" required id="admin-nhanvien-tuoi" min="20">
						</div>
						<div class="form-group">
							<label>Số Điện Thoại</label>
							<input type="text" class="form-control" required id="admin-nhanvien-sodienthoai">
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Hủy">
						<input type="button" class="btn btn-success" id="admin-btn-addNhanVien" value="Thêm">
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Sửa thông tin nhân viên</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="ma_tk">
						<div class="form-group">
						    <label>Mã nhân viên</label>
							<input class="form-control" type="text" readonly='true' name="password" id='admin-update-manhanvien' required>
						</div>
						<div class="form-group">
							<label>Nhân Viên</label>
							<input type="text" class="form-control" name="username" id='admin-update-nhanvien' required>
						</div>
						<div class="form-group">
							<label>Tuổi</label>
							<input class="form-control" type="number" name="age" id='admin-update-tuoi' required>
						</div>
						<div class="form-group">
							<label>Số Điện Thoại</label>
							<input class="form-control" type="text" name="phone" id='admin-update-sodienthoai' required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
						<input type="button" class="btn btn-info" id="admin-btn-updateNhanVien" value="Lưu">
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Xóa nhân viên</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Bạn có muốn xóa nhân viên này không</p>
						<p class="text-warning"><small>Hành động này sẽ không thể hoàn tác</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
						<input type="button" class="btn btn-danger" value="Xóa" id="admin-btn-deleteNhanvien">
					</div>
				</form>
			</div>
		</div>
	</div>
</main>