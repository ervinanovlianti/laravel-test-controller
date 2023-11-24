@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- alert success --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        {{-- alert error --}}
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($questions as $item)
                    <div class="card mb-4">
                        <div class="card-header">{{ $item->user_id }}</div>
                        <div class="card-body">
                            {{ $item->content }}
                        </div>
                        {{-- tambahkan jumlah vote --}}

                        <div class="card-footer">
                            {{-- Tambahkan tombol vote --}}
                            <form action="{{ route('questions.vote', $item->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Vote</button>
                            </form>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
