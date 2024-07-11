@extends('master')
@section('title')
    Factures
@endsection
@section('content')
    <div class="iq-navbar-header" style="height: 150px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-header justify-content-between">
                        <div class="my-auto">
                            <div class="d-flex">
                                <h4 class="content-title mb-0 my-auto">Factures</h4><span class="mt-1 tx-13 mr-2 mb-0">/
                                    Toutes les factures</span>
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

    @include('invoices.modals.delete')
    @include('invoices.modals.payement')

    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title d-flex">
                            <h4 class="card-title m-0">Liste des factures</h4>
                        </div>
                        <div>
                            <a href="/invoices/create" class="btn btn-outline-primary">
                                <i class="fas fa-plus"></i> Facture
                            </a>
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
                                        <th>Numero</th>
                                        <th>Date de facture</th>
                                        <th>Date d'échéance</th>
                                        <th>Produit</th>
                                        <th>Section</th>
                                        <!--
                                                                                                <th>Remise</th>
                                                                                                <th>valeur de vat</th>
                                                                                                <th>pourcentage de vat</th>-->
                                        <th>total</th>
                                        <th>status</th>
                                        <th>actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->invoice_num }}</td>
                                            <td>{{ $invoice->invoice_date }}</td>
                                            <td>{{ $invoice->due_date }}</td>
                                            <td>{{ $invoice->section->name }}</td>
                                            <td>{{ $invoice->product }}</td>
                                            <td>{{ $invoice->total }}</td>
                                            <td>
                                                @if ($invoice->value_Status == 1)
                                                    <span class="text-success">{{ $invoice->status }}</span>
                                                @elseif($invoice->value_Status == 2)
                                                    <span class="text-danger">{{ $invoice->status }}</span>
                                                @else
                                                    <span class="text-warning">{{ $invoice->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="/invoices/{{ $invoice->id }}" type="button"
                                                    class="btn btn-outline-primary btn-sm" title="Modifier"><i
                                                        class='fas fa-eye'></i></a>
                                                <a type="button" class="btn btn-outline-warning btn-sm"
                                                    href="/invoices/edit/{{ $invoice->id }}" title="Modifier"><i
                                                        class='fas fa-edit'></i></a>
                                                <a type="button" class="btn btn-outline-success btn-sm"
                                                    data-id="{{ $invoice->id }}"
                                                    data-invoice_num="{{ $invoice->invoice_num }}" data-bs-toggle="modal"
                                                    data-bs-target="#payementModal" title="supprimer"><i
                                                        class="fas fa-dollar-sign"></i></a>

                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-id="{{ $invoice->id }}"
                                                    data-invoice_num="{{ $invoice->invoice_num }}" data-bs-toggle="modal"
                                                    data-bs-target="#deleteInvoiceModal" title="supprimer"><i
                                                        class="fas fa-trash"></i></button>
                                            </td>
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
            $('#deleteInvoiceModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id'); // Extract info from data-* attributes
                var invoice_num = button.data('invoice_num'); // Use data-name instead of data-invoice_num

                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #invoice_num').val(invoice_num);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#payementModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id'); // Extract info from data-* attributes
                var invoice_num = button.data('invoice_num'); // Use data-name instead of data-invoice_num

                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #invoice_num').val(invoice_num);
            });
        });
    </script>
@endsection
