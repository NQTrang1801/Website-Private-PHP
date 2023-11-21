@extends('admin.layouts.app')
@section('title')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <i class="bi bi-stickies"></i>
    </li>
    <li class="breadcrumb-item breadcrumb-active" aria-current="Categories">Categories/Insert</li>
</ol>
@endsection
@section('content')
<div class="content-wrapper-scroll">

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card card-370">
                    <div class="card-body">
                        <div class="custom-tabs-container">
                            <ul class="nav nav-tabs" id="formsTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="category-tab" data-bs-toggle="tab" href="#category" role="tab" aria-controls="categry" aria-selected="true">Category</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="subCategory-tab" data-bs-toggle="tab" href="#sub-category" role="tab" aria-controls="sub-category" aria-selected="false">Sub Category</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="imageCategory" data-bs-toggle="tab" href="#image-category" role="tab" aria-controls="image-category" aria-selected="false">Image Category</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="formsTabContent">

                                <div class="tab-pane fade show active" id="category" role="tabpanel">
                                    <form action="" method="post" id="insertCategoryForm" name="insertCategoryForm">
                                        @csrf
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-8 col-sm-8 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter Category Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="category-name" name="name" placeholder="Name">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Slug</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="category-slug" name="slug" placeholder="slug">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-8 col-sm-8 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <div class="mt-2">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="status" id="StatusRadio1" value="1" checked>
                                                            <label class="form-check-label" for="StatusRadio1">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="status" id="StatusRadio2" value="0">
                                                            <label class="form-check-label" for="StatusRadio2">Block</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Row end -->

                                        <!-- Form actions footer start -->
                                        <div class="form-actions-footer">
                                            <button type="reset" class="btn btn-light">Reset</button>
                                            <button type="submit" class="btn btn-success" style="color: black;">Save</button>
                                        </div>
                                        <!-- Form actions footer end -->
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="sub-category" role="tabpanel">
                                    <!-- Row start -->

                                    <!-- Row end -->

                                    <!-- Form actions footer start -->
                                    <div class="form-actions-footer">
                                        <button class="btn btn-light">Reset</button>
                                        <button class="btn btn-success">Save</button>
                                    </div>
                                    <!-- Form actions footer end -->
                                </div>
                                <div class="tab-pane fade" id="image-category" role="tabpanel">

                                    <!-- Row start -->

                                    <!-- Row end -->

                                    <!-- Form actions footer start -->
                                    <div class="form-actions-footer">
                                        <button class="btn btn-light">Reset</button>
                                        <button class="btn btn-success">Save</button>
                                    </div>
                                    <!-- Form actions footer end -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Row end -->

    </div>
    <!-- Content wrapper end -->

    <!-- App Footer start -->
    <div class="app-footer">
        <span>© Bootstrap Gallery 2023</span>
    </div>
    <!-- App footer end -->

</div>
@endsection

@section('customJs')
<script>
    $("#insertCategoryForm").submit(function(event) {
        console.log("ok");
        event.preventDefault();
        var element = $(this);
        $.ajax({
            url: '{{ route("categories.store") }}',
            type: 'post',
            data: element.serializeArray(),
            success: function(response) {
                if (response["status"] == true) {
                    $("#category-name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    $("#category-slug").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                } else {
                    var errors = response['errors'];
                    if (errors['name']) {
                        $("#category-name").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['name'])
                    } else {
                        $("#category-name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }

                    if (errors['slug']) {
                        $("#category-slug").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['slug'])
                    } else {
                        $("#category-slug").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }
                }

            },
            error: function(jqXHR, exception) {
                console.log("wrong");
            }
        })
    });
</script>
@endsection