@extends('client.layouts.app')

@section('content')


    <section class="sub-header shop-detail-1">
        <img class="rellax bg-overlay" src="client/images/sub-header/013.jpg" alt="">
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">Shop Cart</h3>
    </section>
    <hr>
    <section class="boxed-sm">
        <div class="container">
            @if ($carts->count() > 0)
                <div class="woocommerce">
                    <form class="woocommerce-cart-form">
                        <table class="woocommerce-cart-table">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Sản phẩm</th>
                                <th class="product-name"></th>
                                <th class="product-price">Giá </th>
                                <th class="product-quantity">Số lượng</th>
                                <th class="product-subtotal">Tổng tiền</th>
                                <th class="product-remove"></th>
                            </tr>
                            </thead>
                            <tbody>
                          @foreach($carts as $item)
                              <tr>
                                  <form  hidden id="formUpdateCart" action="{{ route('cart-update') }}" method="POST" id="update-qty">
                                      @csrf
                                      @method('PUT')
                                      <td class="product-thumbnail">
                                          <img style="height: 70px; width: 70px" src="{{ 'storage/'. $item->product->image }}">
                                      </td>
                                      <td class="product-name" data-title="Product">
                                          <a class="product-name" >{{$item->product->name}}</a>
                                      </td>
                                      <td class="product-price" data-title="Price">{{ CurrencyHelper::format($item->product->selling_price) }}</td>
                                      <td class="cart-product-quantity" >
                                          @if($item->product->stock > $item->quantity)
                                              <div class="input-group mb-3 flex" style="max-width: 120px;">
                                                  <div class="input-group-prepend p-2">
                                                      <button data-dec-product-id="{{ $item->id }}" id="decrease" class="decrease " type="button">&minus;</button>
                                                  </div>
                                                  <input type="text" class="text-center p-2" style="width: 60px" name="quantity" value="{{ $item->quantity }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                                  <div class="input-group-append p-2">
                                                      <button data-inc-product-id="{{ $item->id }}" id="increase" class="increase " type="button">&plus;</button>
                                                  </div>
                                              </div>
                                          @else
                                              <span>Out of stock</span>
                                          @endif
                                          </td>
                                      <td class="product-subtotal" data-title="Total">{{ CurrencyHelper::format($item->product->selling_price*$item->quantity) }}</td>
                                      <td class="product-remove">

                                          <a  href="{{ route('cart.destroy', ['id' => $item->id]) }}" style="cursor: pointer" class="remove" aria-label="Remove this item">×</a>
                                      </td>
                                  </form>
                              </tr>
                          @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">
                                    <div class="form-coupon organic-form">
                                        <div class="form-group update-cart">
                                            <a class="btn btn-brand-ghost pill">CHECK OUT</a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            </tfoot>
                        </table>
                    </form>
                    <hr>

                </div>
            @else
                <div class="woocommerce" style="margin-bottom: 30px">
                    <h3 class="text-center">Không có sản phẩm nào.</h3>
                </div>
            @endif
        </div>
    </section>

    <script type="text/javascript">
        $('.increase').on('click', function(e) {
            e.preventDefault()

            let url = $('#formUpdateCart').attr('action');
            let id = $(this).data('inc-product-id');

            $.ajax({
                url: url,
                method: 'PUT',
                data: {
                    id: id,
                    type: 'inc',
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    location.reload()
                },
                error: function (error) {
                    console.log(error)
                }
            })
        });
    </script>

    <script type="text/javascript">
        $('.decrease').on('click', function(e) {
            e.preventDefault()

            let url = $('#formUpdateCart').attr('action');
            let id = $(this).data('dec-product-id');

            $.ajax({
                url: url,
                method: 'PUT',
                data: {
                    id: id,
                    type: 'dec',
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    location.reload()
                },
                error: function (error) {
                    console.log(error)
                }
            })
        });
    </script>
@endsection

