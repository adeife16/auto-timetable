<?php  ?>
  <div class="alert-box success"></div>
<div class="alert-box failure"></div>
<div class="alert-box warning"></div>
<script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="node_modules/popper.js/dist/popper.min.js"></script>
<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<?php if ($title=="main"): ?>
	<script type="text/javascript">
		$("#initExam").click(function(event) {
			$.ajax({
				url: 'backend/main.php?init',
				type: 'GET',
				dataType: 'json',
			})
			.done(function(res) {
				if(res.status == 200){
					window.location.replace(	"exam.php?examId="+res.data);
				}
				else if(res.status == 403){
					alert_failure("Exam already taken");
				}
			})
			.fail(function() {
				console.log("error");
			})
			
		});
	</script>
<?php endif ?>

<?php if ($title == "Exam")		: ?>
	<script type="text/javascript" src="js/tabs/javascript/tab.min.js"></script>
	<link rel="stylesheet" type="text/css" href="js/tabs/css/animation-tabs.css">
	<script type="text/javascript" src="js/exam.js"></script>
	<script type="text/javascript" src="ajax/exam.js"></script>
	<script type="text/javascript" language="javascript">
	  $(function(){  
	      var tab = $('.tabsTitle .tabButton'),
	          content= $('.tabsContent .tabContent');


	          tab.filter(':first').addClass("active");


	          content.filter(':first').addClass("active").show();


	          tab.click(function () { 

	              var indis = $(this).index();

	              tab.removeClass('active').eq(indis).addClass("active");

	              content.removeClass("active").hide().eq(indis).addClass("active").show();
	              return false;
	          })

	  });
	</script>
<?php endif ?>
</body>
</html>