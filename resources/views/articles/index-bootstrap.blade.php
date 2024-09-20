@extends('layouts/bootstrap/app')

@section('main')
<main>
  <div class="row g-5">
    <div class="col-md-12">
      
      @forelse($articles as $article)
      <article class="">
        <small class="text-success text-opacity-50 fw-bold"> {{ $article->category }}</small>
        <h2 class="mb-2 fw-bold">{{ $article->title }}</h2>
        <p class="">
          <i class="small bi bi-clock text-info text-opacity-70"></i> <span class="small text-muted">{{ $article->created_at->diffForHumans() }}</span>
          <i class="small bi bi-person text-info text-opacity-70 ms-2"></i> <a href="#" class="small  text-muted text-body text-decoration-none me-2">{{ $article->author->name }}</a>
          @if($article->tags && is_array($article->tags ) && !empty($article->tags))
              @foreach($article->tags as $tag)
              <i class="small bi bi-tag text-info text-opacity-70 "></i> <span class="small  text-muted">{{ $tag}} </span>
              @endforeach
          @endif
        </p>

        <hr>

        <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>
      
      </article>
      @empty
      @endforelse

      @if($articles->hasPages())
      <div style="width:50%;">
        {{$articles->links()}}
      </div>
      @endif

    </div>
  </div>
</main>
@endsection

@section('footer')
<footer class="pt-5 my-5 text-muted border-top">
  <!-- Created by the Bootstrap team &middot; &copy; 2022 -->
</footer>
@endsection