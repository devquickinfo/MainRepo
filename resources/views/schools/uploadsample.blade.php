@extends('frontend.layout.applayout')
@section('title', 'School Details')
@section('content')
<style>
    .sample-image-wrapper {
    width: 100%;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: #f5f5f5;
    border-radius: 5px;
    }

    .sample-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Card Sample</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Upload Sample</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card mt-4">
               <div class="card-header d-flex align-items-center">
                    <h3 class="card-title mb-0 badge badge-primary p-2">
                        Uploaded Card Samples
                    </h3>
                    @if(session('role') !== 'school')
                    <form action="{{ route('upload-sample.destroyAll') }}" method="POST" class="ml-auto mr-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"> All</i> 
                        </button>
                    </form>
                    <a href="{{ route('upload-samples.create') }}"
                    class="btn btn-primary ml-auto">
                        Add Samples
                    </a>
                    @else
                    <a href="{{ route('upload-samples.create') }}"
                    class="btn btn-primary ml-auto">
                        Upload Your Own Sample
                    </a>
                    <form action="{{ route('selected-samples.store') }}" method="POST" class="ml-auto">
                            @csrf
                            <input type="hidden"
                                name="sample_id"
                                id="selected-sample-id">

                            <button type="submit"
                                    class="btn btn-primary">
                                Save Samples
                            </button>
                    </form>
                    @endif
                </div>
              
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}

                                <button type="button"
                                        class="close"
                                        data-dismiss="alert"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                             @foreach($alls as $all)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-header bg-primary text-white d-flex align-items-center">
                                        <h3 class="card-title mb-0 flex-grow-1">
                                            @if(session('role') === 'school')
                                                <input type="radio" name="sample_id" value="{{ $all->id }}" class="sample-radio" {{ $selectedSample && $selectedSample->sample_id == $all->id ? 'checked' : '' }}>
                                            @else
                                                {{ $all->name }}
                                            @endif
                                        </h3>
                                        @if(session('role') !== 'school')
                                        <form action="{{ route('upload-samples.destroy', $all->id) }}"
                                            method="POST"
                                            class="ml-auto">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-2">
                                            {{ $all->caption }}
                                        </p>
                                        <div class="sample-image-wrapper">
                                            <img
                                                src="{{ asset('storage/' . $all->file_path) }}"
                                                alt="{{ $all->name }}"
                                                class="sample-image"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
            </div>
        </div>
    </section>
</div>
@endsection
