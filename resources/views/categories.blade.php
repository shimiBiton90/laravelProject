@extends('home')

@section('content')
    <section class="content container">

        @if(session('message'))
            <div class="alert alert-success messageFromServer" role="alert">
                {{ session('message') }}
            </div>
        @endif
        @if(session('errorMessage'))
            <div class="alert alert-warning messageFromServer" role="alert">
                {{ session('errorMessage') }}
            </div>
        @endif


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto mr-auto">
                                <h2 class="card-title">Categories</h2>
                            </div>
                            <div class="col-auto">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#categoriesModal" data-action="Create">Create Category
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($categories))
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                                   data-target="#categoriesModal" data-action="Show"
                                                   data-category="{{$category}}">
                                                    <i class="bi bi-search" data-toggle="tooltip"></i>
                                                </a>
                                                <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal"
                                                   data-target="#categoriesModal" data-action="Edit"
                                                   data-category="{{$category}}">
                                                    <i class="bi bi-pencil-fill" data-toggle="tooltip"></i>
                                                </a>
                                                <form class="form-inline" method="post"
                                                      action="{{route('categories.destroy',$category) }}"
                                                      onsubmit="return confirm('Are You Sure to Delete the Category?')">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h5 class="text-center m-3 mx-auto text-secondary">You don't have any data you can to add
                                some</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="categoriesModal" tableindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="categoryForm" role="form">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" id="actionType" name="actionType">
                            <input type="hidden" class="form-control" id="id" name="id">

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    <span class="text-danger"><strong id="name-error"></strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="submitForm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>

        $("#nvaPages li.btn-primary").removeClass("btn-primary").find("a").removeClass("text-white");
        $("#categoriesLink").addClass("btn-primary").find("a").addClass("text-white");

        $(".messageFromServer").delay(3000).hide("fast");

        function resetErrorsFormMessage() {
            $("strong[id$='-error']").html("");
        }

        $('#categoriesModal').on('show.bs.modal', function (e) {
            var actionButton = $(e.relatedTarget);
            var actionType = actionButton.data('action');
            $("#actionType").val(actionType);

            resetErrorsFormMessage();

            var modal = $(this);
            modal.find('.modal-title').text(actionType + ' Category');
            $("#submitForm").show();

            if (actionType == 'Edit' || actionType == 'Show') {
                var category = actionButton.data('category');
                $("#id").val(category.id);
                $("#name").val(category.name);
                if (actionType == 'Show') {
                    $("#submitForm").hide();
                }
            } else {
                $("#id").val(null);
                $("#categoryForm").trigger("reset");
            }
        });


        $('body').on('click', '#submitForm', function (e) {
            e.preventDefault();
            var categoryForm = $("#categoryForm");
            var formData = categoryForm.serialize();
            resetErrorsFormMessage();

            let url = '/panda/public/categories';

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function (data) {
                    $('#categoriesModal').modal('hide');
                    window.location.href = url;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    var data = jqXHR.responseJSON;
                    if (data.errors) {
                        for (var key in data.errors) {
                            if (data.errors.hasOwnProperty(key)) {
                                $("#" + key + "-error").html(data.errors[key][0]);
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
