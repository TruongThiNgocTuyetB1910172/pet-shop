@extends('client.layouts.app')

@section('content')
    <section class="sub-header shop-layout-1">
        <img class="rellax bg-overlay" src="client/images/sub-header/01.jpg" alt="">
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">Mua sắm </h3>
    </section>
    <section class="box-sm">
        <div class="container">
            <div class="heading-wrapper text-center">
                <h3 class="heading-style-2">Dịch vụ của chúng tôi</h3>
            </div>

            <div class="row main">
                <div class="row product-grid-equal-height-wrapper product-equal-height-4-columns flex multi-row">
                    @foreach($services as $service)
                        <figure class="item" style="margin-top: 30px">
                            <div class="product product-style-1">
                                <div class="img-wrapper">
                                    <a href="#">
                                        <img style="height:280px"  src="{{( 'storage/'.$service->image) }}"  alt="product thumbnail" />
                                    </a>
                                    <div class="product-control-wrapper bottom-right">
                                        <div class="wrapper-control-item">
                                            <a class="js-quick-view" href="#" type="button" data-toggle="modal" data-target="#quick-view-product">
                                                <span class="lnr lnr-eye"></span>
                                            </a>
                                        </div>
                                        <div class="wrapper-control-item item-wish-list">
                                            <a class="js-wish-list js-notify-add-wish-list" href="#">
                                                <span class="lnr lnr-heart"></span>
                                            </a>
                                        </div>

                                        <div class="wrapper-control-item item-add-cart js-action-add-cart">
                                            <a class="animate-icon-cart" href="#">
                                                <span class="lnr lnr-cart"></span>
                                            </a>
                                            <svg x="0px" y="0px" width="36px" height="32px" viewbox="0 0 36 32">
                                                <path stroke-dasharray="19.79 19.79" fill="none" ,="," stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <figcaption class="desc text-center" style="background-color: #9abf65">
                                    <h3>
                                        <a class="product-name" href="product-detail.html">{{$service->name}}</a>
                                    </h3>

                                </figcaption>
                            </div>
                        </figure>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        {{$services->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
