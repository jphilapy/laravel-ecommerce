<div>
    <form wire:submit.prevent="update">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" wire:model="channel.name">
        </div>
        @error('channel.name')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug" class="form-control" wire:model="channel.slug">
        </div>
        @error('channel.slug')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" cols="30" rows="4" class="form-control" wire:model="channel.description"></textarea>
        </div>
        @error('channel.description')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
        <div class="form-group">
           <button type="submit" class="btn btn-success">Update</button>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
    </form>
</div>
