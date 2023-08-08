@extends('admin.admin')
@section('con')
<style>
.form-error{
    color: red;
}
</style>
    <form action="{{ route('home.create','job') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="job_name" placeholder="Your Job Name">
            @error('job_name')
                <div class="form-error">
                    {{ $message }}
                </div>
            @enderror
            <label for="floatingInput">Job Name</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="job_location" placeholder="Job Name">
            @error('job_location')
                <div class="form-error">
                    {{ $message }}
                </div>
            @enderror
            <label for="floatingPassword">Job Location</label><br>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="time">
            <label class="form-check-label" for="flexRadioDefault1">
              Fill time
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="time">
            <label class="form-check-label" for="flexRadioDefault2">
              Part time
            </label>
          </div>
          <br>
        <button type="submit" class="btn btn-success px-5"><i class="fas fa-save"></i>
            Save</button>
    </form>
@endsection
