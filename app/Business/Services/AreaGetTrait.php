<?php


namespace App\Business\Services;

/**
 * Trait AreaGetTrait
 * エリア取得トレイト
 *
 * @package App\Business\Services
 */
trait AreaGetTrait
{
    //キー：各都道府県コード
    public function getAreaList(){
        return [
            'A' => '◆北海道・東北',
            '1' => '北海道',
            '2' => '青森県',
            '3' => '岩手県',
            '4' => '宮城県',
            '5' => '秋田県',
            '6' => '山形県',
            '7' => '福島県',
            'B' => '◆関東',
            '8' => '茨城県',
            '9' => '栃木県',
            '10' => '群馬県',
            '11' => '埼玉県',
            '12' => '千葉県',
            '13' => '東京都',
            '14' => '神奈川県',
            'C' => '◆東海・中部',
            '15' => '新潟県',
            '16' => '富山県',
            '17' => '石川県',
            '18' => '福井県',
            '19' => '山梨県',
            '20' => '長野県',
            '21' => '岐阜県',
            '22' => '静岡県',
            '23' => '愛知県',
            '24' => '三重県',
            'D' => '◆近畿',
            '25' => '滋賀県',
            '26' => '京都府',
            '27' => '大阪府',
            '28' => '兵庫県',
            '29' => '奈良県',
            '30' => '和歌山県',
            'E' => '◆中国・四国',
            '31' => '鳥取県',
            '32' => '島根県',
            '33' => '岡山県',
            '34' => '広島県',
            '35' => '山口県',
            '36' => '徳島県',
            '37' => '香川県',
            '38' => '愛媛県',
            '39' => '高知県',
            'F' => '◆九州・沖縄',
            '40' => '福岡県',
            '41' => '佐賀県',
            '42' => '長崎県',
            '43' => '熊本県',
            '44' => '大分県',
            '45' => '宮崎県',
            '46' => '鹿児島県',
            '47' => '沖縄県',
        ];
    }

    public function AreaChange($areaNumber){
        if ($areaNumber == 'A'){
            return '1,2,3,4,5,6,7';
        }elseif($areaNumber == 'B'){
            return '8,9,10,11,12,13,14';
        }elseif($areaNumber == 'C'){
            return '15,16,17,18,19,20,21,22,23,24';
        }elseif ($areaNumber == 'D'){
            return '25,26,27,28,29,30';
        }elseif ($areaNumber == 'E'){
            return '31,32,33,34,35,36,37,38,39';
        }elseif ($areaNumber == 'F'){
            return '40,41,42,43,44,45,46,47';
        }else{
            return $areaNumber;
        }
    }
}