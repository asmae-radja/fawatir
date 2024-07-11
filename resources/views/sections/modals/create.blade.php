<div class="modal fade" id="createSectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouvelle section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('sections.store') }}" method="Post">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="name" class="form-label">Nom de section</label>
                        <input type="text" class="form-control " id="name" name="name" value="">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="note" class="form-label">Notes</label>
                        <textarea class="form-control " id="note" name="note"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
