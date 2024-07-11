<div class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('products.update') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="col-md-12">
                        <label for="name" class="form-label">Nom de produit</label>
                        <input type="text" class="form-control " id="name" name="name" value="">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="name" class="form-label">Section</label>
                        <select class="form-select form-select mb-3" aria-label=".form-select example" name="section_id"
                            id="section_id">
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="note" class="form-label">Desctiption</label>
                        <textarea class="form-control " id="description" name="description"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
