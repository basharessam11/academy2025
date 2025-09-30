@extends('teacher.layout.app')

@section('page', 'Create Product')

@section('contant')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="app-ecommerce">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card mb-12">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{!! __('admin.Lectures') !!}</h5>
                            </div>

                            <div class="card-body">
                                <div class="mb-3">
                                    <h5>{{ $lectures->name }}</h5>

                                    @foreach ($lectures->files as $key => $lecture)
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-12 mt-3">
                                                    <label class="mb-2">{{ $lecture->name }}</label>

                                                    {{-- YouTube Embed Video --}}
                                                    @if ($lecture->type == 1)
                                                        <iframe
                                                            src="https://www.youtube.com/embed/{{ getYouTubeID($lecture->url) }}?rel=0&showinfo=0&controls=1"
                                                            style="width: 100%; height:500px" frameborder="0"
                                                            allow="autoplay; encrypted-media" allowfullscreen
                                                            oncontextmenu="return false;">
                                                        </iframe>
                                                    @else
                                                        <div class="col-md-12 mt-3">
                                                            <a class="btn btn-success" href="{{ $lecture->url }}">

                                                                Download PDF

                                                            </a>

                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        // منع كلك يمين على iframe
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // منع أدوات المطور
        document.addEventListener('keydown', function(e) {
            if (
                e.key === 'F12' ||
                (e.ctrlKey && e.shiftKey && ['I', 'J', 'C'].includes(e.key.toUpperCase())) ||
                (e.ctrlKey && e.key.toUpperCase() === 'U')
            ) {
                e.preventDefault();
            }
        });
    </script>
@endsection

{{-- Helper function to extract YouTube ID --}}
@php
    function getYouTubeID($url)
    {
        preg_match(
            '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S+\/\S+\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            $url,
            $matches,
        );
        return $matches[1] ?? '';
    }
@endphp
