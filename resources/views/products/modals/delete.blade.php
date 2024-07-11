<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supprimer Produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('products.destroy') }}" method="POST">
                {{ method_field('delete') }}
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="col-md-12">
                        <label for="name" class="form-label">Nom de produit</label>
                        <input type="text" class="form-control " id="name" name="name" value=""
                            disabled>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>
