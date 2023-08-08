@extends('admin.admin')
@section('con')
<style>
.form-error{
    color: red;
}
</style>
    <form action="{{ route('home.create','philosphie') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="title" placeholder="Title">
            @error('title')
                <div class="form-error">
                    {{ $message }}
                </div>
            @enderror
            <label for="floatingInput">Title</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="description" placeholder="Description">
            @error('description')
                <div class="form-error">
                    {{ $message }}
                </div>
            @enderror
            <label for="floatingPassword">Description</label><br>
        </div>
        <div class="form-floating">
            <input type="file" class="form-control" name="image"><br>
            @error('image')
                <div class="form-error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success px-5"><i class="fas fa-save"></i>
            Save</button>
    </form>
@endsection
