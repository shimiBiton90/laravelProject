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
                                <h2 class="card-title">Customer</h2>
                            </div>
                            <div class="col-auto">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#orderModal" data-action="Create">Create Customer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($customers))
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Order No</th>
                                <th>User Name</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>country</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->userName }}</td>
                                    <td>{{ $order->categoryName }}</td>
                                    <td>{{ $order->productName }}</td>
                                    <td>{{ $order->amount }}</td>
                                    <td>{{ $order->countryName }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                               data-target="#orderModal" data-action="Show"
                                               data-order="{{json_encode($order)}}">
                                                <i class="bi bi-search" data-toggle="tooltip"></i>
                                            </a>
                                            <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal"
                                               data-target="#orderModal" data-action="Edit"
                                               data-order="{{json_encode($order)}}">
                                                <i class="bi bi-pencil-fill" data-toggle="tooltip"></i>
                                            </a>
                                            <form class="form-inline" method="post"
                                                  action="{{route('customers.destroy',$order->id) }}"
                                                  onsubmit="return confirm('Are You Sure to Delete the Customers?')">
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

        <div class="modal fade" id="orderModal" tableindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="orderForm" role="form">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" id="actionType" name="actionType">
                            <input type="hidden" class="form-control" id="id" name="id">

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="countryId">Country</label>
                                    <select class="custom-select form-control" id="countryId" name="countryId">
                                        <option selected disabled="disabled">Choose...</option>
                                    </select>
                                    <span class="text-danger"><strong id="countryId-error"></strong></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="categoryId">Categories</label>
                                    <select class="custom-select form-control" id="categoryId" name="categoryId">
                                        <option selected disabled="disabled">Choose...</option>
                                    </select>
                                    <span class="text-danger"><strong id="categoryId-error"></strong></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="productId">Products</label>
                                    <select class="custom-select form-control" id="productId" name="productId">
                                        <option selected disabled="disabled">Choose...</option>
                                    </select>
                                    <span class="text-danger"><strong id="productId-error"></strong></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" min="1" id="amount" name="amount">
                                    <span class="text-danger"><strong id="amount-error"></strong></span>
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
        let countriesData = null;
        let categoriesData = null;

        $("#nvaPages li.btn-primary").removeClass("btn-primary").find("a").removeClass("text-white");
        $("#customersLink").addClass("btn-primary").find("a").addClass("text-white");

        $(".messageFromServer").delay(3000).hide("fast");

        function sendAjax(resource, type, selectToFill, dfr, formData) {
            let baseUrl = '/panda/public/';
            $.ajax({
                url: baseUrl + resource,
                type: type,
                data: formData,
                success: function (data) {
                    selectToFill.find("option").remove();
                    selectToFill.append($("<option />").val(null).text("Choose..."));
                    for (var i in data) {
                        selectToFill.append($("<option />").val(data[i].id).text(data[i].name)).data("obj", data[i]);
                    }
                    if (typeof dfr !== "undefined") {
                        dfr.resolve("ok");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (typeof dfr !== "undefined") {
                        dfr.resolve("ok");
                    }
                }
            });
        }

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
            $("#amount").attr("max", obj["amountInStock"]).data("oldOrdered", obj["amount"]);
        }

        function checkValidateAmount(){
            var el = $("#amount");
            var val = parseInt(el.val());
            var max = parseInt(el.attr("max"));
            var oldOrdered = el.data("oldOrdered") || 0;
            if((val - oldOrdered) > max){
                $("#amount-error").html(`You can buy more maximum of ${max} units`);
                return false;
            }
            return true;
        }

        $("body").on("change", "#categoryId", function () {
            var categoryId = $(this).find(":selected").val();
            sendAjax("products/getProducts/" + categoryId, "GET", $("#productId"));
        });
        $("body").on("change", "#productId", function () {
            var data = $(this).data("obj");
            $("#amount").attr("max", data.amountInStock);
        });
        $("body").on("change", "#amount", function () {
            checkValidateAmount();
        });

        $('#orderModal').on('show.bs.modal', function (e) {
            var actionButton = $(e.relatedTarget);
            var actionType = actionButton.data('action');
            var modal = $(this);
            var dfr = new jQuery.Deferred();
            var dfr2 = new jQuery.Deferred();
            var dfr3 = new jQuery.Deferred();
            dfr.promise();
            dfr2.promise();
            dfr3.promise();
            $("#actionType").val(actionType);

            if (!countriesData) {
                sendAjax("countries/getCountries", "GET", $("#countryId"), dfr);
            } else {
                dfr.resolve("ok");
            }
            if (!categoriesData) {
                sendAjax("categories/getCategories", "GET", $("#categoryId"), dfr2);
            } else {
                dfr2.resolve("ok");
            }
            if (actionType == 'Edit' || actionType == 'Show') {
                var order = actionButton.data('order');
                sendAjax("products/getProducts/" + order.categoryId, "GET", $("#productId"), dfr3);
            }

            $.when(dfr, dfr2, dfr3).done(function (message) {
                resetErrorsFormMessage();

                modal.find('.modal-title').text(actionType + ' Customer');
                $("#submitForm").show();

                if (actionType == 'Edit' || actionType == 'Show') {

                    setData(order);

                    if (actionType == 'Show') {
                        $("#submitForm").hide();
                    }
                } else {
                    $("#id").val(null);
                    $("#orderForm").trigger("reset");
                }
            });
        });


        $('body').on('click', '#submitForm', function (e) {
            e.preventDefault();
            if(!checkValidateAmount()){
                return false;
            }
            var orderForm = $("#orderForm");
            var formData = orderForm.serialize();
            resetErrorsFormMessage();

            let url = '/panda/public/customers';

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function (data) {
                    $('#orderModal').modal('hide');
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
