<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.account.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createLabel">Account Insertion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                        <label for="type" class="form-label">Account type:</label>
                        <select name="type" id="type" class="form-select">
                        <option value="judge">Judge</option>
                        <option value="user">User</option>
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