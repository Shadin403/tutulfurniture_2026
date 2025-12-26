<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    public function add_to_wishlist($id)
    {

        $product = Product::find($id);
        $product_details = $product->productDetail;

        if ($product_details->discount_price) {
            $price = $product_details->discount_price;
        } else {
            $price = $product_details->regular_price;
        }
        Cart::instance('wishlist')->add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $price, 'options' => ['image' => $product->image, 'slug' => $product->slug,]])
            ->associate('App\Models\Product');
        return response()->json(
            [
                'wishlistCount' => Cart::instance('wishlist')->count(),
                'message' => 'Added to wishlist.'
            ]

        );
    }

    public function remove_by_product_id($id)
    {

        $wishlist = Cart::instance('wishlist')->content();
        $item = $wishlist->where('id', $id)->first();

        if ($item) {
            Cart::instance('wishlist')->remove($item->rowId);
            return response()->json([
                'wishlistCount' => Cart::instance('wishlist')->count(),
                'message' => 'Removed from wishlist.'
            ]);
        }

        return response()->json([
            'wishlistCount' => Cart::instance('wishlist')->count(),
            'message' => 'Item not found in wishlist.'
        ], 404);
    }


    public function add_to_cart($id)
    {
        $product = Product::find($id);
        $product_details = $product->productDetail;

        if ($product_details->discount_price) {
            $price = $product_details->discount_price;
        } else {
            $price = $product_details->regular_price;
        }
        Cart::instance('cart')->add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $price, 'options' => ['image' => $product->image, 'slug' => $product->slug,]])
            ->associate('App\Models\Product');
        return response()->json(
            [
                'cartCount' => Cart::instance('cart')->count(),
                'message' => 'Added to cart.'
            ]

        );
    }
}
