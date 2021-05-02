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
                                <h2 class="card-title">Products</h2>
                            </div>
                            <div class="col-auto">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#proModal" data-action="Create">Create Products
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Create Date</th>
                                <th>Update Date</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->amountInStock }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td>{{ $product->categoryName }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                               data-target="#proModal" data-action="Show"
                                               data-product="{{json_encode($product)}}">
                                                <i class="bi bi-search" data-toggle="tooltip"></i>
                                            </a>
                                            <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal"
                                               data-target="#proModal" data-action="Edit"
                                               data-product="{{json_encode($product)}}">
                                                <i class="bi bi-pencil-fill" data-toggle="tooltip"></i>
                                            </a>
                                            <form class="form-inline" method="post"
                                                  action="{{route('products.destroy',$product->id) }}"
                                                  onsubmit="return confirm('Are You Sure to Delete the Products?')">
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
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="proModal" tableindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="productForm" role="form">
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
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="amountInStock">Amount</label>
                                    <input type="number" class="form-control" id="amountInStock" name="amountInStock">
                                    <span class="text-danger"><strong id="amountInStock-error"></strong></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="categoryId">Category</label>
                                    <select class="custom-select form-control" id="categoryId" name="categoryId">
                                        <option value="0" selected disabled="disabled">Choose...</option>
                                        @foreach($categories as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><strong id="categoryId-error"></strong></span>
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
        $("#productsLink").addClass("btn-primary").find("a").addClass("text-white");

        $(".messageFromServer").delay(3000).hide("fast");

        function resetErrorsFormMessage() {
            $("strong[id$='-error']").html("");
        }

        function setData(obj) {
            for (var key in obj) {
                if (obj.hasOwnProperty(key)) {
                    let el = $("#" + key);
                    if (el.length) {
                        if (el.is("select")) {
                            el.find('option[value="' + obj[key] + '"]').prop('selected', true);
                        } else {
                            el.val(obj[key]);
                        }
                    }
                }
            }
        }

        $('#proModal').on('show.bs.modal', function (e) {
            var actionButton = $(e.relatedTarget);
            var actionType = actionButton.data('action');
            $("#actionType").val(actionType);

            resetErrorsFormMessage();

            var modal = $(this);
            modal.find('.modal-title').text(actionType + ' Product');
            $("#submitForm").show();

            if (actionType == 'Edit' || actionType == 'Show') {
                var product = actionButton.data('product');

                setData(product);

                if (actionType == 'Show') {
                    $("#submitForm").hide();
                }
            } else {
                $("#id").val(null);
                $("#productForm").trigger("reset");
            }
        });


        $('body').on('click', '#submitForm', function (e) {
            e.preventDefault();
            var productForm = $("#productForm");
            var formData = productForm.serialize();
            resetErrorsFormMessage();

            let url = '/panda/public/products';

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function (data) {
                    $('#proModal').modal('hide');
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
