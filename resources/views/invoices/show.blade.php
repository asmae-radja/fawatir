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
                                    Détails de la facture</span>
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
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title"></h4>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a class="btn btn-primary" href="/invoices/{{ $invoice->id }}/generatePDF">
                                <i class="fas fa-print"></i> Imprimer
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mt-4">
                                <div class="col form-group">
                                    <label class="form-label" for="invoice_num">Numéro de facture:</label>
                                    <input type="text" class="form-control" id="invoice_num" name="invoice_num"
                                        value="{{ $invoice->invoice_num }}" disabled>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="invoice_date">Date de facture:</label>
                                    <input type="date" class="form-control" id="invoice_date" name="invoice_date"
                                        value="{{ $invoice->invoice_date }}" disabled>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="due_date">Date d'échéance:</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date"
                                        value="{{ $invoice->due_date }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="section_id">Section:</label>

                                    <input type="date" class="form-control" id="due_date" name="due_date"
                                        value="{{ $invoice->section->name }}" disabled>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="product">Produit:</label>
                                    <input type="text" class="form-control" id="product" name="product"
                                        value="{{ $invoice->product }}" disabled>
                                </div>

                                <div class="col form-group">
                                    <label class="form-label" for="Amount_collection">Montant collecté:</label>
                                    <input type="text" class="form-control" id="Amount_collection"
                                        name="Amount_collection" value="{{ $invoice->Amount_collection }}" disabled>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col form-group">
                                    <label class="form-label" for="Amount_Commission">Montant de commission:</label>
                                    <input type="text" class="form-control" id="Amount_Commission"
                                        name="Amount_Commission" value="{{ $invoice->Amount_Commission }}" disabled>
                                </div>

                                <div class="col form-group">
                                    <label class="form-label" for="discount">Remise:</label>
                                    <input type="text" class="form-control" id="discount" name="discount"
                                        value="{{ $invoice->discount }}" disabled>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="rate_vat">Pourcentage TVA:</label>
                                    <select class="form-select mb-3" aria-label="Section select" name="rate_vat"
                                        id="rate_vat" disabled>
                                        <option value="{{ $invoice->rate_vat }}" selected>{{ $invoice->rate_vat }}
                                        </option>
                                        <option value="5%">5%</option>
                                        <option value="10%">10%</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col form-group">
                                    <label class="form-label" for="value_vat">Montant de la TVA:</label>
                                    <input type="text" class="form-control" id="value_vat" name="value_vat"
                                        value="{{ $invoice->value_vat }}" readonly>
                                </div>

                                <div class="col form-group">
                                    <label class="form-label" for="total">Total TTC:</label>
                                    <input type="text" class="form-control" id="total" name="total"
                                        value="{{ $invoice->total }}" readonly>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="note">Notes:</label>
                                    <textarea class="form-control" rows="4" id="note" name="note" disabled>{{ $invoice->note }}</textarea>
                                </div>
                            </div>
                            <br>
                        </form>
                        <h6 class=" mt-5">Délais de paiement </h6>
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">date</th>
                                    <th scope="col">montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice->payements as $payement)
                                    <tr>
                                        <td>{{ $payement->date_payements }}</td>
                                        <td>{{ $payement->montant_payements }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
