<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan ke keranjang!',
            'cart_count' => count($cart)
        ]);
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return response()->json([
            'message' => 'Produk berhasil dihapus!',
            'cart_count' => count($cart)
        ]);
    }

    public function updateCart(Request $request)
    {
        $cart = Session::get('cart', []);
        $id = $request->id;
        $quantity = $request->quantity;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }

        return response()->json([
            'message' => 'Keranjang diperbarui!',
            'cart_total' => number_format($this->getCartTotal($cart), 0, ',', '.')
        ]);
    }

    private function getCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
