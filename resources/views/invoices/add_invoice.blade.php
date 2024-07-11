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
                                    Ajouter une facture</span>
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
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title"></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('invoices.store') }}" method="Post">
                            @csrf
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="email">Numéro de facture:</label>
                                    <input type="text" class="form-control" id="invoice_num" name="invoice_num">
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Date de facture:</label>
                                    <input type="date" class="form-control" id="invoice_date" name="invoice_date">
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Date d'échéance:</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="section_id">Section:</label>
                                    <select class="form-select mb-3" aria-label="Section select" name="section_id"
                                        id="section_id">
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="product">Produit:</label>
                                    <select class="form-select mb-3" aria-label="Product select" name="product"
                                        id="product">
                                    </select>
                                </div>

                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Montant collecté:</label>
                                    <input type="text" class="form-control" id="Amount_collection"
                                        name="Amount_collection">
                                </div>
                            </div>
                            <div class="row">

                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Montant de commission:</label>
                                    <input type="text" class="form-control" id="Amount_Commission"
                                        name="Amount_Commission">
                                </div>

                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Remise:</label>
                                    <input type="text" class="form-control" id="discount" name="discount">
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="rate_vat">Pourcentage TVA:</label>
                                    <select class="form-select mb-3" aria-label="Section select" name="rate_vat"
                                        id="rate_vat" onchange="myFunction()">
                                        <option value="" selected disabled>Déterminer le taux de TVA</option>
                                        <option value="5%">5%</option>
                                        <option value="10%">10%</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Montant de la TVA:</label>
                                    <input type="text" class="form-control" id="value_vat" name="value_vat" readonly>
                                </div>

                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Total TTC:</label>
                                    <input type="text" class="form-control" id="total" name="total" readonly>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="pwd">Notes:</label>
                                    <textarea class="form-control" rows="4" id="note" name="note"></textarea>
                                </div>
                            </div>
                            <br>
                         <!--    <div class="row">
                                <div class="col form-group">
                                    <label class="form-label " for="pwd">Les documents:</label>
                                    <input type="file" name="pic" class="dropify mr-4"
                                        accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                </div>
                            </div>
                        -->
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary me-2">Ajouter</button>
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
                                $('select[name="product"]').append('<option value="' + value + '">' +
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
//console.log("Discount:"Discount.value);
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
