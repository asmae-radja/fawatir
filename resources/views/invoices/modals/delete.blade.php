<div class="modal fade" id="deleteInvoiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supprimer facture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('invoice.destroy') }}" method="POST">
                {{ method_field('delete') }}
                @csrf
                <div class="modal-body">
                    <input type="text" name="id" id="id" value="">
                    <div class="col-md-12">
                        <label for="invoice_num" class="form-label">Numéro de facture:</label>
                        <input type="text" class="form-control" id="invoice_num" name="invoice_num" value=""
                            disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>
