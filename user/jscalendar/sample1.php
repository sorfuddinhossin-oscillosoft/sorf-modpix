<html style="background-color: buttonface; color: buttontext;">

<head>
<meta http-equiv="content-type" content="text/xml; charset=utf-8" />

<title>Simple calendar setups [popup calendar]</title>

  <!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendar-setup.js"></script>

</head>

<body>

<h2>&nbsp;</h2>

<form action="#" method="get">
<input type="text" name="date" id="f_date_a" />
<input type="text" name="date" id="f_calcdate" />
</form>

<script type="text/javascript">
    function catcalc(cal) {
        var date = cal.date;
        var time = date.getTime()
        // use the _other_ field
        var field = document.getElementById("f_calcdate");
        if (field == cal.params.inputField) {
            field = document.getElementById("f_date_a");
            time -= Date.WEEK; // substract one week
        } else {
            time += Date.WEEK; // add one week
        }
        var date2 = new Date(time);
        field.value = date2.print("%Y-%m-%d %H:%M");
    }
    Calendar.setup({
        inputField     :    "f_date_a",   // id of the input field
        ifFormat       :    "%Y-%m-%d %H:%M",       // format of the input field
        showsTime      :    true,
        timeFormat     :    "24",
        onUpdate       :    catcalc
    });
    Calendar.setup({
        inputField     :    "f_calcdate",
        ifFormat       :    "%Y-%m-%d %H:%M",
        showsTime      :    true,
        timeFormat     :    "24",
        onUpdate       :    catcalc
    });
</script>
<form action="#" method="get">
<input type="text" name="date" id="f_date_b" /><button type="reset" id="f_trigger_b">...</button>
</form>

<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_b",      // id of the input field
        ifFormat       :    "%m/%d/%Y %I:%M %p",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>



<hr />

<p>&nbsp;</p>

<form action="#" method="get">
<table cellspacing="0" cellpadding="0" style="border-collapse: collapse"><tr>
 <td><input type="text" name="date" id="f_date_c" readonly="1" /></td>
 <td><img src="img.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" /></td>
</table>
</form>

<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c",     // id of the input field
        ifFormat       :    "%B %e, %Y",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_f",     // id of the input field
        ifFormat       :    "%Y/%d/%m",     // format of the input field (even if hidden, this format will be honored)
        displayArea    :    "show_f",       // ID of the span where the date is to be shown
        daFormat       :    "%A, %B %d, %Y",// format of the displayed date
        align          :    "Tl",           // alignment (defaults to "Bl")
        dateStatusFunc :    function (date) { // disable weekend days (Saturdays == 6 and Subdays == 0)
                              return (date.getDay() == 6 || date.getDay() == 0) ? true : false;
                            }
    });
</script>


</body>
</html>
