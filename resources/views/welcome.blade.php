@extends('layouts.app')

@section('content')
    <h1>Welcome</h1>
    @empty($books)
        <div class="alert alert-danger" role="alert">
            <span>No books yet!</span>
        </div>
    @endempty
    <div class="row justify-content-center align-items-center g-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span id="card_title">
                                    {{ __('Books') }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">description</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($books as $book)
                                            @include('components.book-table')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- {!! $categorias->links() !!} --}}
                </div>
            </div>
        </div>
        {{-- @dump($books) --}}
        {{-- @dd(\Illuminate\Support\Facades\DB::getQueryLog()) --}}
    </div>
@endsection


<script type="text/javascript">
    // const showModal = () => {
    //     // const reservationModal = document.getElementById('reservationModal')
    //     const reservationModal = new bootstrap.Modal(document.getElementById('reservationModal'));

    //     reservationModal.show()
    // }
</script>
