@extends('master')
@section('title')
    Factures
@endsection
@section('content')
    <div class="iq-navbar-header" style="height: 100px;">
    </div>
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title">
                                Modifier la facture
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="email">Numéro de facture:</label>
                                    <input type="text" class="form-control" id="invoice_num" name="invoice_num" value="{{ $invoice->invoice_num }}">
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Date de facture:</label>
                                    <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="{{ $invoice->invoice_date }}">
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Date d'échéance:</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $invoice->due_date }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="section_id">Section:</label>
                                    <select class="form-select mb-3" aria-label="Section select" name="section_id" id="section_id">
                                        <option value="{{ $invoice->section_id }}" selected>{{ $invoice->section->name }}</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="product">Produit:</label>
                                    <select class="form-select mb-3" aria-label="Product select" name="product" id="product" value="{{ $invoice->product }}">
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Montant collecté:</label>
                                    <input type="text" class="form-control" id="Amount_collection" name="Amount_collection" value="{{ $invoice->Amount_collection }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Montant de commission:</label>
                                    <input type="text" class="form-control" id="Amount_Commission" name="Amount_Commission" value="{{ $invoice->Amount_Commission }}">
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Remise:</label>
                                    <input type="text" class="form-control" id="discount" name="discount" value="{{ $invoice->discount }}">
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="rate_vat">Pourcentage TVA:</label>
                                    <select class="form-select mb-3" aria-label="Section select" name="rate_vat" id="rate_vat" onchange="myFunction()">
                                        <option value="{{ $invoice->rate_vat }}" selected></option>
                                        <option value="5%">5%</option>
                                        <option value="10%">10%</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Montant de la TVA:</label>
                                    <input type="text" class="form-control" id="value_vat" name="value_vat" value="{{ $invoice->value_vat }}" readonly>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Total TTC:</label>
                                    <input type="text" class="form-control" id="total" name="total" value="{{ $invoice->total }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Notes:</label>
                                    <textarea class="form-control" rows="4" id="note" name="note">{{ $invoice->note }}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary me-2">Modifier</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#section_id').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "/section/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' +
                                    value + '</option>');
                            });
                        },
                        error: function() {
                            console.log('AJAX load did not work');
                        }
                    });
                } else {
                    console.log('Section ID is empty');
                }
            });
        });
    </script>
    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("discount").value);
            var Rate_VAT = parseFloat(document.getElementById("rate_vat").value);
            var Value_VAT = parseFloat(document.getElementById("value_vat").value);
            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('Veuillez saisir le montant de la commission');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("value_vat").value = sumq;

                document.getElementById("total").value = sumt;

            }

        }
    </script>
@endsection
