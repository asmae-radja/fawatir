@extends('master')
@section('content')
    <div class="iq-navbar-header" style="height: 150px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-header justify-content-between">
                        <div class="my-auto">
                            <div class="d-flex">
                                <h4 class="content-title mb-0 my-auto">Produits</h4><span class="mt-1 tx-13 mr-2 mb-0">/
                                    Tous les produits</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="../assets/images/dashboard/top-header.png" alt="header"
                class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
        </div>
    </div>
    @include('products.modals.create')
    @include('products.modals.update')
    @include('products.modals.delete')

    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title d-flex">
                            <h4 class="card-title m-0">Liste des produits</h4>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#createProductModal">
                                <i class="fas fa-plus"></i> Produit
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-left alert-danger alert-dismissible fade show mb-3" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session()->has('Add'))
                            <div class="alert alert-left alert-success alert-dismissible fade show mb-3" role="alert">
                                <span> {{ session()->get('Add') }}</span>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('edit'))
                            <div class="alert alert-left alert-success alert-dismissible fade show mb-3" role="alert">
                                <span> {{ session()->get('edit') }}</span>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('delete'))
                            <div class="alert alert-left alert-danger alert-dismissible fade show mb-3" role="alert">
                                <span> {{ session()->get('delete') }}</span>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>nom de produit</th>
                                        <th>section</th>
                                        <th>description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->section->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td> <button type="button" class="btn btn-outline-primary btn-sm"
                                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                    data-description="{{ $product->description }}"
                                                    data-section_id="{{ $product->section->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#updateProductModal" title="Modifier"><i
                                                        class='fas fa-edit'></i></button>
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                    data-bs-toggle="modal" data-bs-target="#deleteProductModal"
                                                    title="Modifier"><i class="fas fa-trash"></i></button>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#updateProductModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var name = button.data('name')
                var description = button.data('description')
                var section_id = button.data('section_id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #description').val(description);
                modal.find('.modal-body #section_id').val(section_id);
            })
        });

        $(document).ready(function() {
            $('#deleteProductModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var name = button.data('name')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
            })
        });
    </script>
@endsection
