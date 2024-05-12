<main id="admin-product-main">
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Quản Lý <b>Sản Phẩm</b></h2>
						</div>
						<div class="col-sm-6">
							<form>
								<input type="file" id="import-excel-file" accept=".xlsx,.xls" hidden>
								<a href="#" class="btn btn-primary btn-import-excel">
									<i class="fa-solid fa-file-import"></i>
									<span>Import Excel</span>
								</a>
							</form>
							<div>
								<a href="#" class="btn btn-primary btn-export-excel">
									<i class="fa-solid fa-file-export"></i>
									<span>Export Excel</span>
								</a>
							</div>
							<a href="#addProductModal" class="btn btn-success add" data-toggle="modal">
								<i class="material-icons">&#xE147;</i>
								<span>Thêm</span>
							</a>
							<a href="#deleteProductModal" class="btn btn-danger btn-delete-checked-product-modal delete" data-toggle="modal">
								<i class="material-icons">&#xE15C;</i>
								<span>Xóa</span>
							</a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover admin-product-table">
					<thead>
						<tr>
							<th>
								<span class="custom-checkbox">
									<input type="checkbox" id="selectAll">
									<label for="selectAll"></label>
								</span>
							</th>
							<th>ID</th>
							<th>Tên sản phẩm</th>
							<th>Thương hiệu</th>
							<th>Số lượng tồn</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody class="admin-product-list">
						
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

	<div id="addProductModal" class="modal fade product-config-modal" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title product-config-detail-name">Thêm sản phẩm</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body px-0">
					<form class="add-product-form">
						<div class="modal-row">	
							<div class="control-form__upload">
								<div class="upload-box hide-image">
									<input type="file" id="product-image" accept="image/*" hidden>
									<img src="" alt="Hình ảnh sản phẩm" class="preview-img">
									<span class="btn-remove-img" onClick="removePreviewImage()">
										<i class="fa-solid fa-xmark"></i>
									</span>
									<div class="upload-box-content">
										<span class="btn-upload-img">
											<i class="fa-solid fa-cloud-arrow-up"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Thông tin sản phẩm</h5>
							<ul class="modal-row-list">
								<li class="modal-row-item row align-items-center">
									<label for="product-name" class="col-sm-4 px-0 mb-0">Tên sản phẩm:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="product-name" id="product-name">
									</div>
								</li>
								<li class="modal-row-item row align-items-center">
									<label for="product-origin" class="col-sm-3 px-0 mb-0">Xuất xứ:</label>
									<div class="col-sm-8 px-0">
										<input type="text" class="form-control" name="product-origin" id="product-origin">
									</div>
								</li>
								<li class="modal-row-item row align-items-center">
									<label for="product-brand" class="col-sm-4 px-0 mb-0">Thương hiệu:</label>
									<div class="col-sm-5 px-0">
										<select id="product-brand" class="form-control">

										</select>
									</div>
									<button href="#addProductBrandModal" data-toggle="modal" type="button" class="btn btn-outline-primary btn-ssm br-50 ml-2">
										<i class="fa-solid fa-plus"></i>
									</button>
									<button href="#deleteProductBrandModal" data-toggle="modal" type="button" class="btn-open-delete-brand-modal btn btn-outline-danger btn-ssm br-50 ml-1">
										<i class="fa-solid fa-minus"></i>
									</button>
								</li>
								<li class="modal-row-item row align-items-center">
									<label for="product-type" class="col-sm-3 px-0 mb-0">Thể loại:</label>
									<div class="col-sm-6 px-0">
										<select id="product-type" class="form-control">

										</select>
									</div>
									<button href="#addProductTypeModal" data-toggle="modal" type="button" class="btn btn-outline-primary btn-ssm br-50 ml-2">
										<i class="fa-solid fa-plus"></i>
									</button>
									<button href="#deleteProductTypeModal" data-toggle="modal" type="button" class="btn-open-delete-type-modal btn btn-outline-danger btn-ssm br-50 ml-1">
										<i class="fa-solid fa-minus"></i>
									</button>
								</li>
							</ul>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Thiết kế & trọng lượng</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Trọng lượng(kg):</td>
										<td>
											<input type="number" class="form-control" name="product-weight" id="product-weight">
										</td>
									</tr>
									<tr>
										<td>Màu sắc:</td>
										<td>
											<select id="product-color" class="form-control selectpicker" data-size="5" multiple data-live-search="true" data-live-search="startsWith">

											</select>
										</td>
										<td>
											<button href="#addProductColorModal" data-toggle="modal" type="button" class="btn btn-outline-primary btn-ssm br-50 ml-2">
												<i class="fa-solid fa-plus"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td>Chất liệu:</td>
										<td>
											<input type="text" class="form-control" name="product-material" id="product-material">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Bộ xử lý</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>CPU:</td>
										<td>
											<select id="product-cpu" class="form-control selectpicker" data-size="5" multiple data-live-search="true" data-live-search="startsWith">

											</select>
										</td>
										<td>
											<button href="#addProductCPUModal" data-toggle="modal" type="button" class="btn btn-outline-primary btn-ssm br-50 ml-2">
												<i class="fa-solid fa-plus"></i>
											</button>
											<button href="#deleteProductCPUModal" type="button" class="btn-delete-cpu-modal btn btn-outline-danger btn-ssm br-50 ml-1">
												<i class="fa-solid fa-minus"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Bộ nhớ</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Dung lượng RAM:</td>
										<td>
											<select id="product-ram" class="form-control selectpicker" multiple data-live-search="true">
												<option value="8gb">8GB</option>
												<option value="16gb">16GB</option>
												<option value="32gb">32GB</option>
												<option value="64gb">64GB</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Dung lượng ROM:</td>
										<td>
											<select id="product-rom" class="form-control selectpicker" multiple data-live-search="true">
												<option value="256gb">256GB</option>
												<option value="512gb">512GB</option>
												<option value="1tb">1TB</option>
												<option value="2TB">2TB</option>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Màn hình</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Kích cỡ màn hình:</td>
										<td>
											<input type="text" class="form-control" name="product-screen" id="product-screen">
										</td>
									</tr>
									<tr>
										<td>Độ phân giải:</td>
										<td>
											<input type="text" class="form-control" name="product-resolution" id="product-resolution">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Đồ họa</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Card đồ họa:</td>
										<td>
											<select id="product-gpu" class="form-control selectpicker" data-size="5" multiple data-live-search="true" data-live-search="startsWith">

											</select>
										</td>
										<td>
											<button href="#addProductGPUModal" data-toggle="modal" type="button" class="btn btn-outline-primary btn-ssm br-50 ml-2">
												<i class="fa-solid fa-plus"></i>
											</button>
											<button href="#deleteProductGPUModal" type="button" class="btn-delete-gpu-modal btn btn-outline-danger btn-ssm br-50 ml-1">
												<i class="fa-solid fa-minus"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Giao tiếp & kết nối</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Cổng kết nối:</td>
										<td>
											<select id="product-plug" class="form-control selectpicker" data-size="5" multiple data-live-search="true" data-live-search="startsWith">

											</select>
										</td>
										<td>
											<button href="#addProductPlugModal" data-toggle="modal" type="button" class="btn btn-outline-primary btn-ssm br-50 ml-2">
												<i class="fa-solid fa-plus"></i>
											</button>
											<button href="#deleteProductPlugModal" type="button" class="btn-delete-plug-modal btn btn-outline-danger btn-ssm br-50 ml-1">
												<i class="fa-solid fa-minus"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Bàn phím & TouchPad</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Kiểu bàn phím:</td>
										<td>
											<input type="text" class="form-control" name="product-keyboard" id="product-keyboard">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Thông tin pin & Sạc</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Loại PIN:</td>
										<td>
											<input type="text" class="form-control" name="product-battery" id="product-battery">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Hệ điều hành</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>OS:</td>
										<td>
											<select id="product-os" class="form-control">

											</select>
										</td>
										<td>
											<button href="#addProductOSModal" data-toggle="modal" type="button" class="btn btn-outline-primary btn-ssm br-50 ml-2">
												<i class="fa-solid fa-plus"></i>
											</button>
											<button href="#deleteProductOSModal" data-toggle="modal" type="button" class="btn-delete-os-modal btn btn-outline-danger btn-ssm br-50 ml-1">
												<i class="fa-solid fa-minus"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Hủy">
					<input type="button" class="btn btn-primary btn-add-product" value="Thêm">
				</div>
			</div>
		</div>
	</div>

	<div id="editProductModal" class="modal fade product-config-modal" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title product-config-detail-name">Sửa thông tin chung sản phẩm <b class="product-id"></b></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body px-0">
					<form class="edit-product-form">
						<div class="modal-row">
							<div class="control-form__upload">
								<div class="upload-box hide-image">
									<input type="file" id="product-image" accept="image/*" hidden>
									<img src="" alt="Hình ảnh sản phẩm" class="preview-img">
									<span class="btn-remove-img" onClick="updateRemovePreviewImage()">
										<i class="fa-solid fa-xmark"></i>
									</span>
									<div class="upload-box-content">
										<span class="btn-upload-img">
											<i class="fa-solid fa-cloud-arrow-up"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Thông tin sản phẩm</h5>
							<ul class="modal-row-list">
								<li class="modal-row-item row align-items-center">
									<label for="product-name" class="col-sm-4 px-0 mb-0">Tên sản phẩm:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="product-name" id="product-name">
									</div>
								</li>
								<li class="modal-row-item row align-items-center">
									<label for="product-origin" class="col-sm-3 px-0 mb-0">Xuất xứ:</label>
									<div class="col-sm-8 px-0">
										<input type="text" class="form-control" name="product-origin" id="product-origin">
									</div>
								</li>
								<li class="modal-row-item row align-items-center">
									<label for="product-brand" class="col-sm-4 px-0 mb-0">Thương hiệu:</label>
									<div class="col-sm-5 px-0">
										<select id="product-brand" class="form-control">

										</select>
									</div>
									<button href="#addProductBrandModal" data-toggle="modal" type="button" class="btn btn-outline-primary btn-ssm br-50 ml-2">
										<i class="fa-solid fa-plus"></i>
									</button>
									<button href="#deleteProductBrandModal" data-toggle="modal" type="button" class="btn-open-delete-brand-modal btn btn-outline-danger btn-ssm br-50 ml-1">
										<i class="fa-solid fa-minus"></i>
									</button>
								</li>
								<li class="modal-row-item row align-items-center">
									<label for="product-type" class="col-sm-3 px-0 mb-0">Thể loại:</label>
									<div class="col-sm-6 px-0">
										<select id="product-type" class="form-control">

										</select>
									</div>
									<button href="#addProductTypeModal" data-toggle="modal" type="button" class="btn btn-outline-primary btn-ssm br-50 ml-2">
										<i class="fa-solid fa-plus"></i>
									</button>
									<button href="#deleteProductTypeModal" data-toggle="modal" type="button" class="btn-open-delete-type-modal btn btn-outline-danger btn-ssm br-50 ml-1">
										<i class="fa-solid fa-minus"></i>
									</button>
								</li>
							</ul>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Số lượng</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Số lượng tồn:</td>
										<td>
											<input type="number" class="form-control" name="product-quantity" id="product-quantity">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Thiết kế & trọng lượng</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Trọng lượng(kg):</td>
										<td>
											<input type="number" class="form-control" name="product-weight" id="product-weight">
										</td>
									</tr>
									<tr>
										<td>Chất liệu:</td>
										<td>
											<input type="text" class="form-control" name="product-material" id="product-material">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Màn hình</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Kích cỡ màn hình:</td>
										<td>
											<input type="text" class="form-control" name="product-screen" id="product-screen">
										</td>
									</tr>
									<tr>
										<td>Độ phân giải:</td>
										<td>
											<input type="text" class="form-control" name="product-resolution" id="product-resolution">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Bàn phím & TouchPad</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Kiểu bàn phím:</td>
										<td>
											<input type="text" class="form-control" name="product-keyboard" id="product-keyboard">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Thông tin pin & Sạc</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Loại PIN:</td>
										<td>
											<input type="text" class="form-control" name="product-battery" id="product-battery">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Hệ điều hành</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>OS:</td>
										<td>
											<select id="product-os" class="form-control">

											</select>
										</td>
										<td>
											<button href="#addProductOSModal" data-toggle="modal" type="button" class="btn btn-outline-primary btn-ssm br-50 ml-2">
												<i class="fa-solid fa-plus"></i>
											</button>
											<button href="#deleteProductOSModal" data-toggle="modal" type="button" class="btn-delete-os-modal btn btn-outline-danger btn-ssm br-50 ml-1">
												<i class="fa-solid fa-minus"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<button type="button" class="btn-to-product-detail">Sửa chi tiết sản phẩm</button>
					</form>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Hủy">
					<input type="button" class="btn btn-primary btn-update-product" value="Lưu">
				</div>
			</div>
		</div>
	</div>

	<div id="deleteProductModal" class="modal fade" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Xóa sản phẩm</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body confirm-delete">

					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Hủy">
						<input type="button" class="btn btn-danger btn-delete-product" value="Xóa">
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="viewProductModal" class="modal fade product-config-modal" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title product-config-detail-name">Thông tin sản phẩm <b class="product-id"></b></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body px-0">
					<form class="view-product-form">
						<div class="modal-row">
							<div class="control-form__upload">
								<div class="upload-box">
									<img src="" alt="Hình ảnh sản phẩm" class="preview-img">
								</div>
							</div>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Thông tin hàng hóa</h5>
							<ul class="modal-row-list">
								<li class="modal-row-item row align-items-center">
									<label class="mb-0 mr-2">Tên sản phẩm:</label>
									<span class="product-name"></span>
								</li>
								<li class="modal-row-item row align-items-center">
								<label class="mb-0 col-sm-3 px-0">Xuất xứ:</label>
									<span class="product-origin"></span>
								</li>
								<li class="modal-row-item row align-items-center">
									<label for="product-brand" class="col-sm-4 px-0 mb-0">Thương hiệu:</label>
									<div class="col-sm-5 px-0">
										<select id="product-brand" class="form-control" disabled>

										</select>
									</div>
								</li>
								<li class="modal-row-item row align-items-center">
									<label for="product-type" class="col-sm-3 px-0 mb-0">Thể loại:</label>
									<div class="col-sm-8 px-0">
										<select id="product-type" class="form-control" disabled>

										</select>
									</div>
								</li>
							</ul>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Giá:</h5>
							<ul class="modal-row-list">
								<li class="modal-row-item row align-items-center">
									<label class="mb-0 mr-2">Giá nhập:</label>
									<span class="product-import-price"></span>
								</li>
								<li class="modal-row-item row align-items-center">
									<label class="mb-0 mr-2">Chiết khấu:</label>
									<span class="product-chietkhau"></span>
								</li>
								<li class="modal-row-item row align-items-center">
									<label class="mb-0 mr-2">Giá bán:</label>
									<span class="product-price"></span>
								</li>
							</ul>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Số lượng</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Số lượng tồn:</td>
										<td class="product-quantity"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Thiết kế & trọng lượng</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Trọng lượng(kg):</td>
										<td class="product-weight"></td>
									</tr>
									<tr>
										<td>Màu sắc:</td>
										<td class="product-color"></td>
									</tr>
									<tr>
										<td>Chất liệu:</td>
										<td class="product-material"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Bộ xử lý</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>CPU:</td>
										<td>
											<ul class="product-cpu mb-0">

											</ul>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Bộ nhớ</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Dung lượng RAM:</td>
										<td class="product-ram"></td>
									</tr>
									<tr>
										<td>Dung lượng ROM:</td>
										<td class="product-rom"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Màn hình</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Kích cỡ màn hình:</td>
										<td class="product-screen"></td>
									</tr>
									<tr>
										<td>Độ phân giải:</td>
										<td class="product-resolution"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Đồ họa</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Card đồ họa:</td>
										<td>
											<ul class="product-gpu mb-0">

											</ul>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Giao tiếp & kết nối</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Cổng kết nối:</td>
										<td>
											<ul class="product-plug mb-0 d-flex flex-wrap" style="list-style-type: disc; gap: 40px;">

											</ul>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Bàn phím & TouchPad</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Kiểu bàn phím:</td>
										<td class="product-keyboard"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Thông tin pin & Sạc</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>Loại PIN:</td>
										<td class="product-battery"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-row">
							<h5 class="modal-row-title">Hệ điều hành</h5>
							<table class="modal-row-table">
								<tbody>
									<tr>
										<td>OS:</td>
										<td>
											<select id="product-os" class="form-control" disabled>

											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php
	include 'ThuongHieu.php';
	include 'TheLoai.php';
	include 'MauSac.php';
	include 'ChipXuLy.php';
	include 'CardDoHoa.php';
	include 'CongKetNoi.php';
	include 'HeDieuHanh.php';
	?>
</main>