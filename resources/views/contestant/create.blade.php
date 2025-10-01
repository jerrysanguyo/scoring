<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.contestant.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createLabel">Contestant Insertion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <label for="name" class="form-label">Contestant name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                        <label for="barangay" class="form-label">Barangay:</label>
                        <select name="barangay" id="barangay" class="form-select">
                            <option value="">Choose ...</option>
                            @foreach($barangays as $barangay)
                                <option value="{{ $barangay }}">{{ $barangay }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label for="no_of_members">No. of members:</label>
                        <input type="number" name="no_of_members" id="no_of_members" class="form-control">
                    </div>
                    <div class="col-lg-12">
                        <label for="focal_person">Focal person:</label>
                        <input type="text" name="focal_person" id="focal_person" class="form-control">
                    </div>
                    <div class="col-lg-12">
                        <label for="folk_dance_id">Category:</label>
                        <select name="folk_dance_id" id="folk_dance_id" class="form-select">
                            <option value="">Choose ...</option>
                            @foreach($getAllCategory as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label for="dance_id">Type:</label>
                        <select name="dance_id" id="dance_id" class="form-select">
                            <option value="">Choose ...</option>
                            @foreach($getAllDance as $dance)
                            <option value="{{ $dance->id }}">{{ $dance->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Add" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>