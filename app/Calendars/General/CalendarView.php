<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');//予約確認画面で表示されている年月
  }

  function render(){
    $html = [];//予約画面上部で表示されている1週間
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();//getWeeks()メソッドを取得
    foreach($weeks as $week){//対象月が何週間あるか
      $html[] = '<tr class="'.$week->getClassName().'">';//繰り返し処理されている1枠分のクラス名？

      $days = $week->getDays();//1週間から日付を取得
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");//月初の初め日付を定義
        $toDay = $this->carbon->copy()->format("Y-m-d");//今日の日付を定義

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){//今日より過去か未来か？、、
          $html[] = '<td class="calendar-td" style="background:#D3D3D3">';//過去スタイルを変更し、薄い灰色に。
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';//未来
        }
        $html[] = $day->render();//繰り返されたひとつひとつをレンダーで表示している。
        //ここまででカレンダーの記述は完了。

        if(in_array($day->everyDay(), $day->authReserveDay())){//毎日かつ自分が予約している日
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;//自分がその日何部で予約しているのか
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){//予約している過去日薄く予約してたやつを出す。
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{//予約している未来日
            $html[] = '<button type="submit" class="js-modal-open p-0 w-75" name="delete_date" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }else if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){//予約していない過去日
          $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px" value="">受付終了</p>';
        }else{//予約していない未来日。
          $html[] = $day->selectPart($day->everyDay());
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}

//2月は何週間あるの？→5週間で巣となった場合、$weeksは5回繰り返しされる。
//$weeksを繰り返ししているので、$weeks as $weekで繰り返す。
//1週間は7日なので、繰り返している週の中に7日で入ってくる。
//