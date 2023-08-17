@extends('client.layouts.app')

@section('content')
    <section class="sub-header shop-detail-1">
        <img class="rellax bg-overlay" src="images/sub-header/01.jpg" alt="" />
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">Chi tiết sản phẩm</h3>
    </section>
    <hr>
    <section class="boxed-sm">
        <div class="container">
            <div class="row product-detail">
                <div class="row main">
                    <div class="col-md-6">
                        <div class="woocommerce-product-gallery">
                            <div class="main-carousel">
                                @foreach($product->productImages as $key => $image)
                                    <div class="item">
                                        <img
                                            class="img-responsive"
                                            src="{{ asset($image->image) }}"
                                            alt="product thumbnail"
                                        />
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <div class="thumbnail-carousel ">
                                @foreach($product->productImages as $key => $image)
                                    <div class="item">
                                        <img
                                            class="img-responsive"
                                            src="{{ asset($image->image) }}"
                                            alt="{{ $product->name }}"
                                        />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="summary">
                            <div class="desc">
                                <div class="header-desc">
                                    <h2 class="product-title">{{$product->name}}</h2>
                                    <br>
                                    <span style="font-size: 20px" class="price">Giá: {{ CurrencyHelper::format($product->selling_price) }}</span>
                                </div>
                                <br>
                                <div class="product-meta">
                                    <p class="posted-in">
                                        Danh mục:
                                        <a href="#" rel="tag">{{$product->category->name}}</a>
                                    </p>
                                    <p class="tagged-as">
                                        Tags: <a href="#" rel="tag">Natural</a>,
                                        <a href="#" rel="tag">Organic</a>,
                                        <a href="#" rel="tag">Health</a>,
                                        <a href="#" rel="tag">Green</a>,
                                        <a href="#" rel="tag">Vegetable</a>
                                    </p>
                                    <p class="id">
                                        ID:
                                        <a href="#"> {{$product->sku}}</a>
                                    </p>
                                </div>
                                <br>
                                <div class="widget-social align-left">
                                    <ul>
                                        <li>
                                            <a
                                                class="facebook"
                                                data-toggle="tooltip"
                                                title="Facebook"
                                                href="https://www.facebook.com/authemes"
                                            >
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="pinterest"
                                                data-toggle="tooltip"
                                                title="Pinterest"
                                                href="https://www.pinterest.com/authemes"
                                            >
                                                <i class="fa fa-pinterest"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="twitter"
                                                data-toggle="tooltip"
                                                title="Twitter"
                                                href="https://www.twitter.com/authemes"
                                            >
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="google-plus"
                                                data-toggle="tooltip"
                                                title="Google Plus"
                                                href="https://plus.google.com/authemes"
                                            >
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="instagram"
                                                data-toggle="tooltip"
                                                title="Instagram"
                                                href="https://instagram.com/authemes"
                                            >
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <br>
                                <br>
                                <div class="footer-desc">
                                    <form class="cart" action="{{ route('cart.addToCart', ['id' => $product->id]) }}" method="POST" id="addCart">
                                        @csrf
                                        <div class="quantity buttons-added " style="margin-right: 20px">
                                            <input class="minus" value="-" onclick="decQuantity" type="button" />
                                            <input
                                                class="input-text qty text"
                                                step="1"
                                                min="1"
                                                max=""
                                                name="qty"
                                                value="1"
                                                title="Qty"
                                                size="4"
                                                pattern="[0-9]*"
                                                inputmode="numeric"
                                                id="qty"

                                            />
                                            <input class="plus" value="+" onclick="incQuantity"  type="button"  />
                                        </div>
                                        <button class="btn btn-brand no-radius" style="margin-right: 20px" type="submit">
                                            <a href="{{ route('cart.addToCart', ['id' => $product->id]) }}" class="primary-btn" onclick="event.preventDefault(); document.getElementById('addcart').submit();">ADD TO CART</a>
                                        </button>
                                        <button
                                            class="btn btn-wishlist btn-brand-ghost no-radius"
                                        >
                                            <i class="fa fa-heart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <div class="woocommerce-tabs">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="tabs tab-style-1" role="tablist">
                                            <li class="active" role="presentation">
                                                <a
                                                    href="#Description"
                                                    aria-controls="Description"
                                                    role="tab"
                                                    data-toggle="tab"
                                                >Description
                                                    <i class="more-less fa fa-angle-down"></i>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a
                                                    href="#Additional-Information"
                                                    aria-controls="Additional-Information"
                                                    role="tab"
                                                    data-toggle="tab"
                                                >Additional Information
                                                    <i class="more-less fa fa-angle-down"></i>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a
                                                    href="#Review"
                                                    aria-controls="Review"
                                                    role="tab"
                                                    data-toggle="tab"
                                                >Review (2)
                                                    <i class="more-less fa fa-angle-down"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="tab-content tab-content-style-1">
                                            <div
                                                class="tab-pane fade in active"
                                                id="Description"
                                                role="tabpanel"
                                            >
                                                <h3 class="title-tab">Description</h3>
                                                <ul class="arrow">
                                                    <li>Using energy and natural resources responsibly</li>
                                                    <li>Maintaining biodiversity</li>
                                                    <li>Respecting regional environmental balances</li>
                                                    <li>Enhancing soil fertility</li>
                                                    <li>Preserving water quality</li>
                                                    <li>Promoting animal health and welfare</li>
                                                    <li>Catering for animals' specific needs</li>
                                                </ul>
                                            </div>
                                            <div
                                                class="tab-pane fade"
                                                id="Additional-Information"
                                                role="tabpanel"
                                            >
                                                <h3 class="title-tab">Additional Information</h3>
                                                <table
                                                    class="shop_attributes table table-striped table-bordered"
                                                >
                                                    <tbody>
                                                    <tr>
                                                        <th>Country</th>
                                                        <td>
                                                            <p>England, London</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Weight</th>
                                                        <td>
                                                            <p>3.5 Kg</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Next Day Delivery Available</th>
                                                        <td>
                                                            <p>Yes</p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="Review" role="tabpanel">
                                                <h3 class="title-tab">2 reviews for Salad Organic Shop</h3>
                                                <ol class="comment-list">
                                                    <li>
                                                        <div class="the-comment">
                                                            <div class="avatar">
                                                                <img
                                                                    class="avatar"
                                                                    alt="avatar"
                                                                    src="images/comment/01.png"
                                                                />
                                                            </div>
                                                            <div class="comment-box">
                                                                <div class="comment-author meta">
                                                                    <p class="author">Mark Hunt</p>
                                                                    <p class="time">15 March 2017</p>
                                                                </div>
                                                                <div class="comment-text">
                                                                    <p>
                                                                        This is a test … Quisque ligulas ipsum, euismod
                                                                        atras vulputate iltricies etri elit.This is a
                                                                        test …
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="the-comment">
                                                            <div class="avatar">
                                                                <img
                                                                    class="avatar"
                                                                    alt="avatar"
                                                                    src="images/comment/02.png"
                                                                />
                                                            </div>
                                                            <div class="comment-box">
                                                                <div class="comment-author meta">
                                                                    <p class="author">Lori Peters</p>
                                                                    <p class="time">16 March 2017</p>
                                                                </div>
                                                                <div class="comment-text">
                                                                    <p>This is a reply test …</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container">
            <div class="relate-product">
                <div class="heading-wrapper text-center">
                    <h3 class="heading">Sản phẩm tương tự</h3>
                </div>
                <div class="row main">
                    <div class="row product-grid-equal-height-wrapper product-equal-height-4-columns flex multi-row">
                        @foreach($relatedProducts as $product)
                            <figure class="item" style="margin-top: 30px">
                                <div class="product product-style-1">
                                    <div class="img-wrapper">
                                        <a href="{{ route('product-list.detail', ['id' => $product->id]) }}">
                                            <img style="height:280px"  src="{{( 'storage/'.$product->image) }}"  alt="product thumbnail" />
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
                                    <figcaption class="desc text-center" >
                                        <h3>
                                            <a class="product-name" href="product-detail.html">{{$product->name}}</a>
                                        </h3>
                                        <span class="price">Giá: {{ CurrencyHelper::format($product->selling_price) }}</span>
                                    </figcaption>
                                </div>
                            </figure>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
