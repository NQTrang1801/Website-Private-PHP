@extends('admin.layouts.app')
@section('title')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <i class="bi bi-stickies"></i>
    </li>
    <li class="breadcrumb-item breadcrumb-active" aria-current="Sizes"><a href="{{route('sizes.index')}}">Sizes</a>/Insert</li>
</ol>
@endsection
@section('content')
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
                                    <a class="nav-link active" id="size-tab" data-bs-toggle="tab" href="#size" role="tab" aria-controls="size" aria-selected="true">ID: {{$size->id}}</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="formsTabContent">

                                <div class="tab-pane fade show active" id="size" role="tabpanel">
                                    <form action="" method="post" id="sizeForm" name="sizeForm">
                                        @csrf
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-8 col-sm-8 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter size Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="size-name" name="name" placeholder="Name" value="{{$size->name}}" autocomplete="off">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Row end -->

                                        <!-- Form actions footer start -->
                                        <div class="form-actions-footer">
                                            <button type="reset" class="btn btn-light">Reset</button>
                                            <button type="submit" class="btn btn-success" style="color: black;">Update</button>
                                        </div>
                                        <!-- Form actions footer end -->
                                    </form>
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
@endsection

@section('customJs')
<script>
    $("#sizeForm").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("sizes.update",$size->id) }}',
            type: 'put',
            data: element.serializeArray(),
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) {

                    window.location.href="{{route('sizes.index')}}";

                    alert('size updated successfully!');

                    $("#size-name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                } else {
                    if (response["notFound"] == true) 
                    {
                        alert("size not found");
                        window.location.href = "{{route('sizes.index')}}";
                    }
                    var errors = response['errors'];
                    if (errors['name']) {
                        $("#size-name").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['name'])
                    } else {
                        $("#size-name").removeClass('is-invalid')
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