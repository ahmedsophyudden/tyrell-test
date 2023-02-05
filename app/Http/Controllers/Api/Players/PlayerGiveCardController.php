<?php

namespace App\Http\Controllers\Api\Players;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constants\CardSuit;

class PlayerGiveCardController extends Controller
{
    public function execute(Request $request)
    {
        $total_player = $request->total_player;
        
        $listOfCards = $this->generateCards();

        shuffle($listOfCards);

        return $this->givePlayerCards($total_player, $listOfCards);
    }

    private function generateCards()
    {
        $listOfCards = [];
        foreach (CardSuit::LIST as $cardSuit) {
            for ($i = 1; $i <= 13; $i++) {
                $card = $cardSuit['shortname'] . "-";

                switch ($i) {
                    case 1:
                        $card .= 'A';
                        break;
                    case 10:
                        $card .= 'X';
                        break;
                    case 11:
                        $card .= 'J';
                        break;
                    case 12:
                        $card .= 'Q';
                        break;
                    case 13:
                        $card .= 'K';
                        break;
                    default:
                        $card .= $i;
                }

                $listOfCards[] = $card;
            }
        }
        return $listOfCards;
    }

    private function givePlayerCards($total_player, $listOfCards)
    {
        $playerWithCards = [];

        $currentPlayer = 1;

        foreach($listOfCards as $card){
            $key = $currentPlayer - 1;

            if(!isset($playerWithCards[$key])){
                $playerWithCards[$key] = [
                    'no' => $currentPlayer,
                    'cards' => [],
                    'string_cards' => ''
                ];
            }

            $playerWithCards[$key]['cards'][] = $card;
            $playerWithCards[$key]['string_cards'] = implode(',', $playerWithCards[$key]['cards']);

            $currentPlayer++;
            if($currentPlayer > $total_player){
                $currentPlayer = 1;
            }
        }

        return $playerWithCards;
    }
}
