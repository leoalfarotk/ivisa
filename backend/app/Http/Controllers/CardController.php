<?php

namespace App\Http\Controllers;

use App\Card;
use App\Helpers\Detector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function all()
    {
        $cards = Card::where('user_id', Auth::user()->id)->get();

        $cards->transform(function ($item) {
            $number = $item->number;
            $number = substr($number, 4);

            for ($i = 0; $i < 8; ++$i) {
                $number[$i] = '*';
            }

            $number = wordwrap($number, 4, ' ', true);

            $item->number = $number;

            return $item;
        });

        return response()->json(['cards' => $cards]);
    }

    public function save(Request $request)
    {
        $detector = new Detector();

        $provider = $detector->detect($request->card_number);
        $provider_id = null;

        switch ($provider) {
            case 'Visa':
                $provider_id = 1;
                break;
            case 'MasterCard':
                $provider_id = 2;
                break;
            case 'Amex':
                $provider_id = 3;
                break;
            default:
                $provider_id = 0;
        }

        $new_card = new Card;
        $new_card->user_id = Auth::user()->id;
        $new_card->name = $request->name_on_card;
        $new_card->number = $request->card_number;
        $new_card->provider_id = $request->provider_id;
        $new_card->exp_month = $request->exp_month;
        $new_card->exp_year = $request->exp_year;
        $new_card->provider_id = $provider_id;
        $new_card->is_default = false;

        $new_card->save();


        return response()->json([
            'card_id' => $new_card->id,
            'provider_id' => $new_card->provider_id,
        ]);
    }

    public function setAsDefault(Request $request)
    {
        $card_id = $request->card_id;

        if (!Card::where('user_id', Auth::user()->id)->exists($card_id)) {
            return response()->json(['success' => false]);
        }

        DB::table('cards')
            ->where('user_id', Auth::user()->id)
            ->update(['is_default' => false]);

        $updated_rows = DB::table('cards')
            ->where('user_id', Auth::user()->id)
            ->where('id', $card_id)
            ->update(['is_default' => true]);

        if ($updated_rows === 1) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function delete(Request $request)
    {
        $card_id = $request->card_id;

        if (!Card::where('user_id', Auth::user()->id)->exists($card_id)) {
            return response()->json(['success' => false]);
        }

        $deleted_rows = DB::table('cards')
            ->where('id', $card_id)
            ->delete();

        if ($deleted_rows === 1) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
