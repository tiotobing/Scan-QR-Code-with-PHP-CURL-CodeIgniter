<script type="text/javascript">
  $(document).ready(function(){
    $('.date i').click(function(){
      $(this).parent().find('input').click();
    });
    updateConfig();

    function updateConfig(){
      var options = {};
      options.opens = "center";
      options.ranges = {
        'Today' : [moment(), moment()],
        'Yesterday' : [moment().subtract(1,'days'),moment().subtract(1,'days')],
        'Last Month' : [moment().subtract(1,'month').startOf('month'),moment().subtract(1,'month').endOf('month')]
      };

      $('#config-demo').daterangepicker(options, function(start, end, label){
          var startDate = start.format('YYYY-MM-DD'); var endDate = end.format('YYYY-MM-DD');
          passDate(startDate,endDate);
        });
      }
  });

  function passDate(startDate,endDate){
    $('.loader').show();
    $.ajax({
        type: 'POST',
        url: 'date-filteration.php',
        date: 'startDate='+startDate+'&endDate='+endDate,
    })
    .done(function(data){
        $('.loader').hide();

        $('.response').html(data);
    });
  }

    
</script>