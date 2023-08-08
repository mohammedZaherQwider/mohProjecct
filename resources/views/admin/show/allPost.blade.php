@extends('admin.admin')
@section('con')

<h2>All Posts</h2>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Title</th>
        <th>Created At</th>
        <th>Description</th>
    </tr>

    @php
        $index = ($posts->currentPage() - 1) * $posts->perPage() + 1;
    @endphp

    @forelse ($posts as $post)
        <tr id="row_{{ $post->id }}">
            <td>{{ $index++ }}</td>
            <td><img width="60" src="{{ asset($post->image) }}" alt=""></td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->created_at ? $post->created_at->diffForHumans() : '' }}</td>
            <td>{{ $post->description }}</td>
            <td>
                <a
                    onclick="editProduct(event)"
                    data-bs-toggle="modal"
                    data-bs-target="#EditProduct"
                    data-name="{{ $post->name }}"
                    data-price="{{ $post->price }}"
                    data-image="{{ asset($post->image) }}"
                    data-content="{{ $post->content }}"
                    {{-- href="{{ route('products.update', $expert->id) }}" --}}
                    class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i>
                </a>

                <form class="d-inline" method="POST"
                action="{{ route('home.deletepost',$post->id) }}">
                    @csrf
                    @method('delete')
                    <button type="button" onclick="deleteItem(event)" class="btn btn-danger btn-sm"><i
                            class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">No data found</td>
        </tr>
    @endforelse
</table>
<br>
{{ $posts->links() }}
<script>
    function deleteItem(e) {
        let url = e.target.closest('form').action
        let row = e.target.closest('tr')
        console.log(url);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, deleted it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(url, {
                        _method: 'delete'
                    })
                    .then(res => {
                        row.remove()
                    })
            }
        })
    }
</script>
@endsection
