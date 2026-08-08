<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    
    public function purchase(Request $request)
    {
        //リクエストから必要なデータを取得する
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        //product_idを基に購入された商品情報を取得
        $product = Product::find($product_id);

        //購入個数が在庫を上回る場合、処理終了
        if ($quantity > $product->stock) {
            return response()->json(['message' => '在庫が不足しています。'], 400);
        }

            //トランスアクション開始
        DB::beginTransaction();
        try {
            //購入情報を注文テーブルに追加
            $sale = Order::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);
            //商品の在庫を購入個数分減らす
            $product->decrement('stock', $quantity);
            //DB更新処理実行
            DB::commit();
        } catch (\Exception $e) {
            //try内処理でエラーが発生した場合
            DB::rollBack();
            //DB更新処理ロールバック後、エラーメッセージを返却
            return response()->json(['message' => '購入処理に失敗しました。'], 500);
        }
        //try内処理が成功した場合、成功メッセージを返却
        return response()->json(['message' => '購入処理が完了しました。', 'order' => $sale], 201);
    }
}
