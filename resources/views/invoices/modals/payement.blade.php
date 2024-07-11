<div class="modal fade" id="payementModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un montant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('invoices.payments')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="col-md-12">
                        <label for="invoice_num" class="form-label">Numéro de facture:</label>
                        <input type="text" class="form-control" id="invoice_num" name="invoice_num" value=""
                            disabled>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="date_payements" class="form-label">Date de paiement:</label>
                        <input type="date" class="form-control" id="date_payements" name="date_payements"
                            value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="montant_payements" class="form-label">Montant:</label>
                        <input type="text" class="form-control" id="montant_payements" name="montant_payements">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
