@extends('client.layouts.app')
@section('content')
    <section class="sub-header shop-detail-1">
        <img class="rellax bg-overlay" src="client/images/sub-header/014.jpg" alt="">
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">Yêu thích</h3>
    </section>
    <hr>
    <section class="boxed-sm", style="margin-bottom: 30px">
        <div class="container">
            @if ($wishLists->count() > 0)
            <div class="woocommerce">
                <div class="woocommerce-cart-form">
                    <table class="woocommerce-cart-table">
                        <thead>
                        <tr>
                            <th class="product-thumbnail"></th>
                            <th class="product-name">Sản phẩm</th>
                            <th class="product-price">Giá</th>
                            <th class="product-add-to-cart">Thêm vào giỏ hàng </th>
                            <th class="product-remove">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wishLists as $wishList)
                            <tr>
                                <td class="product-thumbnail">
                                    <img src="{{asset( 'storage/'. $wishList->product->image) }}" style="width: 100px; height: 100px">
                                </td>
                                <td class="product-name" data-title="Product">
                                    <a class="product-name" href="product-detail.html">{{ $wishList->product->name }}</a>
                                </td>
                                <td class="product-weight" data-title="Weight">{{ CurrencyHelper::format($wishList->product->selling_price) }}</td>
                                <td class="product-add-to-cart">
                                    <form action="{{ route('cart.add-to-cart', ['id' => $wishList->product_id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="qty">
                                    <button class="btn btn-brand " type="submit">Thêm vào giỏ hàng</button>
                                    </form>
                                </td>
                                <td class="product-remove text-right">
                                    <a class="remove" href="{{ route('product-wishlist.destroy', ['id' => $wishList->id]) }}" aria-label="Remove this item">×</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
            @else
                <div class="woocommerce" style="margin-bottom: 30px">
                    <h3 class="text-center">Không có sản phẩm yêu thích nào.</h3>
                </div>
            @endif
        </div>
    </section>
@endsection
