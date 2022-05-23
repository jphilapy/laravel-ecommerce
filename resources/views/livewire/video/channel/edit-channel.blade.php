<div>
    <form wire:submit.prevent="update">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" cols="30" rows="4" class="form-control"></textarea>
        </div>

        <div class="form-group">
           <submit type="submit" class="btn btn-success">Update</submit>
        </div>
    </form>
</div>
