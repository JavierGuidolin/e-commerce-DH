@extends('layouts.plantilla')

 @section('titulo')
   Inicio
 @endsection

 @section('styles')
    <link rel="stylesheet" href="/css/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="/css/index.css">
 @endsection

 @section('principal')

 <main>

  <!-- Hero Section -->
  <section class="__hero-index col-12">

      <div class="__hero-data pl-4 pt-2 h-100">
          <p class="text-uppercase animated fadeInDown delay-1s">a sofa,</p>
          <p class="text-uppercase animated fadeInDown delay-2s">a good book,</p>
          <p class="text-uppercase animated fadeInDown delay-3s">and you.</p>
      </div>

  </section>
  <!-- End Hero Section -->

  <!-- Welcome Section -->
  <section class="__welcome">

      <div class="container py-5">

          <div class="row">
              <div class="col-12 col-md-10 offset-md-1 mb-5">
                  <h1 class="text-center font-weight-bold pt-3">WELCOME TO BOOKSTORE</h1>
                  <h2 class="text-center pt-3">
                      " Lorem ipsum dolor sit amet consectetur, <b>adipisicing elit. Iure molestiae quae est
                          repudiandae
                          eum!
                          Facere error beatae praesentium similique</b> fuga eos illum deleniti consectetur?
                      Deserunt."
                  </h2>
              </div>
          </div>


          <div class="row">


            <div class="offset-1 col-10 col-md-4 offset-md-0 ">
                <div class="text-center __welcome-options">
                  <i class="fas fa-book p-3 animated pulse infinite"></i>
                  <p>
                      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, sapiente. Facere
                      omnis error accusamus unde modi corporis laborum. Accusamus, sequi.
                  </p>
                </div>
            </div>


              <div class="offset-1 col-10 col-md-4 offset-md-0">
                <div class="text-center __welcome-options">
                    <i class="fas fa-pen-alt p-3 animated pulse infinite"></i>
                    <p class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam dolor doloremque
                        laboriosam, delectus similique assumenda officia repellat fugiat.
                    </p>
                </div>
              </div>

              <div class="offset-1 col-10 col-md-4 offset-md-0">
                <div class="text-center  __welcome-options">
                    <i class="fas fa-glasses p-3 animated pulse infinite"></i>
                    <p class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere voluptate illum
                        dolores quibusdam sit.
                    </p>
                </div>
              </div>

          </div>

      </div>

    </div>

  </section>
  <!-- End Welcome Section -->

  <!-- Bestsellers Section -->
  <section class="__betsellers">

      <div class="pt-4 pb-4">
          <h2 class="text-center">Bestsellers</h2>
      </div>

      <div class="owl-carousel owl-theme">

        @forelse ($bestsellers as $best)

            <div class="item">
                <div class="__cover-bestseller">
                    <img class="w-75 mx-auto " src="{{$best->cover}}" alt="{{$best->title}}">
                    <div class="__options pb-2">

                        <a class="__options-add-to-cart mr-1 mb-1" href="#">
                            <i class="fas fa-shopping-bag"></i>
                            <span>BUY</span>
                        </a>
                        <a class="__options-add-to-fav mr-1" href="#">
                            <i class="far fa-heart"></i>
                        </a>

                    </div>
                </div>
                <div class="pt-3">
                    <h3 class="text-center font-weight-bold">
                        <a href="/libros/{{$best->id}}"> {{$best->title}} </a>
                    </h3>
                    <h3 class="text-center">$ {{$best->price}}</h3>
                </div>
            </div>
            
        @empty
            <p>No hay libros disponibles</p>
        @endforelse

          

      </div>

  </section>
  <!-- End Bestsellers Section -->

  <!-- New Books Section -->
  <section class="__betsellers">

      <div class="pt-4 pb-4">
          <h2 class="text-center">Nuevos</h2>
      </div>

      <div class="owl-carousel owl-theme">

        @forelse ($news as $new)

        <div class="item">
            <div class="__cover-bestseller">
                <img class="w-75 mx-auto " src="{{$new->cover}}" alt="{{$new->title}}">
                <div class="__options pb-2">

                    <a class="__options-add-to-cart mr-1 mb-1" href="#">
                        <i class="fas fa-shopping-bag"></i>
                        <span>BUY</span>
                    </a>
                    <a class="__options-add-to-fav mr-1" href="#">
                        <i class="far fa-heart"></i>
                    </a>

                </div>
            </div>
            <div class="pt-3">
                <h3 class="text-center font-weight-bold">
                    <a href="/libros/{{$best->id}}"> {{$new->title}} </a>
                </h3>
                <h3 class="text-center">$ {{$new->price}}</h3>
            </div>
        </div>
        
    @empty
        <p>No hay libros disponibles</p>
    @endforelse

      </div>

  </section>
  <!-- End Books Section -->

  <!-- Random Cite Section -->
  <section class="__random-cite mt-5 ">
      <div class="h-100">
          <div class="h-100 text-light d-flex justify-content-center align-items-center font">
              <blockquote class=" blockquote text-center col-md-10 col-lg-8">
                  <p class="mb-0 font-weight-bold font-italic">Lorem ipsum dolor sit amet, consectetur adipiscing
                      elit. Integer posuere erat a
                      ante.</p>
                  <footer class="blockquote-footer text-light">Someone famous in <cite title="Source Title">Source
                          Title</cite></footer>
              </blockquote>
          </div>
      </div>
  </section>
  <!-- End Random Cite Section -->


@endsection


@section('scripts')

<script src="/js/owl.carousel.min.js"></script>
<script src="/js/manageOwlCarousel.js"></script>

@endsection
