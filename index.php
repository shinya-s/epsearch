<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
</head>
<body>
  <form method="post" id="search">
    <input name="birth01" type="number" id="changeYear" value="1997" min="1997" max="2021"> 年
    <select name="birth02" id="changeMonth">
      <option value="8" selected="selected">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
    </select> 月
    <select name="birth03" id="changeDay">
      <option value="4" selected="selected">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="24">24</option>
      <option value="25">25</option>
      <option value="26">26</option>
      <option value="27">27</option>
      <option value="28">28</option>
      <option value="29">29</option>
      <option value="30">30</option>
      <option value="31">31</option>
    </select> 日
    <button id="submit" formaction="/epsearch/episode?year=1997&month=08&day=04" type="submit">検索</button>
  </form>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script>
     window.addEventListener( "pageshow", function ( event ) {
      var historyTraversal = event.persisted || 
      ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
      if ( historyTraversal ) {
        // Handle page restore.
        window.location.reload();
      }
    });
    function formSetDate(){
      var lastday = formSetLastDay($('#changeYear').val(), $('#changeMonth').val());
      formSetLoop(1, lastday, '#changeDay');
      if($('#changeYear').val() == 2021){
        formSetLoop(1, 1, '#changeMonth');
        formSetLoop(1, 4, '#changeDay');
      }else if($('#changeYear').val() == 1997){
        formSetLoop(8, 12, '#changeMonth');
        if($('#changeMonth').val() == 8){
          formSetLoop(4, lastday, '#changeDay');
        }
      }else{
        formSetLoop(1, 12, '#changeMonth');
        formSetLoop(1, lastday, '#changeDay');
      }
    }
    function formSetLoop(start, last, target){
      var option = '';
      for (var i = start; i <= last; i++) {
        if (i == $(target).val()){
          option += '<option value="' + i + '" selected="selected">' + i + '</option>\n';
        }else{
          option += '<option value="' + i + '">' + i + '</option>\n';
        }
      }
      $(target).html(option);
    }
    function formSetLastDay(year, month){
      var lastday = new Array('', 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
      if ((year % 4 === 0 && year % 100 !== 0) || year % 400 === 0){
        lastday[2] = 29;
      }
      return lastday[month];
    }
    $(function() {
      var addYear = $('#changeYear').val();
      var addMonth = ( '00' + $('#changeMonth').val() ).slice(-2);
      var addDay = ( '00' + $('#changeDay').val() ).slice(-2);
      $('#changeYear, #changeMonth, #changeDay').on('input', function() {
        formSetDate();
        var value = $(this).val();
        if($(this).is('#changeYear')){
          if( value == 2021 || value == 1997 ){
            var numM = ( '00' + $('#changeMonth').val() ).slice(-2);
            var numD = ( '00' + $('#changeDay').val() ).slice(-2);
            addMonth = numM;
            addDay = numD;
          }
          addYear = value;
        }else if($(this).is('#changeMonth')){
          addMonth = ( '00' + value ).slice(-2);
        }else if($(this).is('#changeDay')){
          addDay = ( '00' + value ).slice(-2);
        }
        var url = '/epsearch/episode?year=' + addYear + '&month=' + addMonth + '&day=' + addDay;
        $('#submit').attr('formaction', url);
      });
    });
  </script>
</body>
</html>
