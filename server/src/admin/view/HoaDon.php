<main id="admin-bill-main">
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Quản Lý <b>HÓA ĐƠN</b></h2>
						</div>
						<div class="col-sm-6">
							<!-- <a href="#addEmployeeModal" class="btn btn-success add" data-toggle="modal">
								<i class="material-icons">&#xE147;</i>
								<span>Thêm</span>
							</a> -->
							<a href="#deleteEmployeeModal" class="btn btn-danger delete" data-toggle="modal">
								<i class="material-icons">&#xE15C;</i>
								<span>Xóa</span>
							</a>
						</div>
					</div>
				</div>
				<table class="table-bill table table-striped table-hover">
					<thead>
						<tr>
							<th>
								<span class="custom-checkbox">
									<input type="checkbox" id="selectAll">
									<label for="selectAll"></label>
								</span>
							</th>
							<th>ID</th>
							<th>Khách Hàng</th>
							<th>Nhân Viên</th>
							<th>Ngày Tạo</th>
							<th>Tổng Tiền</th>
							<th>Khuyến Mãi</th>
							<th>Thành tiền</th>
							<th>Hình thức</th>
							<th>Tình Trạng</th>
							<th class="w-auto">Actions</th>
						</tr>
					</thead>
					<tbody class="admin-bill-list">
						
					</tbody>
				</table>
				<div class="clearfix">
					<div class="hint-text">Hiển thị <b>5</b> trong <b>25</b> kết quả</div>
					<ul class="pagination">
						<li class="page-item disabled"><a href="#">Previous</a></li>
						<li class="page-item"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item active"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">4</a></li>
						<li class="page-item"><a href="#" class="page-link">5</a></li>
						<li class="page-item"><a href="#" class="page-link">Next</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- <div id="addBill" class="modal fade product-config-modal" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title promotion-config-detail-name">Thêm khuyến mãi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body px-0">
					<form class="add-promotion-form">
						<div class="modal-row">
							<h5 class="modal-row-title">Thông tin khuyến mãi</h5>
							<ul class="modal-row-list">
								<li class="modal-row-item row align-items-center justify-content-between">
									<label for="promotion-id" class="col-sm-3 px-0 mb-0">ID:</label>
									<div class="col-sm-8 px-0">
										<input type="text" readonly class="form-control" name="promotion-id" id="promotion-id">
									</div>
								</li>
								<li class="modal-row-item row align-items-center justify-content-between">
									<label for="promotion-name" class="col-sm-3 px-0 mb-0">Tên:</label>
									<div class="col-sm-8 px-0">
										<input type="text" class="form-control" name="promotion-name" id="promotion-name">
									</div>
								</li>
								<li class="modal-row-item row align-items-center justify-content-between">
									<label for="promotion-percent" class="col-sm-3 px-0 mb-0">Mức giảm:</label>
									<div class="col-sm-8 px-0">
										<input type="number" class="form-control" name="promotion-percent" id="promotion-percent">
									</div>
								</li>
								<li class="modal-row-item row align-items-center justify-content-between">
									<label for="promotion-condition" class="col-sm-3 px-0 mb-0">Điều kiện:</label>
									<div class="input-group col-sm-8 px-0">
										<div class="input-group-prepend">
											<div class="input-group-text">≥</div>
										</div>
										<input type="number" class="form-control" name="promotion-condition" id="promotion-condition">
									</div>
								</li>
								<li class="modal-row-item row align-items-center justify-content-between">
									<label for="promotion-date-from" class="col-sm-3 px-0 mb-0">Từ ngày:</label>
									<div class="col-sm-8 px-0">
										<input type="date" class="form-control" name="promotion-date-from" id="promotion-date-from">
									</div>
								</li>
								<li class="modal-row-item row align-items-center justify-content-between">
									<label for="promotion-date-to" class="col-sm-3 px-0 mb-0">Đến ngày:</label>
									<div class="col-sm-8 px-0">
										<input type="date" class="form-control" name="promotion-date-to" id="promotion-date-to">
									</div>
								</li>
								<li class="modal-row-item row align-items-center justify-content-between">
									<label for="promotion-status" class="col-sm-3 px-0 mb-0">Trạng thái:</label>
									<div class="col-sm-8 px-0">
										<input type="text" readonly class="form-control" name="promotion-status" id="promotion-status">
									</div>
								</li>
							</ul>
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Hủy">
							<input type="button" class="btn btn-primary btn-add-promotion" value="Thêm">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->

	<div id="deleteBill" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Xóa hóa đơn</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body delete-body">
						
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
						<input id="confirm-delete" class="btn btn-danger" value="Xóa">
					</div>
				</form>
			</div>
		</div>
	</div>
</main>