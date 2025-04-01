<?php include __DIR__ . '/../shares/header.php'; ?>


<h1 class="text-center mb-4">Chỉnh Sửa Sách</h1>

<hr />
<div class="row">
    <div class="col-md-10 mx-auto">
        <form asp-action="Edit" method="post" enctype="multipart/form-data">
            <div asp-validation-summary="ModelOnly" class="text-danger mb-4"></div>
            <input type="hidden" asp-for="Id" />

            <div class="row">
                <!-- Cột trái -->
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label asp-for="Name" class="control-label">Tên sách</label>
                        <input asp-for="Name" class="form-control" />
                        <span asp-validation-for="Name" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label asp-for="CategoryId" class="control-label">Thể loại</label>
                        <select asp-for="CategoryId" class="form-control" asp-items="ViewBag.CategoryId"></select>
                        <span asp-validation-for="CategoryId" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label asp-for="AuthorId" class="control-label">Tác giả</label>
                        <select asp-for="AuthorId" class="form-control" asp-items="ViewBag.AuthorId"></select>
                        <span asp-validation-for="AuthorId" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label asp-for="Price" class="control-label">Giá</label>
                        <input asp-for="Price" class="form-control" id="priceInput" />
                        <span asp-validation-for="Price" class="text-danger"></span>
                        <div id="formattedPrice" class="text-muted mt-2"></div>
                    </div>
                    @if (Model.Price != 0)
                    {
                        <div class="form-group mb-3">
                            <label asp-for="StockQuantity" class="control-label">Số lượng tồn kho</label>
                            <input asp-for="StockQuantity" type="number" class="form-control" min="0" />
                            <span asp-validation-for="StockQuantity" class="text-danger"></span>
                        </div>
                    }
                    <div class="form-group mb-3">
                        <label asp-for="Description" class="control-label">Mô tả</label>
                        <textarea asp-for="Description" class="form-control" rows="5"></textarea>
                        <span asp-validation-for="Description" class="text-danger"></span>
                    </div>
                </div>

                <!-- Cột phải -->
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label asp-for="pdf" class="control-label">Nội dung PDF</label>
                        <input type="file" asp-for="pdf" class="form-control" />                        
                        @if (!string.IsNullOrEmpty(Model.pdf))
                        {
                            <p>PDF: <a href="@Model.pdf" target="_blank">@Model.pdf</a></p>
                        }
                        <span asp-validation-for="pdf" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label asp-for="AudioFileUrl" class="control-label">Sách nói (Audio)</label>
                        <input type="file" asp-for="AudioFileUrl" class="form-control" />                        
                        @if (!string.IsNullOrEmpty(Model.AudioFileUrl))
                        {
                            <p>File audio:</p>
                            <audio controls style="width: 100%;">
                                <source src="@Model.AudioFileUrl" type="audio/mpeg" />
                                Trình duyệt của bạn không hỗ trợ phát âm thanh.
                            </audio>
                        }
                        <span asp-validation-for="AudioFileUrl" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label asp-for="ImageUrl" class="control-label">Hình ảnh</label>
                        <input type="file" asp-for="ImageUrl" class="form-control" id="imageInput" onchange="previewImage(event)" />
                        <!-- Hiển thị ảnh cũ nếu có -->
                        <div id="imagePreviewContainer" class="mt-2">
                            @if (!string.IsNullOrEmpty(Model.ImageUrl))
                            {
                                <img id="imagePreview" src="/images/@Model.ImageUrl" alt="Hình ảnh cũ" style="max-width: 200px;" />
                            }
                            else
                            {
                                <img id="imagePreview" src="#" alt="Hình ảnh preview" style="max-width: 200px; display: none;" />
                            }
                        </div>
                        <span asp-validation-for="ImageUrl" class="text-danger"></span>
                    </div>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="text-center mt-4">
                <input type="submit" value="Lưu" class="btn btn-success btn-lg" />
                <a asp-action="Index" class="btn btn-secondary btn-lg ml-3">Quay về danh sách</a>
            </div>
        </form>
    </div>
</div>




<?php include __DIR__ . '/../shares/footer.php'; ?>
