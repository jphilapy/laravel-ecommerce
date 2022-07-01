<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        <form wire:submit.prevent="update">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" wire:model="video.title">
                            </div>
                            @error('video.title')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" cols="30" rows="4" class="form-control"
                                          wire:model="video.description"></textarea>
                            </div>
                            @error('video.description')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                            <div class="form-group">
                                <label for="visibility">Visibility</label>
                                <select wire:model="video.visibility" class="form-control">
                                    <option value="private">Private</option>
                                    <option value="public">Public</option>
                                    <option value="unlisted">Unlisted</option>
                                </select>
                            </div>

                            @error('video.visibility')
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
                </div>
            </div>
        </div>
    </div>
</div>
