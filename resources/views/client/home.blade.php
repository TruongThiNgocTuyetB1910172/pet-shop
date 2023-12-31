@extends('client.layouts.app')

@section('content')
    <div class="banner-slider-2 rev_slider" id="slider-2">
        <ul>
            @foreach($banners as $banner)
                @if($banner->status ===1)
                    <li data-transition="fade">
                        <img src="{{ asset( 'storage/'.$banner->image) }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10">
                        <div class="tp-caption" data-x="center" data-y="center" data-voffset="['-100','-100','-140','-140']" data-transform_in="y:-80px;opacity:0;s:800;e:easeInOutCubic;" data-transform_out="y:-80px;opacity:0;s:300;" data-start="1000">
                            <h2>Cửa hàng đồ dùng cho pet</h2>
                        </div>
                        <div class="tp-caption" data-x="center" data-y="center" data-voffset="['20','20','40','40']" data-width="['650','550','480','320']" data-whitespace="normal" data-transform_in="y:80px;opacity:0;s:800;e:easeInOutCubic;" data-transform_out="y:80px;opacity:0;s:300;" data-start="1400">
                            <p>Nunc suscipit elit ligula, ut porttitor justo rutrum eget. Proin et diam fringilla, elementum nisi volutpat, eleifend eros. Nullam venenatis nunc nisl, elementum euismod dui imperdiet id.</p>
                        </div>
                        <div class="tp-caption" data-x="center" data-y="center" data-voffset="['120','120','200','200']" data-transform_in="y:100px;opacity:0;s:800;e:easeInOutCubic;" data-transform_out="y:200px;opacity:0;s:300;" data-start="1600">
                            <a class="btn btn-brand pill" href="product-list.html">SHOP NOW</a>
                        </div>
                    </li>
                @endif

            @endforeach
        </ul>
    </div>

    <section class="boxed-sm">
        <div class="container">
            <div class="heading-wrapper text-center">
                <h3 class="heading">Our Blog</h3>
            </div>
            <div class="row blog-v reverse">
                <div class="col-md-12">
                    <div class="post">
                        <div class="video-wrapper js-set-bg-blog-thumb">
                            <a href="blog-detail.html">
                                <img src="https://images.pexels.com/photos/1693443/pexels-photo-1693443.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="blog-thumb" />
                            </a>
                        </div>
                        <div class="desc">
                            <h3>
                                <a href="blog-detail.html">Lịch sử ra đời của Pet Shop</a>
                            </h3>
                            <p class="meta">
                                <span class="time">March 05, 2017</span>
                            </p>
                            <p class="sapo">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce malesuada varius enim, sit amet facilisis arcu fermentum lacinia. Sed varius pharetra enim nec tempor.</p>
                            <a class="read-more" href="blog-detail.html">READ MORE
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="post">
                        <div class="video-wrapper js-set-bg-blog-thumb">
                            <a href="blog-detail.html">
                                <img src="https://images.pexels.com/photos/17050293/pexels-photo-17050293/free-photo-of-thien-nhien-hoa-mua-he-v-n.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="blog-thumb" />
                            </a>
                        </div>
                        <div class="desc">
                            <h3>
                                <a href="blog-detail.html">Hướng phát triển của Pet Shop</a>
                            </h3>
                            <p class="meta">
                                <span class="time">March 12, 2017</span>
                            </p>
                            <p class="sapo">Urabitur vel congue tellus. Pellentesque velit ligula, lobortis eget volutpat vel, lacinia sit amet libero. Sed sed ultrices magna. Donec volutpat nunc sed est eleifend scelerisque. Aliquam erat volutpat.</p>
                            <a class="read-more" href="blog-detail.html">READ MORE
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="box-sm">
        <div class="container">
            <div class="heading-wrapper text-center">
                <h3 class="heading-style-2">Sản phẩm nỗi bật </h3>
            </div>
            <div class="row main">
                <div class="row product-grid-equal-height-wrapper product-equal-height-4-columns flex multi-row">
                    @foreach($products as $product)
                        @if($product->feature === 1)
                            <figure class="item" style="margin-top: 30px">
                                <div class="product product-style-1">
                                    <div class="img-wrapper">
                                        <a href="{{ route('product-list.detail', ['id' => $product->id]) }}">
                                            <img style="height:280px"  src="{{ asset('storage/' . $product->image) }}"  alt="product thumbnail" />
                                        </a>
                                    </div>
                                    <figcaption class="desc text-center">
                                        <h3>
                                            <a class="product-name"  href="{{ route('product-list.detail', ['id' => $product->id]) }}">{{$product->name}}</a>
                                        </h3>
                                        <span class="price">{{ CurrencyHelper::format($product->selling_price) }}</span>
                                    </figcaption>
                                </div>
                            </figure>
                        @endif
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
